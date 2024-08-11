<?php
// Include the database connection file
include 'db_connection.php';

// Initialize variables for username and password
$username = '';
$password = '';

// Check if the form is submitted with the 'login' button
if (isset($_POST['login']) && $_POST['login'] == 'Login') {

    // Initialize an array to hold error messages
    $errors = array();

    // Retrieve the username, password, and verification code from the POST request
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Encrypt the password using md5
    $vercode = $_POST["vercode"]; // Get the verification code from the POST request

    // Validate the verification code
    if ($vercode == "") {
        $errors[2] = "Please enter your captcha!";
    } else if ($vercode != $_SESSION["vercode"] || $_SESSION["vercode"] == '') {
        $errors[2] = "Verification code not matched, please try again!";
    } else {

        // Escape special characters for use in the SQL query
        $username = $conn->real_escape_string($username);
        $password = $conn->real_escape_string($password);

        // Create an SQL query to check if the username and password exist in the database
        $query1 = "SELECT user_id, user_name, user_type, user_status, password FROM user_details WHERE user_name LIKE '" . $username . "' AND password='" . $password . "'";
        $result = $conn->query($query1);
        $num = mysqli_num_rows($result); // Get the number of rows returned by the query

        // Validate the input fields and store error messages
        if ($username == '') {
            $errors[0] = "Please enter your username.";
        }
        if ($password == '') {
            $errors[1] = "Please enter your password.";
        }

        // If the user is found in the database
        if ($num > 0) {
            $row = $result->fetch_assoc();
            // Check if the account is active
            if ($row['user_status'] == "Active") {
                // If no errors, proceed to set session variables and redirect to the index page
                if (count($errors) == 0) {
                    $_SESSION['user_id'] = $row['user_id'];
                    $_SESSION['user_type'] = $row['user_type'];
                    header('Location: index.php');
                }
            } else {
                // If the account is disabled, show an error message
                $errors[3] = "Account is disabled, please contact Admin office!";
            }
        } else {
            // If the username and password do not exist, show an error message
            $errors[3] = "Username and password do not exist, please try again!";
        }
    }
}
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Login | SRMS - Student Records Management System</title>
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
                                        <p>Sign in to continue to SRMS.</p>
                                    </div>
                                </div>
                                <div class="col-5 align-self-end">
                                    <img src="assets/images/profile-img.png" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="p-2">
                                <form class="form-horizontal" method="post" action="" onsubmit="return validateForm()">

                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control" name="username" id="username"
                                            placeholder="Enter username">
                                        <div style="color: red" id="error_username">
                                            <span><?php if (isset($errors[0]))
                                                echo $errors[0]; ?></span>
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label for="userpassword">Password</label>
                                        <input type="password" class="form-control" name="password" id="userpassword"
                                            placeholder="Enter password">
                                        <div style="color: red" id="error_password">
                                            <span><?php if (isset($errors[1]))
                                                echo $errors[1]; ?></span>
                                        </div>

                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <input type="text" name="vercode" class="form-control"
                                            placeholder="Verfication Code" id="vercode">
                                        <div style="color: red" id="error_vercode">
                                            <span><?php if (isset($errors[2]))
                                                echo $errors[2]; ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group small clearfix">
                                        <label class="checkbox-inline">Verification Code</label>
                                        <img src="captcha.php">
                                    </div>
                            </div>

                            <br>
                            <div style="color: red"><span><?php if (isset($errors[3]))
                                echo $errors[3]; ?></span></div>

                            <div class="mt-3">
                                <button class="btn btn-primary btn-block waves-effect waves-light" name="login"
                                    value="Login" type="submit">Log In</button>
                            </div>

                            <div class="mt-4 text-center">
                                <a href="forgotPassword.php" class="text-muted"><i class="mdi mdi-lock mr-1"></i>
                                    Forgot your password?</a>
                            </div>
                            </form>
                        </div>
                    </div>
                    <div class="mt-5 text-center">
                        <p>Don't have an account ? <a href="signup.php" class="font-weight-medium text-primary"> Signup
                                Now </a> </p>
                        <p>© Copyright <i class="mdi mdi-heart text-danger"></i> Student Records Management System
                            (SRMS)</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function validateForm() {
            var username = document.getElementById("username").value;
            var password = document.getElementById("userpassword").value;
            var vercode = document.getElementById("vercode").value;
            var valid = true;

            if (username == "") {
                document.getElementById("error_username").innerText = "Please enter your username.";
                valid = false;
            } else {
                document.getElementById("error_username").innerText = "";
            }

            if (password == "") {
                document.getElementById("error_password").innerText = "Please enter your password.";
                valid = false;
            } else {
                document.getElementById("error_password").innerText = "";
            }

            if (vercode == "") {
                document.getElementById("error_vercode").innerText = "Please enter the verification code.";
                valid = false;
            } else {
                document.getElementById("error_vercode").innerText = "";
            }

            return valid;
        }
    </script>
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