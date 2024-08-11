<?php
include "header.php";

//Uploading CSV file 
if (isset($_POST['upload_csv_button'])) {
    $file_name = $_FILES['upload_csv']['name'];
    $file_size = $_FILES['upload_csv']['size'];
    $file_tmp = $_FILES['upload_csv']['tmp_name'];
    $file_type = $_FILES['upload_csv']['type'];

    $count = 1;
    $errors = '';

    if ($file_size > 1) {

        if (move_uploaded_file($file_tmp, "temp_file/" . $file_name)) {
            $file = fopen("temp_file/" . $file_name, "r");

            $all_userId = array();
            $query3 = "select user_id from user_details";
            $result3 = $conn->query($query3);
            if (mysqli_num_rows($result3) > 0) {
                while ($rows3 = $result3->fetch_assoc()) {
                    $all_userId[] = $rows3['user_id'];
                }
            }
            
        if ($file) {
                while (!feof($file)) {
                    $CSVContent = fgetcsv($file);

                    // Started fetching data from 2nd row of CSV file.
                    if ($count > 1) {
                        $userId = $conn->real_escape_string(trim($CSVContent[0] ?? ""));
                        $first_name = $conn->real_escape_string(trim($CSVContent[1] ?? ""));
                        $middle_name = $conn->real_escape_string(trim($CSVContent[2] ?? ""));
                        $last_name = $conn->real_escape_string(trim($CSVContent[3] ?? ""));
                        $email = $conn->real_escape_string(trim($CSVContent[4] ?? ""));
                        $user_name = $conn->real_escape_string(trim($CSVContent[5] ?? ""));
                        $user_type = $conn->real_escape_string(trim($CSVContent[6] ?? ""));
                        $user_status = $conn->real_escape_string(trim($CSVContent[7] ?? ""));

                        $errors_array = array();

                        //if user_id is blank then terminate the file.
                        if ($userId != '') {
                            
                            if ($first_name == '') {
                                $errors_array[] = "Please enter your firstname in line no. " . $count . " and column B";
                            } else if (!ctype_alpha($first_name)) {
                                $errors_array[] = "Please enter only alphabets in line no. " . $count . " and column B";
                            }

                            if ($middle_name == '') {
                                $errors_array[] = "Please enter your middle_name in line no. " . $count . " and column C";
                            } else if (!ctype_alpha($middle_name)) {
                                $errors_array[] = "Please enter only alphabets in line no. " . $count . " and column C";
                            }

                            if ($last_name == '') {
                                $errors_array[] = "Please enter your last_name in line no. " . $count . " and column D";
                            } else if (!ctype_alpha($last_name)) {
                                $errors_array[] = "Please enter only alphabets in line no. " . $count . " and column D";
                            }

                            //Verify user_name and email that is exist in db or not
                            $query6 = "select user_name, email from user_details where user_id=" . $userId;
                            $result6 = $conn->query($query6);
                            if (mysqli_num_rows($result6) > 0) {
                                $rows6 = $result6->fetch_array();
                            }

                            $query5 = "select user_id from user_details where email='" . $email . "'";
                            $result5 = $conn->query($query5);
                            $num5 = mysqli_num_rows($result5);

                            if ($email == '') {
                                $errors_array[] = "Please enter your email in line no. " . $count . " and column E";
                            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                $errors_array[] = "Please enter a valid email in line no. " . $count . " and column E";
                            } else if ($num5 > 0 && $rows6['email'] != $email) {
                                $errors_array[] = "Email already exists, please try again in line no. " . $count . " and column E";
                            } else if ($num5 > 0 && !in_array($userId, $all_userId)) {
                                $errors_array[] = "Email already exists, please try again in line no. " . $count . " and column E";
                            }

                            $query4 = "select user_id from user_details where user_name='" . $user_name . "'";
                            $result4 = $conn->query($query4);
                            $num4 = mysqli_num_rows($result4);

                            if ($user_name == '') {
                                $errors_array[] = "Please create your username in line no. " . $count . " and column F";
                            } else if ($num4 > 0 && $rows6['user_name'] != $user_name) {
                                $errors_array[] = "Username already exists, please try again in line no. " . $count . " and column F";
                            } else if ($num4 > 0 && !in_array($userId, $all_userId)) {
                                $errors_array[] = "Username already exists, please try again in line no. " . $count . "  and column F";
                            }

                            if ($user_type == '') {
                                $errors_array[] = "Please enter the user type in line no. " . $count . " and column G";
                            } else if ($user_type == "Admin" || $user_type == "Viewer" || $user_type == "Updater") {
                                //do nothing.
                            } else {
                                $errors_array[] = "Please write correct user type (Admin or Viewer or Updater) in line no. " . $count . " and column G";
                            }

                            if ($user_status == '') {
                                $errors_array[] = "Please enter user status in line no. " . $count . " and column H";
                            } else if ($user_status == "Active" || $user_status == "Inactive") {
                                //do nothing
                            } else {
                                $errors_array[] = "Please write correct user status (Active or Inactive) in line no. " . $count . " and column H";
                            }

                            //if error count is zero then update or insert data acccordingly
                            if (count($errors_array) == 0) {
                                if (!in_array($userId, $all_userId)) {
                                    $query2 = "Insert into user_details (user_id, first_name, middle_name, last_name, email, user_name, user_type, user_status) values ('" . $userId . "','" . $first_name . "','" . $middle_name . "','" . $last_name . "','" . $email . "','" . $user_name . "','" . $user_type . "','" . $user_status . "' )";
                                    $conn->query($query2);
                                    if ($conn->affected_rows) {
                                        $success_message = "Data Inserted successfully!";
                                    }
                                } else {
                                    $query2 = "Update user_details set first_name='" . $first_name . "', middle_name='" . $middle_name . "', last_name='" . $last_name . "', email='" . $email . "', user_name='" . $user_name . "', user_type='" . $user_type . "', user_status='" . $user_status . "' where user_id=" . $userId;
                                    $conn->query($query2);
                                    if ($conn->affected_rows) {
                                        $success_message = "Data Updated successfully!";
                                    }
                                }
                            } else {
                                //To print or show all errors here from CSV file.
                                foreach ($errors_array as $k => $v) {
                                    $errors .= $v . "<br>";
                                }
                            }
                        }
                    }
                    //Row count
                    $count++;
                }
                fclose($file);
            } else {
                $errors = "Unable to open file";
            }
        } else {
            $errors = "Error in uploading file.Please try again later";
        }
    } else {
        $errors = $file_type . " Please upload a valid file";
    }
}
?>

