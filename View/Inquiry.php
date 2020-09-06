<?php
include_once '../Controller/InquiryController.php';
include_once '../Controller/HomeController.php';

if (!isset($_SESSION["current_user"]) || $_SESSION["current_user"] == null) {
    header("Location: ./Login.php");
    exit();

}
if (isset($_GET['newMsg'])) {
   $res =$_GET['newMsg'];
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>CGU - Messages</title>
    <meta name="description" content="Career Guidance Unit - System">
    <meta name="author" content="CGU-UOK">
    <link rel="stylesheet" href="../res/css/Inquiry.css">
    <?php $loadingPositon = 'header'; include '../Common/CommonResources.php'; ?>

    <!-- include libraries(jQuery, bootstrap) -->

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.css" rel="stylesheet">

</head>

<body>
<h5 class="title">Inbox</h5>
<div id="main" class="row">

    <div id="contact_list" class="col-md-3">
        <ul class="list-group">
        <?php
            $msges = loadAllInqueries(unserialize($_SESSION['current_user'])->getUser_id());
            $msg_names = array();
            foreach ( $msges as $msg){
                   $allreadyIn = 0 ;
                   foreach ($msg_names as $a){
                       if($msg->getSender() == $a){
                           $allreadyIn =1;
                       }
                       if($msg->getReceiver() == $a){
                           $allreadyIn =1;
                       }
                   }

                    $otherUserID = "";

                    if($msg->getSenderId() == unserialize($_SESSION['current_user'])->getUser_id() ){
                        $otherUserID = $msg->getReceiverId();

                    }
                    if($msg->getReceiverId() == unserialize($_SESSION['current_user'])->getUser_id() ){
                        $otherUserID = $msg->getSenderId();

                    }

                   if($allreadyIn == 0){
                       $msgData = array(); // all messages with certain user
                       foreach ( $msges as $msg2){
                           //filtering out communication with certain user
                           if(  ($msg2->getSenderId() == $otherUserID || $msg2->getReceiverId() == $otherUserID)  ){

                                   array_push($msgData,$msg2);
                           }
                       }

                       $tobeSent = $msgData;

                       if($msg->getSenderId() != unserialize($_SESSION['current_user'])->getUser_id()){
                           array_push($msg_names,$msg->getSender());
                           echo "<li id='ele_".str_replace("/","-",$msg->getSenderId())."' onclick='showMsg(".json_encode($tobeSent).",\"".str_replace(" "," ",unserialize($_SESSION['current_user'])->getUser_id())."\",\"".str_replace("/","-",$msg->getSenderId())."\")'>".$msg->getSender()."<span class=\"badge\">2</span>  </li>";
                       }
                       if($msg->getReceiverId() != unserialize($_SESSION['current_user'])->getUser_id()){
                           array_push($msg_names,$msg->getReceiver());
                           echo "<li id='ele_".str_replace("/","-",$msg->getReceiverId())."' onclick='showMsg(".json_encode($tobeSent).",\"".str_replace(" "," ",unserialize($_SESSION['current_user'])->getUser_id())."\",\"".str_replace("/","-",$msg->getReceiverId())."\")'>".$msg->getReceiver()."<span class=\"badge\">2</span>  </li>";
                       }
                   }
            }
        ?>
        </ul>
    </div>

    <div id="msg_main_div" class="col-md-5">
        <div style="position:absolute; top:-40px; right:0px;">
            <button class="btn btn-warning" onclick = "newMessage()">New Message</button>
        </div>
        <div>
            <!-- <button class="btn btn-light" >View Inquiry History</button><br><br> -->
            <div>
                 <!--<label for="inquiry">Select Inquiry Type:</label>
                <select id="inquiryType" class="custom-select">
                    <option value="Level one Subject Selection">Stu 1</option>
                    <option value="Level two Subject Selection">Stu 2</option>
                </select>-->

                <h3 id="NewMessageHeading">New Message:</h3>
                <label for="to">To:</label>
                <select id="receiverList" class="custom-select" style="font-size: inherit !important;">
                    <?php
                        if( unserialize($_SESSION['current_user'])->getRole() == "lecturer" || unserialize($_SESSION['current_user'])->getRole() == "admin"){
                            $stu_list = loadStudentList();

                            foreach ( $stu_list as $stu){
                                echo("<option id='".str_replace("/","-",$stu->getUser_id())."' value='".$stu->getUser_id()."'>".$stu->getFname()." ".$stu->getLname()."-".$stu->getUser_id()."</option>");
                            }
                        }
                    if( unserialize($_SESSION['current_user'])->getRole() == "student"){
                        $staff_list = loadStaffList();

                        foreach ( $staff_list as $staff){
                            echo("<option id='".str_replace("/","-",$staff->getUser_id())."' value='".$staff->getUser_id()."'>".$staff->getFname()." ".$staff->getLname()."-".$staff->getUser_id()."</option>");
                        }
                    }
                    ?>

                </select>
                <br><br>
                <label for="composeInquiry">Compose Your Message:</label>
                <br>
                <div id="composeInquiry"></div>
                <script>
                    $('#composeInquiry').summernote({
                        placeholder: 'Type your message',
                        tabsize: 2,
                        height: 100
                    });
                </script>
                <input class="btn btn-info" id="submitInquiry" type="button" value="Send">
            </div>
        </div>
        <div>
            <div id="msg_div">

            </div>
        </div>
    </div>
</div>
<style>

</style>

<?php $loadingPositon = 'footer'; include '../Common/CommonResources.php'; ?>
<?php

if(isset($res)){
 echo "
 <script>
       setTimeout(function(){\$('#ele_".$res."').click()},2000);
 </script>
 ";
}
?>
<script src="../res/js/Inquiry.js"></script>
<?php
$id = unserialize($_SESSION['current_user'])->getUser_id();
echo "  <script> getMessageNotifications('".$id."');  </script>";

$id = unserialize($_SESSION['current_user'])->getUser_id();
echo "  <script>
                $( document ).ready(function(){
                      showUnreadCount('".$id."');
                 });

        </script>";

?>
</body>

</html>
<?php