<?php
    include_once '../Common/DbCon.php';
    include_once '../Model/User.php';
    include_once '../Model/Inquiry.php';

    session_start();

    $inqType;
    $inqBody;
    $method;
    $stu_id = unserialize($_SESSION['current_user'])->getUser_id();

    if(!empty($_POST['method'])) {
        $method =$_POST['method'];
    }
    if(!empty($_POST['inqType'])) {
        $inqType=$_POST['inqType'];
    }
    if(!empty($_POST['inqBody'])) {
        $inqBody=$_POST['inqBody'];
    }

    if($method == 'inqSubmit' && isset($inqType) && isset($inqBody)){
        $con = DbCon::connection();
        $sql="INSERT INTO inquiry (stu_id,inq_type,inq_description) VALUES ('".$stu_id."','".$inqType."','".$inqBody."');";
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

?>
