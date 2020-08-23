<?php
include_once '../Common/DbCon.php';
include_once '../Model/User.php';


function create_staff_obj(){

}

function loadUser(){

}


function loadStaffList(){
    $con = DbCon::connection();
    $sql = "SELECT distinct user.*,staff_member.*,faculty.fac_name
            FROM student_counselor,user,faculty ,degree,staff_member
            WHERE user.user_id = staff_member.staff_id AND 
            staff_member.staff_id = student_counselor.staff_id AND 
            student_counselor.stu_id = '".unserialize($_SESSION['current_user'])->getUser_id()."' AND 
            faculty.fac_id = staff_member.fac_id 
            UNION
            SELECT u.*,s.*,f.fac_name
            FROM user u
            JOIN staff_member s ON s.staff_id =  u.user_id
            LEFT JOIN  faculty f on f.fac_id = s.fac_id 
            WHERE u.user_role = 'admin' OR s.cgu_position = 'director' 
            OR s.cgu_position = 'coordinator'
            OR s.cgu_position = 'FAA'";
    try{
        $staff_array = array();

        $res=$con->query($sql);

        while($row = $res->fetch(PDO::FETCH_BOTH)){

            $staff_obj = new Staff();

            $staff_obj->setFname($row["fname"]);
            $staff_obj->setLname($row["lname"]);
            $staff_obj->setEmail($row["email"]);
            $staff_obj->setDob($row["dob"]);
            $staff_obj->setUser_id($row["user_id"]);
            $staff_obj->setTpnumber($row["tpnumber"]);
            $staff_obj->setImage($row["image"]);
            $staff_obj->setGender($row["gender"]);
            $staff_obj->setRole($row["user_role"]);
            $staff_obj->setSpecialized_area($row["specialised_area"]);//
            $staff_obj->setAcademicPosition($row["academic_position"]);//
            $staff_obj->setFac_id($row["fac_id"]);
            $staff_obj->setFacName($row["fac_name"]);
            $staff_obj->setCguPosition($row["cgu_position"]);//

            array_push($staff_array, $staff_obj);

        }

        // echo  $student_array[0]->getFname();
        return $staff_array;

    }catch (PDOException $e){
        echo $e;
    }
    $con = null; //closing connection
} 

function loadStaff(){
    $con = DbCon::connection();
    $sql = "SELECT distinct user.*,staff_member.*,faculty.fac_name
            FROM user,faculty ,degree,staff_member
            WHERE user.user_id = staff_member.staff_id AND 
            faculty.fac_id = staff_member.fac_id 
            UNION
            SELECT u.*,s.*,f.fac_name
            FROM user u
            JOIN staff_member s ON s.staff_id =  u.user_id
            LEFT JOIN  faculty f on f.fac_id = s.fac_id 
            WHERE u.user_role = 'admin' OR s.cgu_position = 'director' 
            OR s.cgu_position = 'coordinator'
            OR s.cgu_position = 'FAA'";
    try{
        $staff_array = array();

        $res=$con->query($sql);

        while($row = $res->fetch(PDO::FETCH_BOTH)){

            $staff_obj = new Staff();

            $staff_obj->setFname($row["fname"]);
            $staff_obj->setLname($row["lname"]);
            $staff_obj->setEmail($row["email"]);
            $staff_obj->setDob($row["dob"]);
            $staff_obj->setUser_id($row["user_id"]);
            $staff_obj->setTpnumber($row["tpnumber"]);
            $staff_obj->setImage($row["image"]);
            $staff_obj->setGender($row["gender"]);
            $staff_obj->setRole($row["user_role"]);
            $staff_obj->setSpecialized_area($row["specialised_area"]);//
            $staff_obj->setAcademicPosition($row["academic_position"]);//
            $staff_obj->setFac_id($row["fac_id"]);
            $staff_obj->setFacName($row["fac_name"]);
            $staff_obj->setCguPosition($row["cgu_position"]);//

            array_push($staff_array, $staff_obj);

        }

        // echo  $student_array[0]->getFname();
        return $staff_array;

    }catch (PDOException $e){
        echo $e;
    }
    $con = null; //closing connection
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

function studentList(){

    $con = DbCon::connection();
    $sql = "SELECT user.*,student.*,faculty.fac_name,degree.degree_title 
            FROM student_counselor,user,student ,faculty ,degree
            WHERE user.user_id = student.stu_id AND 
             student.stu_id = student_counselor.stu_id AND 
             faculty.fac_id = student.fac_id AND 
             student.deg_id = degree.deg_id";
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

            array_push($student_array, $student_obj);

        }

       // echo  $student_array[0]->getFname();
        return $student_array;

    }catch (PDOException $e){
        echo $e;
    }
    $con = null; //closing connection

}