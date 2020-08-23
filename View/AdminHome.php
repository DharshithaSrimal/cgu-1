<?php include_once '../Controller/UserController.php'; loadData();?>
<link rel="stylesheet" href="../res/css/staffHome.css">
<script src="../res/js/staffHome.js"></script>
<div class="container bootstrap snippets">
    <div class="row decor-default">
        <div class="col-lg-3 col-md-4 col-sm-12">
            <div id="leftCol" class="contacts-labels">
                <br>
                <h4>Welcome <?php echo unserialize($_SESSION['current_user'])->getFname() ?> !</h4>
                <br>
                <div class="pro_pic_frame" >
                    <?php echo '<img class="pro_pic" src="data:image/jpg;base64,'.base64_encode(unserialize($_SESSION['current_user'])->getImage()).'" />'; ?>
                </div>
            </div>
        </div>
        <div class="col-lg-9 col-md-8 col-sm-12">
            <h4>Manage Users</h4>
                <div class="contacts-list">
                    <a href="ManageStudents.php"><button>Manage Students</button></a>
                    <a href="ManageStaff.php"><button>Manage Staff</button></a>
                </div>
                <h4>View Reports</h4>
                <div class="contacts-list">
                    <a href="../res/FPDF/students.php" target="_blank"><button href= "">View Students</button></a>
                    <a href="../res/FPDF/lecturers.php" target="_blank"><button href= "">View Lecturers</button></a>
                </div>
                <h4>Post a Job Opportunity</h4>
                <button onclick="window.location.href='../View/job.php'">Job Posting</button>
            </div>
            </div>
        </div>
    </div>
</div>


