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
                           echo "<li onclick='showMsg(".json_encode($tobeSent).",".unserialize($_SESSION['current_user'])->getUser_id().")'>".$msg->getSender()."<span class=\"badge\">2</span>  </li>";
                       }
                       if($msg->getReceiverId() != unserialize($_SESSION['current_user'])->getUser_id()){
                           array_push($msg_names,$msg->getReceiver());
                           echo "<li onclick='showMsg(".json_encode($tobeSent).",".unserialize($_SESSION['current_user'])->getUser_id().")'>".$msg->getReceiver()."<span class=\"badge\">2</span>  </li>";
                       }
                   }
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