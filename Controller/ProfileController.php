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

if($method == 'loadSkills_proView') {
    $userId = $_POST['profUid'] ;
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

if($method =='updateRatiing'){
    $userId = $_POST['profUid'];
    $rating = $_POST['rating'];
    $con = DbCon::connection();
    $sql = "UPDATE student_counselor SET given_rating = '".$rating."' WHERE stu_id='".$userId."'";
    $res = $con->query($sql);
    if ($res) {
        echo "ok";
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

if ($method == 'insertTags'){

    $userId = unserialize($_SESSION['current_user'])->getUser_id();
    $tags = $_POST['tags'];
    $output = rtrim($tags, ',');

    $sql = "UPDATE user SET tags='".$output."' WHERE user_id='".$userId."'";

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

function loadOtherUser($profileUserId){

        $con = DbCon::connection();
        $sql =  "Select u.*,s.*,f.*,d.*,
                ua.aq_institute,ua.aq_level,
                ua.description,aq.aq_title,aq.aq_id,
                up.pq_institute,up.pq_level,
                pq.pq_title,pq.pq_id,up.description AS pq_description from user u
                inner join student s on u.user_id = s.stu_id 
                inner join faculty f on s.fac_id = f.fac_id
                inner join degree d on s.deg_id = d.deg_id
                Left join user_academic_qualification ua on ua.user_id = u.user_id
                Left join academic_qualification aq on aq.aq_id = ua.aq_id
                Left join user_proffesional_qualification up on up.user_id = u.user_id
                Left join proffesional_qualification pq on pq.pq_id = up.pq_id
                where u.user_id ='".$profileUserId."'";

        $res = $con->query($sql);

        $conn = null; //closing connection
        if ($res) {
            $stu_obj = new Student();
            $row_count = 0;
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                $row_count = $row_count+1;
                if($row_count == 1){
                    $stu_obj->setFname($row["fname"]);
                    $stu_obj->setLname($row["lname"]);
                    $stu_obj->setEmail($row["email"]);
                    $stu_obj->setDob($row["dob"]);
                    $stu_obj->setUser_id($row["user_id"]);
                    $stu_obj->setGender($row["gender"]);
                    $stu_obj->setTpnumber($row["tpnumber"]);
                    $stu_obj->setImage($row["image"]);
                    $stu_obj->setFac_id($row["fac_id"]);
                    $stu_obj->setFacName($row["fac_name"]);
                    $stu_obj->setRole($row["user_role"]);
                    $stu_obj->setDeg_id($row["deg_id"]);
                    $stu_obj->setDegName($row["degree_title"]);

                    $stu_obj->setAcademic_q_array(array("aq_id"=>$row["aq_id"],"aq_title"=>$row["aq_title"],"aq_institute"=>$row["aq_institute"],
                        "aq_level"=>$row["aq_level"],"aq_description"=>$row["description"]));

                    $stu_obj->setProf_q_array(array("pq_id"=>$row["pq_id"],"pq_title"=>$row["pq_title"],"pq_institute"=>$row["pq_institute"],
                        "pq_level"=>$row["pq_level"],"pq_description"=>$row["pq_description"]));
                }
                else{
                    $exist1 = 0;
                    foreach ( $stu_obj->getAcademic_q_array() as $i){
                        if($i["aq_id"] == $row["aq_id"] &&  $i["aq_id"] != ""){
                            $exist1 = 1;
                        }
                    }
                    if($exist1 == 0){
                        $stu_obj->setAcademic_q_array(array("aq_id"=>$row["aq_id"],"aq_title"=>$row["aq_title"],"aq_institute"=>$row["aq_institute"],
                            "aq_level"=>$row["aq_level"],"aq_description"=>$row["description"]));
                    }

                    $exist = 0;
                    foreach ( $stu_obj->getProf_q_array() as $i){
                        if($i["pq_id"] == $row["pq_id"] &&  $i["pq_id"] != ""){
                            $exist = 1;
                        }
                    }
                    if($exist == 0){
                        $stu_obj->setProf_q_array(array("pq_id"=>$row["pq_id"],"pq_title"=>$row["pq_title"],"pq_institute"=>$row["pq_institute"],
                            "pq_level"=>$row["pq_level"],"pq_description"=>$row["pq_description"]));
                    }
                }

            }
            return $stu_obj;
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









