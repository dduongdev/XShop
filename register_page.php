<?php
require_once './php/dbconnect.php';

session_start();

// Function to check if the username exists
function checkUsernameExists($_conn, $username)
{
    $stmt = $_conn->prepare("SELECT * FROM users WHERE user_name = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    return $result->num_rows > 0; // Return true if the username exists
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve user input (ensure proper sanitization and validation)
    $username = $_POST['username'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    if ($_conn->connect_error) {
        die("Connection failed: " . $_conn->connect_error);
    }

    // Validate input (add more comprehensive validation in a real-world scenario)
    $error_message = "";
    if (empty($username) || empty($password) || empty($confirmPassword)) {
        $error_message = "Please fill in all fields.";
    } elseif ($password !== $confirmPassword) {
        $error_message = "Passwords do not match.";
    } elseif (checkUsernameExists($_conn, $username)) {
        $error_message = "Tên đăng nhập đã tồn tại";
    } else {
        // Check if the username already exists
        $stmt = $_conn->prepare("SELECT * FROM users WHERE user_name = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            // Username is available, proceed with registration
            // Hash the password before storing it (use password_hash() in production)
            $hashedPassword = $password; // Replace with actual hashing

            // $stmt = $_conn->prepare("INSERT INTO users (user_name, email, user_password, phone, user_role) VALUES (?, ?, ?, ?, 'customer')");
            // $stmt->bind_param("ssss", $username, $email, $hashedPassword, $phone);
            $stmt = $_conn->prepare("INSERT INTO users (user_name, email, user_password, phone, user_role, fullname) VALUES (?, ?, ?, ?, 'customer', ?)");
            $stmt->bind_param("sssss", $username, $email, $hashedPassword, $phone, $fullname); // Bind fullname to the query

            if ($stmt->execute()) {
                // Successful registration
                $success_message = "Registration successful.";
                // Redirect to the homepage (index.php)
                header("Location: login_page.php");
                exit(); // Ensure the script stops after the redirect
            } else {
                $error_message = "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            $error_message = "Tên đăng nhập đã tồn tại";
        }
    }

    $_conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>X-Shop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="../css/grid.css">
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/register_login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <div class="app">
        <?php include "header.php" ?>
        
        <div class="container">
            <div class="grid wide">
                <div class="register-container">
                    <form class="register-form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                        <h1 class="register-form__heading">Đăng ký</h1>
                        <?php
                        if (isset($error_message)) {
                            echo '<div class="error-message">' . $error_message . '</div>';
                        } elseif (isset($success_message)) {
                            echo '<div class="success-message">' . $success_message . '</div>';
                        }
                        ?>
                        <div class="register-form__input-box">
                            <input type="text" name="username" placeholder="Tên đăng nhập" required>
                        </div>

                        <div class="register-form__input-box">
                            <input type="text" name="fullname" placeholder="Tên của bạn" required>
                        </div>

                        <div class="register-form__input-box">
                            <input type="email" name="email" placeholder="Email của bạn" required>
                        </div>

                        <div class="register-form__input-box">
                            <input type="text" name="phone" placeholder="SĐT của bạn" required>
                        </div>

                        <div class="register-form__input-box">
                            <input type="password" name="password" placeholder="Mật khẩu" required>
                        </div>

                        <div class="register-form__input-box">
                            <input type="password" name="confirm_password" placeholder="Nhập lại mật khẩu" required>
                        </div>

                        <button type="submit" class="register_form__btn">Đăng ký</button>

                        <div class="register-form__link-box">
                            <p>Bạn đã có tài khoản? <a href="login_page.php">Đăng nhập</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <?php include "footer.php" ?>
    </div>
</body>

</html>