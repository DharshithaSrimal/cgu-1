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
        <title>CGU - Profile</title>
        <meta name="description" content="Career Guidance Unit - System">
        <meta name="author" content="CGU-UOK">
        <link rel="stylesheet" href="../res/css/Profile.css">
        <?php $loadingPositon = 'header'; include '../Common/CommonResources.php'; ?>
        <script src="../res/js/Profile.js"></script>
    </head>

    <body>

    <?php
    include_once '../Model/User.php';
    $userImage;
    $firstName;
    $lastName;
    $faculty;
    $degree;
    sleep(5);
    if(isset($_SESSION["student_user"]) && $_SESSION["student_user"] != null){
        $firstName = unserialize($_SESSION['student_user'])->getFname();
        $lastName = unserialize($_SESSION['student_user'])->getLname();
        $userImage = unserialize($_SESSION['student_user'])->getImage();
        $faculty = unserialize($_SESSION['student_user'])->getFacName();
        $degree = unserialize($_SESSION['student_user'])->getDegName();
    }
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card bg-light mb-3 text-center card-user ">
                    <div class="card-header">
                        <h2>Welcome <?php echo $firstName ?>....!!!</h2>
                    </div>
                    <?php
                    echo '<img class="card-img-top rounded-circle user-img" src="data:image/jpg;base64,'
                        .base64_encode(unserialize($_SESSION['student_user'])->getImage()).'" />';?>
                    <div class="card-body">
                        <?php
                        echo  ("
                        <br>
                            <h4 class=\"card-title\">".$firstName." ".$lastName."</h4>
                            <p class=\"card-text\">".$degree."</p>
                            <p class=\"card-text\">".$faculty."</p>
                        "
                        );
                        ?>
                    </div>
                </div>
        </div>
            <div class="col-md-4 center">
                <div class="row">
                <button class="btn btn-secondary col-md-6" onclick="window.location.href='../View/EditProfile.php'">Edit Profile</button>
                </div>
                <div class="row">
                <button class="btn btn-secondary col-md-6" onclick="window.location.href='../View/Inquiry.php'">Inquiry</button>
                </div>
                <div class="row">
                <button class="btn btn-secondary col-md-6" onclick="">View Events</button>
                </div>
                <div class="row">
                <button class="btn btn-secondary col-md-6">Video Tutorials</button>
                </div>
                <div class="row">
                <button class="btn btn-secondary col-md-6">View CGU Staff</button>
                </div>
                <div class="row">
                <button class="btn btn-secondary col-md-6">View Degree Contents</button>
                </div>
            </div>
        </div>
    </div>
    <?php $loadingPositon = 'footer'; include '../Common/CommonResources.php'; ?>

    </body>

    </html>
<?php
