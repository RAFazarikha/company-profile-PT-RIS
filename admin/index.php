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
<?php include 'component/head.php'; ?>
<body>
    <!--====== SIGNIN ONE PART START ======-->
    <section class="signin-area signin-one">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <form action="" method="post">
                <div class="signin-form form-style-two rounded-buttons">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-input">
                            <label>
                                Your Username
                            </label>
                            <div class="input-items default">
                                <input type="text" name="username" placeholder="Username" />
                                <i class="lni lni-user"></i>
                            </div>
                            </div>
                            <!-- form input -->
                        </div>
                        <div class="col-md-12">
                            <div class="form-input">
                            <label>Your Password</label>
                            <div class="input-items default">
                                <input type="password" name="password" placeholder="Password" />
                                <i class="lni lni-key"></i>
                            </div>
                            </div>
                            <!-- form input -->
                        </div>
                        <div class="col-md-6">
                            <div class="form-input rounded-buttons">
                            <button
                                class="btn primary-btn rounded-full"
                                type="submit" name="login"
                                >
                            Login
                            </button>
                            </div>
                            <!-- form input -->
                        </div>
                        <div class="col-md-12">
                            <div class="form-input text-center">
                            <p class="text">
                                By signing in you agree with the
                                <a href="javascript:void(0)">Terms and Conditions</a>
                                and
                                <a href="javascript:void(0)">Privacy</a>
                            </p>
                            </div>
                            <!-- form input -->
                        </div>
                    </div>
                </div>
                <!-- signin form -->
                </form>
            </div>
        </div>
        <!-- row -->
    </div>
    <!-- container -->
    </section>
    <!--====== SIGNIN ONE PART ENDS ======-->
</body>
</html>