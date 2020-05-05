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
    <script src="../res/js/Degree.js"></script>
    
</head>

<body>
<div>
    <p>View Degree Content</p>
    <div class="row">
        <div class="col-md-4">
            <label for="faculty">Select Faculty:</label>
            <select id="faculty">
                <option value="1">Level one Subject Selection</option>
                <option value="2">2</option>
            </select>
        </div>
        
        <div class="col-md-4">;
        <?php 
           // $result =  unserialize($_SESSION['student_user']);
            
            //print_r($result);
            ?>
            <label for='degree'>Select Degree:</label>;
           
                <select id='degree'>;    
                <?php
                    require '../Model/User.php';
                    require '../Model/Degree.php';
                                        
                    foreach($result as $output){   
                        echo ("<option value='".$output["deg_id"]."'>'".$output["degree_title"]."'</option>");
                    }                 
                ?>
                 </select>
            </div>
        <div class="col-md-4">
            <input type = "button" id = "viewContent" value="View Degree Content">
        </div>
    </div>
    <div class="degree_content" id="degree_content">
    <?php
            
            $deg_id;
            $fac_id;
            $degree_title;
            $degree_duration;
                       
            if(isset($_SESSION["student_user"]) || $_SESSION["student_user"] != null){
                $fac_id = unserialize($_SESSION['student_user'])->getFacultyName();
                $degree_title = unserialize($_SESSION['student_user'])->getDegreeTitle();
                $degree_duration = unserialize($_SESSION['student_user'])->getDegreeDuration();
                
            }
            echo  ("
            <div>
            <br>
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
<script src="../res/js/Degree.js"></script>
<script src="../res/js/LoadDegree.js"></script>
</body>
</body>

</html>