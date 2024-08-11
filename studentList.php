<?php
include 'header.php';


//To disable account 
if (isset($_GET['account']) && $_GET['account'] == "disabled") {
    $user_id = $conn->real_escape_string($_GET['user_id']);
    $query2 = "Update user_details set user_status='Inactive' where user_id=" . $user_id;
    $conn->query($query2);
    if ($conn->affected_rows) {
        $disabled_success = "User disabled successfully!";
    }
}

//To filter user by thier name  or email  and user type and user status.
$all_filter = '';
$search_status = '';
$search_cond = '';
$status_cond = '';
$searched = '';
$user_status = '';

if (isset($_GET['submit']) && $_GET['submit'] == "Submit") {
    $searched = $conn->real_escape_string($_GET['search']);
    $user_status = $conn->real_escape_string($_GET['userStatus']);

    if (isset($searched) && isset($user_status) && $searched != '' && $user_status != '') {
        $all_filter = " Where (first_name like '" . $searched . "%' or email like'" . $searched . "%') and status='" . $user_status . "'";
    } else if (isset($searched) && isset($user_status) && $searched != '' && $user_status != '') {
        $search_status = " Where (first_name like '" . $searched . "%' or email like'" . $searched . "%') and status='" . $user_status . "'";
    } else if (isset($searched) && $searched != '') {
        $search_cond = " where (first_name like '" . $searched . "%' or email like'" . $searched . "%')";
    } else if (isset($user_status) && $user_status != '') {
        $status_cond = " where status='" . $user_status . "'";
    }
}

//Fetched all data from user details table
$query1 = "select * from student_details " . $all_filter . $search_status  . $search_cond . $status_cond;
$result = $conn->query($query1);

