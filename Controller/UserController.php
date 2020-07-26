<?php

include_once '../Common/DbCon.php';
include_once '../Model/User.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$method = null;


if(!empty($_POST['method'])) {
    $method =$_POST['method'];
}


if($method == 'load') {

    loadData();

}

function loadData()
{
    if(unserialize($_SESSION['current_user'])->getRole()=='student'){
        $userName = unserialize($_SESSION['current_user'])->getUser_id();
        $con = DbCon::connection();
        $sql = "select * from user u inner join student s on u.user_id = s.stu_id inner join faculty f on s.fac_id = f.fac_id
                inner join degree d on s.deg_id = d.deg_id where u.user_id = '".$userName."'" ;
        $res = $con->query($sql);
        $conn = null; //closing connection
        if ($res) {
            $stu_obj = new Student();
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
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
            }
//            print_r(json_encode(var_dump((array) $stu_obj)));
            $_SESSION["student_user"] = serialize($stu_obj);

        }
    }

    if(unserialize($_SESSION['current_user'])->getRole()=='lecturer'){
        $userName = unserialize($_SESSION['current_user'])->getUser_id();
        $con = DbCon::connection();


        $sql =  "Select u.*,s.*,f.*,
                ua.aq_institute,ua.aq_level,
                ua.description,aq.aq_title,aq.aq_id,
                up.pq_institute,up.pq_level,
                pq.pq_title,pq.pq_id,up.description AS pq_description from user u
                inner join staff_member s on u.user_id = s.staff_id 
                inner join faculty f on s.fac_id = f.fac_id
                Left join user_academic_qualification ua on ua.user_id = u.user_id
                Left join academic_qualification aq on aq.aq_id = ua.aq_id
                Left join user_proffesional_qualification up on up.user_id = u.user_id
                Left join proffesional_qualification pq on pq.pq_id = up.pq_id
                where u.user_id = '".$userName."'";

        $res = $con->query($sql);
        $conn = null; //closing connection
        if ($res) {
            $staff_obj = new Staff();
            $row_count = 0;
            while ($row = $res->fetch(PDO::FETCH_BOTH)) {
                $row_count = $row_count+1;
                if($row_count == 1){
                    $staff_obj->setFname($row["fname"]);
                    $staff_obj->setLname($row["lname"]);
                    $staff_obj->setEmail($row["email"]);
                    $staff_obj->setDob($row["dob"]);
                    $staff_obj->setUser_id($row["user_id"]);
                    $staff_obj->setTpnumber($row["tpnumber"]);
                    $staff_obj->setImage($row["image"]);
                    $staff_obj->setFac_id($row["fac_id"]);
                    $staff_obj->setFacName($row["fac_name"]);
                    $staff_obj->setRole($row["user_role"]);
                    $staff_obj->setExperience($row["experience"]);
                    $staff_obj->setSpecialized_area($row["specialised_area"]);
                    $staff_obj->setAcademicPosition($row["academic_position"]);
                    $staff_obj->setCguPosition($row["cgu_position"]);

                    $staff_obj->setAcademic_q_array(array("aq_id"=>$row["aq_id"],"aq_title"=>$row["aq_title"],"aq_institute"=>$row["aq_institute"],
                        "aq_level"=>$row["aq_level"],"aq_description"=>$row["description"]));

                    $staff_obj->setProf_q_array(array("pq_id"=>$row["pq_id"],"pq_title"=>$row["pq_title"],"pq_institute"=>$row["pq_institute"],
                        "pq_level"=>$row["pq_level"],"pq_description"=>$row["pq_description"]));

                }
                else{
                    $staff_obj->setAcademic_q_array(array("aq_id"=>$row["aq_id"],"aq_title"=>$row["aq_title"],"aq_institute"=>$row["aq_institute"],
                        "aq_level"=>$row["aq_level"],"aq_description"=>$row["description"]));
                     $exist = 0;
                     foreach ( $staff_obj->getProf_q_array() as $i){
                         if($i["pq_id"] == $row["pq_id"] &&  $i["pq_id"] != ""){
                             $exist = 1;
                         }
                     }
                    if($exist == 0){
                        $staff_obj->setProf_q_array(array("pq_id"=>$row["pq_id"],"pq_title"=>$row["pq_title"],"pq_institute"=>$row["pq_institute"],
                            "pq_level"=>$row["pq_level"],"pq_description"=>$row["pq_description"]));
                    }
                }
            }
            $_SESSION["current_user"] = serialize($staff_obj);
        }

    }
}