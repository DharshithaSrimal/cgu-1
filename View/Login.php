<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Career Guidance Unit - UOK</title>
  <meta name="description" content="Career Guidance Unit - System">
  <meta name="author" content="CGU-UOK">

  <link rel="stylesheet" href="../res/css/Login.css">
  <?php $loadingPositon = 'header'; include '../Common/CommonResources.php'; ?>

</head>

<body>

<div>
    <div>
        <h1>Career Guidance Unit - UOK</h1>
        <h2>Login</h2>
    </div>
    <div>
        <label>Student Number:</label>
        <input id="stuNumber" type="text">

        <label>Password :</label>
        <input id="password" type="password">
        
        
        <input id="submitLogin" type="button" value="Submit">

        <p id="errorMsg"></p>
    </div>
</div>
  <?php $loadingPositon = 'footer'; include '../Common/CommonResources.php'; ?>
</body>
<script src="../res/js/Login.js"></script>
</html>

<?php
    include_once '..\Model\User.php';
    session_start();

    if(isset($_SESSION["current_user"]) && $_SESSION["current_user"]!= null){
        echo ("
            <div>
            <br>
                <p>Logged in as".unserialize($_SESSION['current_user'])->getFname()."</p>
                <p>will be redirected to CGU home... </p>
            </div>
            "
        );

        header("Location: ./Home.php");
        exit();
    }

?>

