        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        2024 © Copyright.
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-right d-none d-sm-block">
                            Support Email:<a href="#" target="_blank" class="text-muted"> support@srms.com </a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        </div>
        <!-- ============================================================== -->
        <!-- End Right Content here -->
        <!-- ============================================================== -->
        </div>
        <!-- End layout-wrapper -->

        <!-- Modal Start -->
        <div class="modal fade" id="addStudent" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Add New Student</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="validateJs" method="post" action="addStudent.php">
                        <div class="modal-body">
                            <div class="row" style="align-items: center; padding:20px 70px;">
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label for="FirstName">First Name<em>*</em></label>
                                        <input type="text" class="form-control" id="FirstName" name="FirstName"
                                            value='<?php if (isset($first_name))
                                                        echo $first_name; ?>'
                                            placeholder="Enter Your First Name" data-rule-mandatory="true">
                                        <div style="color: red" id="studentfirstname"></div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label for="LastName">Last Name<em>*</em></label>
                                        <input type="text" class="form-control" id="LastName" name="LastName"
                                            value='<?php if (isset($last_name))
                                                        echo $last_name; ?>'
                                            placeholder="Enter Your Last Name" data-rule-mandatory="true">
                                        <div style="color: red" id="studentlastname"></div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label for="Email">Email<em>*</em></label>
                                        <input type="email" class="form-control" id="Email" name="Email"
                                            value='<?php if (isset($email))
                                                        echo $email; ?>' placeholder="Enter Your E-mail Id"
                                            data-rule-mandatory="true">
                                        <div style="color: red" id="studentemail"></div>

                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label for="Gender">Gender<em>*</em></label>
                                        <label for="male" style="padding: 10px 20px;">Male
                                            <input type="radio" id="male" name="Gender"
                                                value='<?php if (isset($Gender))
                                                            echo $Gender; ?>' data-rule-mandatory="true">
                                        </label>
                                        <label for="female">Female
                                            <input type="radio" id="female" name="Gender"
                                                value='<?php if (isset($Gender))
                                                            echo $Gender; ?>' data-rule-mandatory="true">
                                        </label>
                                        <div style="color: red" id="studentgender"></div>

                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label for="Status">Status<em>*</em></label>
                                        <select class="form-control" id="Status" name="Status" data-rule-mandatory="true">
                                            <option value="">Select Status</option>
                                            <option value="Active" <?php if (isset($user_status) && $user_status == "Active")
                                                                        echo 'selected'; ?>>Active</option>
                                            <option value="Inactive" <?php if (isset($user_status) && $user_status == "Inactive")
                                                                            echo 'selected'; ?>>Inactive</option>
                                        </select>
                                        <div style="color: red"><span><?php if (isset($errors[8]))
                                                                            echo $errors[8]; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label for="class">Class<em>*</em></label>
                                        <input type="text" class="form-control" id="class" name="Class"
                                            value='<?php if (isset($Class))
                                                        echo $Class; ?>' placeholder="Enter Your Standard"
                                            data-rule-mandatory="true">
                                        <div style="color: red" id="studentclass"></div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label for="subject">Subject<em>*</em></label>
                                        <select class="form-control" id="subject" name="Subject" data-rule-mandatory="true">
                                            <option value="">Select your subject</option>
                                            <option value="Math">Math</option>
                                            <option value="Science">Science</option>
                                            <option value="Social Science">Social Science</option>
                                            <option value="Biology">Biology</option>
                                            <option value="Computer">Computer</option>
                                            <option value="Hindi">Hindi</option>
                                            <option value="English">English</option>
                                            <option value="English Grammar">English Grammar</option>
                                            <option value="Sanskrit">Sanskrit</option>
                                        </select>
                                        <div style="color: red" id="studentsubject"></div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label for="Marks">Marks<em>*</em></label>
                                        <input type="number" class="form-control" id="marks" name="Marks"
                                            value='<?php if (isset($Marks))
                                                        echo $Marks; ?>'
                                            placeholder="Enter Your Subject's Marks" data-rule-mandatory="true">
                                        <div style="color: red" id="studentmarks"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer col-lg-12 col-md-12 mt-4 text-right">
                            <button type="submit" name="submit" value="Submit" class="btn btn-primary mb-2 mt-1">Submit</button>
                            <button type="button" class="btn btn-secondary ml-2 mb-2 mt-1" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal ENd -->

        <script>
            $(document).on('click', '#addBtnClick', function() {
                alert("Only Admin can create a new user's account");
            });
            $(document).on('click', '#addBtnClick2', function() {
                alert("Only Admin or Teachers can create teacher");
            });
            $(document).on('click', '#addBtnClick3', function() {
                alert("Only Admin or Teachers can create new/update student");
            });


            $(document).on('click', '#editBtnClick', function() {
                alert("Only Admin can be update User's account");
            });
            $(document).on('click', '#editBtnClick2', function() {
                alert("Only Admin or Teachers can update teacher");
            });
            $(document).on('click', '#editBtnClick3', function() {
                alert("Only Admin or Teachers can update students");
            });

            $(document).on('click', '#disableBtnClick1', function() {
                alert("Teachers can not disable Admin's account");
            });
            $(document).on('click', '#disableBtnClick2', function() {
                alert("Only Admin or Teachers can disabled user's account");
            });
            $(document).on('click', '#disableBtnClick3', function() {
                alert("Only Admin or Teachers can disabled teacher");
            });
            $(document).on('click', '#disableBtnClick4', function() {
                alert("Only Admin or Teachers can disabled students");
            });

            $(document).on('click', '#deleteBtnClick', function() {
                alert("Only Admin can delete user's account");
            });
            $(document).on('click', '#deleteBtnClick2', function() {
                alert("Only Admin or Teachers can delete teacher");
            });
            $(document).on('click', '#deleteBtnClick3', function() {
                alert("Only Admin or Teachers can delete students");
            });
        </Script>

        <!-- JAVASCRIPT -->
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>

        <!-- Required datatable js -->
        <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        <!-- Buttons examples -->
        <script src="assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
        <script src="assets/libs/jszip/jszip.min.js"></script>
        <script src="assets/libs/pdfmake/build/pdfmake.min.js"></script>
        <script src="assets/libs/pdfmake/build/vfs_fonts.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>

        <!-- Responsive examples -->
        <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

        <!-- Datatable init js -->
        <script src="assets/js/pages/datatables.init.js"></script>
        <script src="assets/js/app.js"></script>

        </body>

        </html>
        <?php $conn->close(); ?>