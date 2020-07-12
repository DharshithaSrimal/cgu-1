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

    $academic_qualifications =json_decode($_POST['academic_qualifications']);
    $professional_qualifications =json_decode($_POST['professional_qualifications']);

    $fac_id = $_POST['fac_id'];

    $con = DbCon::connection();


    try{
   // $sql1="DELETE  FROM academic_qualification WHERE user_id ='';";
    $sql2="DELETE  FROM user_academic_qualification WHERE user_id ='".unserialize($_SESSION['current_user'])->getUser_id()."';";
    //$sql3="DELETE  FROM proffesional_qualification WHERE user_id ='';";
    $sql4 ="DELETE  FROM user_proffesional_qualification WHERE user_id ='".unserialize($_SESSION['current_user'])->getUser_id()."';";
       // $res=$con->query($sql1);
        $res=$con->query($sql2);
       // $res=$con->query($sql3);
        $res=$con->query($sql4);
    }catch (PDOException $e){
         echo $e;

    }


    $sql1 = "UPDATE user SET fname='".$firstName."',lname='".$lastName."',email='".$email."',tpnumber='".$tpnumber."',image='".$image."'
     WHERE user_id='".unserialize($_SESSION['current_user'])->getUser_id()."'";

    $sql2 = "UPDATE staff_member SET experience ='".$experience."' ,fac_id = '".$fac_id."',specialised_area ='".$specialized_areas."' ,
    academic_position ='".$academic_position."' ,cgu_position ='".$cgu_position."'  WHERE staff_id = '".unserialize($_SESSION['current_user'])->getUser_id()."'";

    try{

        $res=$con->query($sql1);
        $res=$con->query($sql2);

    }catch (PDOException $e){
         echo $e;

    }

    //update academic and professional qualifications
    foreach ($academic_qualifications as &$value) {
        $aq_id =  $value[0];
        $aq_title =  $value[1];
        $aq_institute =  $value[2];
        $description =  $value[3];
        $user_id = unserialize($_SESSION['current_user'])->getUser_id();
        if($aq_id == ""){
            //new AQ
            $aq_id = time();
            $sql3="INSERT INTO academic_qualification values('".$aq_id."','".$aq_title."','')";
            $sql4="INSERT INTO user_academic_qualification values('".$user_id."','".$aq_id."','".$aq_institute."','Completed','".$description."')";
            try{
                $res=$con->query($sql3);
                $res=$con->query($sql4);
            }catch (PDOException $e){
                 echo $e;
            }
        }
        else{
            //existing AQ
            $sql5="INSERT INTO user_academic_qualification values('".$user_id."','".$aq_id."','".$aq_institute."','Completed','".$description."')";
            try{
                $res=$con->query($sql5);
            }catch (PDOException $e){
                 echo $e;
            }
        }

    }
    foreach ($professional_qualifications as &$value) {
        $pq_id = time();
        $pq_title =  $value[0];
        $pq_institute =  $value[1];
        $description =  $value[2];

        $sql3="INSERT INTO proffesional_qualification values('".$pq_id."','".$pq_title."','')";
        $sql4="INSERT INTO user_proffesional_qualification values('".$user_id."','".$pq_id."','".$pq_institute."','Completed','".$description."')";
        try{
            $res=$con->query($sql3);
            $res=$con->query($sql4);
        }catch (PDOException $e){
             echo $e;
        }
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


