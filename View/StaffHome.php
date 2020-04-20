<?php include_once '../Controller/UserController.php'; loadData();?>
<link rel="stylesheet" href="../res/css/staffHome.css">
<div class="container bootstrap snippets">
    <div class="row decor-default">
        <div class="col-lg-3 col-md-4 col-sm-12">
            <div class="contacts-labels">
                <br>
                <h4>Welcome <?php echo unserialize($_SESSION['current_user'])->getFname() ?> !</h4>
                <br>
                <div class="pro_pic_frame" >
                    <?php echo '<img class="pro_pic" src="data:image/jpg;base64,'.base64_encode(unserialize($_SESSION['current_user'])->getImage()).'" />'; ?>
                </div>

                <div id="home_profile_summary">
                    <br>
                    <h5><?php echo unserialize($_SESSION['current_user'])->getAcademicPosition()?></h5>

                    <br>
                    <button class="btn btn-default">Edit profile</button>
                </div>
            </div>
        </div>
        <div class="col-lg-9 col-md-8 col-sm-12">
            <div class="contacts-list">
                <h5 class="title">Students under your supervision</h5>

                <form class="ac-custom ac-checkbox ac-checkmark" autocomplete="off">

                    <div class="input-group">
                        <input type="text" class="contacts-list-search" placeholder="Search......." name="search">
                        <button type="button" class="btn" id="search_button"><i class="fa fa-search"></i></button>
                    </div>
                  <?php


                  include_once '../Controller/HomeController.php';
                  $stu_ar = loadStudentList();

                  foreach ($stu_ar as $stu) {

                      echo "  <div class=\"unit\">
                        <div class=\"field name\">
                            <div class=\"check\">
                                <input id=\"cb2\" name=\"cb1\" type=\"checkbox\">
                                <label for=\"cb2\"></label>
                                <svg viewBox=\"0 0 100 100\" xmlns=\"http://www.w3.org/2000/svg\"></svg>

                            </div>
                            <div>
                                <div class='avatartFrame'> 
                                    <img src=\"data:image/jpg;base64,".base64_encode($stu->getImage())."\" alt=\"image\" class=\"avatar\"> 
                                </div>
                                ".$stu->getFname()." ".$stu->getLname()."
                            </div>
    <!--                            <div class=\"lab lab-warning\">Friends</div>-->
                        </div>
                        <div class=\"field phone\">
                            +1-800-600-9898
                        </div>
                        <div class=\"field email\">
                            example@gmail.com
                        </div>
                    </div>";
                  }
                  ?>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="../res/js/staffHome.js"></script>
