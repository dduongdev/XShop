<?php
    session_start();

    // Database Connection
    $server = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'xshop_ver4';

    $conn = new mysqli($server, $username, $password, $database);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if(isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $query = "select count(user_name) as test from users where user_name='$username' and user_password='$password'";
        $result = $conn->query($query);
        $count = $result->fetch_assoc();
        $count = $count['test'];
        echo $count;
        if($count > 0) {
            echo "Login successful";
            header("Location: index.php");
        } else {
            echo "Login Not Successful";
        }
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
    <link rel="stylesheet" href="./css/grid.css">
    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/register_login.css">
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
                <div class="login-container">
                    <form class="login-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <h1 class="login-form__heading">Đăng nhập</h1>
                        <?php 
                            if (isset($error_message)) {
                                echo '<div class="error-message">' . $error_message . '</div>';
                            }
                        ?>
                        <div class="login-form__input-box">
                            <input type="text" name="username" placeholder="Tên đăng nhập" required>
                        </div>

                        <div class="login-form__input-box">
                            <input type="password" name="password" placeholder="Mật khẩu" required>
                        </div>

                        <div class="login-form__forgot-password-box">
                            <a href="#">Quên mật khẩu?</a>
                        </div>

                        <button type="submit" name="save" class="login-form__btn">Đăng nhập</button>

                        <div class="login-form__link-box">
                            <p>Bạn chưa có tài khoản? <a href="register_page.php">Đăng ký</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php include "footer.php" ?>
    </div>
</body>

</html>