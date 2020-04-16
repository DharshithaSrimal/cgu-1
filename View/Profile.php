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
        <title>CGU - Home</title>
        <meta name="description" content="Career Guidance Unit - System">
        <meta name="author" content="CGU-UOK">
        <link rel="stylesheet" href="../res/css/Home.css">
        <?php $loadingPositon = 'header'; include '../Common/CommonResources.php'; ?>
        <script src="../res/js/Profile.js"></script>
    </head>

    <body>

    <div>
        <div>
            <p>Student Summary</p>
            <?php
            include_once '../Model/User.php';
            $userImage;
            $firstName;
            $lastName;
            $faculty;
            $degree;

            if(isset($_SESSION["student_user"]) || $_SESSION["student_user"] != null){
                $firstName = unserialize($_SESSION['student_user'])->getFname();
                $lastName = unserialize($_SESSION['student_user'])->getLname();
                $userImage = unserialize($_SESSION['student_user'])->getImage();
                $faculty = unserialize($_SESSION['student_user'])->getFacName();
                $degree = unserialize($_SESSION['student_user'])->getDegName();
            }
            echo '<img width="200px" src="data:image/jpg;base64,'.base64_encode(unserialize($_SESSION['student_user'])->getImage()).'" />';
            echo  ("
            <br>
                <p>Name : ".$firstName." ".$lastName."</p><br>
                <p>Degree Programme : ".$degree."</p><br>
                <p>Faculty : ".$faculty."</p><br>
            "
            );
            
            ?>
        <div>
            <button onclick="window.location.href='../View/EditProfile.php'">Edit Profile</button>
            <button onclick="window.location.href='../View/Inquiry.php'">Inquiry</button>
            <button onclick="">View Events</button>
            <button>Video Tutorials</button>
            <button>View CGU Staff</button>
            <button>View Degree Contents</button>
        </div>
        </div>

    </div>
    <?php $loadingPositon = 'footer'; include '../Common/CommonResources.php'; ?>

    </body>

    </html>
<?php
