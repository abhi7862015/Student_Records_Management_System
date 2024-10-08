<?php
include 'header.php';

$first_name = '';
$middle_name = '';
$last_name = '';
$email = '';
$username = '';
$password = '';
$confirm_password = '';
$user_type = '';

if (isset($_POST['submit']) && $_POST['submit'] == 'Submit') {
    if (isset($_GET['user']) && $_GET['user'] == "new") {

        $errors = array();

        $first_name = $_POST['FirstName'];
        $middle_name = $_POST['MiddleName'];
        $last_name = $_POST['LastName'];
        $email = $_POST['Email'];
        $username = $_POST['UserName'];
        $password = $_POST['Password'];
        $confirm_password = $_POST['ConfirmPassword'];
        $user_type = $_POST['UserType'];

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

        if ($user_type != "Admin") {
            $user_status = "Inactive";
        } else {
            $user_status = "Active";
        }


        if (count($errors) == 0) {

            $user_type1 = $user_type;
            $user_status1 = $user_status;
            $first_name = $conn->real_escape_string($first_name);
            $middle_name = $conn->real_escape_string($middle_name);
            $last_name = $conn->real_escape_string($last_name);
            $password = $conn->real_escape_string($password);
            $user_type = $conn->real_escape_string($user_type);
            $user_status = $conn->real_escape_string($user_status);

            $query1 = "Insert into user_details (first_name, middle_name, last_name, email, user_name, password, user_type, user_status)
                    values('" . $first_name . "','" . $middle_name . "','" . $last_name . "','" . $email . "','" . $username . "','" . md5($password) . "','" . $user_type . "','" . $user_status . "')";
            $conn->query($query1);

            if ($conn->affected_rows) {
                $lastInsteredID = $conn->insert_id;
                $success = "Data Inserted successfully!";

                if ($user_type == "Teacher") {
                    $query2 = "INSERT INTO teacher_details (user_id, first_name, last_name, email, status)
                            VALUES($lastInsteredID, '$first_name', '$last_name', '$email', '$user_status')";
                } else if ($user_type == "Student") {
                    $query2 = "INSERT INTO student_details (user_id, first_name, last_name, email, status)
                            VALUES($lastInsteredID, '$first_name', '$last_name', '$email', '$user_status')";
                }
                $conn->query($query2);

                $Failed = "Account is disabled, please wait for Admin's Activation";
            } else {
                $Failed = "Something wrong with database";
            }
        }
    } else if (isset($_GET['user']) && $_GET['user'] == "existing") {
        $errors = array();

        $username = $_POST['UserName'];
        $password = $_POST['Password'];
        $confirm_password = $_POST['ConfirmPassword'];
        $user_type = $_POST['UserType'];
        $user_id = $_POST['user_id'];

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

        if ($user_type != "Admin") {
            $user_status = "Inactive";
        } else {
            $user_status = "Active";
        }


        if (count($errors) == 0) {

            if ($user_type == "Teacher") {
                $TableName = "teacher_details";
            } else if ($user_type == "Student") {
                $TableName = "student_details";
            }
            
            $user_id = $conn->real_escape_string($user_id);
            $query3 = "select * from $TableName where id='" . $user_id . "'";
            $result3 = $conn->query($query3);
            $num3 = mysqli_num_rows($result3);
            if ($num3 > 0) {
                while ($teacher = $result3->fetch_assoc()) {
                    $first_name = $teacher['first_name'];
                    $last_name = $teacher['last_name'];
                    $email = $teacher['email'];
                }
            }

            $user_type1 = $user_type;
            $user_status1 = $user_status;
            $first_name = $conn->real_escape_string($first_name);
            $middle_name = $conn->real_escape_string("");
            $last_name = $conn->real_escape_string($last_name);
            $email = $conn->real_escape_string($email);
            $username = $conn->real_escape_string($username);
            $password = $conn->real_escape_string($password);
            $user_type = $conn->real_escape_string($user_type);
            $user_status = $conn->real_escape_string($user_status);

            $query1 = "Insert into user_details (first_name, middle_name, last_name, email, user_name, password, user_type, user_status)
                    values('" . $first_name . "','" . $middle_name . "','" . $last_name . "','" . $email . "','" . $username . "','" . md5($password) . "','" . $user_type . "','" . $user_status . "')";
            $conn->query($query1);

            if ($conn->affected_rows) {
                $lastInsteredID = $conn->insert_id;
                $success = "Data Inserted successfully!";

                $query2 = "INSERT INTO $TableName (user_id, first_name, last_name, email, status)
                            VALUES($lastInsteredID, '$first_name', '$last_name', '$email', '$user_status')";
                $conn->query($query2);

                $Failed = "Account is disabled, please wait for Admin's Activation";
            } else {
                $Failed = "Something wrong with database";
            }
        }
    } else {
        $Failed = "Something wrong!";
    }
}
?>
<!-- Start Page-content -->
<div class="page-content">
    <div class="container-fluid">

        <div style="margin-top: 1rem; margin-left: 2rem;"><b><span style="color:green;"><?php if (isset($success))
                                                                                            echo $success; ?></span></b>
        </div>
        <div style="margin-top: 1rem; margin-left: 2rem;"><span style="color:red;"><b><?php if (isset($success))
                                                                                            echo $Failed; ?></b></span></div>
        <br>
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">

                    <h4 class="mb-0 font-size-18">Add User</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                            <li class="breadcrumb-item"><a href="userList.php">User</a></li>
                            <li class="breadcrumb-item active">Add User</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <?php
                        if (isset($_GET['user']) && $_GET['user'] == 'new') {
                        ?>
                            <form class="validateJs" method="post" action="addUser.php?user=new">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <label for="FirstName">First Name<em>*</em></label>
                                            <input type="text" class="form-control" id="FirstName" name="FirstName" value='<?php if (isset($first_name))
                                                                                                                                echo $first_name; ?>' placeholder="" data-rule-mandatory="true">
                                            <div style="color: red">
                                                <span><?php if (isset($errors[0]))
                                                            echo $errors[0]; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <label for="MiddleName">Middle Name<em>*</em></label>
                                            <input type="text" class="form-control" id="MiddleName" name="MiddleName" value='<?php if (isset($middle_name))
                                                                                                                                    echo $middle_name; ?>' placeholder="" data-rule-mandatory="true">
                                            <div style="color: red">
                                                <span><?php if (isset($errors[1]))
                                                            echo $errors[1]; ?></span>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <label for="LastName">Last Name<em>*</em></label>
                                            <input type="text" class="form-control" id="LastName" name="LastName" value='<?php if (isset($last_name))
                                                                                                                                echo $last_name; ?>' placeholder="" data-rule-mandatory="true">
                                            <div style="color: red">
                                                <span><?php if (isset($errors[2]))
                                                            echo $errors[2]; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <label for="Email">Email<em>*</em></label>
                                            <input type="email" class="form-control" id="Email" name="Email" value='<?php if (isset($email))
                                                                                                                        echo $email; ?>' placeholder="" data-rule-mandatory="true">
                                            <div style="color: red">
                                                <span><?php if (isset($errors[3]))
                                                            echo $errors[3]; ?></span>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <label for="UserName">User Name<em>*</em></label>
                                            <input type="text" class="form-control" id="UserName" name="UserName" value='<?php if (isset($username))
                                                                                                                                echo $username; ?>' placeholder="" data-rule-mandatory="true">
                                            <div style="color: red">
                                                <span><?php if (isset($errors[4]))
                                                            echo $errors[4]; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <label for="Password">Password<em>*</em></label>
                                            <input type="text" class="form-control" id="Password" name="Password" value='<?php if (isset($password))
                                                                                                                                echo $password; ?>' placeholder="" data-rule-mandatory="true">
                                            <div style="color: red">
                                                <span><?php if (isset($errors[5]))
                                                            echo $errors[5]; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <label for="ConfirmPassword">Confirm Password<em>*</em></label>
                                            <input type="text" class="form-control" id="ConfirmPassword"
                                                name="ConfirmPassword" value='<?php if (isset($confirm_password))
                                                                                    echo $confirm_password; ?>' placeholder=""
                                                data-rule-mandatory="true">
                                            <div style="color: red">
                                                <span><?php if (isset($errors[6]))
                                                            echo $errors[6]; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <label for="UserType">User Type<em>*</em></label>
                                        <select class="form-control" name="UserType" data-rule-mandatory="true">
                                            <option value="">Select User Type</option>
                                            <option value="Admin" <?php if (isset($user_type) && $user_type == 'Admin')
                                                                        echo 'selected'; ?>>Admin</option>
                                            <option value="Teacher" <?php if (isset($user_type) && $user_type == 'Teacher')
                                                                        echo 'selected'; ?>>Teacher</option>
                                            <option value="Parent" <?php if (isset($user_type) && $user_type == 'Parent')
                                                                        echo 'selected'; ?>>Parent</option>
                                            <option value="Student" <?php if (isset($user_type) && $user_type == 'Student')
                                                                        echo 'selected'; ?>>Student</option>
                                        </select>
                                        <div style="color: red">
                                            <span><?php if (isset($errors[7]))
                                                        echo $errors[7]; ?></span>
                                        </div>
                                    </div>

                                    <!-- <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <label for="Status">Status<em>*</em></label>
                                            <select class="form-control" id="Status" name="Status"
                                                data-rule-mandatory="true">
                                                <option value="">Select Status</option>
                                                <option value="Active" <?php if (isset($user_status) && $user_status == "Active")
                                                                            echo 'selected'; ?>>Active</option>
                                                <option value="Inactive" <?php if (isset($user_status) && $user_status == "Inactive")
                                                                                echo 'selected'; ?>>Inactive</option>
                                            </select>
                                            <div style="color: red">
                                                <span><?php if (isset($errors[8]))
                                                            echo $errors[8]; ?></span>
                                            </div>
                                        </div>
                                    </div> -->
                                </div>

                                <div class="col-lg-12 col-md-12 mt-4 text-right">
                                    <button type="submit" name="submit" value="Submit"
                                        class="btn btn-primary mb-2 mt-1">Submit</button>
                                    <a href="userList.php"><button type="button"
                                            class="btn btn-secondary ml-2 mb-2 mt-1">Cancel</button></a>
                                </div>
                            </form>
                        <?php } else { ?>
                            <form class="validateJs" method="post" action="addUser.php?user=existing">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label for="UserName">User Name<em>*</em></label>
                                            <input type="text" class="form-control" id="UserName" name="UserName" value='<?php if (isset($username))
                                                                                                                                echo $username; ?>' placeholder="" data-rule-mandatory="true">
                                            <div style="color: red">
                                                <span><?php if (isset($errors[4]))
                                                            echo $errors[4]; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label for="Password">Password<em>*</em></label>
                                            <input type="text" class="form-control" id="Password" name="Password" value='<?php if (isset($password))
                                                                                                                                echo $password; ?>' placeholder="" data-rule-mandatory="true">
                                            <div style="color: red">
                                                <span><?php if (isset($errors[5]))
                                                            echo $errors[5]; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label for="ConfirmPassword">Confirm Password<em>*</em></label>
                                            <input type="text" class="form-control" id="ConfirmPassword"
                                                name="ConfirmPassword" value='<?php if (isset($confirm_password))
                                                                                    echo $confirm_password; ?>' placeholder=""
                                                data-rule-mandatory="true">
                                            <div style="color: red">
                                                <span><?php if (isset($errors[6]))
                                                            echo $errors[6]; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <label for="existingUserType">User Type<em>*</em></label>
                                        <select class="form-control" name="UserType" id="existingUserType"
                                            data-rule-mandatory="true">
                                            <option value="">Select User Type</option>
                                            <option value="Teacher" <?php if (isset($user_type) && $user_type == 'Teacher')
                                                                        echo 'selected'; ?>>Teacher</option>
                                            <option value="Student" <?php if (isset($user_type) && $user_type == 'Student')
                                                                        echo 'selected'; ?>>Student</option>
                                        </select>
                                        <div style="color: red">
                                            <span><?php if (isset($errors[7]))
                                                        echo $errors[7]; ?></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <label for="user_id">Select User<em>*</em></label>
                                        <select class="form-control" name="user_id" id="user_id" data-rule-mandatory="true">
                                            <option value="">Select User</option>
                                            <option value="">First select user type</option>
                                        </select>
                                        <div style="color: red">
                                            <span><?php if (isset($errors[7]))
                                                        echo $errors[7]; ?></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 mt-4 text-right">
                                    <button type="submit" name="submit" value="Submit"
                                        class="btn btn-primary mb-2 mt-1">Submit</button>
                                    <a href="userList.php"><button type="button"
                                            class="btn btn-secondary ml-2 mb-2 mt-1">Cancel</button></a>
                                </div>
                            </form>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->

    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->

<script>
    $('#existingUserType').on('change', function() {
        var inputValue = $(this).val();
        $.ajax({
            url: 'FetchUsers.php', // Replace with your server endpoint
            type: 'POST',
            data: 'user_type=' + inputValue + '&Fetch=user',
            success: function(response) {
                // Handle the response from the server
                $('#user_id').html(response);
            },
        });
    });
</script>
<?php include 'footer.php'; ?>