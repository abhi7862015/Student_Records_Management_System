<?php
include 'header.php';

// Initialize variables
$first_name = '';
$middle_name = '';
$last_name = '';
$email = '';
$Gender = '';
$Status = '';
$AttendedClass = '';
$SubjectExpertise = '';
$Experience = '';

// Check if the form is submitted
if (isset($_POST['submit']) && $_POST['submit'] == 'Submit') {

    // Get form data
    $first_name = $_POST['FirstName'];
    $last_name = $_POST['LastName'];
    $email = $_POST['Email'];
    $Gender = $_POST['Gender'];
    $Status = $_POST['Status'];
    $AttendedClass = $_POST['AttendedClass'];
    $SubjectExpertise = $_POST['SubjectExpertise'];
    $Experience = $_POST['Experience'];

    // Sanitize form data
    $first_name = $conn->real_escape_string($first_name);
    $last_name = $conn->real_escape_string($last_name);
    $email = $conn->real_escape_string($email);
    $Gender = $conn->real_escape_string($Gender);
    $Status = $conn->real_escape_string($Status);
    $AttendedClass = $conn->real_escape_string($AttendedClass);
    $SubjectExpertise = $conn->real_escape_string($SubjectExpertise);
    $Experience = $conn->real_escape_string($Experience);

    // Check if the email already exists in the database
    $query1 = "SELECT id FROM teacher_details WHERE email='" . $email . "'";
    $result1 = $conn->query($query1);
    $num1 = mysqli_num_rows($result1);

    // If the email exists, update the existing record
    if ($num1 > 0) {
        $query1 = "UPDATE teacher_details SET first_name='$first_name', last_name='$last_name', email='$email', gender='$Gender', status='$Status', attended_class='$AttendedClass', subject_expertise='$SubjectExpertise', experience='$Experience', last_updated_date=CURRENT_TIMESTAMP WHERE email='$email'";
        if ($conn->query($query1)) {
            // Set success message for updating existing record
            $teacher_success = "Teacher Already Exists, Data Updated Successfully!";
        }
    } else {
        // If the email does not exist, insert a new record
        $query1 = "INSERT INTO teacher_details (first_name, last_name, email, gender, status, attended_class, subject_expertise, experience)
                   VALUES('$first_name', '$last_name', '$email', '$Gender', '$Status', '$AttendedClass', '$SubjectExpertise', '$Experience')";
        $conn->query($query1);
        if ($conn->affected_rows) {
            // Set success message for inserting new record
            $teacher_success = "Data Inserted Successfully!";
        } else {
            $teacher_failed = "Data Not Inserted/updated Successfully!";
        }
    }
}
?><div class="page-content">
    <div class="container-fluid">

        <div style="margin-top: 1rem; margin-left: 2rem;"><b><span style="color:green;"><?php if (isset($teacher_success)) echo $teacher_success; ?></span></b></div>
        <div style="margin-top: 1rem; margin-left: 2rem;"><b><span style="color:red;"><?php if (isset($teacher_failed)) echo $teacher_failed; ?></span></b></div>

        <br>
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">

                    <h4 class="mb-0 font-size-18">Add New Teacher</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                            <li class="breadcrumb-item"><a href="teacherList.html">Teacher</a></li>
                            <li class="breadcrumb-item active">Add Teacher</li>
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
                        <form id="teacherForm" method="post" action="">
                            <div class="row">
                                <div class="col-lg-4 col-md-4">
                                    <div class="form-group">
                                        <label for="FirstName">First Name<em>*</em></label>
                                        <input type="text" class="form-control" id="FirstName" name="FirstName" value='<?php if (isset($first_name)) echo $first_name; ?>' placeholder="">
                                        <div style="color: red" id="teacherFirstName"><span></span></div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <div class="form-group">
                                        <label for="LastName">Last Name<em>*</em></label>
                                        <input type="text" class="form-control" id="LastName" name="LastName" value='<?php if (isset($last_name)) echo $last_name; ?>' placeholder="">
                                        <div style="color: red" id="teacherLastName"><span></span></div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <div class="form-group">
                                        <label for="Email">Email<em>*</em></label>
                                        <input type="email" class="form-control" id="Email" name="Email" value='<?php if (isset($email)) echo $email; ?>' placeholder="">
                                        <div style="color: red" id="teacherEmailID"><span></span></div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4 col-md-4">
                                    <div class="form-group">
                                        <label for="Gender">Gender<em>*</em></label>
                                        <label for="male" style="padding: 10px 20px;">Male
                                            <input type="radio" id="male" name="Gender" value='male' <?php if (isset($Gender) && $Gender == "male") echo "checked"; ?>>
                                        </label>
                                        <label for="female">Female
                                            <input type="radio" id="female" name="Gender" value='female' <?php if (isset($Gender) && $Gender == "female") echo "checked"; ?>>
                                        </label>
                                        <div style="color: red" id="teacherGender"><span></span></div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4">
                                    <div class="form-group">
                                        <label for="Status">Status<em>*</em></label>
                                        <select class="form-control" id="Status" name="Status">
                                            <option value="">Select Status</option>
                                            <option value="Active" <?php if (isset($Status) && $Status == "Active") echo 'selected'; ?>>Active</option>
                                            <option value="Inactive" <?php if (isset($Status) && $Status == "Inactive") echo 'selected'; ?>>Inactive</option>
                                        </select>
                                        <div style="color: red" id="teacherStatus"><span></span></div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <div class="form-group">
                                        <label for="AttendedClass">Attended Class<em>*</em></label>
                                        <input type="text" class="form-control" id="AttendedClass" name="AttendedClass" value='<?php if (isset($AttendedClass)) echo $AttendedClass; ?>' placeholder="Enter Your Standard">
                                        <div style="color: red" id="teacherClass"><span></span></div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4 col-md-4">
                                    <div class="form-group">
                                        <label for="SubjectExpertise">Subject Expertise<em>*</em></label>
                                        <select class="form-control" id="SubjectExpertise" name="SubjectExpertise">
                                            <option value="">Select your subject</option>
                                            <option value="Math" <?php if (isset($SubjectExpertise) && $SubjectExpertise == "Math") echo 'selected'; ?>>Math</option>
                                            <option value="Science" <?php if (isset($SubjectExpertise) && $SubjectExpertise == "Science") echo 'selected'; ?>>Science</option>
                                            <option value="Social Science" <?php if (isset($SubjectExpertise) && $SubjectExpertise == "Social Science") echo 'selected'; ?>>Social Science</option>
                                            <option value="Biology" <?php if (isset($SubjectExpertise) && $SubjectExpertise == "Biology") echo 'selected'; ?>>Biology</option>
                                            <option value="Computer" <?php if (isset($SubjectExpertise) && $SubjectExpertise == "Computer") echo 'selected'; ?>>Computer</option>
                                            <option value="Hindi" <?php if (isset($SubjectExpertise) && $SubjectExpertise == "Hindi") echo 'selected'; ?>>Hindi</option>
                                            <option value="English" <?php if (isset($SubjectExpertise) && $SubjectExpertise == "English") echo 'selected'; ?>>English</option>
                                            <option value="English Grammar" <?php if (isset($SubjectExpertise) && $SubjectExpertise == "English Grammar") echo 'selected'; ?>>English Grammer</option>
                                            <option value="Sanskrit" <?php if (isset($SubjectExpertise) && $SubjectExpertise == "Sanskrit") echo 'selected'; ?>>Sanskrit</option>
                                        </select>
                                        <div style="color: red" id="teacherSubject"><span></span></div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4">
                                    <div class="form-group">
                                        <label for="Experience">Experience (In months)<em>*</em></label>
                                        <input type="number" class="form-control" id="Experience" name="Experience" value='<?php if (isset($Experience)) echo $Experience; ?>' placeholder="Enter Your Work Experience">
                                        <div style="color: red" id="teacherExp"><span></span></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 mt-4 text-right">
                                <button type="submit" name="submit" value="Submit" class="btn btn-primary mb-2 mt-1">Submit</button>
                                <a href="teacherList.php"><button type="button" class="btn btn-secondary ml-2 mb-2 mt-1">Cancel</button></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div> <!-- container-fluid -->
