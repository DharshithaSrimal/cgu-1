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
    <div class="container">
        <div class="form-horizontal" name="registration" method="post" action="index.php" enctype="multipart/form-data">
            <div id="page1CreateAccount">
                <h3><center><b>Create a new account</center></h3></br>

                <div>
                    <p>Conditions</p>
                    <p>To create a account,</p>
                    <p> *You must be a undergraduate of University of Kelaniya</p>
                </div>


                <div class="form-group">
                    <label for="indexNo" class="col-sm-3 control-label">Student No*</label>
                    <div class="col-sm-9">
                        <input type="text" id="indexNo" name="indexNo" placeholder="IM/2018/0**" class="form-control" autofocus required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="firstName" class="col-sm-3 control-label">First Name*</label>
                    <div class="col-sm-9">
                        <input type="text" id="firstName"  name="firstName"  placeholder="Last Name" class="form-control" autofocus required>
                    </div>
                </div>

               <div class="form-group">
                    <label for="lastName" class="col-sm-3 control-label">Last Name*</label>
                    <div class="col-sm-9">
                        <input type="text" id="lastName"  name="lastName"  placeholder="Last Name" class="form-control" autofocus required>
                    </div>
                </div>

                <p>You must use your student email address given by university</p>

                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Email*</label>
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
                    <label for="birthDate" class="col-sm-3 control-label">Date of Birth</label>
                    <div class="col-sm-9">
                        <input type="date" id="birthDate" name="birthDate" class="form-control" >
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
            </div>
            <div id="page2CreateAccount">
                <i id="btnBackPage2" class="fas fa-arrow-circle-left"></i>
                <p>Set password to your account</p>
                <form>
                    <div class="form-group">
                        <label for="password" class="col-sm-3 control-label">Password</label>
                        <div class="col-sm-9">
                            <input type="password" id="userPassword" name="userPassword" class="form-control" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="reEnterPassword" class="col-sm-3 control-label">Re-enter password</label>
                        <div class="col-sm-9">
                            <input type="password" id="reEnterPassword" name="reEnterPassword"  class="form-control">
                            <!-- <span class="help-block">Your phone number won't be disclosed anywhere </span> -->
                        </div>
                    </div>
                </form>
            </div>

            <div id="page3CreateAccount">
                <i id="btnBackPage3" class="fas fa-arrow-circle-left"></i>
                <p>Verification code is sent to your student email address</p>
                <form>
                    <div class="form-group">
                        <div class="col-sm-9">
                            <input type="text" placeholder="Enter the verification code" id="verificationCode" name="verificationCode" class="form-control" >
                            <p id="verificationError"></p>
                            <button Id="btnResendVer">Resend</button>
                        </div>
                    </div>
                </form>
            </div>

            <button id="btnNextCreateAccount" class="btn btn-primary btn-block">Next</button>
        </div> <!-- /form -->
    </div> <!-- ./container -->

   <?php $loadingPositon = 'footer'; include '../Common/CommonResources.php'; ?>
   <script src="../res/js/CreateAccount.js"></script>
</body>
</html>

<?php




?>