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
                        $stu_ar = loadStaff();
                        echo "<table class='table'><tr>
                                <th>Staff ID</th>
                                <th>Name</th>
                                <th>Faculty</th>
                                <th>Report</th>
                                <th>Delete</th>
                            </tr>";
                        foreach ($stu_ar as $stu) {
                            $id=str_replace("/","",$stu->getUser_id());
                            echo "  <tr>
                                        <td><input id=\"stu_id\" value=".$stu->getUser_id()."></td>
                                        <td><div class=\"stuName\">".$stu->getFname()." ".$stu->getLname()."</div></td>
                                        <td><div class=\"stuName\">".$stu->getFacName()."</div></td>
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
<?php $loadingPositon = 'footer'; include '../Common/CommonResources.php'; ?>
<script src="../res/js/DeleteStaff.js"></script>

