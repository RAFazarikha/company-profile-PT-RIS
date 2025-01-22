<?php
    session_start();
    include '../koneksi/koneksi.php';

    if (isset($_POST['login'])) {
        $name = $_POST['username'];
        $password = $_POST['password'];

        // Gunakan prepared statement untuk keamanan
        $sql = "SELECT * FROM admin WHERE username = ? AND password = ?";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("ss", $name, $password); // "ss" untuk dua parameter string
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $_SESSION['username'] = $name;
            $_SESSION['password'] = $password;

            header('Location: dashboard-admin');
            exit();
        } else {
            echo "Gagal login. Username atau password salah.";
        }

        $stmt->close();
    }
?>


<!DOCTYPE html>
<html lang="en">
<?php include 'dashboard-admin/component/head.php'; ?>
<body class="login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="../../index2.html"><b>Admin</b> PT RIS</a>
        </div><!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Log In to start your session</p>
            <form action="" method="post">
            <div class="form-group has-feedback">
                <input type="text" name="username" class="form-control" placeholder="Username"/>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" name="password" class="form-control" placeholder="Password"/>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
                <div class="row">
                    <div class="col-xs-8">                       
                    </div><!-- /.col -->
                    <div class="col-xs-4">
                    <button type="submit" name="login" class="btn btn-primary btn-block btn-flat">Log In</button>
                    </div><!-- /.col -->
                </div>
            </form>

        </div><!-- /.login-box-body -->
        </div><!-- /.login-box -->

        <!-- jQuery 2.1.3 -->
        <script src="../../plugins/jQuery/jQuery-2.1.3.min.js"></script>
        <!-- Bootstrap 3.3.2 JS -->
        <script src="../../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="../../plugins/iCheck/icheck.min.js" type="text/javascript"></script>
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