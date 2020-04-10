<?php

include_once '../Common/DbCon.php';
require '../Model/Degree.php';
require '../Model/User.php';

session_start();
$method;

    if(!empty($_POST['method'])) {
        $method = $_POST['method'];
    }
    if($method == 'load') {
        function loadData()
        {
            $userName = unserialize($_SESSION['current_user'])->getUser_id();
            $con = DbCon::connection();
            //$sql = "select * from degree d inner join faculty f on d.fac_id = f.fac_id where d.fac_id = '".$fac_id."' and d.deg_id = '".$deg_id."'";
            $sql = "select * from degree d inner join faculty f on d.fac_id = f.fac_id where d.fac_id = 1 and d.deg_id = 1";
            $res = $con->query($sql);
            $conn = null; //closing connection
            if ($res) {
                $degree_obj = new Degree();
                while ($row = $res->fetch(PDO::FETCH_BOTH)) {
                    $degree_obj->setFacultyId($row["fac_id"]);
                    $degree_obj->setDegreeId($row["deg_id"]);
                    $degree_obj->setDegreeTitle($row["degree_title"]);
                    $degree_obj->setDegreeDuration($row["degree_duration"]);
                    //$degree_obj->setUser_id($row["fac_name"]);
                }
                return $degree_obj;
            }
        }
        $stu_user = loadData();
        $_SESSION["student_user"] = serialize($stu_user);
    }



