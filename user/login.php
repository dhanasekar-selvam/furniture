<?php
include("./header/header.php");
include("../db/db.php");
?>

<body>
    <?php
    if (isset($_POST['login-submit'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result);


        if ($row['email'] == $email) {
            if ($row['password'] != $password) {
                echo '<script>
            toastr.error("Invalid Password");
            </script>';
            } else {

                $_SESSION['email'] = $email;

                echo '<script>
            toastr.success("Login successfully");
            </script>';
                if ($row['usrtype'] == 'admin') {
                    header("Location: admin/index.php");
                } else if ($row['usrtype'] == 'user') {
                    header("Location: user/index.php");
                }
    ?>
                <script>
                    setTimeout(function() {
                        window.location.href = 'index.php';
                    }, 2000);
                </script>
    <?php
            }
        } else {
            echo '<script>
            toastr.error("Invalid Credentials");
            </script>';
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
                                <h2 class="mb-2">Sign In</h2>
                                <p>To Keep connected with us please login with your personal info.</p>
                                <form method="POST" action="">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="mb-0">Email</label>
                                                <input class="form-control" type="email" name="email" placeholder=" ">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="mb-0">Password</label>
                                                <input class="form-control" type="password" name="password" value="" id="myInput">
                                            </div>
                                        </div>


                                        <!-- An element to toggle between password visibility -->
                                        <div class="col-lg-6">
                                            <input type="checkbox" onclick="myFunction()"> Show Password

                                        </div>
                                        <div class="col-lg-6">
                                            <a href="forgot.php" style="color:red" class="float-right ">Forgot Password?</a>
                                        </div>
                                    </div><br>
                                    <button type="submit" class="btn btn-warning btn-lg" name="login-submit">Sign In</button>
                                    <p class="mt-3">
                                        Create an Account <a href="signup.php" class="text-primary">Sign Up</a>
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
            var x = document.getElementById("myInput");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
</body>

</html>