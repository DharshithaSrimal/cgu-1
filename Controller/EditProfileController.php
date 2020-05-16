<?php

include_once '../Common/DbCon.php';
include_once '../Model/User.php';

$method;

if(!empty($_POST['method'])) {
    $method = $_POST['method'];
}

if($method == 'update_profile'){

    $firstName =$_POST['firstName'];
    $lastName =$_POST['lastName'];


    $con = DbCon::connection();
    $sql = " ";
    try{
        $res=$con->query($sql);
    }catch (PDOException $e){

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
