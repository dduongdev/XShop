<?php
    require_once './php/dbconnect.php';

    session_start();

    if(!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin'){
        header("HTTP/1.0 404 Not Found");
        echo "Page not found";
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>

    <!-- Montserrat font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="./css/list_users.css">
    <link rel="stylesheet" href="./css/dashboard.css">

</head>
<body>
    <div class="grid-container">
        <?php include 'toast.php'; ?>
        <?php include 'dashboard_sidebar.php'; ?>

        <main class="main-container">
            <div class="container">
                <h2>User List</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Phone</th>
                            <th>Full Name</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                            $sql = "SELECT id, user_name, email, user_password, phone, fullname, user_role FROM users";
                            $result = $_conn->query($sql);

                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr>
                                            <td>" . htmlspecialchars($row["user_name"]) . "</td>
                                            <td>" . htmlspecialchars($row["email"]) . "</td>
                                            <td>" . htmlspecialchars($row["user_password"]) . "</td>
                                            <td>" . htmlspecialchars($row["phone"]) . "</td>
                                            <td>" . htmlspecialchars($row["fullname"]) . "</td>
                                            <td>" . htmlspecialchars($row["user_role"]) . "</td>
                                            <td><button onclick='editUser(" . $row["id"] . ")'>Edit</button></td>
                                          </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='7'>No users found</td></tr>";
                            }
                            $_conn->close();
                        ?>
                    </tbody>
                </table>

                <!-- Edit Form -->
                <div id="editForm" style="display: none;">
                    <h2>Edit User</h2>
                    <form id="editUserForm">
                        <input type="hidden" name="id" id="editUserId">
                        <div class="form-column">
                            <div>
                                <label for="editUserName">Username:</label>
                                <input type="text" name="user_name" id="editUserName" required>
                            </div>
                            <div>
                                <label for="editEmail">Email:</label>
                                <input type="email" name="email" id="editEmail" required>
                            </div>
                            <div>
                                <label for="editPassword">Password:</label>
                                <input type="password" name="user_password" id="editPassword" required>
                            </div>
                        </div>
                        <div class="form-column">
                            <div>
                                <label for="editPhone">Phone:</label>
                                <input type="text" name="phone" id="editPhone" required>
                            </div>
                            <div>
                                <label for="editFullName">Full Name:</label>
                                <input type="text" name="fullname" id="editFullName" required>
                            </div>
                            <div>
                                <label for="editUserRole">Role:</label>
                                <select name="user_role" id="editUserRole" required>
                                    <option value="admin">Admin</option>
                                    <option value="customer">Customer</option>
                                </select>
                            </div>
                        </div>
                        <button type="button" onclick="submitEditForm()">Save</button>
                    </form>
                </div>

                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script src="./js/toast.js"></script> <!-- Include your toast.js file -->

                <script>
                    function submitEditForm() {
                        var form = document.getElementById('editUserForm');
                        var formData = new FormData(form);

                        fetch('php/ajax_update_user.php', {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                toast({
                                    title: 'Update Successful',
                                    message: 'User information has been updated.',
                                    type: 'success'
                                });

                                // Update the user row in the table without reloading
                                updateTableRow(formData);

                                // Hide the edit form on success
                                document.getElementById('editForm').style.display = 'none';

                                // Reload the page after a short delay (adjust as needed)
                                setTimeout(() => {
                                    location.reload();
                                }, 1000); // Reload after 1 second (1000 milliseconds)
                            } else {
                                toast({
                                    title: 'Update Failed',
                                    message: 'Error: ' + data.message,
                                    type: 'danger'
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            toast({
                                title: 'Update Failed',
                                message: 'An unexpected error occurred.',
                                type: 'danger'
                            });
                        });
                    }

                    function updateTableRow(formData) {
                        const id = formData.get('id');
                        const user_name = formData.get('user_name');
                        const email = formData.get('email');
                        const user_password = formData.get('user_password');
                        const phone = formData.get('phone');
                        const fullname = formData.get('fullname');
                        const user_role = formData.get('user_role');

                        // Find the existing row and update its contents
                        const table = document.querySelector('table tbody');
                        const row = table.querySelector(`tr[data-id="${id}"]`);
                        if (row) {
                            row.cells[0].textContent = user_name;
                            row.cells[1].textContent = email;
                            row.cells[2].textContent = user_password;
                            row.cells[3].textContent = phone;
                            row.cells[4].textContent = fullname;
                            row.cells[5].textContent = user_role;
                        } else {
                            console.error(`Row with ID ${id} not found.`);
                        }

                        // Log for debugging
                        console.log(`Updated row with ID ${id}`);
                    }

                    function editUser(id) {
                        // Fetch user data using AJAX
                        fetch('get_user.php?id=' + id)
                            .then(response => response.json())
                            .then(data => {
                                document.getElementById('editUserId').value = data.id;
                                document.getElementById('editUserName').value = data.user_name;
                                document.getElementById('editEmail').value = data.email;
                                document.getElementById('editPassword').value = data.user_password;
                                document.getElementById('editPhone').value = data.phone;
                                document.getElementById('editFullName').value = data.fullname;
                                document.getElementById('editUserRole').value = data.user_role;

                                document.getElementById('editForm').style.display = 'block';
                            });
                    }
                </script>
            </div>
        </main>
    </div>
</body>
</html>
