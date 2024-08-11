<?php
include 'db_connection.php';

$first_name = '';
$middle_name = '';
$last_name = '';
$email = '';
$username = '';
$password = '';
$confirm_password = '';
$user_type = '';
$user_status = '';
$phone = '';

if (isset($_POST['submit']) && $_POST['submit'] == 'Submit') {

    $errors = array();

    $first_name = $_POST['FirstName'];
    $middle_name = $_POST['MiddleName'];
    $last_name = $_POST['LastName'];
    $email = $_POST['Email'];
    $username = $_POST['UserName'];
    $password = $_POST['Password'];
    $confirm_password = $_POST['ConfirmPassword'];
    $user_type = $_POST['UserType'];
    $user_status = $_POST['Status'];
    $phone = $_POST['phone'];

    if ($first_name == '') {
        $errors[0] = "Please enter your firstname.";
    } else if (!ctype_alpha($first_name)) {
        $errors[0] = "Please enter only alphabets.";
    }

    if ($middle_name == '') {
        $errors[1] = "Please enter your middle_name.";
    } else if (!ctype_alpha($middle_name)) {
        $errors[1] = "Please enter only alphabets.";
    }

    if ($last_name == '') {
        $errors[2] = "Please enter your last_name.";
    } else if (!ctype_alpha($last_name)) {
        $errors[2] = "Please enter only alphabets.";
    }

    $email = $conn->real_escape_string($email);
    $query1 = "select user_id from user_details where email='" . $email . "'";
    $result1 = $conn->query($query1);
    $num1 = mysqli_num_rows($result1);

    if ($email == '') {
        $errors[3] = "Please enter your email.";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[3] = "Please enter a valid email.";
    } else if ($num1 > 0) {
        $errors[3] = "Email already exists, please try again!";
    }

    $username = $conn->real_escape_string($username);
    $query2 = "select user_id from user_details where user_name='" . $username . "'";
    $result2 = $conn->query($query2);
    $num2 = mysqli_num_rows($result2);

    if ($username == '') {
        $errors[4] = "Please create your username";
    } else if ($num2 > 0) {
        $errors[4] = "Username already exists, please try again!";
    }

    if ($password == '') {
        $errors[5] = "Please create your password.";
    } else if (strlen($password) < 5) {
        $errors[5] = "Password length should be greater than 5";
    }

    if ($confirm_password == '') {
        $errors[6] = "Please re-enter your password.";
    } else if ($password != $confirm_password) {
        $errors[6] = "Password not matched, please try again!";
    }

    if ($user_type == '') {
        $errors[7] = "Please select the type of user.";
    }

    if ($user_status == '') {
        $errors[8] = "Please select user status";
    }

    $query3 = "select user_id from user_details where user_phone=" . $phone;
    $result3 = $conn->query($query3);
    if ($result3) {
        $num3 = mysqli_num_rows($result3);
    } else {
        $num3 = 0;
    }

    if ($phone == '') {
        $errors[9] = "Please enter your mobile number";
    } else if ($num3 > 0) {
        $errors[9] = "Mobile number already exists, please try again!";
    }


    if (count($errors) == 0) {

        $first_name = $conn->real_escape_string($first_name);
        $middle_name = $conn->real_escape_string($middle_name);
        $last_name = $conn->real_escape_string($last_name);
        $password = $conn->real_escape_string($password);
        $user_type = $conn->real_escape_string($user_type);
        $user_status = $conn->real_escape_string($user_status);

        $query1 = "Insert into user_details (first_name, middle_name, last_name, email, user_name, password, user_type, user_status, user_phone)
                    values('" . $first_name . "','" . $middle_name . "','" . $last_name . "','" . $email . "','" . $username . "','" . md5($password) . "','" . $user_type . "','" . $user_status . "','" . $phone . "')";
        $conn->query($query1);
        if ($conn->affected_rows) {
            $success = "Data Inserted successfully!";
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
                            <form class="validateJs" method="post" action="signup.php">
                                <div class="row" style="align-items: center; padding:20px 40px;">

                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="Email">Email<em>*</em></label>
                                            <input type="email" class="form-control" id="Email" name="Email" value='<?php if (isset($email))
                                                echo $email; ?>' placeholder="" data-rule-mandatory="true">
                                            <div style="color: red" id="ForgotEmail"></div>

                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="UserName">OTP<em>*</em></label>
                                            <input type="text" class="form-control" id="UserName" name="UserName" placeholder="Enter Your OTP Number" data-rule-mandatory="true">
                                            <div style="color: red" id="ForgotOTP"></div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12 mt-4 text-right">
                                        <button type="submit" name="submit" value="Submit" class="btn btn-primary mb-2 mt-1">Forgot Password</button>
                                        <a href="login.php"><button type="button" class="btn btn-secondary ml-2 mb-2 mt-1">Cancel</button></a>
                                    </div>
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