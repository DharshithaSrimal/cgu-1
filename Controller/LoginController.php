<?php 
    include '..\Common\DbCon.php';

    $userName=$_POST['userName'];
    $pw=$_POST['pw'];
    //echo $userName;
    $con = DbCon::connection();

?>