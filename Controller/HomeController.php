<?php
include_once '../Common/DbCon.php';
include_once '../Model/User.php';


function create_staff_obj(){

}

function loadUser(){


}

function loadStudentList(){

    $con = DbCon::connection();
    $sql = "SELECT user.*,student.*,faculty.fac_name,degree.degree_title,student_counselor.given_rating 
            FROM student_counselor,user,student ,faculty ,degree
            WHERE user.user_id = student.stu_id AND 
             student.stu_id = student_counselor.stu_id AND 
             student_counselor.staff_id = '".unserialize($_SESSION['current_user'])->getUser_id()."' AND 
             faculty.fac_id = student.fac_id AND 
             student.deg_id = degree.deg_id AND 
             student_counselor.relationship = 'counselor'";
    try{
        $student_array = array();

        $res=$con->query($sql);

        while($row = $res->fetch(PDO::FETCH_BOTH)){

            $student_obj = new Student();

            $student_obj->setFname($row["fname"]);
            $student_obj->setLname($row["lname"]);
            $student_obj->setEmail($row["email"]);
            $student_obj->setDob($row["dob"]);
            $student_obj->setUser_id($row["user_id"]);
            $student_obj->setTpnumber($row["tpnumber"]);
            $student_obj->setImage($row["image"]);
            $student_obj->setGender($row["gender"]);
            $student_obj->setRole($row["user_role"]);
            $student_obj->setDeg_id($row["degree_title"]);
            $student_obj->setDegName($row["deg_id"]);
            $student_obj->setFac_id($row["fac_id"]);
            $student_obj->setFacName($row["fac_name"]);
            $student_obj->setRate($row["given_rating"]);

            array_push($student_array, $student_obj);

        }

       // echo  $student_array[0]->getFname();
        return $student_array;

    }catch (PDOException $e){
        echo $e;
    }
    $con = null; //closing connection

}