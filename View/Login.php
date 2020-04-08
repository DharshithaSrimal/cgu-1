<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Career Guidance Unit - UOK</title>
  <meta name="description" content="Career Guidance Unit - System">
  <meta name="author" content="CGU-UOK">

  <link rel="stylesheet" href="../res/css/Login.css">
  <link rel='stylesheet' href='../res/1-bootstrap-4.4.1-dist/css/bootstrap.css'>
  <link rel='stylesheet' href='../res/1-bootstrap-4.4.1-dist/css/bootstrap-grid.css'>
<!--  --><?php //$loadingPositon = 'header'; include '../Common/CommonResources.php'; ?>

</head>

<body>

<div>
    <div>
        <h1>Career Guidance Unit - UOK</h1>
        <h2>Login</h2>

       <!---- /////////////////////////about us modal start//////////////////////////////////////  ----!>
        <button id="btnaboutUs">About</button>

        <div id="myModal" class="modal">

          <div class="modal-content">
            <span class="close">&times;</span>
            <p>About The Career Guidance Unit of University Of Kelaniya</p>
            <p>
                The objective of this unit is to prepare the students for their professional life. Making the students aware of employment opportunities available in the country and instructing them about the specific course units they should follow and soft skills they should acquire during their undergraduate life are the broad goals of this unit.

                The aim of the Career Guidance Unit is to prepare students for the outside world and to assist them in finding employment.

                Currently employers are looking for more attributes than simply the Degree. They are searching for a comprehensive graduate. Further the work life highly search for soft skills such as interpersonal skills, communication skills, presentation skills, time management, teamwork, and organizational abilities. The Career Guidance Unit helps the students of the University of Kelaniya to develop these skills.

                This unit gives the chance to the students to identify their goals and to go on that path by providing information, mentoring, advising them, training them and empowering them to achieve their goals.

                Creating links between private and public sector institutions with university students, identifying vocational needs and job opportunities of the industry and making students aware of them are the hallmark of this unit.
            </p>
            <p> </p>
            <a target="_blank" href="https://units.kln.ac.lk/cgu/index.php/contact-us">Contact CGU UOK<a/>
          </div>

        </div>
        <!---- /////////////////////////about us modal end////////////////////////////////////// ----!>

    </div>
    <div>
        <label>Student Number:</label>
        <input id="stuNumber" type="text">

        <label>Password :</label>
        <input id="password" type="password">

        <input id="submitLogin" type="button" value="Submit">

        <p id="errorMsg"></p>
        <a href="./ResetPassword.php">Forgot password ?<a/>
        <br>
        <a href="./CreateAccount.php">Sign up<a/>
    </div>
</div>

  <div>
  <p>
      Career Guidance Unit,
      University of Kelaniya,
      Dalugama, Kelaniya,
      Sri Lanka, 11600.

      Email: careers@kln.ac.lk
      Tel:  +94 (0) 112 917 711
      Fax: +94 (0) 112 917 711
  </p>
  </div>

   <?php $loadingPositon = 'footer'; include '../Common/CommonResources.php'; ?>
   <script src="../res/js/Login.js"></script>
</body>

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

