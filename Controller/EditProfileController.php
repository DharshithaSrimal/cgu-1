<?php

include_once '../Common/DbCon.php';
include_once '../Model/User.php';
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
$method;
if(!empty($_POST['method'])) {
    $method = $_POST['method'];
}

if($method == 'update_profile'){
    $firstName =$_POST['fname'];
    $lastName =$_POST['lname'];
    $email =$_POST['email'];
    $tpnumber =$_POST['tpnumber'];

    $image= explode(';base64,',$_POST['image'])[1];
    $image = addslashes(base64_decode($image));

    $academic_position =$_POST['academic_position'];
    $cgu_position =$_POST['cgu_position'];
    $experience =$_POST['experience'];
    $specialized_areas =$_POST['specialized_areas'];

    $academic_qualifications =$_POST['academic_qualifications'];
    $professional_qualifications =$_POST['professional_qualifications'];

    $fac_id = $_POST['fac_id'];

    $con = DbCon::connection();
    $sql1 = "UPDATE user SET fname='".$firstName."',lname='".$lastName."',email='".$email."',tpnumber='".$tpnumber."',image='".$image."'
     WHERE user_id='".unserialize($_SESSION['current_user'])->getUser_id()."'";

    $sql2 = "UPDATE staff_member SET experience ='".$experience."' ,fac_id = '".$fac_id."',specialised_area ='".$specialized_areas."' ,
    academic_position ='".$academic_position."' ,cgu_position ='".$cgu_position."'  WHERE staff_id = '".unserialize($_SESSION['current_user'])->getUser_id()."'";

    $sql3 = "";

    try{
        $res=$con->query($sql1);
    }catch (PDOException $e){
         echo $e;
    }
 echo "Profile Updated";
}

function getFacultis(){
    $con = DbCon::connection();
    $sql = "SELECT fac_name,fac_id FROM faculty";

    $res = $con->query($sql);

    $conn = null; //closing connection

    $facultyArray = array();

    if ($res) {
        while($row = $res->fetch(PDO::FETCH_ASSOC)){
            array_push($facultyArray,array($row["fac_id"],$row["fac_name"]));
        }
    }

    return $facultyArray;

}

function getAQPrograms(){
    $con = DbCon::connection();
    $sql = "SELECT distinct aq_id, aq_title FROM academic_qualification;";

    $res = $con->query($sql);

    $conn = null; //closing connection

    $aQArray = array();

    if ($res) {
        while($row = $res->fetch(PDO::FETCH_ASSOC)){
            array_push($aQArray,array($row["aq_id"],$row["aq_title"]));
        }
    }

    return $aQArray;
}

function getAQInstitutes(){
    $con = DbCon::connection();
    $sql = "SELECT distinct aq_institute  FROM user_academic_qualification;";

    $res = $con->query($sql);

    $conn = null; //closing connection

    $aQArray = array();

    if ($res) {
        while($row = $res->fetch(PDO::FETCH_ASSOC)){
            array_push($aQArray,$row["aq_institute"]);
        }
    }
    return $aQArray;
}




function getPQPrograms(){
    $con = DbCon::connection();
    $sql = "SELECT distinct pq_id,pq_title FROM proffesional_qualification;";

    $res = $con->query($sql);

    $conn = null; //closing connection

    $aQArray = array();

    if ($res) {
        while($row = $res->fetch(PDO::FETCH_ASSOC)){
            array_push($aQArray,array($row["pq_id"],$row["pq_title"]));
        }
    }
    return $aQArray;
}

function getPQInstitutes(){
    $con = DbCon::connection();
    $sql = "SELECT distinct pq_institute FROM user_proffesional_qualification;";

    $res = $con->query($sql);

    $conn = null; //closing connection

    $aQArray = array();

    if ($res) {
        while($row = $res->fetch(PDO::FETCH_ASSOC)){
            array_push($aQArray,$row["pq_institute"]);
        }
    }
    return $aQArray;
}
