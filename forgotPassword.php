<?php
include 'db_connection.php';


$OTP = '';
$email = '';
$OTP_SENT = 0;
$OTP_VERIFIED = 0;
$OTP_NOT_VERIFIED = 0;
$PASSWORD_CREATED = 0;
if (isset($_POST['submit']) && $_POST['submit'] == 'Submit') {

    $errors = array();

    if (isset($_POST['Email'])) {

        $email = $_POST['Email'];

        $email = $conn->real_escape_string($email);
        $query1 = "select user_id from user_details where email='" . $email . "'";
        $result1 = $conn->query($query1);
        $num1 = mysqli_num_rows($result1);

        if ($email == '') {
            $errors[0] = "Please enter your email ID.";
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[0] = "Please enter a valid email.";
        } else if ($num1 == 0) {
            $errors[0] = "Email does not exists, please try again!";
        }

        if (count($errors) == 0) {

            $email = $conn->real_escape_string($email);

            // Generate a random 6-digit integer
            $randomNumber = rand(100000, 999999);

            $query1 = "update user_details set set_otp=$randomNumber WHERE email='$email'";
            $conn->query($query1);
            if ($conn->affected_rows) {
                $OTP_SENT = 1;
                $_SESSION['ResetPasswordByEmail'] = $email;
                $_SESSION['randomNumber'] = $randomNumber;

                $success = "OTP has been sent successfully, please check your email inbox";
            }
        }
    } else if (isset($_POST['OTP'])) {

        $OTP = $_POST['OTP'];
        if (isset($_SESSION['ResetPasswordByEmail'])) {
            $email = $_SESSION['ResetPasswordByEmail'];
            $randomNumber = $_SESSION['randomNumber'];
        } else {
            $email = "";
            $randomNumber = "";
            $errors[0] = "Session Expired, please try again!";
        }

        if ($email == '') {
            $errors[0] = "Please enter your email ID.";
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[0] = "Please enter a valid email.";
        }



        $OTP = $conn->real_escape_string($OTP);
        $email = $conn->real_escape_string($email);
        $query1 = "select user_id from user_details where email='" . $email . "' AND set_otp='$OTP'";
        $result1 = $conn->query($query1);
        $num1 = mysqli_num_rows($result1);


        if ($OTP == '') {
            $errors[1] = "Please enter your OTP.";
        }
        if ($num1 == 0) {
            $errors[1] = "Incorrect OTP, Please try again!.";
            $OTP_NOT_VERIFIED = 1;
        }

        if (count($errors) == 0) {
            $OTP_VERIFIED = 1;
        }
    } else if (isset($_POST['Password']) || isset($_POST['ConfirmPassword'])) {
        $Password = $_POST['Password'];
        $ConfirmPassword = $_POST['ConfirmPassword'];

        if ($Password == "") {
            $errors[2] = "Please create a new password";
        }
        if ($ConfirmPassword == "") {
            $errors[3] = "Confirm your password";
        } else if ($Password != $ConfirmPassword) {
            $errors[3] = "Password not matched, please try again!";
        }

        if (isset($_SESSION['ResetPasswordByEmail'])) {
            $email = $_SESSION['ResetPasswordByEmail'];
        } else {
            $email = "";
            $errors[3] = "Session Expired, please try again!";
        }

        if (count($errors) == 0) {
            $Password = $conn->real_escape_string($Password);
            $email = $conn->real_escape_string($email);
            $query1 = "update user_details set password='" . md5($Password) . "', set_otp=NULL where email='" . $email . "'";
            $conn->query($query1);

            unset($_SESSION['ResetPasswordByEmail']);
            unset($_SESSION['randomNumber']);
            $OTP_SENT = 0;
            $OTP_VERIFIED = 0;
            $OTP_NOT_VERIFIED = 0;
            $PASSWORD_CREATED = 1;
        }else{
            $OTP_VERIFIED = 1;
        }
    }
} else if (isset($_GET['Resend']) && $_GET['Resend']) {
    if (isset($_SESSION['ResetPasswordByEmail'])) {
        $email = $_SESSION['ResetPasswordByEmail'];
    } else {
        $email = "";
        $errors[1] = "Session Expired, please try again!";
    }

    $email = $conn->real_escape_string($email);
    $query1 = "select user_id from user_details where email='" . $email . "'";
    $result1 = $conn->query($query1);
    $num1 = mysqli_num_rows($result1);

    if ($num1 > 0) {

        $email = $conn->real_escape_string($email);

        // Generate a random 6-digit integer
        $randomNumber = rand(100000, 999999);

        $query1 = "update user_details set set_otp=$randomNumber WHERE email='$email'";
        $conn->query($query1);
        if ($conn->affected_rows) {
            $OTP_SENT = 1;
            $_SESSION['ResetPasswordByEmail'] = $email;
            $_SESSION['randomNumber'] = $randomNumber;
        }
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Signup | SRMS - Student Records Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body>
    <div class="home-btn d-none d-sm-block">
        <a href="index.html" class="text-dark"><i class="fas fa-home h2"></i></a>
    </div>
    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card overflow-hidden">
                        <div class="bg-soft-primary">
                            <div class="row">
                                <div class="col-12">
                                    <div class="text-primary p-4">
                                        <h5 class="text-primary">Welcome Back !</h5>
                                        <p>Sign up to continue to SRMS.</p>
                                    </div>
                                </div>
                                <div class="col-5 align-self-end">
                                    <img src="assets/images/profile-img.png" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <form class="validateJs" method="post" action="">
                                <div style="margin-top: 1rem; margin-left: 1rem;"><b><span style="color:green;"><?php if (isset($success)) echo $success;
                                                                                                                ?></span></b></div>
                                <br>
                                <div class="row" style="align-items: center; padding:20px 40px;">

                                    <?php if ($OTP_SENT == 1 || $OTP_NOT_VERIFIED == 1) { ?>
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <label for="OTP">OTP<em style="color:red;">*</em></label>
                                                <input type="text" class="form-control" id="OTP" name="OTP" placeholder="Enter Your OTP Number" data-rule-mandatory="true">
                                                <div style="color: red" id="ForgotOTP"></div>
                                                <div style="color: red">
                                                    <span><?php if (isset($errors[1]))
                                                                echo $errors[1]; ?></span>
                                                </div>
                                            </div>

                                            <?php if (isset($randomNumber)) { ?>
                                                <span style="color:#460089;text-align:center;">Email is not integrated, therefore showing OTP here, <br><br><b> OTP: <?php echo $randomNumber; ?></b></span>
                                            <?php } ?>
                                            <a href="forgotpassword.php?Resend=otp"><button style="float:right;" type="button" name="button" value="Resend OTP" class="btn btn-success mb-2 mt-1">Resend OTP</button></a>
                                        </div>

                                        <div class="col-lg-12 col-md-12 mt-4 text-right">
                                            <button type="submit" name="submit" value="Submit" class="btn btn-primary mb-2 mt-1">Check OTP</button>
                                            <a href="login.php"><button type="button" class="btn btn-secondary ml-2 mb-2 mt-1">Cancel</button></a>
                                        </div>

                                    <?php } else if ($OTP_VERIFIED == 1) { ?>
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <label for="Password">Password<em style="color:red;">*</em></label>
                                                <input type="password" class="form-control" id="Password" name="Password" value='<?php if (isset($password))
                                                                                                                                        echo $password; ?>' placeholder="Create a New Password">
                                                <div style="color: red">
                                                    <span><?php if (isset($errors[2]))
                                                                echo $errors[2]; ?></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <label for="ConfirmPassword">Confirm Password<em
                                                        style="color:red;">*</em></label>
                                                <input type="password" class="form-control" id="ConfirmPassword"
                                                    name="ConfirmPassword" value='<?php if (isset($confirm_password))
                                                                                        echo $confirm_password; ?>' placeholder="Confirm Your Password">
                                                <div style="color: red">
                                                    <span><?php if (isset($errors[3]))
                                                                echo $errors[3]; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 mt-4 text-right">
                                            <button type="submit" name="submit" value="Submit" class="btn btn-primary mb-2 mt-1">Create</button>
                                            <a href="login.php"><button type="button" class="btn btn-secondary ml-2 mb-2 mt-1">Cancel</button></a>
                                        </div>
                                    <?php } else if ($PASSWORD_CREATED == 1) { ?>
                                        <span class="text-center" style="color:green;text-align:center;"><b>New password has been created successfully!</b></span>

                                        <div class="col-lg-12 col-md-12 mt-4 text-center">
                                            <a href="login.php"><button type="button" class="btn btn-success ml-2 mb-2 mt-1">Login Here</button></a>
                                        </div>
                                    <?php } else { ?>
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <label for="Email">Email<em style="color:red;">*</em></label>
                                                <input type="email" class="form-control" id="Email" name="Email" value='<?php if (isset($email))
                                                                                                                            echo $email; ?>' placeholder="" data-rule-mandatory="true">
                                                <div style="color: red" id="ForgotEmail"></div>
                                                <div style="color: red">
                                                    <span><?php if (isset($errors[0]))
                                                                echo $errors[0]; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 mt-4 text-right">
                                            <button type="submit" name="submit" value="Submit" class="btn btn-primary mb-2 mt-1">Forgot Password</button>
                                            <a href="login.php"><button type="button" class="btn btn-secondary ml-2 mb-2 mt-1">Cancel</button></a>
                                        </div>
                                    <?php } ?>


                                </div>
                                <br>
                                <div style="color: red"><span><?php if (isset($errors[2]))
                                                                    echo $errors[2]; ?></span>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="mt-5 text-center">
                        <p>Want to try again with your password ? <a href="login.php"
                                class="font-weight-medium text-primary">Login</a> </p>
                        <p>© Copyright <i class="mdi mdi-heart text-danger"></i> Student Records Management System
                            (SRMS)</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>
</body>

</html>