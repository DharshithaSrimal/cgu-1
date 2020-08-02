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
        <?php
            include_once '../Model/User.php';
           

            if((isset($_SESSION["current_user"]) || $_SESSION["current_user"] != null)&& unserialize($_SESSION['current_user'])->getRole()=="lecturer"){

              include '../View/StaffHome.php';
            }

            if((isset($_SESSION["current_user"]) || $_SESSION["current_user"] != null)&& unserialize($_SESSION['current_user'])->getRole()=="admin"){

                include '../View/AdminHome.php';
              }
        ?>
    </div>
<div>
    <div>
        <div class="container bootstrap snippets">
            <div class="row decor-default">
                <div class="col-lg-3 col-md-4 col-sm-12">
                <?php

                if((isset($_SESSION["current_user"]) || $_SESSION["current_user"] != null)&& unserialize($_SESSION['current_user'])->getRole()=="student"){
                    echo ("
                    <div id=\"leftCol\" class=\"contacts-labels card bg-light mb-3  card-user\">
                        <br>
                        <h4>Welcome ".unserialize($_SESSION['current_user'])->getFname()."</h4>
                        <br>
                        <div class=\"pro_pic_frame\" >
                            <img class=\"pro_pic\" src=\"data:image/jpg;base64,'".base64_encode(unserialize($_SESSION['current_user'])->getImage())."'\" />;
                        </div>

                        <div id=\"home_profile_summary\">
                            <br>
                            <h5  style = \"text-transform:capitalize;\">".unserialize($_SESSION['current_user'])->getRole()."<span style = \"text-transform:none;\"> at</span> CGU</h5>
                           
                            <br>
                            <p style=\"margin-top: -10px\">".unserialize($_SESSION['current_user'])->getUser_id()."</p>
                            <p style=\"margin-top: -10px\"> ".unserialize($_SESSION['current_user'])->getEmail()."</p>
                            <p style=\"margin-top: -10px\">".unserialize($_SESSION['current_user'])->getTpnumber()."</p>

                            <div>
                                <button onclick=\"window.location.href='../View/EditProfile.php'\" class=\"btn btn-default editProfileBtn\">Edit profile</button>
                            </div>
                        </div>
                    </div>
                </div>
                "
            );
        }
                ?>
            <div class="col-lg-9 col-md-8 col-sm-12 card bg-light mb-3 card-details">
                <div class="tab-content">
                    <div class="personalDetails container tab-pane active" id="home" >
                    <?php
                    if(unserialize($_SESSION['current_user'])->getRole()=='student'){
                                echo "
                        <h4 class=\"card-header h5\">Important Notices</h4>
                        <div class=\"card-body\">
                            
                                 <iframe id=\"iframeNewsView\" src=\"./NewsView.php\" title=\"News view\" frameBorder=\"0\"
                                   style=\"height: 500px; overflow-x: hidden !important; overflow-y: scroll !important\"
                                   onload=\"resizeIframe(this)\">
                                 </iframe>";
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $loadingPositon = 'footer'; include '../Common/CommonResources.php'; ?>
<script src="../res/js/Home.js"></script>

<?php
    $id = unserialize($_SESSION['current_user'])->getUser_id();
    echo "  <script>
                          showUnreadCount('".$id."');

                        function resizeIframe(obj) {
                          obj.style.height = obj.contentWindow.document.documentElement.scrollHeight + 'px';
                        }


            </script>";

?>



</body>

</html>
