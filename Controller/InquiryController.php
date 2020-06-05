<?php
    include_once '../Common/DbCon.php';
    include_once '../Model/User.php';
    include_once '../Model/Inquiry.php';

    $inqType = null;
    $inqBody = null;
    $method = null;
    $receiver = null;
    $sender = unserialize($_SESSION['current_user'])->getUser_id();

    if(!empty($_POST['method'])) {
        $method =$_POST['method'];
    }
    if(!empty($_POST['inqType'])) {
        $inqType=$_POST['inqType'];
    }
    if(!empty($_POST['inqBody'])) {
        $inqBody=$_POST['inqBody'];
    }
    if(!empty($_POST['receiver'])) {
        $receiver=$_POST['receiver'];
    }

    if($method == 'inqSubmit' && isset($inqType) && isset($inqBody)){
        $con = DbCon::connection();
        $sql="INSERT INTO inquiry (sender,receiver,inq_type,msg_body,time) VALUES ('".$sender."','".$receiver."','".$inqType."','".$inqBody.", '".date("Y-m-d h:m:s",time())."'');";
        $res=$con->query($sql);
        $conn = null; //closing connection
        if($res) {
            echo "inq success";
        }
        else {
            echo "inq failed";
        }
    }

    if($method == 'logout'){
        session_unset();
        session_destroy();
        echo "logout success";
    }

    function loadAllInqueries($currentUser){
        $con = DbCon::connection();
         $sql="SELECT i.inq_id,inq_type,i.msg_body,i.time, CONCAT(u.fname ,' ',u.lname) as receiver ,i.receiver as receiver_id , CONCAT(u1.fname ,' ', u1.lname) as sender,i.sender as sender_id
         FROM inquiry i JOIN  user u ON i.receiver = u.user_id JOIN user u1 ON i.sender = u1.user_id
         WHERE receiver ='".$currentUser."' OR sender = '".$currentUser."'";

        $res=$con->query($sql);
        $conn = null; //closing connection

        $msg_array = array();

        if($res) {

            while($row = $res->fetch(PDO::FETCH_BOTH)){

                $inq_obj = new Inquiry();

                $inq_obj->setInqId($row["inq_id"]);
                $inq_obj->setInqType($row["inq_type"]);
                $inq_obj->setMsgBody($row["msg_body"]);
                $inq_obj->setSender($row["sender"]);
                $inq_obj->setReceiver($row["receiver"]);
                $inq_obj->setTime($row["time"]);

                array_push($msg_array, $inq_obj);
            }

            return $msg_array;
        }
        else {
            echo "No msg";
        }
    }
?>
