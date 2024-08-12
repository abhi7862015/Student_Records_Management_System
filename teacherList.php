<?php
include 'header.php';


//To disable account 
if (isset($_GET['teacher_id']) && $_GET['teacher_id'] != 0) {
    $teacher_id = $conn->real_escape_string($_GET['teacher_id']);

    $query2 = "select * from teacher_details where id=" . $teacher_id;
    $result2 = $conn->query($query2);
    if ($result2->num_rows > 0) {
        while ($User = $result2->fetch_assoc()) {
            $status = $User['status'];
        }
    }

    if (isset($_GET['account']) && $_GET['account'] == "disabled") {

        if ($status == "Active") {
            $NewStatus = "Inactive";
        } else {
            $NewStatus = "Active";
        }
        $query3 = "Update teacher_details set status='$NewStatus' where id=" . $teacher_id;
        $conn->query($query3);
        if ($conn->affected_rows) {
            $disabled_success = "User $teacher_id $NewStatus successfully!";
        }
    } else if (isset($_GET['account']) && $_GET['account'] == "delete") {
        $query4 = "delete from teacher_details where id=" . $teacher_id;
        $conn->query($query4);

        if ($conn->affected_rows) {
            $disabled_success = "User $teacher_id deleted successfully!";
        }
    }
}

//To filter user by thier name  or email  and user type and user status.
$all_filter = '';
$search_status = '';
$search_type = '';
$status_type = '';
$search_cond = '';
$status_cond = '';
$type_cond = '';
$searched = '';
$user_status = '';
$user_type = 'Teacher';

if (isset($_GET['submit']) && $_GET['submit'] == "Submit") {
    $searched = $conn->real_escape_string($_GET['search']);
    $user_status = $conn->real_escape_string($_GET['userStatus']);
    $user_type = $conn->real_escape_string($_GET['userType']);

    if (isset($searched) && isset($user_status) && isset($user_type) && $searched != '' && $user_status != '' && $user_type != '') {
        $all_filter = " Where (first_name like '" . $searched . "%' or email like'" . $searched . "%') and user_status='" . $user_status . "' and user_type='" . $user_type . "'";
    } else if (isset($searched) && isset($user_status) && $searched != '' && $user_status != '') {
        $search_status = " Where (first_name like '" . $searched . "%' or email like'" . $searched . "%') and user_status='" . $user_status . "'";
    } else if (isset($searched) && isset($user_type) && $searched != '' && $user_type != '') {
        $search_type = " Where (first_name like '" . $searched . "%' or email like'" . $searched . "%') and user_type='" . $user_type . "'";
    } else if (isset($user_status) && isset($user_type) && $user_status != '' && $user_type != '') {
        $status_type = " Where user_status='" . $user_status . "' and user_type='" . $user_type . "'";
    } else if (isset($searched) && $searched != '') {
        $search_cond = " where (first_name like '" . $searched . "%' or email like'" . $searched . "%')";
    } else if (isset($user_status) && $user_status != '') {
        $status_cond = " where user_status='" . $user_status . "'";
    } else if (isset($user_type) && $user_type != '') {
        $type_cond = " where user_type='" . $user_type . "'";
    }
} else {
    $type_cond = " where user_type='" . $user_type . "'";
}

//Fetched all data from user details table
$query1 = "select * from teacher_details " . $all_filter . $search_status . $search_type . $status_type . $search_cond . $status_cond;
$result = $conn->query($query1);

