<?php

include_once '../Common/DbCon.php';
include_once '../Model/User.php';

session_start();

$method;


if(!empty($_POST['method'])) {
    $method =$_POST['method'];
}


if($method == 'load') {
    function loadData()
    {
        $userName = unserialize($_SESSION['current_user'])->getUser_id();
        $con = DbCon::connection();
        $sql = "select * from user u inner join student s on u.user_id = s.stu_id inner join faculty f on s.fac_id = f.fac_id
                inner join degree d on s.deg_id = d.deg_id where u.user_id = '".$userName."'" ;
        $res = $con->query($sql);
        $conn = null; //closing connection
        if ($res) {
            $stu_obj = new Student();
            while ($row = $res->fetch(PDO::FETCH_BOTH)) {
                $stu_obj->setFname($row["fname"]);
                $stu_obj->setLname($row["lname"]);
                $stu_obj->setEmail($row["email"]);
                $stu_obj->setDob($row["dob"]);
                $stu_obj->setUser_id($row["user_id"]);
                $stu_obj->setTpnumber($row["tpnumber"]);
                $stu_obj->setImage($row["image"]);
                $stu_obj->setFac_id($row["fac_id"]);
                $stu_obj->setFacName($row["fac_name"]);
                $stu_obj->setDeg_id($row["deg_id"]);
                $stu_obj->setDegName($row["degree_title"]);
            }
            return $stu_obj;
        }
    }
    $stu_user = loadData();
    $_SESSION["student_user"] = serialize($stu_user);
}