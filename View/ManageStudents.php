<head>
    <meta charset="utf-8">
    <title>CGU - Home</title>
    <meta name="description" content="Career Guidance Unit - System">
    <meta name="author" content="CGU-UOK">
    <link rel="stylesheet" href="../res/css/Home.css">

    <?php $loadingPositon = 'header'; include '../Common/CommonResources.php'; ?>
</head>

<?php include_once '../Controller/UserController.php'; loadData();?>
<link rel="stylesheet" href="../res/css/staffHome.css">
<script src="../res/js/staffHome.js"></script>
<div class="container bootstrap snippets">
    <div class="row decor-default">
        
        <div class="col-lg-9 col-md-8 col-sm-12">
            <div class="contacts-list">
            <h4>Manage Students</h4>
                    <div class="allUnits">
                        <?php

                        include_once '../Controller/HomeController.php';
                        $stu_ar = studentList();
                        echo "<table class='table'><tr>
                                <th>Student ID</th>
                                <th>Name</th>
                                <th>Faculty</th>
                                <th>Report</th>
                                <th colspan=\"2\"><center>Assign</center></th>
                                <th>Delete</th>
                            </tr>";
                        foreach ($stu_ar as $stu) {
                            $id=str_replace("/","",$stu->getUser_id());
                            echo "  <tr>
                                        <td><input id=\"stu_id\" value=".$stu->getUser_id()."></td>
                                        <td><div class=\"stuName\">".$stu->getFname()." ".$stu->getLname()."</div></td>
                                        <td><div class=\"stuName\">".$stu->getFacName()."</div></td>
                                        <td><a href=\"../res/FPDF/personal.php?id=".$stu->getUser_id()."\"><button>View Information</button></a></td>
                                        <td>
                                            <select class=\"form-control\" id=\"staff_id\">";
                                            $lecturer = loadStaff();
                                            foreach ($lecturer as $lec){
                                                echo "<option value=".$lec->getUser_id().">".$lec->getFname()." ".$lec->getLname()."</option>";
                                            }                                            
                                            echo "</select>
                                        </td>
                                        <td><button id=\"btnSoft\">Assign</button></td>
                                        <td><button id=\"delete\"><center><i class=\"fa fa-trash\" style=\"font-size:24px\"></i></center></button></td>
                                    </tr>";
                        }
                        echo "</table>";
                        ?>
                    </div>
            </div>
        </div>
    </div>
</div>
<br><br><br><br><br><br>
<?php $loadingPositon = 'footer'; include '../Common/CommonResources.php'; ?>
<script src="../res/js/AssignLec.js"></script>
<script src="../res/js/DeleteUser.js"></script>