?>
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
            <div style="margin-top: 1rem; margin-left: 1rem;"><span style="color:green;"><?php if (isset($disabled_success)) echo $disabled_success;
                                                                                            ?></span></div>
            <div style="margin-top: 1rem; margin-left: 2rem;"><span style="color:green; font-weight:bold; font-size:20px;"><?php if (isset($_SESSION['student_success'])) echo $_SESSION['student_success'];
                                                                                                                            unset($_SESSION['student_success']) ?></span></div>
            <div style="margin-top: 1rem; margin-left: 2rem;"><span style="color:red; font-weight:bold; font-size:20px;"><?php if (isset($_SESSION['student_failure'])) echo $_SESSION['student_failure'];
                                                                                                                            unset($_SESSION['student_failure']) ?></span></div>
            <br>
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">

                        <h4 class="mb-0 font-size-18">Student List</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                <li class="breadcrumb-item active">Student List</li>
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
                            <h5 class="card-title mb-4">Filter</h5>

                            <form class="" method="get" action=''>
                                <div class="row">
                                    <div class="col-lg-4 col-md-4">

                                        <label class="sr-only" for="inlineFormSearchl2">Search Student</label>
                                        <div class="input-group mb-2 mr-sm-3">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="mdi mdi-magnify"></i></div>
                                            </div>
                                            <input type="text" class="form-control" name="search" id="inlineFormSearchl2" value="<?php if (isset($searched)) echo $searched; ?>" placeholder="Search student by name or email">
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-4">
                                        <select class="form-control" id="circleVillage" name="userStatus">
                                            <option value="">Select User Status</option>
                                            <option value="Active" <?php if (isset($user_status) && $user_status == "Active") echo 'selected'; ?>>Active</option>
                                            <option value="Inactive" <?php if (isset($user_status) && $user_status == "Inactive") echo 'selected'; ?>>Inactive</option>
                                        </select>
                                    </div>

                                    <div class="col-lg-4 col-md-4 text-right">
                                        <button type="submit" name="submit" value="Submit" class="btn btn-primary mb-2">Submit</button>
                                        <button type="submit" name="reset" value="Reset" class="btn btn-secondary ml-2 mb-2">Reset</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->


            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="TableHeader">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <h4 class="card-title">Student List</h4>
                                    </div>
                                    <div class="col-lg-9 text-right">
                                        <div class="headerButtons">
                                            <a href="importStudent.php" class="btn btn-sm btn-primary mr-2"><i class="mdi mdi-cloud-download"></i> Import</a>
                                            <a href="export.php?export=student" target="_blank" class="btn btn-sm btn-warning mr-2"><i class="mdi mdi-share"></i> Export</a>
                                            <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#addStudent"><i class="mdi mdi-plus"></i> Add</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table mb-0 listingData dt-responsive" id="datatable">
                                    <thead>
                                        <tr>
                                            <th>S. No.</th>
                                            <th>Student ID</th>
                                            <th>Full Name</th>
                                            <th>Email</th>
                                            <th>Gender</th>
                                            <th>Class</th>
                                            <th>All Subjects</th>
                                            <th>All Marks</th>
                                            <th>Status</th>
                                            <th>Last Update</th>
                                            <th>Created</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        //To list user details
                                        if (mysqli_num_rows($result) > 0) {
                                            $count = 1;
                                            while ($rows = $result->fetch_assoc()) {
                                                $id=$rows['id'];
                                        ?>
                                                <tr>
                                                    <th scope="row"><?php echo $count; ?></th>
                                                    <th scope="row"><?php echo $id; ?></th>
                                                    <td><?php echo $rows['first_name'] . " " . $rows['last_name']; ?></td>
                                                    <td><?php echo $rows['email']; ?></td>
                                                    <td><?php echo $rows['gender']; ?></td>
                                                    <td><?php echo $rows['class']; ?></td>
                                                    <td><?php echo $rows['subject']; ?></td>
                                                    <td><?php echo $rows['marks']; ?></td>
                                                    <td><span class="<?php if ($rows['status'] == "Active") echo 'badge badge-pill badge-success';
                                                                        else echo 'badge badge-pill badge-danger'; ?>"><?php echo $rows['status']; ?></span></td>

                                                    <td><?php echo $rows['last_updated_date']; ?></td>
                                                    <td><?php echo $rows['created_date']; ?></td>
                                                    <td>
                                                        <?php if (isset($_SESSION['user_type']) && ($_SESSION['user_type'] != 'Parent' || $_SESSION['user_type'] != 'Student')) { ?>
                                                            <a href="editStudent.php?user_id=<?php echo $rows['user_id']; ?>" class="text-primary mr-2"><i class="mdi mdi-pencil"></i></a>
                                                        <?php } else { ?>
                                                            <a href="#" id="editBtnClick" class="text-primary mr-2"><i class="mdi mdi-pencil"></i></a>
                                                        <?php } ?>
                                                        <?php if (isset($_SESSION['user_type']) && ($_SESSION['user_type'] != 'Parent' || $_SESSION['user_type'] != 'Student')) { ?>
                                                            <a href="disabledStudent.php?account=disabled&user_id=<?php echo $rows['user_id']; ?>" class="text-danger"><i class="mdi mdi-circle-off-outline"></i></a>
                                                        <?php } else { ?>
                                                            <a href="#" id="disableBtnClick" class="text-danger"><i class="mdi mdi-circle-off-outline"></i></a>
                                                        <?php } ?>
                                                        <?php if (isset($_SESSION['user_type']) && ($_SESSION['user_type'] != 'Parent' || $_SESSION['user_type'] != 'Student')) { ?>
                                                            <a href="studentdelete.php?account=delete&user_id=<?php echo $rows['user_id']; ?>" class="text-secondary"><span><?php echo '&nbsp'.'&nbsp'; ?></span><i class="mdi mdi-delete"></i></a>
                                                        <?php } else { ?>
                                                            <a href="#" id="disableBtnClick" class="text-secondary"><span><?php echo '&nbsp'; ?></span><i class="mdi mdi-delete">/i></a>
                                                        <?php } ?>
                                                    </td>
                                                </tr>   
                                        <?php
                                                $count++;
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>

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
<script>
    $(document).on('click', '#btnClick', function() {
        alert("Only Admin can add new User");
    });
    $(document).on('click', '#editBtnClick', function() {
        alert("Only Updater can edit/view/add Users details");
    });
    $(document).on('click', '#disableBtnClick', function() {
        alert("Only Admin can Disabled Users");
    });
</Script> -->
<!-- end main content
<?php include 'footer.php'; ?>