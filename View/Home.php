<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>CGU - Home</title>
    <meta name="description" content="Career Guidance Unit - System">
    <meta name="author" content="CGU-UOK">
    <link rel="stylesheet" href="../res/css/Home.css">
    <?php $loadingPositon = 'header'; include '../Common/CommonResources.php'; ?>
    <?php
        session_start();
    ?>

</head>

<body>

<div>
    <div>
        <h1>Career Guidance Unit - UOK</h1>
        <h2>Home</h2>
    </div>
    <div>
        <?php
            include_once '..\Model\User.php';

            if($_SESSION["current_user"] != null){
                echo ("
                <br>
                <div>
                    <p>Logged in as ".unserialize($_SESSION['current_user'])->getFname()."</p>
                </div>
                "
                );
            }
        ?>
    </div>
</div>
<?php $loadingPositon = 'footer'; include '../Common/CommonResources.php'; ?>
</body>
<script src="../res/js/Home.js"></script>
</html>
