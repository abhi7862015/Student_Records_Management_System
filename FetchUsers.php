<?php
include 'db_connection.php';

if (isset($_POST['Fetch']) && isset($_POST['user_type'])) {
    $Fetch_UserType = $_POST['user_type'];

    if ($Fetch_UserType == "Teacher") {
        $TableName = "user_details";
    } else if ($Fetch_UserType == "Student") {
        $TableName = "student_details";
    }
    $query1 = "select * from $TableName";
    $result1 = $conn->query($query1);
    $num1 = mysqli_num_rows($result1);

    if ($num1 > 0) {
        while ($Users = $result1->fetch_assoc()) {

            $id = $Users['id'];
            $first_name = $Users['first_name'];
            $last_name = $Users['last_name'];
            $full_name = $first_name . " " . $last_name;
            $html .= "<option value='$id'>$full_name</option>";
        }

        echo ' <select class="form-control" name="user_id" id="user_id" data-rule-mandatory="true">
                                            <option value="">Select User</option>
                                            ' . $html . '
                                        </select>';
        die;
    }
}

?>