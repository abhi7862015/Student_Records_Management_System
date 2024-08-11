<?php
// Include the database connection file
include 'db_connection.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not logged in
    header('Location: login.php');
}

// Logout functionality
if (isset($_GET['logout'])) {
    // Unset the user session and redirect to the login page
    unset($_SESSION['user_id']);
    header('Location: login.php');
}

// Initialize variables
$first_name = '';
$middle_name = '';
$last_name = '';
$email = '';
$Gender = '';
$Status = '';
$Class = '';
$Subject = '';
$Marks = '';

// Check if the form is submitted
if (isset($_POST['submit']) && $_POST['submit'] == 'Submit') {

    // Get form data
    $first_name = $_POST['FirstName'];
    $last_name = $_POST['LastName'];
    $email = $_POST['Email'];
    $Gender = $_POST['Gender'];
    $Status = $_POST['Status'];
    $Class = $_POST['Class'];
    $Subject = $_POST['Subject'];
    $Marks = $_POST['Marks'];

    // Sanitize form data
    $first_name = $conn->real_escape_string($first_name);
    $last_name = $conn->real_escape_string($last_name);
    $email = $conn->real_escape_string($email);
    $Gender = $conn->real_escape_string($Gender);
    $Status = $conn->real_escape_string($Status);
    $Class = $conn->real_escape_string($Class);
    $Subject = $conn->real_escape_string($Subject);
    $Marks = $conn->real_escape_string($Marks);

    // Check if the email already exists in the database
    $query1 = "SELECT id FROM student_details WHERE email='" . $email . "'";
    $result1 = $conn->query($query1);
    $num1 = mysqli_num_rows($result1);

    // If the email exists, update the existing record
    if ($num1 > 0) {
        $query1 = "UPDATE student_details SET first_name='$first_name', last_name='$last_name', email='$email', gender='$Gender', status='$Status', class='$Class', subject='$Subject', marks='$Marks', last_updated_date=CURRENT_TIMESTAMP WHERE email='$email'";
        if ($conn->query($query1)) {
            // Set success message for updating existing record
            $_SESSION['student_success'] = "Student Already Exists, Data Updated Successfully!";
        }
    } else {
        // If the email does not exist, insert a new record
        $query1 = "INSERT INTO student_details (first_name, last_name, email, gender, status, class, subject, marks)
                   VALUES('$first_name', '$last_name', '$email', '$Gender', '$Status', '$Class', '$Subject', '$Marks')";
        $conn->query($query1);
        if ($conn->affected_rows) {
            // Set success message for inserting new record
            $_SESSION['student_success'] = "Data Inserted Successfully!";
        }
    }
} else {
    // Set failure message for technical error
    $_SESSION['student_failure'] = "Technical Error!";
}

// Redirect to the student list page
header("Location: studentList.php");
exit();
