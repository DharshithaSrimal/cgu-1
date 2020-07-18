<?php include_once '../Controller/UserController.php'; loadData();?>
<link rel="stylesheet" href="../res/css/staffHome.css">
<script src="../res/js/staffHome.js"></script>
<div class="container bootstrap snippets">
    <div class="row decor-default">
        <div class="col-lg-3 col-md-4 col-sm-12">
            <div id="leftCol" class="contacts-labels">
                <br>
                <h4>Welcome <?php echo unserialize($_SESSION['current_user'])->getFname() ?> !</h4>
                <br>
                <div class="pro_pic_frame" >
                    <?php echo '<img class="pro_pic" src="data:image/jpg;base64,'.base64_encode(unserialize($_SESSION['current_user'])->getImage()).'" />'; ?>
                </div>

                <div id="home_profile_summary">
                    <br>
                    <h5  style = "text-transform:capitalize;"><?php echo unserialize($_SESSION['current_user'])->getCguPosition()?> <span style = "text-transform:none;">at</span> CGU</h5>
                    <h6><?php echo unserialize($_SESSION['current_user'])->getAcademicPosition()?></h6>
                    <p style="margin-top: -10px"><?php echo unserialize($_SESSION['current_user'])->getFacName()?></p>
                    <br>
                    <p style="margin-top: -10px">Contact: <?php echo unserialize($_SESSION['current_user'])->getTpnumber()?></p>

                    <br>
                   <div>
                       <button id="editProfileBtn" class="btn btn-default editProfileBtn">Edit profile</button>
                   </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9 col-md-8 col-sm-12">
            <div id="newsPublishWindow" class="row">
                <div class ='col-md-8'>
                    <br>
                    <h5 style="color: var(--main-color3);" class="title">Publish News for your students</h5>
                    <br>
                    <iframe src="http://localhost:8080/cgu/View/NewsPublish.php" title="News publish" frameBorder="0"
                            style="width:800px;height:500px;">

                    </iframe>
                    <iframe src="http://localhost:8080/cgu/View/NewsView.php" title="News view" frameBorder="0"
                            style="width:800px;height:500px; overflow-x: hidden !important; overflow-y: scroll !important" >

                    </iframe>
                    <br>
                </div>
                <div class ='col-md-4' style="height: 200px">
                    <button style="margin-left: 60px;margin-top:30px;" class="btn-default">View Published Items</button>
                </div>
            </div>
            <div class="contacts-list">
                <h5 class="title">Students under your supervision</h5>
<!--                <div style="float: right">-->
<!--                    <div class="dropdown show">-->
<!--                        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
<!--                            All-->
<!--                        </a>-->
<!---->
<!--                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">-->
<!--                            <a class="dropdown-item" href="#">Recent activities</a>-->
<!--                            <a class="dropdown-item" href="#">Another action</a>-->
<!--                            <a class="dropdown-item" href="#">Something else here</a>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->

                <form class="ac-custom ac-checkbox ac-checkmark" autocomplete="off">

                    <div class="input-group">
                        <input type="text" class="contacts-list-search" placeholder="Search......." name="search">
                        <button type="button" class="btn" id="search_button"><i class="fa fa-search"></i></button>
                    </div>
                    <div class="allUnits">
                        <?php

                        include_once '../Controller/HomeController.php';
                        $stu_ar = loadStudentList();

                        foreach ($stu_ar as $stu) {
                            $id=str_replace("/","",$stu->getUser_id());
                            echo "  <div class=\"unit\">
                                        <div class=\"field name\">
                                            <div>
                                                <div class='avatartFrame'> 
                                                    <img src=\"data:image/jpg;base64,".base64_encode($stu->getImage())."\" alt=\"image\" class=\"avatar\"> 
                                                </div>
                                                <div class=\"stuName\">".$stu->getFname()." ".$stu->getLname()."  </div>
                                                    <fieldset id=\"".$id."\" class=\"rating\">
                                                        <input type=\"radio\" id=\"".$id."star5\" name=\"".$id."rating\" value=\"5\" /><label class = \"full\" for=\"star5\" title=\"Very Good\"></label>
                                                        <input type=\"radio\" id=\"".$id."star4half\" name=\"".$id."rating\" value=\"4 and a half\" /><label class=\"half\" for=\"star4half\" title=\"Very Good\"></label>
                                                        <input type=\"radio\" id=\"".$id."star4\" name=\"".$id."rating\" value=\"4\" /><label class = \"full\" for=\"star4\" title=\"Good\"></label>
                                                        <input type=\"radio\" id=\"".$id."star3half\" name=\"".$id."rating\" value=\"3 and a half\" /><label class=\"half\" for=\"star3half\" title=\"Good\"></label>
                                                        <input type=\"radio\" id=\"".$id."star3\" name=\"".$id."rating\" value=\"3\" /><label class = \"full\" for=\"star3\" title=\"Average\"></label>
                                                        <input type=\"radio\" id=\"".$id."star2half\" name=\"".$id."rating\" value=\"2 and a half\" /><label class=\"half\" for=\"star2half\" title=\"Average\"></label>
                                                        <input type=\"radio\" id=\"".$id."star2\" name=\"".$id."rating\" value=\"2\" /><label class = \"full\" for=\"star2\" title=\"Poor\"></label>
                                                        <input type=\"radio\" id=\"".$id."star1half\" name=\"".$id."rating\" value=\"1 and a half\" /><label class=\"half\" for=\"star1half\" title=\"Poor\"></label>
                                                        <input type=\"radio\" id=\"".$id."star1\" name=\"".$id."rating\" value=\"1\" /><label class = \"full\" for=\"star1\" title=\"Very Poor\"></label>
                                                        <input type=\"radio\" id=\"".$id."starhalf\" name=\"".$id."rating\" value=\"half\" /><label class=\"half\" for=\"starhalf\" title=\"Very Poor\"></label>
                                                    </fieldset>
                                            </div>
                                        </div>
                                        <div class=\"field phone\" style=\"width: 60% !important;height: 100px  !important;\">
                                             <span style='font-weight: bold'>Notes: </span>
                                             Dear sir, I changed my profile description. Please review my profile
                                        </div>
                                    </div>";

                            echo "<script type=\"text/javascript\">
                              drawStarRating(\"".$id."\",".$stu->getRate().");
                              </script>"
                            ;
                        }
                        ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


