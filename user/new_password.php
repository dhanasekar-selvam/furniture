<?php
session_start();
include("./header/header.php");
include("../db/db.php");
?>

<body>
    <?php
    if (isset($_POST['reset-password'])) {
        if ($_POST['password'] == '' || $_POST['cpassword'] == '') {
            echo '<script>
                toastr.error("Please enter your password", "Error");
                </script>';
        } else {
            if ($_POST['password'] == $_POST['cpassword']) {
                $sql = "UPDATE users SET password='" . $_POST['password'] . "' WHERE email='" . $_SESSION['email'] . "'";
                $result = mysqli_query($con, $sql);
                if ($result) {
                    echo '<script>
                        toastr.success("Password reset successfully");
                        </script>';
                    unset($_SESSION['email']);
                    unset($_SESSION['otp']);

    ?>
                    <script>
                        setTimeout(function() {
                            window.location.href = 'login.php';
                        }, 2000);
                    </script>
    <?php
                } else {
                    echo '<script>
                            toastr.error("Password reset failed");
                            </script>';
                }
            } else {
                echo '<script>
                        toastr.error("Password not match");
                        </script>';
            }
        }
    }


    ?>
    <!-- loader Start -->
    <!-- <div id="loading">
        <div id="loading-center">
        </div>
    </div> -->
    <!-- loader END -->

    <div class="wrapper">
        <section class="login-content">
            <div class="container h-100">
                <div class="row align-items-center justify-content-center h-100">
                    <div class="col-12">
                        <center><img src="../assets/customimg/furniture_logo_default-.png" alt=""></center>

                        <div class="row align-items-center">
                            <div class="col-lg-6">
                                <h2 class="mb-2">New Password</h2>
                                <form method="POST" action="">
                                    <div class="row">

                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="mb-0">Password</label>
                                                <input class="form-control" type="password" name="password" value="" id="password">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="mb-0">Confirm Password</label>
                                                <input class="form-control" type="password" name="cpassword" value="" id="password1">
                                            </div>
                                        </div>


                                        <!-- An element to toggle between password visibility -->
                                        <div class="col-lg-6">
                                            <input type="checkbox" onclick="myFunction()"> Show Password

                                        </div>

                                    </div><br>
                                    <button type="submit" class="btn btn-warning btn-lg" name="reset-password">Reset Password</button>
                                    <p class="mt-3">
                                        Remember Password <a href="auth-sign-up.html" class="text-primary">Sign In</a>
                                    </p>
                                </form>
                            </div>
                            <div class="col-lg-6 mb-lg-0 mb-4 mt-lg-0 mt-4">
                                <img src="../assets/customimg/furnniture.jpg" class="img-fluid w-80" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <?php
    include("./header/script.php");
    ?>
    <script>
        function myFunction() {
            var x = document.getElementById("password");
            var y = document.getElementById("password1");

            if (x.type === "password" && y.type === "password") {
                x.type = "text";
                y.type = "text";
            } else {
                x.type = "password";
                y.type = "password";
            }
        }
    </script>
</body>

</html>