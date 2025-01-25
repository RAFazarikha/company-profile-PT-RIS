<?php
// Memulai session
session_start();

// Proses login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require '../config/database.php';
    require 'models/User.php';

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $userModel = new User($db);
    $user = $userModel->authenticate($username, $password);

    if ($user) {
        // Set session jika login berhasil
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        // Redirect berdasarkan peran
        if ($user['role'] === 'admin') {
            header("Location: views/dashboard.php");
        } exit();
    } else {
        $error = "Username atau password salah.";
    }
}

// Jika sudah login, redirect ke dashboard
if (isset($_SESSION['user_id'])) {
    if ($_SESSION['role'] === 'admin') {
        header("Location: views/dashboard.php");
    } exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PT RIS</title>
    <!-- Link ke CSS Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />
</head>
<body class="login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>Admin</b> PT RIS</a>
        </div><!-- /.login-logo -->

        <div class="login-box-body">
            <p class="login-box-msg">Log In to start your session</p>
            
            <!-- Menampilkan pesan error jika ada -->
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            
            <!-- Form Login -->
            <form action="" method="post">

                <!-- Field Username -->
                <div class="form-group has-feedback">
                    <input type="text" name="username" class="form-control" placeholder="Username" required />
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>

                <!-- Field Password -->
                <div class="form-group has-feedback">
                    <input type="password" name="password" class="form-control" placeholder="Password" required />
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>

                <!-- Tombol Login -->
                <div class="row">
                    <div class="col-xs-8"></div><!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Log In</button>
                    </div><!-- /.col -->
                </div>
            </form>
        </div><!-- /.login-box-body -->
        <br>
        <a href="../index.php">Go to PT.RIS</a>
    </div><!-- /.login-box -->

    <!-- jQuery -->
    <script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- iCheck JS -->
    <script src="plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    
    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
</body>
</html>
