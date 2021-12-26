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
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];
        $phone = $_POST['phone'];
        $role = $_POST['role'];
        if (empty($fname) || empty($lname) || empty($email) || empty($password) || empty($cpassword) || empty($phone) || empty($role)) {
            echo "<script>toastr.error('Please fill all the fields');</script>";
        } else {
            if ($password == $cpassword) {
                $sql = "Select Count(*) as user From users Where email='" . $email . "'";
                $query = mysqli_query($con, $sql);
                $row = mysqli_fetch_array($query);
                if ($row['user'] == 1) {
                    echo '<script>
                toastr.error("Email already exists", "Error");
                </script>';
                } else {
                    $sql = "INSERT INTO users (f_name, l_name,email,password, usrtype,phone) VALUES ('$fname', '$lname', '$email', '$password','$role','$phone')";
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
                                <h2 class="mb-2">Sign Up</h2>
                                <p>Enter your personal details and start journey with us.</p>
                                <form method="POST" action="">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="mb-0">First Name</label>
                                                <input class="form-control" name="fname" type="text" placeholder=" " value="<?php echo $_SERVER['REQUEST_METHOD'] === 'POST' ? $_POST['fname'] : '' ?>">

                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="mb-0">Last Name</label>
                                                <input class="form-control" name="lname" type="text" placeholder=" " value="<?php echo $_SERVER['REQUEST_METHOD'] === 'POST' ? $_POST['lname'] : '' ?>">

                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="mb-0">Email</label>
                                                <input class="form-control" name="email" type="email" placeholder=" " value="<?php echo $_SERVER['REQUEST_METHOD'] === 'POST' ? $_POST['email'] : '' ?>">

                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="mb-0">Phone No.</label>
                                                <input class="form-control" type="text" placeholder=" " name="phone" pattern="[7-9]{1}[0-9]{9}" title="Phone number with 7-9 and remaing 9 digit with 0-9" value="<?php echo $_SERVER['REQUEST_METHOD'] === 'POST' ? $_POST['phone'] : '' ?>">

                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="mb-0">Password</label>
                                                <input class="form-control" type="password" name="password" id="password" placeholder=" ">

                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="mb-0">Confirm Password</label>
                                                <input class="form-control" type="password" name="cpassword" id="password1" placeholder=" ">

                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <input type="checkbox" onclick="myFunction()"> Show Password

                                        </div>
                                    </div>
                                    <input type="hidden" name="role" value="user">
                                    <button type="submit" class="btn btn-warning btn-lg mt-4" name="create-account">Sign Up</button>
                                    <p class="mt-3">
                                        Already have an Account <a href="login.php" class="text-primary">Sign In</a>
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