<?php
session_start();
if (!isset($_SESSION["current_user"]) || $_SESSION["current_user"] == null) {
    header("Location: ./Login.php");
    exit();
}
?>
<?php include_once '../Model/User.php';  ?>
<?php include_once '../Controller/EditProfileController.php';?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>CGU - Home</title>
    <meta name="description" content="Career Guidance Unit - System">
    <meta name="author" content="CGU-UOK">
    <link rel="stylesheet" href="../res/css/editProfile.css">
    <?php $loadingPositon = 'header'; include '../Common/CommonResources.php'; ?>

</head>
<body>

<div class="container bootstrap snippets">
    <div class="row decor-default contacts-labels card bg-light mb-3  card-user">

        <div style="margin-top: 30px">
            <h4 class="card-header h5">Personal Details</h4>
            <div class="card-body">
                <div class="image-upload">
                    <label for="fileinput">
                        <a class="image_upload_ic" style = "color:var(--main-color2)">
                            <i class="fas fa-plus-circle fa-2x"></i>
                        </a>
                    </label>
                    <input type='file' onchange="readURL(this);" id="fileinput"/>
                </div>
                <div class="pro_pic_frame" >
                    <img class="pro_pic" id ="pro_pic_ele"<?php echo 'src="data:image/jpeg;base64,'.base64_encode(unserialize($_SESSION['current_user'])->getImage()).'"'; ?> />
                </div>
                <br>
                <br>


<!--                <input type="file" id="logo" /><br>-->
<!--                <label>Student Number</label>-->
<!--                <input type="text" id="stuNumber" value="--><?PHP //echo unserialize($_SESSION['student_user'])->getUser_id(); ?><!--"><br>-->
                <div class="grid-container" style="display: grid;grid-template-columns: auto auto;grid-gap:20px;">
                    <div class="grid-item">
                        <label>First Name</label>
                        <input  type="input" class="form-control"  id="fName" value="<?PHP echo unserialize($_SESSION['student_user'])->getFname(); ?>">
                    </div>
                    <div class="grid-item">
                        <label>Last Name</label>
                        <input  type="input" class="form-control"  id="lName" value="<?PHP echo unserialize($_SESSION['student_user'])->getLname(); ?>"><br>
                    </div>
                </div>

                <div class="grid-container" style="display: grid;grid-template-columns: auto auto auto;grid-gap:20px;">
                    <div class="grid-item">
                        <label>Email</label>
                        <input  type="input" class="form-control" id="email" value="<?PHP echo unserialize($_SESSION['student_user'])->getEmail(); ?>"><br>
                    </div>
                    <div class="grid-item">
                        <label>Mobile</label>
                        <input type="tel"  class="form-control" id="mobile" value="<?PHP echo unserialize($_SESSION['student_user'])->getTpnumber(); ?>"><br>
                    </div>
                    <div class="grid-item">
                        <label>Date of Birth</label>
                        <input type="date" class="form-control" id="dob" value="<?PHP echo unserialize($_SESSION['student_user'])->getDob(); ?>"><br>
                    </div>
                </div>

<!--                <label>Gender</label>-->
<!--                <input  type="input" class="form-control" id="gender" value="--><?PHP //echo unserialize($_SESSION['student_user'])->getGender(); ?><!--"><br>-->
<!--                -->

                <button style="" class="btn btn-info" id="btnPersonal">Update Personal Information</button>
                <br><br>
<!--                <p>Educational Qualifications</p><hr>-->
<!---->
<!--                <label>Degree</label>-->
<!--                <input type="text" readonly="readonly" id="degree" size="70" value="--><?PHP //echo unserialize($_SESSION['student_user'])->getDegName(); ?><!--"><br>-->
<!--                <label>Faculty</label>-->
<!--                <input type="text" readonly="readonly" id="faculty" value="--><?PHP //echo unserialize($_SESSION['student_user'])->getFacName(); ?><!--"><br>-->
<!--                <button id="btnEducational">Update</button>-->
            </div>
        </div>
    </div>
    <br>
    <br>
    <div class="row decor-default contacts-labels card bg-light mb-3  card-user">
        <h4 class="card-header h5">Academic Qualifications</h4>
<!--        <div id="outputAcademic" class="card-body"></div>-->
<!--        <button id="btnAcademic">Update</button>-->

        <div>
            <div class="row" style="margin:0 auto;padding-right: 10px; padding-left: 10px;">
                <span class="col-md-6" style="padding-right: 0px; padding-left: 0px;">
                    <input class="form-control" list="editAQMain" name="editAQMain" placeholder="Program.." >
                    <datalist id="editAQMain">
                        <?php
                        foreach (getAQPrograms() as $i)
                        {
                            echo "<option id =".$i[0]." value='".$i[1]."'>"  ;
                        }
                        ?>
                    </datalist>
                </span>
                <span class="col-md-6" style="padding-right: 0px; padding-left: 0px;">
                    <input class="form-control" list="editAQInstitiute" name="editAQInstitiute" placeholder="Institute..">
                    <datalist id="editAQInstitiute">
                        <?php
                        foreach (getAQInstitutes() as $i)
                        {
                            echo "<option value='".$i."' >"  ;
                        }
                        ?>
                    </datalist>
                </span>
                <textarea placeholder="Description.." style="resize: none;" class="form-control" id="editAQDescription" rows="2" maxlength="100"></textarea>
                <button id="addAQ" style="margin-top: 10px;">Add</button>
            </div>

            <div id="AQLoadingSection" style="margin:0 auto;padding: 30px;">
                <?php  foreach ( unserialize($_SESSION['current_user'])->getAcademic_q_array() as $i){
                    if(isset($i["aq_title"])){
                        echo(" <div class=\"row\" id='".$i["aq_id"]."'>
 <p><a style=\"color:red;cursor: pointer;\"><i onclick=\"delQ('".$i["aq_id"]."')\" class=\"fas fa-trash-alt\"></i></a>&nbsp;&nbsp;" .$i["aq_title"] . "-" . $i["aq_institute"]
                            . "&nbsp;(" .$i["aq_description"] . ")" . "</p></div>");
                    }
                }
                ?>
            </div>

        </div>
    </div>
    <div class="row decor-default contacts-labels card bg-light mb-3  card-user">
        <h4 class="card-header h5">Proffessional Qualifications</h4>
