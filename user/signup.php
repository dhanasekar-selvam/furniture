<?php
include("./header/header.php");
?>

<body>

    <?php
    include '../db/db.php';

    if (isset($_POST['create-account'])) {

        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $password = $_POST['login']['password'];
        $cpassword = $_POST['cpassword'];
        $role = $_POST['role'];
        if ($password == $cpassword) {
            $sql = "Select Count(*) as user From users Where email='" . $email . "'";
            $query = mysqli_query($con, $sql);
            $row = mysqli_fetch_array($query);
            if ($row['user'] == 1) {
                echo '<script>
                toastr.error("Email already exists", "Error");
                </script>';
            } else {
                $sql = "INSERT INTO users (f_name, l_name,email,password, usrtype) VALUES ('$fname', '$lname', '$email', '$password','$role')";
                $result = mysqli_query($con, $sql);
                if ($result) {
                    echo "<script>toastr.success('Signup successfully');</script>";
    ?>
                    <script>
                        setTimeout(function() {
                            window.location.href = 'login.php';
                        }, 2000);
                    </script>
    <?php
                } else {
                    echo "<script>toastr.error('Signup Failed');</script>";
                }
            }
        } else {
            echo "<script>toastr.error('Password not match');</script>";
        }
    }
    ?>


    <!-- login page start-->
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-xl-5"><img class="bg-img-cover bg-center" src="../assets/images/customimg/signup3.jpeg" alt="looginpage"></div>
            <div class="col-xl-7 p-0">
                <div class="login-card">
                    <div>
                        <div><a class="logo" href="index.html"><img class="img-fluid for-light" src="../assets/images/customimg/furniture_logo_default.png" alt="looginpage"><img class="img-fluid for-dark" src="../assets/images/logo/logo_dark.png" alt="looginpage"></a></div>
                        <div class="login-main">
                            <form class="theme-form" method="POST" action="">
                                <h4>Create your account</h4>
                                <p>Enter your personal details to create account</p>
                                <div class="form-group">
                                    <label class="col-form-label pt-0">Your Name</label>
                                    <div class="row g-2">
                                        <div class="col-6">
                                            <input class="form-control" type="text" required="" name="fname" placeholder="First name" value="<?php echo $_SERVER['REQUEST_METHOD'] === 'POST' ? $_POST['fname'] : '' ?>">
                                        </div>
                                        <div class="col-6">
                                            <input class="form-control" type="text" required="" name="lname" placeholder="Last name" value="<?php echo $_SERVER['REQUEST_METHOD'] === 'POST' ? $_POST['lname'] : '' ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Email Address</label>
                                    <input class="form-control" type="email" required="" placeholder="Your Email Address" name="email" value="<?php echo $_SERVER['REQUEST_METHOD'] === 'POST' ? $_POST['email'] : '' ?>">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Password</label>
                                    <div class="form-input position-relative">
                                        <input class="form-control" type="password" name="login[password]" required="" placeholder="*********">
                                        <div class="show-hide"><span class="show"></span></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Confirm Password</label>
                                    <div class="form-input position-relative">
                                        <input class="form-control" type="password" name="cpassword" required="" placeholder="*********">
                                    </div>

                                </div>
                                <input type="hidden" name="role" value="user">

                                <div class="form-group mb-0">

                                    <button class="btn btn-primary btn-block w-100" type="submit" name="create-account">Create Account</button>
                                </div>
                                <p class="mt-4 mb-0 text-center">Already have an account?<a class="ms-2" href="login.php">Sign in</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            include('./header/script.php');
            ?>
        </div>
</body>

</html>