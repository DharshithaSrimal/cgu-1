<?php include_once '../Controller/UserController.php'; loadData();?>
<?php include_once '../Controller/EditProfileController.php';?>
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
<link rel="stylesheet" href="../res/css/staffProfile.css">
<script src="../res/js/staffHome.js"></script>
<div class="container bootstrap snippets">
    <div class="row decor-default">
        <div class="col-lg-3 col-md-4 col-sm-12">
            <div id="leftCol" class="contacts-labels">
                <br>
                <input style="width: 100%" type="input" class="form-control" id="editFname" value="<?php echo unserialize($_SESSION['current_user']    )->getFname()?>" placeholder="First Name">
                <input style="width: 100%" type="input" class="form-control" id="editLname" value="<?php echo unserialize($_SESSION['current_user']    )->getLname() ?>" placeholder="Last Name">
                <br>
                <div class="image-upload">
                    <label for="file-input">
                        <a class="image_upload_ic" style = "color:var(--main-color2)">
                            <i class="fas fa-plus-circle fa-2x"></i>
                        </a>
                    </label>
                    <input type='file' onchange="readURL(this);" id="file-input"/>
                </div>
                <div class="pro_pic_frame" >
                    <img class="pro_pic" id ="pro_pic_ele"<?php echo 'src="data:image/jpg;base64,'.base64_encode(unserialize($_SESSION['current_user'])->getImage()).'"'; ?> />
                </div>
                <div id="home_profile_summary">
                    <br>
                    <div class="row">
                        <select class="form-control col-md-8" id="editCguPos">
                            <?php foreach ($cgu_postions as $val)
                            {
                                if(unserialize($_SESSION['current_user'])->getCguPosition() == $val){ echo"<option id='".$val."' selected >".$val."</option>";}
                                else echo"<option id='".$val."'>".$val."</option>";
                            }?>
                        </select>
                        <div  class="" style="width:auto">
                            <h5 style="text-transform:capitalize;text-align: right"><span style = "text-transform:none;">&nbsp;at</span> CGU</h5>
                        </div>
                    </div>
                    <br>
                    <div style="margin-top:10px;"><span style="color:#868686">Faculty position:&nbsp;</span>
                        <select class="form-control col-md-12" id="editFacPos">
                            <?php foreach ($faculty_position as $val)
                            {
                                if(unserialize($_SESSION['current_user'])->getAcademicPosition() == $val){ echo"<option id='".$val."' selected >".$val."</option>";}
                                else echo"<option id='".$val."'>".$val."</option>";
                            }?>

                        </select>
                    </div>
                    <div style="margin-top:10px;"><span style="color:#868686">Faculty:&nbsp;</span>
                        <select class="form-control col-md-12" id="editFac">
                            <?php foreach (getFacultis() as $val)
                            {
                                if(unserialize($_SESSION['current_user'])->getFacName() == $val[1]){ echo"<option id='".$val[0]."' selected >".$val[1]."</option>";}
                                else echo"<option id='".$val[0]."'>".$val[1]."</option>";
                            }?>
                        </select>
                    </div>
                    <div style="margin-top:10px;">
                        <span style="color:#868686">Phone:&nbsp;</span><input type="input" class="form-control" id="editPhone" value="<?php echo unserialize($_SESSION['current_user'])->getTpnumber()?>"/></input>
                    </div>
                    <div style="margin-top:10px;">
                        <span style="color:#868686">E-mail:&nbsp;</span><input type="input" class="form-control" id="editEmail" value="<?php echo unserialize($_SESSION['current_user'])->getEmail()?>"/></input>
                    </div>
                    <br>

                </div>
            </div>
        </div>
        <div class="col-lg-9 col-md-8 col-sm-12">
            <div class="contacts-list">
                <div>
                    <form class="ac-custom ac-checkbox ac-checkmark" autocomplete="off"></form>
                    <div class="allUnits">
                        <br>
                        <div style="display:inline-flex">
                            <span style="color:#868686">Service period:&nbsp&nbsp</span>
                            <input style="width: 50px" type="input" class="form-control" id="editServicePeriod" value="<?php
                            $txt = unserialize($_SESSION['current_user'])->getExperience();
                            $txt1 = explode(" ",$txt);
                            echo ($txt1[0]);
                            ?>"/>
                            &nbsp&nbsp
                            <select class="form-control" id="editServicePeriod1">
                                <?php
                                    foreach (Array("years","month")as $i)
                                    {
                                        if($txt1[1] == $i){echo ("<option selected>".$i."</option>");}
                                        else{echo ("<option>".$i."</option>");}
                                    }
                                ?>
                            </select>
                            <div style="color:#868686">at&nbsp;academic&nbsp;staff</div>
                        </div>
                        <hr>
                        <div>
                            <span style="color:#868686">Academic Qualifications:&nbsp&nbsp</span>
                            <div class="row">
                                <span class="col-md-6" style="padding-right: 0px; padding-left: 0px;">
                                    <input class="form-control" list="editAQMain" name="editAQMain" placeholder="Program.." >
                                    <datalist id="editAQMain">
                                        <?php foreach (getAQPrograms() as $i)
                                                {
                                                    echo "<option id =".$i[0]." value='".$i[1]."'>"  ;
                                                }
                                            ?>
                                    </datalist>
                                </span>
                                <span class="col-md-6" style="padding-right: 0px; padding-left: 0px;">
                                    <input class="form-control" list="editAQInstitiute" name="editAQInstitiute" placeholder="Institute..">
                                    <datalist id="editAQInstitiute">
                                        <?php foreach (getAQInstitutes() as $i)
                                        {
                                            echo "<option value='".$i."' >"  ;
                                        }
                                        ?>
                                    </datalist>
                                </span>
                                <textarea placeholder="Description.." style="resize: none;" class="form-control" id="editAQDescription" rows="2" maxlength="100"></textarea>
                                <button id="addAQ">Add</button>
                            </div>
                            <div id="AQLoadingSection">
                                <?php  foreach ( unserialize($_SESSION['current_user'])->getAcademic_q_array() as $i){
                                if(isset($i["aq_title"])){
                                    echo(" <div class=\"row\" id='".str_replace(array(',', ' '), '', $i["aq_title"]).str_replace(array(',', ' '), '', $i["aq_institute"])."'>
 <p><a style=\"color:red;cursor: pointer;\"><i onclick=\"delQ('".str_replace(array(',', ' '), '', $i["aq_title"]).str_replace(array(',', ' '), '', $i["aq_institute"])."')\" class=\"fas fa-trash-alt\"></i></a>&nbsp;&nbsp;" .$i["aq_title"] . "-" . $i["aq_institute"]
                                        . "&nbsp;(" .$i["aq_description"] . ")" . "</p></div>");
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <hr>
                        <div>
                            <span style="color:#868686">Professional Qualifications:&nbsp&nbsp</span>
                            <div class="row">
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
                                <button  id="addPQ">Add</button>
                            </div>
                            <div id="PQLoadingSection">
                                <?php
                                foreach ( unserialize($_SESSION['current_user'])->getProf_q_array() as $i){
                                        if(isset($i["pq_title"])){
                                            echo (" <div class=\"row\" id='".str_replace(array(',', ' '), '', $i["pq_title"]).str_replace(array(',', ' '), '', $i["pq_institute"])."'>
 <p><a style=\"color:red;cursor: pointer;\"><i onclick=\"delQ('".str_replace(array(',', ' '), '', $i["pq_title"]).str_replace(array(',', ' '), '', $i["pq_institute"])."')\" class=\"fas fa-trash-alt\"></i></a>&nbsp;&nbsp;".$i["pq_title"]."-".$i["pq_institute"]
                                                ."&nbsp;(".$i["pq_description"].")"."</p></div>");
                                        }
                                }
                                ?>
                            </div>
                        </div>
                        <hr>
                        <div>
                            <span style="color:#868686">Specialized Areas:&nbsp&nbsp</span>
                            <textarea class="form-control" id="editSA" rows="3" ><?php echo unserialize($_SESSION['current_user'])->getSpecialized_area()?></textarea></div>
                        <hr>
                    </div>
                    </form>

                    <div>
                        <button id="saveProfileBtn" class="btn btn-default saveProfileBtn">Save profile</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="../res/js/EditStaffProfile.js"></script>
<?php $loadingPositon = 'footer'; include '../Common/CommonResources.php'; ?>
</body>

</html>