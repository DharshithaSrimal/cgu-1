<?php
include_once '../Common/DbCon.php';
include_once '../Model/User.php';

session_start();

$method;

if(!empty($_POST['method'])) {
    $method =$_POST['method'];
}

if($method == 'loadAcademic') {
    $userId = unserialize($_SESSION['current_user'])->getUser_id();
    $con = DbCon::connection();
    $sql = "select * from user_academic_qualification u inner join academic_qualification s on u.aq_id = s.aq_id where u.user_id='".$userId."'";

    $res = $con->query($sql);

    $conn = null; //closing connection
    if ($res) {
        $yourArray = array(); // make a new array to hold all your data

        $index = 0;
        while($row = $res->fetch(PDO::FETCH_ASSOC)){ // loop to store the data in an associative array.
            $yourArray[$index] = $row;
            $index++;
        }
//        print_r($yourArray);
        echo json_encode($yourArray);
    }
    else{
        echo "Failed";
    }
    }

if($method == 'loadProfessional') {
    $userId = unserialize($_SESSION['current_user'])->getUser_id();
    $con = DbCon::connection();
    $sql = "select * from user_proffesional_qualification u inner join proffesional_qualification s on u.pq_id = s.pq_id where u.user_id='".$userId."'";

    $res = $con->query($sql);

    $conn = null; //closing connection
    if ($res) {
        $yourArray = array(); // make a new array to hold all your data

        $index = 0;
        while($row = $res->fetch(PDO::FETCH_ASSOC)){ // loop to store the data in an associative array.
            $yourArray[$index] = $row;
            $index++;
        }
//        print_r($yourArray);
        echo json_encode($yourArray);
    }
    else{
        echo "Failed";
    }
}

if($method == 'loadSkills') {
    $userId = unserialize($_SESSION['current_user'])->getUser_id();
    $con = DbCon::connection();
    $sql = "select * from student_soft_skill u inner join soft_skill s on u.ss_id = s.ss_id where u.stu_id='".$userId."'";

    $res = $con->query($sql);

    $conn = null; //closing connection
    if ($res) {
        $yourArray = array(); // make a new array to hold all your data

        $index = 0;
        while($row = $res->fetch(PDO::FETCH_ASSOC)){ // loop to store the data in an associative array.
            $yourArray[$index] = $row;
            $index++;
        }
//        print_r($yourArray);
        echo json_encode($yourArray);
    }
    else{
        echo "Failed";
    }
}

if ($method == 'editPersonal'){

    $stuNum = $_POST['stuNum'];
    $fName = $_POST['fName'];
    $lName = $_POST['lName'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $mobile = $_POST['mobile'];
    $gender = $_POST['gender'];

    $sql = "UPDATE user SET fname='".$fName."',lname='".$lName."',email='".$email."',dob='".$dob."',tpnumber='".$mobile."',gender='".$gender."'
     WHERE user_id='".$stuNum."'";
    
    $con = DbCon::connection();
    $res = $con->query($sql);
    $conn = null;

    if ($res) {
        echo "edit success";
    }
    else{
        echo "edit failed";
    }
}

if ($method == 'editAcademic'){

    $userId = unserialize($_SESSION['current_user'])->getUser_id();
    $level = $_POST['level'];
    $institute = $_POST['institute'];
    $courseId = $_POST['courseId'];

    $sql = "UPDATE user_academic_qualification SET aq_institute='".$institute."',aq_level='".$level."' 
            WHERE user_id='".$userId."' AND aq_id ='".$courseId."'";

    $con = DbCon::connection();
    $res = $con->query($sql);
    $conn = null;

    if ($res) {
        echo "edit success";
    }
    else{
        echo "edit failed";
    }
}

if ($method == 'editProfessional'){

    $userId = unserialize($_SESSION['current_user'])->getUser_id();
    $level = $_POST['level'];
    $institute = $_POST['institute'];
    $courseId = $_POST['courseId'];

    $sql = "UPDATE user_proffesional_qualification SET pq_institute='".$institute."',pq_level='".$level."' 
            WHERE user_id='".$userId."' AND pq_id ='".$courseId."'";

    $con = DbCon::connection();
    $res = $con->query($sql);
    $conn = null;

    if ($res) {
        echo "edit success";
    }
    else{
        echo "edit failed";
    }
}

if ($method == 'editSoft'){

    $userId = unserialize($_SESSION['current_user'])->getUser_id();
    $description = $_POST['description'];
    $courseId = $_POST['courseId'];

    $sql = "UPDATE student_soft_skill SET description='".$description."' 
            WHERE stu_id='".$userId."' AND ss_id ='".$courseId."'";

    $con = DbCon::connection();
    $res = $con->query($sql);
    $conn = null;

    if ($res) {
        echo "edit success";
    }
    else{
        echo "edit failed";
    }
}