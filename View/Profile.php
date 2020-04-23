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
    <div class="container bootstrap snippets">
        <div class="row decor-default">
            <div class="col-lg-3 col-md-4 col-sm-12">
                <div id="leftCol" class="contacts-labels card bg-light mb-3  card-user">
                    <br>
                    <h4>Welcome <?php echo unserialize($_SESSION['current_user'])->getFname() ?> !</h4>
                    <br>
                    <div class="pro_pic_frame" >
                        <?php echo '<img class="pro_pic" src="data:image/jpg;base64,'.base64_encode(unserialize($_SESSION['current_user'])->getImage()).'" />'; ?>
                    </div>

                    <div id="home_profile_summary">
                        <br>
                        <h5  style = "text-transform:capitalize;"><?php echo unserialize($_SESSION['current_user'])->getRole()?> <span style = "text-transform:none;">at</span> CGU</h5>
<!--                        <h6>--><?php //echo unserialize($_SESSION['current_user'])->getAcademicPosition()?><!--</h6>-->
                        <p style="margin-top: -10px"><?php echo unserialize($_SESSION['student_user'])->getDegName()?></p>
                        <br>
                        <p style="margin-top: -10px">Contact: <?php echo unserialize($_SESSION['student_user'])->getTpnumber()?></p>

                        <div>
                            <button onclick="window.location.href='../View/EditProfile.php'" class="btn btn-default editProfileBtn">Edit profile</button>
                            <button class="btn btn-default editProfileBtn" onclick="">View Events</button>
                            <button class="btn btn-default editProfileBtn">Video Tutorials</button>
                            <button class="btn btn-default editProfileBtn">View CGU Staff</button>
                            <button class="btn btn-default editProfileBtn">View Degree Contents</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-8 col-sm-12 card bg-light mb-3 card-details">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#home">Personal Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#menu1">Academic Qualifications</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#menu2">Professional Qualifications</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#menu3">Soft Skills</a>
                    </li>
                </ul>
                <div class="tab-content">
                <div class="personalDetails container tab-pane active" id="home" >
                    <h4 class="card-header h5">Personal Details</h4>
                    <div class="card-body">
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <td>Student Number</td>
                                <td><?PHP echo unserialize($_SESSION['student_user'])->getUser_id(); ?></td>
                            </tr>
                            <tr>
                                <td>First Name</td>
                                <td><?PHP echo unserialize($_SESSION['student_user'])->getFname(); ?></td>
                                <td>Last Name</td>
                                <td><?PHP echo unserialize($_SESSION['student_user'])->getLname(); ?></td>
                            </tr>
                            <tr>
                                <td>Date of Birth</td>
                                <td><?PHP echo unserialize($_SESSION['student_user'])->getDob(); ?></td>
                            </tr>
                            <tr>
                                <td>Gender</td>
                                <td><?PHP echo unserialize($_SESSION['student_user'])->getGender(); ?></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td><?PHP echo unserialize($_SESSION['student_user'])->getEmail(); ?></td>
                                <td>Mobile</td>
                                <td><?PHP echo unserialize($_SESSION['student_user'])->getTpnumber(); ?></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="menu1" class="AcademicDetails container tab-pane fade">
                    <h4 class="card-header h5">Academic Qualifications</h4>
                    <div class="card-body">
                        <table id="AcademicDetails" class="table table-hover">
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="menu2" class="ProfessionalDetails container tab-pane fade">
                    <h4 class="card-header h5">Professional Qualifications</h4>
                    <div class="card-body">
                        <table id="ProfessionalDetails" class="table table-hover">
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="menu3" class="SoftSkills container tab-pane fade">
                    <h4 class="card-header h5">Soft Skills</h4>
                    <div class="card-body">
                        <table id="SoftSkills" class="table table-hover">
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>

                </div>
            </div>
        </div>
    </div>
    <?php $loadingPositon = 'footer'; include '../Common/CommonResources.php'; ?>

    </body>

    </html>
<?php
