<?php
session_start();
ob_start();
include("./header/header.php");
?>

<body>

    <?php
    require_once('./mail/SMTP.php');
    require_once('./mail/PHPMailer.php');
    require_once('./mail/Exception.php');

    use \PHPMailer\PHPMailer\PHPMailer;
    use \PHPMailer\PHPMailer\Exception;

    if (isset($_POST['send'])) {
        if ($_POST['email'] == '') {
            echo '<script>
            toastr.error("Please enter your email address", "Error");
            </script>';
        } else {
            $_SESSION['email'] = $_POST['email'];

            //random number generate
            $gotp = rand(pow(10, 4 - 1), pow(10, 4) - 1);
            $_SESSION["otp"] = $gotp;


            $mail = new PHPMailer(true); // Passing `true` enables exceptions

            try {
                //settings
                $mail->SMTPDebug = 0; // Enable verbose debug output
                $mail->isSMTP(); // Set mailer to use SMTP
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true; // Enable SMTP authentication
                $mail->Username = 'msdhanadon@gmail.com'; // SMTP username
                $mail->Password = '9943258202'; // SMTP password
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;

                $mail->setFrom('admin@gmail.com');

                //recipient
                $mail->addAddress($_POST['email']);     // Add a recipient

                //content
                $mail->isHTML(true); // Set email format to HTML
                $mail->Subject = 'Reset password';
                $mail->Body = '<h1>Reset Password</h1><p>Your otp is : <b>' . $gotp . '</b></p>';
                //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();

                echo "<script>toastr.success('Mail Sent Success');</script>";
            } catch (Exception $e) {
                echo "<script>toastr.error('Message could not be sent.')</script>";

                //echo 'Mailer Error: ' . $mail->ErrorInfo;
            }
        }
    }
    if (isset($_POST['done'])) {
        if ($_POST['otp'] == $_SESSION['otp']) {
            $_SESSION['otp'] = '';
            // echo '<script>toastr.success("Password change success")</script>';
            header("location:new_password.php");
        } else {
            echo '<script>toastr.error("Wrong otp")</script>';
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
                                <h2 class="mb-2">Forgot Password</h2>
                                <p>Enter your email address and we'll send you an email with otp to reset your password.</p>
                                <form method="POST" action="">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group ">
                                                <label class="mb-0">Email</label>
                                                <input type="email" name="email" class="form-control" placeholder="Enter your email" value="<?php echo $_SESSION ? $_SESSION['email'] : '' ?> " required>

                                            </div>
                                            <button type="submit" name="send" class="btn btn-warning">Send</button>
                                            <div class="mt-4 mb-4"><span class="reset-password-link">If don't receive OTP?  <button class="btn btn-danger" type="submit" name="send">Resend</button></span></div>
                                </form>

                            </div>
                            <form method="POST" action="">
                                <div class="col-lg-12 mt-4">
                                    <div class="form-group">
                                        <label class="mb-0">Enter OTP</label>
                                        <input class="form-control text-center " type="text" name="otp" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" maxlength="4">
                                    </div>
                                </div>



                        </div><br>
                        <button class="btn btn-warning btn-block w-100" type="submit" name="done">Verify </button>
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