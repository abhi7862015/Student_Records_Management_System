<?php
include 'header.php';

?>
<style>
    .dashlet {
        padding: 10px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin: 20px 0;
    }

    .dashlet .count {
        font-size: 2.5em;
        font-weight: bold;
    }

    .dashlet .label {
        font-size: 1.2em;
        color: white;
    }

    .dashlet i {
        font-size: 100px;
    }

    .dashlet .info {
        align-items: center;
        text-align: center;
        color: white;
    }

    .Teacher {
        background-color: #c10000;
        align-items: center;
    }

    .Student {
        background-color: #052b5d;
    }
</style>
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">

                    <h4 class="mb-0 font-size-18">Welcome to the Student Records Management System (SRMS) Dashboard!</h4>

                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body d-flex">
                        <!-- Total Users Dashlet -->
                        <div class="col-md-6">
                            <div class="dashlet Student text-white text-center">
                                <div class="count"><?php echo $AdminCount; ?></div>
                                <div class="label">Total Admins</div>
                            </div>
                        </div>
                        <!-- Total Teachers Dashlet -->
                        <div class="col-md-6">
                            <div class="dashlet Teacher text-white text-center  ">
                                <!-- <i class="mdi mdi-school"></i> -->
                                <!-- <div class="info"> -->
                                <div class="count"><?php echo $TeacherCount; ?></div>
                                <div class="label">Total Teachers</div>
                                <!-- </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="card-body d-flex">
                        <!-- Total Users Dashlet -->
                        <div class="col-md-6">
                            <div class="dashlet Student text-white text-center">
                                <div class="count"><?php echo $StudentCount; ?></div>
                                <div class="label">Total Students</div>
                            </div>
                        </div>
                        <!-- Total Teachers Dashlet -->
                        <div class="col-md-6">
                            <div class="dashlet Teacher text-white text-center  ">
                                <!-- <i class="mdi mdi-school"></i> -->
                                <!-- <div class="info"> -->
                                <div class="count"><?php echo $ParentCount; ?></div>
                                <div class="label">Total Parents</div>
                                <!-- </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->
<?php
include 'footer.php';

?>