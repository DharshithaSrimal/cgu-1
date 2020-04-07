<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Create Account</title>
  <meta name="description" content="Career Guidance Unit - System">
  <meta name="author" content="CGU-UOK">

  <link rel="stylesheet" href="../res/css/CreateAccount.css">
  <?php $loadingPositon = 'header'; include '../Common/CommonResources.php'; ?>

</head>

<body>

    <div>
        <p>Conditions</p>
         <p>To create a account,</p>
        <p> *You must be a undergraduate of University of Kelaniya</p>
    </div>

    <div class="container">
        <form class="form-horizontal" name="registration" method="post" action="index.php" enctype="multipart/form-data">
            <h3><center><b>Student Registration</center></h3></br>

            <div class="form-group">
                <label for="indexNo" class="col-sm-3 control-label">Student No*</label>
                <div class="col-sm-9">
                    <input type="text" id="indexNo" name="indexNo" placeholder="IM/2018/0**" class="form-control" autofocus required>
                </div>
            </div>

            <div class="form-group">
                <label for="studentName" class="col-sm-3 control-label">Student Name*</label>
                <div class="col-sm-9">
                    <input type="text" id="studentName"  name="studentName"  placeholder="Student Name" class="form-control" autofocus required>
                </div>
            </div>

            <p>You must use your student email address given by university</p>

            <div class="form-group">
                <label for="email" class="col-sm-3 control-label">Email </label>
                <div class="col-sm-9">
                    <input type="email" id="email" name="email" placeholder="Email" class="form-control" name= "email">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-3">Gender*</label>
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-sm-4">
                            <label class="radio-inline">
                                <input type="radio" id="femaleRadio" name="gender" value="Female" required>Female
                            </label>
                        </div>
                        <div class="col-sm-4">
                            <label class="radio-inline">
                                <input type="radio" id="maleRadio"  name="gender"  value="Male" required>Male
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-3">Upload Photo:</label><br />
                <div class="col-sm-9">
                        <input name="userImage" type="file" class="inputFile" />
                </div>
            </div>

            <div class="form-group">
                <label for="birthDate" class="col-sm-3 control-label">Date of Birth*</label>
                <div class="col-sm-9">
                    <input type="date" id="birthDate" name="birthDate" class="form-control" required>
                </div>
            </div>

            <div class="form-group">
                <label for="phoneNumber" class="col-sm-3 control-label">Phone number </label>
                <div class="col-sm-9">
                    <input type="phoneNumber" id="phoneNumber" name="phoneNumber"  placeholder="Phone number" class="form-control">
                    <!-- <span class="help-block">Your phone number won't be disclosed anywhere </span> -->
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-9 col-sm-offset-3">
                    <span class="help-block">*Required fields</span>
                </div>
            </div>
            <button  type="submit" name="submit" class="btn btn-primary btn-block">Register</button>
        </form> <!-- /form -->
    </div> <!-- ./container -->

   <?php $loadingPositon = 'footer'; include '../Common/CommonResources.php'; ?>
   <script src="../res/js/CreateAccount.js"></script>
</body>
</html>

<?php




?>