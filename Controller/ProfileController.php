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

    $stuNum = unserialize($_SESSION['current_user'])->getUser_id();
    $fName = $_POST['fName'];
    $lName = $_POST['lName'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $mobile = $_POST['mobile'];

    $image= explode(';base64,',$_POST['image'])[1];
    $image = addslashes(base64_decode($image));

//    $gender = $_POST['gender'];

//    $sql = "UPDATE user SET fname='".$fName."',lname='".$lName."',email='".$email."',dob='".$dob."',tpnumber='".$mobile."',gender='".$gender."'
//     WHERE user_id='".$stuNum."'";
    $sql = "UPDATE user SET fname='".$fName."',lname='".$lName."',email='".$email."',dob='".$dob."',tpnumber='".$mobile."',image='".$image."'
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

    session_update();
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

function session_update(){
    $con = DbCon::connection();
    $sql="select * from user where user.user_id = '".unserialize($_SESSION['current_user'])->getUser_id()."'";
    $res=$con->query($sql);
    $conn = null; //closing connection
    if($res)
    {
        $user_obj = new User();
        while($row = $res->fetch(PDO::FETCH_BOTH)){
            $user_obj->setFname($row["fname"]);
            $user_obj->setLname($row["lname"]);
            $user_obj->setEmail($row["email"]);
            $user_obj->setDob($row["dob"]);
            $user_obj->setUser_id($row["user_id"]);
            $user_obj->setTpnumber($row["tpnumber"]);
            $user_obj->setImage($row["image"]);
            $user_obj->setGender($row["gender"]);
            $user_obj->setRole($row["user_role"]);
        }
         $curr_user = $user_obj;

         if( $curr_user->getFname() != null){
            session_unset();
            session_destroy();
            session_start();
            $_SESSION["current_user"] = serialize($curr_user);

         }
    }
    else
    {
        //
    }
    loadData();  //in UserController.php
}