<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <div style="margin-top: 1rem; margin-left: 1rem;"><span style="color:red;"><?php if (isset($errors)) echo $errors; ?></span></div>
                        <div style="margin-top: 1rem; margin-left: 1rem;"><span style="color:green;"><?php if (isset($success_message)) echo $success_message; ?></span></div>
                        <h4 class="mb-0 font-size-18">Import User</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                <li class="breadcrumb-item"><a href="userList.php">User List</a></li>
                                <li class="breadcrumb-item active">Import User</li>
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
                            <form class="" method="post" action="" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4">
                                        <label for="districtImport">Import Excel</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="customFile" name="upload_csv" >
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 mt-4">
                                        <button type="submit" name="upload_csv_button" value="Upload CSV" class="btn btn-primary mb-2 mt-1">Submit</button>
                                        <a href="userList.php"><button type="button" class="btn btn-secondary ml-2 mt-1 mb-2">Cancel</button></a>
                                    </div>
                                    <div class="col-lg-4 col-md-4 mt-4 text-right">
                                        <button type="submit" class="btn btn-success mb-2">Download Template</button>
                                    </div>
                                </div>




                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->



        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->


    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    2020 © Copyright.
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-right d-none d-sm-block">
                        Support Email:<a href="#" target="_blank" class="text-muted"> support@frimsassam.com </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
<!-- end main content-->
<?php include "footer.php"; ?>