</div>

<script>
    document.getElementById('teacherForm').addEventListener('submit', function(e) {
        let errors = 0;

        // Clear all previous errors
        document.querySelectorAll("div[style='color: red'] span").forEach(span => span.textContent = '');

        let firstName = document.getElementById('FirstName').value.trim();
        let lastName = document.getElementById('LastName').value.trim();
        let email = document.getElementById('Email').value.trim();
        let gender = document.querySelector('input[name="Gender"]:checked');
        let status = document.getElementById('Status').value;
        let attendedClass = document.getElementById('AttendedClass').value.trim();
        let subjectExpertise = document.getElementById('SubjectExpertise').value;
        let experience = document.getElementById('Experience').value.trim();

        if (firstName === '') {
            document.getElementById('teacherFirstName').querySelector('span').textContent = 'Please enter the first name.';
            errors++;
        }

        if (lastName === '') {
            document.getElementById('teacherLastName').querySelector('span').textContent = 'Please enter the last name.';
            errors++;
        }

        if (email === '') {
            document.getElementById('teacherEmailID').querySelector('span').textContent = 'Please enter the email.';
            errors++;
        }

        if (!gender) {
            document.getElementById('teacherGender').querySelector('span').textContent = 'Please select a gender.';
            errors++;
        }

        if (status === '') {
            document.getElementById('teacherStatus').querySelector('span').textContent = 'Please select a status.';
            errors++;
        }

        if (attendedClass === '') {
            document.getElementById('teacherClass').querySelector('span').textContent = 'Please enter the attended class.';
            errors++;
        }

        if (subjectExpertise === '') {
            document.getElementById('teacherSubject').querySelector('span').textContent = 'Please select a subject expertise.';
            errors++;
        }

        if (experience === '' || isNaN(experience) || experience <= 0) {
            document.getElementById('teacherExp').querySelector('span').textContent = 'Please enter a valid experience in months.';
            errors++;
        }

        // Prevent form submission if there are errors
        if (errors > 0) {
            e.preventDefault();
        }
    });
</script>

<!-- End Page-content -->
<?php include 'footer.php'; ?>