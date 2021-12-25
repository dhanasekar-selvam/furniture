<?php
session_start();
ob_start();
?>


<?php
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
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-12">
                    <div class="login-card">
                        <div>
                            <div><a class="logo" href="index.html"><img class="img-fluid for-light" src="../assets/images/logo/login.png" alt="looginpage"><img class="img-fluid for-dark" src="../assets/images/logo/logo_dark.png" alt="looginpage"></a></div>
                            <div class="login-main">
                                <h4>Reset Your Password</h4>
                                <form method="POST" action="">

                                    <div class="form-group">
                                        <label class="col-form-label">Enter Your Email</label>
                                        <div class="row">

                                            <div class="col-8 col-sm-9">
                                                <input class="form-control mb-1" type="email" name="email" value="<?php echo $_SESSION ? $_SESSION['email'] : '' ?> " required>
                                            </div>
                                            <div class="col-4 col-sm-3">
                                                <button class="btn btn-primary btn-block  " type="submit" name="send">Send</button>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="mt-4 mb-4"><span class="reset-password-link">If don't receive OTP?  <button class="btn btn-danger" type="submit" name="send">Resend</button></span></div>

                                </form>
                                <form class=" theme-form" method="POST" action="">

                                    <div class="form-group">
                                        <label class="col-form-label pt-0">Enter OTP</label>
                                        <div class="col">
                                            <input class="form-control text-center " type="text" name="otp" maxlength="4">
                                        </div>

                                    </div>

                                    <button class="btn btn-primary btn-block w-100" type="submit" name="done">Verify </button>
                            </div>
                            <p class="mt-4 mb-0 text-center">Already have an password?<a class="ms-2" href="login.php">Sign in</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    include("./header/script.php");
    ?>
    </div>



</body>

</html>