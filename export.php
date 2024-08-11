<?php

include 'db_connection.php';


function filterData(&$str)
{
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if (strstr($str, '"'))
        $str = '"' . str_replace('"', '""', $str) . '"';
}

if (isset($_GET['export']) && $_GET['export'] == 1) {

    $filename = "members-data_" . date('y-m-d') . ".csv";
    $fileds = array('User ID', ',', 'First Name', ',', 'Middle Name', ',', 'Last Name', ',', 'User Email', ',', 'Username', ',', 'User Type', ',', 'User Status');
    $excelData = implode("\t", array_values($fileds)) . "\n";

    $query2 = "SELECT user_id, first_name, middle_name, last_name, email, user_name, user_type, user_status FROM user_details";
    $result2 = $conn->query($query2);
    if ($result2->num_rows > 0) {
        while ($row2 = $result2->fetch_assoc()) {
            $lineData = array($row2['user_id'], ',', $row2['first_name'], ',', $row2['middle_name'], ',', $row2['last_name'], ',', $row2['email'], ',', $row2['user_name'], ',', $row2['user_type'], ',', $row2['user_status']);
            array_walk($lineData, 'filterData');
            $excelData .= implode("\t", array_values($lineData)) . "\n";
        }
    } else {
        $exelData .= "No records Found..." . "\n";
    }

    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"$filename\"");
    echo $excelData;
    //    $_SESSION['success'] = "CSV File Download Successfully!";
    exit;
}

if (isset($_GET['export']) && $_GET['export'] == "student") {

    $filename = "members-data_" . date('y-m-d') . ".csv";
    $fileds = array('S.No', ',', 'Student ID,', ',', 'First Name', ',', 'Last Name', ',', 'Email', ',', 'Gender', ',', 'Status', ',', 'Class', ',', 'Subject', ',', 'Marks', ',', 'Last Updated Date', ',', 'Created Date');
    $excelData = implode("\t", array_values($fileds)) . "\n";

    $query2 = "SELECT * FROM student_details";
    $result2 = $conn->query($query2);
    if ($result2->num_rows > 0) {
        $count = 1;
        while ($row2 = $result2->fetch_assoc()) {
            $lineData = array($count, ",", $row2['id'], ',', $row2['first_name'], ',', $row2['last_name'], ',', $row2['email'], ',', $row2['gender'], ',', $row2['status'], ',', $row2['class'], ',', $row2['subject'], ',', $row2['marks'], ',', $row2['last_updated_date'], ',', $row2['created_date']);
            array_walk($lineData, 'filterData');
            $excelData .= implode("\t", array_values($lineData)) . "\n";
            $count++;
        }
    } else {
        $exelData .= "No records Found..." . "\n";
    }

    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"$filename\"");
    echo $excelData;
    // $_SESSION['student_success'] = "CSV File Download Successfully!";
    exit;
}
