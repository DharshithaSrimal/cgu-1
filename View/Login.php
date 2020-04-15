 <?php session_start(); ?>

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
  <?php
      include_once '..\Model\User.php';

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
  <?php $loadingPositon = 'header'; include '../Common/CommonResources.php'; ?>

</head>

<body>

<div>
    <div class="container login-container">
        <div class="row">
            <div class="col-md-6 login-form-2">
                <h3>Login</h3>
                <form onsubmit="return false">
                    <div class="form-group">
                        <input id="stuNumber"  type="text" class="form-control" placeholder="Your Email *" value="" />
                    </div>
                    <div class="form-group">
                        <input  id="password" type="password" class="form-control" placeholder="Your Password *" value="" />
                    </div>
                    <p id="errorMsg"></p>
                    <div class="form-group">
                        <input id="submitLogin" type="submit" class="btnSubmit" value="Login" />
                    </div>
                    <div class="form-group">
                        <a href="#" class="ForgetPwd" value="Login">Forget Password?</a>
                        <br>
                        <a href="./CreateAccount.php" class="ForgetPwd">Sign up<a/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

  <div>
  </div>

   <?php $loadingPositon = 'footer'; include '../Common/CommonResources.php'; ?>
   <script src="../res/js/Login.js"></script>
</body>
</html>