<!--        <div id="outputProfessional" class="card-body"></div>-->
<!--        <button id="btnProffessional">Update</button>-->
<!---->

    <div>
        <div class="row" style="margin:0 auto;padding-right: 10px; padding-left: 10px;">
                <span class="col-md-6" style="padding-right: 0px; padding-left: 0px;">
                    <input class="form-control" list="editPQMain" name="editPQMain" placeholder="Program.." >
                    <datalist id="editPQMain">
                   <?php foreach (getPQPrograms() as $i)
                   {
                       echo "<option id =".$i[0]." value='".$i[1]."'>"  ;
                   }
                   ?>
                    </datalist>
                </span>
            <span class="col-md-6" style="padding-right: 0px; padding-left: 0px;">
                    <input class="form-control" list="editPQInstitiute" name="editPQInstitiute" placeholder="Institute..">
                    <datalist id="editPQInstitiute">
                        <?php foreach (getPQInstitutes() as $i)
                        {
                            echo "<option value='".$i."' >"  ;
                        }
                        ?>
                    </datalist>
                </span>
            <textarea placeholder="Description.." style="resize: none;" class="form-control" id="editPQDescription" rows="2" maxlength="100"></textarea>
            <button  id="addPQ" style="margin-top: 10px;">Add</button>
        </div>
        <div id="PQLoadingSection" style="margin:0 auto;padding: 30px;">
            <?php
            foreach ( unserialize($_SESSION['current_user'])->getProf_q_array() as $i){
                if(isset($i["pq_title"])){
                    echo (" <div class=\"row\" id='".$i["pq_id"]."'>
     <p><a style=\"color:red;cursor: pointer;\"><i onclick=\"delQ('".$i["pq_id"]."')\" class=\"fas fa-trash-alt\"></i></a>&nbsp;&nbsp;".$i["pq_title"]."-".$i["pq_institute"]
                        ."&nbsp;(".$i["pq_description"].")"."</p></div>");
                }
            }
            ?>
        </div>
    </div>

    </div>
    <div class="row decor-default contacts-labels card bg-light mb-3  card-user">
        <h4 class="card-header h5">Soft Skills</h4>
        <div>
            <div class="row" style="margin:0 auto;padding-right: 10px; padding-left: 10px;">
                <span class="col-md-12" style="padding-right: 0px; padding-left: 0px;">
                    <input class="form-control" list="editSSMain" name="editSSMain" placeholder="Skill type.." >
                    <datalist id="editSSMain">
                   <?php foreach (getSkills() as $i)
                   {
                       echo "<option id =".$i[1]." value='".$i[0]."'>"  ;
                   }
                   ?>
                    </datalist>
                </span>
                <textarea placeholder="Description.." style="" class="form-control" id="editSSDescription" rows="2" maxlength="100"></textarea>
                <button  id="addSS" style="margin-top: 10px;">Add</button>
            </div>
        </div>
        <div id="softSkills" class="card-body"></div>
    </div>

    <button id="btnSoft" class="btn btn-info" >Update Skills & Qualifications</button>
    <br><br>
    
    <div class="row decor-default contacts-labels card bg-light mb-3  card-user">
        <h4 class="card-header h5">Tags</h4>
        <div>
            <div class="row" style="margin:0 auto;padding-right: 10px; padding-left: 10px;">
                <div class="autocomplete" style="width:400px;">
                    <input id="myInput" class="form-control" type="text" name="myCountry" placeholder="Search tags">
                </div>

                <textarea id="tags" class="form-control" rows="2" maxlength="100"></textarea>
                <button onclick="AddToTextBox()" style="margin-top: 10px;">Add</button>
            </div>
        </div>
    </div>
    <button id="updateTags" style="margin-left: 5px;" class="btn btn-info">Update Tags</button>
</div>
<br>
<br>
<?php $loadingPositon = 'footer'; include '../Common/CommonResources.php'; ?>
<script src="../res/js/EditProfile.js"></script>

<?php
    $id = unserialize($_SESSION['current_user'])->getUser_id();
    echo "
     <script src='../res/js/CommonResources.js'></script>
    <script>
        $( document ).ready(function(){
         showUnreadCount('".$id."');
        });
    </script>";
?>

</body>
<script>
    function AddToTextBox(){
            var tagval = document.getElementById("myInput").value;
            document.getElementById("tags").append(tagval + ",");
        }
</script>
</html>

