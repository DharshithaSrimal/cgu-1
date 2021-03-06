<?php
    include_once '../Common/DbCon.php';
    include_once '../Model/User.php';
    include_once '../Model/Inquiry.php';

    session_start();

    $inqType = null;
    $msg_body = null;
    $method = null;
    $receiver = null;
    $sender = unserialize($_SESSION['current_user'])->getUser_id();
    $time  = null;

    if(!empty($_POST['method'])) {
        $method =$_POST['method'];
    }
    if(!empty($_POST['inqType'])) {
        $inqType=$_POST['inqType'];
    }
    if(!empty($_POST['msg_body'])) {
        $msg_body=$_POST['msg_body'];
    }
    if(!empty($_POST['receiver'])) {
        $receiver=$_POST['receiver'];
    }

    if($method == 'inqSubmit' && isset($inqType) && isset($msg_body)){
        $con = DbCon::connection();
        $sql="INSERT INTO inquiry (sender,receiver,inq_type,msg_body,time) VALUES ('".$sender."','".$receiver."','".$inqType."','".$msg_body."','".date("Y-m-d h:m:s",time())."');";
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

    if($method == 'unreadCount'){
        $receiverID = "";
        $senderID = "";
        if(!empty($_POST['receiverID'])) {
            $receiverID=$_POST['receiverID'];
        }

        $con = DbCon::connection();
        $sql="SELECT inquiry.sender,COUNT(inquiry.read) AS count FROM inquiry WHERE inquiry.read = 0 and  inquiry.receiver = \"".$receiverID."\" group by sender";
        $res=$con->query($sql);
        $conn = null; //closing connection
        if($res) {
            $msg_count_array = array();
            while($row = $res->fetch(PDO::FETCH_BOTH)){
                $msg_count_array[$row["sender"]] = $row["count"];
            }
            echo json_encode($msg_count_array);
        }
//        else {
//            echo "inq failed";
//        }
    }

    if($method == "setReadMsg"){
        if(!empty($_POST['receiverID'])) {
            $receiverID=$_POST['receiverID'];
        }
        if(!empty($_POST['senderID'])) {
            $senderID=$_POST['senderID'];
        }
        $con = DbCon::connection();
        $sql="UPDATE inquiry SET inquiry.read = 1 WHERE sender='".$senderID."' AND receiver='".$receiverID."'";
        $res=$con->query($sql);
        var_dump($res) ;
        $conn = null; //closing connection
    }
    function loadAllInqueries($currentUser){
        $con = DbCon::connection();
         $sql="SELECT i.inq_id,inq_type,i.msg_body,i.time, CONCAT(u.fname ,' ',u.lname) as receiver ,i.receiver as receiver_id , CONCAT(u1.fname ,' ', u1.lname) as sender,i.sender as sender_id, i.read
         FROM inquiry i JOIN  user u ON i.receiver = u.user_id JOIN user u1 ON i.sender = u1.user_id
         WHERE receiver ='".$currentUser."' OR sender = '".$currentUser."' ORDER BY i.time DESC";

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
                $inq_obj->setSenderId($row["sender_id"]);
                $inq_obj->setReceiverId($row["receiver_id"]);
                $inq_obj->setRead($row["read"]);

                array_push($msg_array, $inq_obj);
            }

            return $msg_array;
        }
        else {
            echo "No msg";
        }
    }

?>
