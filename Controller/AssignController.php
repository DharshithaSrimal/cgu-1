
<?php
include_once '../Common/DbCon.php';
include_once '../Model/User.php';

$method ="";
if(!empty($_POST['method'])) {
    $method = $_POST['method'];
}

if($method == 'assign_lecturer'){

    $staff_id = $_POST['staff_id'];
    $stu_id = $_POST['stu_id'];
    $con = DbCon::connection();
    $sql = "UPDATE student_counselor SET staff_id = '".$staff_id."' WHERE stu_id = '".$stu_id."'";
    try{
        $res=$con->query($sql);

    }catch (PDOException $e){
         echo $e;
    }
   

}

?>