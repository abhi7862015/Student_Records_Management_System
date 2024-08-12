<?php
include 'header.php';

$student_id = $conn->real_escape_string($_GET['student_id']);
$query2 = "select * from student_details where id=" . $student_id;
$result2 = $conn->query($query2);
if (mysqli_num_rows($result2) > 0) {
    $rows2 = $result2->fetch_assoc();

    $first_name = $rows2['first_name'];
    $last_name = $rows2['last_name'];
    $email = $rows2['email'];
    $Gender = $rows2['gender'];
    $user_status = $rows2['status'];
    $Class = $rows2['class'];
    $Subject = $rows2['subject'];
    $Marks = $rows2['marks'];
}

?>
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">

                        <div style="margin-top: 1rem; margin-left: 2rem;"><span style="color:green;"><?php if (isset($success)) echo $success; ?></span></div>

                        <h4 class="mb-0 font-size-18">Edit Student</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                <li class="breadcrumb-item"><a href="studentList.html">Student</a></li>
                                <li class="breadcrumb-item active">Edit Student</li>
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
                            <form class="validateJs" method="post" action="addStudent.php">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <label for="FirstName">First Name<em>*</em></label>
                                            <input type="text" class="form-control" id="FirstName" name="FirstName" value='<?php if (isset($first_name)) echo $first_name; ?>' placeholder="" data-rule-mandatory="true">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <label for="LastName">Last Name<em>*</em></label>
                                            <input type="text" class="form-control" id="LastName" name="LastName" value='<?php if (isset($last_name)) echo $last_name; ?>' placeholder="" data-rule-mandatory="true">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <label for="Email">Email<em>*</em></label>
                                            <input type="email" class="form-control" id="Email" name="Email" value='<?php if (isset($email)) echo $email; ?>' placeholder="" data-rule-mandatory="true">
                                            <div style="color: red"><span><?php if (isset($errors[3])) echo $errors[3]; ?></span></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <label for="Gender">Gender<em>*</em></label>
                                            <label for="male" style="padding: 10px 20px;">Male
                                                <input type="radio" id="male" name="Gender" value='male' <?php if (isset($Gender) && $Gender=="male") echo "checked" ; ?> data-rule-mandatory="true">
                                            </label>
                                            <label for="female">Female
                                                <input type="radio" id="female" name="Gender" value='female' <?php if (isset($Gender) && $Gender=="female") echo "checked";?> data-rule-mandatory="true">
                                            </label>
                                            <div style="color: red" id="studentgender"></div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <label for="Status">Status<em>*</em></label>
                                            <select class="form-control" id="Status" name="Status" data-rule-mandatory="true">
                                                <option value="">Select Status</option>
                                                <option value="Active" <?php if (isset($user_status) && $user_status == "Active") echo 'selected'; ?>>Active</option>
                                                <option value="Inactive" <?php if (isset($user_status) && $user_status == "Inactive") echo 'selected'; ?>>Inactive</option>
                                            </select>
                                            <div style="color: red"><span><?php if (isset($errors[8])) echo $errors[8]; ?></span></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <label for="class">Class<em>*</em></label>
                                            <input type="text" class="form-control" id="class" name="Class" value='<?php if (isset($Class)) echo $Class; ?>' placeholder="Enter Your Standard" data-rule-mandatory="true">
                                            <div style="color: red" id="studentclass"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <label for="subject">Subject<em>*</em></label>
                                            <select class="form-control" id="subject" name="Subject" data-rule-mandatory="true">
                                                <option value="">Select your subject</option>
                                                <option value="Math" <?php if (isset($Subject) && $Subject == "Math") echo 'selected'; ?> >Math</option>
                                                <option value="Science" <?php if (isset($Subject) && $Subject == "Science") echo 'selected'; ?>>Science</option>
                                                <option value="Social Science" <?php if (isset($Subject) && $Subject == "Social Science") echo 'selected'; ?>>Social Science</option>
                                                <option value="Biology" <?php if (isset($Subject) && $Subject == "Biology") echo 'selected'; ?>>Biology</option>
                                                <option value="Computer" <?php if (isset($Subject) && $Subject == "Computer") echo 'selected'; ?>>Computer</option>
                                                <option value="Hindi" <?php if (isset($Subject) && $Subject == "Hindi") echo 'selected'; ?>>Hindi</option>
                                                <option value="English" <?php if (isset($Subject) && $Subject == "English") echo 'selected'; ?>>English</option>
                                                <option value="English Grammar" <?php if (isset($Subject) && $Subject == "English Grammar") echo 'selected'; ?>>English Grammer</option>
                                                <option value="Sanskrit" <?php if (isset($Subject) && $Subject == "Sanskrit") echo 'selected'; ?>>Sanskrit</option>
                                            </select>
                                            <div style="color: red" id="studentsubject"></div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <label for="Marks">Marks<em>*</em></label>
                                            <input type="number" class="form-control" id="marks" name="Marks" value='<?php if (isset($Marks)) echo $Marks; ?>' placeholder="Enter Your Subject's Marks" data-rule-mandatory="true">
                                            <div style="color: red" id="studentmarks"></div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden"id="student_id" name="student_id" value='<?php if (isset($_GET)) echo $_GET['student_id']; ?>'>

                                <div class="col-lg-12 col-md-12 mt-4 text-right">
                                    <button type="submit" name="submit" value="Submit" class="btn btn-primary mb-2 mt-1">Submit</button>
                                    <a href="studentList.php"><button type="button" class="btn btn-secondary ml-2 mb-2 mt-1">Cancel</button></a>
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
<?php include 'footer.php'; ?>