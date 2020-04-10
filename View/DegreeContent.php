<?php
session_start();
if (!isset($_SESSION["current_user"]) || $_SESSION["current_user"] == null) {
    header("Location: ./Login.php");
    exit();
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Degree - Content</title>
    <meta name="description" content="Career Guidance Unit - System">
    <meta name="author" content="CGU-UOK">
    <link rel="stylesheet" href="../res/css/Home.css">
    <?php $loadingPositon = 'header'; include '../Common/CommonResources.php'; ?>
    <script src="../res/js/Profile.js"></script>
    
</head>

<body>
<div>
    <p>View Degree Content</p>
    <div class="row">
        <div class="col-md-4">
            <label for="faculty">Select Faculty:</label>
            <select id="faculty">
                <option value="selection">Level one Subject Selection</option>
            </select>
        </div>
        <div class="col-md-4">
            <label for="department">Select Department:</label>
            <select id="department">
                <option value="selection">Level one Subject Selection</option>
            </select>
        </div>
        <div class="col-md-4">
            <br>
            <button>View Degree Content</button>
        </div>
    </div>
    <div class="degree_content" id="degree_content">
    <?php
   
            require '../Model/Degree.php';
            $deg_id;
            $fac_id;
            $degree_title;
            $degree_duration;

            if(isset($_SESSION["student_user"]) || $_SESSION["student_user"] != null){
                $fac_id = unserialize($_SESSION['student_user'])->getFacultyId();
                $deg_id = unserialize($_SESSION['student_user'])->getDegreeId();
                $degree_title = unserialize($_SESSION['student_user'])->getDegreeTitle();
                $degree_duration = unserialize($_SESSION['student_user'])->getDegreeDuration();
                
            }
            echo  ("
            <div>
            <br>
                <p>Degree Id : ".$deg_id."</p><br>
                <p>Faculty : ".$fac_id."</p><br>
                <p>Degree Programme : ".$degree_title."</p><br>
                <p>Duration : ".$degree_duration."</p><br>
            </div>
            "
            );
            
            ?>
    </div>  
    
</div>

<?php $loadingPositon = 'footer'; include '../Common/CommonResources.php'; ?>
</body>

</html>