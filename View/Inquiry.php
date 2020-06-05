<?php
session_start();
if (!isset($_SESSION["current_user"]) || $_SESSION["current_user"] == null) {
    header("Location: ./Login.php");
    exit();
}

include_once '../Controller/InquiryController.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>CGU - Home</title>
    <meta name="description" content="Career Guidance Unit - System">
    <meta name="author" content="CGU-UOK">
    <link rel="stylesheet" href="../res/css/Inquiry.css">
    <?php $loadingPositon = 'header'; include '../Common/CommonResources.php'; ?>
</head>

<body>
<h5 class="title">Inbox</h5>
<div id="main" class="row">
    <div id="contact_list" class="col-md-3">
        <ul class="list-group">
        <?php
            $msges = loadAllInqueries(unserialize($_SESSION['current_user'])->getUser_id());
           // $senders = array();
//            var_dump($msges) ;
            foreach ( $msges as $msg){
                //array_push($senders,$msg->getSender());
                echo "<li>".$msg->getSender()."<span class=\"badge\">2</span>  </li>";
            }
        ?>
        </ul>
    </div>

    <div id="msg_main_div" class="col-md-5">
        <div>
            <button class="btn btn-light" >View Inquiry History</button><br><br>
            <div>
                <label for="inquiry">Select Inquiry Type:</label>
                <select id="inquiryType" class="custom-select">
                    <option value="Level one Subject Selection">Level one Subject Selection</option>
                    <option value="Level two Subject Selection">Level two Subject Selection</option>
                    <option value="Level three Subject Selection">Level three Subject Selection</option>
                    <option value="Level four Subject Selection">Level four Subject Selection</option>
                </select>
                <br><br>
                <label for="composeInquiry">Compose Your Inquiry:</label>
                <br>
                <textarea id="composeInquiry" rows="4" cols="50"></textarea>

                <input class="btn btn-info" id="submitInquiry" type="button" value="Submit">
            </div>
        </div>
        <div>
            <div id="msg_div">
                <div class="my">
                    <div class="d_time">2020 May 27 8:55 PM</div>
                    <div class="msg_text">
                        Hi i'm test 1
                    </div>
                    <div class="pro_pic_frame" >
                        <img class="pro_pic" src="../res/img/testImage.jpg" />
                    </div>
                </div>
                <div class="other">
                    <div class="d_time">2020 May 27 8:55 PM</div>
                    <div class="pro_pic_frame" >
                        <img class="pro_pic" src="../res/img/testImage.jpg" />
                    </div>
                    <div class="msg_text">
                        Hi i'm test 2
                    </div>
                </div>
                <div class="my">
                    <div class="d_time">2020 May 27 8:55 PM</div>
                    <div class="msg_text">
                        Hi i'm test 1
                    </div>
                    <div class="pro_pic_frame" >
                        <img class="pro_pic" src="../res/img/testImage.jpg" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>

</style>

<?php $loadingPositon = 'footer'; include '../Common/CommonResources.php'; ?>
<script src="../res/js/Inquiry.js"></script>
</body>

</html>
<?php