?>
<!-- Start Page-content -->
<div class="page-content">
    <div class="container-fluid">
        <div style="margin-top: 1rem; margin-left: 1rem;"><span style="color:green;"><?php if (isset($disabled_success)) echo $disabled_success;
                                                                                        ?></span></div>
        <div style="margin-top: 1rem; margin-left: 2rem;"><span style="color:green;"><?php if (isset($_SESSION['success'])) echo $_SESSION['success'];
                                                                                        unset($_SESSION['success']) ?></span></div>
        <br>
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">

                    <h4 class="mb-0 font-size-18">Teacher List</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                            <li class="breadcrumb-item active">Teacher Circle</li>
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

                                    <label class="sr-only" for="inlineFormSearchl2">Search</label>
                                    <div class="input-group mb-2 mr-sm-3">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="mdi mdi-magnify"></i></div>
                                        </div>
                                        <input type="text" class="form-control" name="search" id="inlineFormSearchl2" value="<?php if (isset($searched)) echo $searched; ?>" placeholder="Search">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4">
                                    <select class="form-control" id="circleVillage" name="userStatus">
                                        <option value="">Select User Status</option>
                                        <option value="Active" <?php if (isset($user_status) && $user_status == "Active") echo 'selected'; ?>>Active</option>
                                        <option value="Inactive" <?php if (isset($user_status) && $user_status == "Inactive") echo 'selected'; ?>>Inactive</option>
                                    </select>
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <select class="form-control" id="circleVillage" name="userType">
                                        <option value="">Select User Type</option>
                                        <option value="Teacher" <?php if (isset($user_type) && $user_type == 'Teacher') echo 'selected'; ?>>Teacher</option>
                                    </select>
                                </div>

                                <div class="col-lg-12 col-md-12 text-right">
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
                                    <h4 class="card-title">Teacher List</h4>
                                </div>
                                <div class="col-lg-9 text-right">
                                    <div class="headerButtons">
                                        <!-- <a href="importUser.php" class="btn btn-sm btn-primary mr-2"><i class="mdi mdi-cloud-download"></i> Import</a> -->
                                        <a href="export.php?export=teacher" target="_blank" class="btn btn-sm btn-warning mr-2"><i class="mdi mdi-share"></i> Export</a>
                                        <?php if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'Admin') { ?>
                                            <a href="addTeacher.php" class="btn btn-sm btn-success "><i class="mdi mdi-plus"></i> Add</a>
                                        <?php } else { ?>
                                            <button id="addBtnClick2" class="btn btn-sm btn-success "><i class="mdi mdi-plus"></i> Add</button>
                                        <?php } ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table mb-0 listingData dt-responsive" id="datatable">
                                <thead>
                                    <tr>
                                        <th>Teacher ID</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Gender</th>
                                        <th>Attended Class</th>
                                        <th>Subject Expertise</th>
                                        <th>Experience</th>
                                        <th>User Account Exits</th>
                                        <th>Status</th>
                                        <th>Last Update</th>
                                        <th>Created</th>
                                        <th width=150>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    //To list user details
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($rows = $result->fetch_assoc()) {
                                    ?>
                                            <tr>
                                                <th scope="row"><?php echo $rows['id']; ?></th>
                                                <td><?php echo $rows['first_name'] . " " . $rows['last_name']; ?></td>
                                                <td><?php echo $rows['email']; ?></td>
                                                <td><?php echo $rows['gender']; ?></td>
                                                <td><?php echo $rows['attended_class']; ?></td>
                                                <td><?php echo $rows['subject_expertise']; ?></td>
                                                <td><?php echo $rows['experience']; ?></td>
                                                <td><?php if ($rows['user_id'] == 0) echo "<span style='color:red'><b>No</b></span>";
                                                    else echo "<span style='color:green'><b>Yes</b></span>";; ?></td>
                                                <td><span class="<?php if ($rows['status'] == "Active") echo 'badge badge-pill badge-success';
                                                                    else echo 'badge badge-pill badge-danger'; ?>" style="width:80px;height:20px;padding-top:5px;"><?php echo $rows['status']; ?></span></td>

                                                <td><?php echo $rows['last_updated_date']; ?></td>
                                                <td><?php echo $rows['created_date']; ?></td>
                                                <td>
                                                    <!-- Update Teacher by teacher/admin -->
                                                    <?php if (isset($_SESSION['user_type']) && ($_SESSION['user_type'] == 'Admin' || $_SESSION['user_type'] == 'Teacher')) { ?>
                                                        <a href="editTeacher.php?teacher_id=<?php echo $rows['id']; ?>" class="text-primary mr-2"><i class="mdi mdi-pencil"></i></a>
                                                    <?php } else { ?>
                                                        <a href="#" id="editBtnClick2" class="text-primary mr-2"><i class="mdi mdi-pencil"></i></a>
                                                    <?php } ?>

                                                    <!-- Disabled Teacher by teacher/admin -->
                                                    <?php if (isset($_SESSION['user_type']) && ($_SESSION['user_type'] == 'Admin' || $_SESSION['user_type'] == 'Teacher')) { ?>
                                                        <a href="teacherList.php?account=disabled&teacher_id=<?php echo $rows['id']; ?>" class="text-danger"><i class="mdi mdi-circle-off-outline"></i></a>
                                                    <?php } else { ?>
                                                        <a href="#" id="disableBtnClick3" class="text-danger"><i class="mdi mdi-circle-off-outline"></i></a>
                                                    <?php } ?>

                                                    <!-- Delete Teacher by teacher/admin-->
                                                    <?php if (isset($_SESSION['user_type']) && ($_SESSION['user_type'] == 'Admin' || $_SESSION['user_type'] == 'Teacher')) { ?>
                                                        <a href="teacherList.php?account=delete&teacher_id=<?php echo $rows['id']; ?>" class="text-secondary"><span><?php echo '&nbsp' . '&nbsp'; ?></span><i class="mdi mdi-delete"></i></a>
                                                    <?php } else { ?>
                                                        <a href="#" id="deleteBtnClick2" class="text-secondary"><span><?php echo '&nbsp'; ?></span><i class="mdi mdi-delete"></i></a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                    <?php
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
<?php include 'footer.php'; ?>