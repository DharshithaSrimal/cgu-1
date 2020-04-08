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
            <?php
            include_once '../Model/User.php';
            $userImage;
            $firstName;
            $lastName;
            $faculty;
            $degree;

            if(isset($_SESSION["current_user"]) || $_SESSION["current_user"] != null){
                $firstName = unserialize($_SESSION['student_user'])->getFname();
                $lastName = unserialize($_SESSION['current_user'])->getLname();
                $userImage = unserialize($_SESSION['current_user'])->getImage();
                //$faculty = unserialize($_SESSION['current_user'])->getFac_id();
                //$degree = unserialize($_SESSION['current_user'])->getDeg_id();
            }
            echo $firstName ;
            ?>

        </div>

    </div>
    <?php $loadingPositon = 'footer'; include '../Common/CommonResources.php'; ?>
    </body>

    </html>
<?php
