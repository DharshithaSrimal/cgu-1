<?php

include_once '../Common/DbCon.php';
include_once '../Model/User.php';
include_once 'UserController.php';

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

$method;

if(!empty($_POST['method'])) {
    $method =$_POST['method'];
}

if($method == 'searchStudent') {
    $userId = unserialize($_SESSION['current_user'])->getUser_id();
    $tags = $_POST['tags'];
    $output = rtrim($tags, ',');

    $con = DbCon::connection();
    $sql = "select user_id,tags from user where tags IS NOT NULL";

    $res = $con->query($sql);
    $conn = null; //closing connection
    if ($res) {
        $yourArray = array(); // make a new array to hold all your data

        $index = 0;
        while($row = $res->fetch(PDO::FETCH_ASSOC)){ // loop to store the data in an associative array.
            similar_text($output,$row['tags'],$percent);
            if ($percent > "50") {
                $yourArray[$index] = $row;
            }
            $index++;
        }
       //print_r($yourArray);
       echo json_encode($yourArray);
    }
    else{
        echo "Failed";
    }
}