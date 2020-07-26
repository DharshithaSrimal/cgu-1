<?php
include_once '../Common/DbCon.php';
include_once '../Model/User.php';

session_start();

$method = null;

if(!empty($_POST['method'])) {
    $method =$_POST['method'];
}

if($method == 'publishNews') {
    $content =$_POST['content'];
    $publishedForAll = $_POST['publishScope'];
    $publishedBy =  unserialize($_SESSION['current_user'])->getUser_id();
    $con = DbCon::connection();
    $sql="INSERT INTO news (content,publishedForAll,publishedBy,dateTime) VALUES 
          ('".$content."','".$publishedForAll."','".$publishedBy."','".date("Y-m-d h:m:s",time())."');";
    $res=$con->query($sql);
    $conn = null; //closing connection
    if($res) {
        echo "Publish success";
    }
    else {
        echo "Publish failed";
    }

}

if($method == 'deleteNews') {

    $newsId =$_POST['newsId'];

    $con = DbCon::connection();
    $sql="UPDATE news SET isDeleted= 1 WHERE idnews=".$newsId;
    $res=$con->query($sql);
    $conn = null; //closing connection
    if($res) {
        echo "Deleted";
    }
    else {
        echo "Delete failed";
    }

}


?>