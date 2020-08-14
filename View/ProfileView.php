<?php
session_start();
if (!isset($_SESSION["current_user"]) || $_SESSION["current_user"] == null) {
    header("Location: ./Login.php");
    exit();
}
?>
<?php include_once '../Model/User.php';  ?>
<?php include_once '../Controller/ProfileController.php';?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>CGU - Home</title>
    <meta name="description" content="Career Guidance Unit - System">
    <meta name="author" content="CGU-UOK">
    <link rel="stylesheet" href="../res/css/editProfile.css">
    <link rel="stylesheet" href="../res/css/ViewProfile.css">
    <?php $loadingPositon = 'header'; include '../Common/CommonResources.php'; ?>
</head>
<body>
    <?php
        $profileUserID = $_GET['profUid'];
        $userObj =  loadOtherUser($profileUserID);  //Implemented in ProfileController php

    ?>
<div class="container bootstrap snippets">
    <div class="row decor-default contacts-labels card bg-light mb-3  card-user">

        <div style="margin-top: 30px">
            <h4 class="card-header h5">Personal Details</h4>
            <div class="card-body">
                <br>
                <!--                <input type="file" id="logo" /><br>-->
                <!--                <label>Student Number</label>-->
                <!--                <input type="text" id="stuNumber" value="--><?PHP //echo unserialize($_SESSION['student_user'])->getUser_id(); ?><!--"><br>-->

                <?php  echo "<input style='display: none;' id='id_div' value='".$userObj->getUser_id()."'>"?>
                <div class="grid-container" style="display: grid;grid-template-columns:10% 30% 60%;grid-gap:20px;">
                    <div class="grid-item">
                    </div>
                    <div class="grid-item">
                        <h2><?PHP echo $userObj->getFname(); ?> <?PHP echo $userObj->getLname(); ?></h2>
                        <div class="unit">
                            <div class="field name" style='margin-left:40px'>
                                <div>
                                    <fieldset  class="rating">
                                        <input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Very Good"></label>
                                        <input type="radio" id="star4half" name="rating" value="4 and a half" /><label class="half" for="star4half" title="Very Good"></label>
                                        <input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Good"></label>
                                        <input type="radio" id="star3half" name="rating" value="3 and a half" /><label class="half" for="star3half" title="Good"></label>
                                        <input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Average"></label>
                                        <input type="radio" id="star2half" name="rating" value="2 and a half" /><label class="half" for="star2half" title="Average"></label>
                                        <input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Poor"></label>
                                        <input type="radio" id="star1half" name="rating" value="1 and a half" /><label class="half" for="star1half" title="Poor"></label>
                                        <input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Very Poor"></label>
                                        <input type="radio" id="starhalf" name="rating" value="half" /><label class="half" for="starhalf" title="Very Poor"></label>
                                    </fieldset>
                                </div>
                            </div>
                        </div>

                        <br><br>
                        <div class="pro_pic_frame" style="margin-left: 20px;">
                            <img class="pro_pic" id ="pro_pic_ele"<?php echo 'src="data:image/jpeg;base64,'.base64_encode($userObj->getImage()).'"'; ?> />
                        </div>
                    </div>

                    <div class="grid-item">
                        <label>Email</label>
                        <p> <?PHP echo $userObj->getEmail(); ?></p><br>

                        <label>Mobile</label>
                        <p> <?PHP echo $userObj->getTpnumber(); ?></p><br>

                        <label>Date of Birth</label>
                        <p> <?PHP echo $userObj->getDob(); ?></p><br>

                        <label>Gender</label>
                        <p> <?PHP echo $userObj->getGender(); ?></p><br>
                    </div>
                </div>
                <br><br>
            </div>
        </div>
    </div>
    <br>
    <br>
    <div class="row decor-default contacts-labels card bg-light mb-3  card-user">
        <h4 class="card-header h5">Academic Qualifications </h4>
        <div>
            <div id="AQLoadingSection" style="margin:0 auto;padding: 30px;">
                <?php  foreach ( $userObj->getAcademic_q_array() as $i){
                    if(isset($i["aq_title"])){
                        echo(" <div class=\"row\" id='".$i["aq_id"]."'>
 <p><a style=\"color:red;cursor: pointer;\"><i onclick=\"delQ('".$i["aq_id"]."')\" class=\"fa fa-dot-circle-o\"></i></a>&nbsp;&nbsp;" .$i["aq_title"] . "-" . $i["aq_institute"]
                            . "&nbsp;(" .$i["aq_description"] . ")" . "</p></div>");
                    }
                }
                ?>
            </div>

        </div>
        <div class="unit">
            <div class="field name" style='margin-left:20px'>
                <div>
                    <fieldset  class="rating">
                        <input type="radio" id="AQstar5" name="AQrating" value="5" /><label class = "full" for="star5" title="Very Good"></label>
                        <input type="radio" id="AQstar4half" name="AQrating" value="4 and a half" /><label class="half" for="star4half" title="Very Good"></label>
                        <input type="radio" id="AQstar4" name="AQrating" value="4" /><label class = "full" for="star4" title="Good"></label>
                        <input type="radio" id="AQstar3half" name="AQrating" value="3 and a half" /><label class="half" for="star3half" title="Good"></label>
                        <input type="radio" id="AQstar3" name="AQrating" value="3" /><label class = "full" for="star3" title="Average"></label>
                        <input type="radio" id="AQstar2half" name="AQrating" value="2 and a half" /><label class="half" for="star2half" title="Average"></label>
                        <input type="radio" id="AQstar2" name="AQrating" value="2" /><label class = "full" for="star2" title="Poor"></label>
                        <input type="radio" id="AQstar1half" name="AQrating" value="1 and a half" /><label class="half" for="star1half" title="Poor"></label>
                        <input type="radio" id="AQstar1" name="AQrating" value="1" /><label class = "full" for="star1" title="Very Poor"></label>
                        <input type="radio" id="AQstarhalf" name="AQrating" value="half" /><label class="half" for="starhalf" title="Very Poor"></label>
                    </fieldset>
                </div>
            </div>
        </div>
        <p style="font-size: small">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rate academic qualifications </p>

    </div>



    <div class="row decor-default contacts-labels card bg-light mb-3  card-user">
        <h4 class="card-header h5">Proffessional Qualifications</h4>
    <div>
        <div id="PQLoadingSection" style="margin:0 auto;padding: 30px;">
            <?php
            foreach ( $userObj->getProf_q_array() as $i){
                if(isset($i["pq_title"])){
                    echo (" <div class=\"row\" id='".$i["pq_id"]."'>
     <p><a style=\"color:red;cursor: pointer;\"><i onclick=\"delQ('".$i["pq_id"]."')\" class=\"fa fa-dot-circle-o\"></i></a>&nbsp;&nbsp;".$i["pq_title"]."-".$i["pq_institute"]
                        ."&nbsp;(".$i["pq_description"].")"."</p></div>");
                }
            }
            ?>
        </div>
    </div>
        <div class="unit">
            <div class="field name" style='margin-left:20px'>
                <div>
                    <fieldset  class="rating">
                        <input type="radio" id="PQstar5" name="PQrating" value="5" /><label class = "full" for="star5" title="Very Good"></label>
                        <input type="radio" id="PQstar4half" name="PQrating" value="4 and a half" /><label class="half" for="star4half" title="Very Good"></label>
                        <input type="radio" id="PQstar4" name="PQrating" value="4" /><label class = "full" for="star4" title="Good"></label>
                        <input type="radio" id="PQstar3half" name="PQrating" value="3 and a half" /><label class="half" for="star3half" title="Good"></label>
                        <input type="radio" id="PQstar3" name="PQrating" value="3" /><label class = "full" for="star3" title="Average"></label>
                        <input type="radio" id="PQstar2half" name="PQrating" value="2 and a half" /><label class="half" for="star2half" title="Average"></label>
                        <input type="radio" id="PQstar2" name="PQrating" value="2" /><label class = "full" for="star2" title="Poor"></label>
                        <input type="radio" id="PQstar1half" name="PQrating" value="1 and a half" /><label class="half" for="star1half" title="Poor"></label>
                        <input type="radio" id="PQstar1" name="PQrating" value="1" /><label class = "full" for="star1" title="Very Poor"></label>
                        <input type="radio" id="PQstarhalf" name="PQrating" value="half" /><label class="half" for="starhalf" title="Very Poor"></label>
                    </fieldset>
                </div>
            </div>
        </div>
        <p style="font-size: small">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rate professional qualifications </p>
    </div>

    <div class="row decor-default contacts-labels card bg-light mb-3  card-user">
        <h4 class="card-header h5">Soft Skills</h4>
        <div id="softSkills" class="card-body"></div>
        <div class="unit">
            <div class="field name" style='margin-left:20px'>
                <div>
                    <fieldset  class="rating">
                        <input type="radio" id="SQstar5" name="SQrating" value="5" /><label class = "full" for="star5" title="Very Good"></label>
                        <input type="radio" id="SQstar4half" name="SQrating" value="4 and a half" /><label class="half" for="star4half" title="Very Good"></label>
                        <input type="radio" id="SQstar4" name="SQrating" value="4" /><label class = "full" for="star4" title="Good"></label>
                        <input type="radio" id="SQstar3half" name="SQrating" value="3 and a half" /><label class="half" for="star3half" title="Good"></label>
                        <input type="radio" id="SQstar3" name="SQrating" value="3" /><label class = "full" for="star3" title="Average"></label>
                        <input type="radio" id="SQstar2half" name="SQrating" value="2 and a half" /><label class="half" for="star2half" title="Average"></label>
                        <input type="radio" id="SQstar2" name="SQrating" value="2" /><label class = "full" for="star2" title="Poor"></label>
                        <input type="radio" id="SQstar1half" name="SQrating" value="1 and a half" /><label class="half" for="star1half" title="Poor"></label>
                        <input type="radio" id="SQstar1" name="SQrating" value="1" /><label class = "full" for="star1" title="Very Poor"></label>
                        <input type="radio" id="SQstarhalf" name="SQrating" value="half" /><label class="half" for="starhalf" title="Very Poor"></label>
                    </fieldset>
                </div>
            </div>
        </div>
        <p style="font-size: small">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rate Soft Skills </p>
    </div>
</div>
<br>
<br>

<?php $loadingPositon = 'footer'; include '../Common/CommonResources.php'; ?>
<script src="../res/js/ViewProfile.js"></script>

<?php
    $id = $userObj->getUser_id();
    echo "
     <script src='../res/js/CommonResources.js'></script>
    <script>
        $( document ).ready(function(){
         showUnreadCount('".$id."');
        });
    </script>";
?>

</body>
</html>

