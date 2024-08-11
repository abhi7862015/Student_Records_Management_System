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

$student_id = $conn->real_escape_string($_GET['student_id']);
$query1 = "select * from student_details where id=" . $student_id;
$result1 = $conn->query($query1);
$num1 = mysqli_num_rows($result1);

if ($num1 > 0) {
    $rows = $result->fetch_assoc();
    $Status = $rows['status'];
    if()
    $Status = $conn->real_escape_string($Status);
    $query1 = "UPDATE student_details SET status='$Status', last_updated_date=CURRENT_TIMESTAMP WHERE id=$student_id";
    if ($conn->query($query1)) {
        // Set success message for updating existing record
        $_SESSION['student_success'] = "Student Id: $student_id has been disabled!";
    }
} 

// Redirect to the student list page
header("Location: studentList.php");
exit();
