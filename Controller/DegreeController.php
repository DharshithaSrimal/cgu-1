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
            $facultyId  = "";
            $degreeId  = "";
            if(!empty($_POST['faculty'])) {
                $facultyId =$_POST['faculty'];
            }
            if(!empty($_POST['degree'])) {
                $degreeId=$_POST['degree'];
            }

            $userName = unserialize($_SESSION['current_user'])->getUser_id();
            $con = DbCon::connection();

            
            $sql = "select * from degree d inner join faculty f on d.fac_id = f.fac_id where d.fac_id = '".$facultyId."' and d.deg_id = '".$degreeId."'";
            //$sql = "select * from degree d inner join faculty f on d.fac_id = f.fac_id where d.fac_id = 1 and d.deg_id = 1";
            $res = $con->query($sql);
            $conn = null; //closing connection
            if ($res) {
                echo "inq success";
                $degree_obj = new Degree();
                while ($row = $res->fetch(PDO::FETCH_BOTH)) {
                    $degree_obj->setFacultyName($row["fac_name"]);
                    $degree_obj->setDegreeId($row["deg_id"]);
                    $degree_obj->setDegreeTitle($row["degree_title"]);
                    $degree_obj->setDegreeDuration($row["degree_duration"]);
                }
                return $degree_obj;
            }
            else {
                echo "Failed to load data.";
            }
        }
        $stu_user = loadData(); 
        $_SESSION["student_user"] = serialize($stu_user);    
    }

    if($method == 'loadDegree') {

            $facultyId = "";
            if(!empty($_POST['faculty'])) {
                $facultyId =$_POST['faculty'];
            }
//                $userName = unserialize($_SESSION['student_user'])->getUser_id();
                try{
                    $con = DbCon::connection();
                    $query = "select * from degree d inner join faculty f on d.fac_id = f.fac_id where d.fac_id =".$facultyId;
                    $stmt = $con->prepare($query);
                    $stmt->execute(); 
                    $result = $stmt->fetchAll();
                    
//                    $_SESSION["student_user"] = serialize($result);
                    echo json_encode($result);
                }
                catch(Exception $ex){                    
                    echo($ex->getMessage());
                }
         
    }
     
        
    



