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

            if(isset($_SESSION["current_user"]) || $_SESSION["current_user"] != null){
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
    <button id="btnLogout">Logout</button>
</div>
<?php $loadingPositon = 'footer'; include '../Common/CommonResources.php'; ?>
</body>
<script src="../res/js/Home.js"></script>
</html>
