<?php
include_once '../Common/DbCon.php';
include_once '../Model/News.php';
include_once '../Model/User.php';

session_start();

function LoadNews(){

    $news_array = array();

    $con = DbCon::connection();
    $sql="SELECT * FROM news WHERE publishedBy =".unserialize($_SESSION['current_user'])->getUser_id()." AND isDeleted =0";

    $res=$con->query($sql);
    $conn = null; //closing connection

    if($res) {

        while($row = $res->fetch(PDO::FETCH_BOTH)){
            $news_obj = new News();

            $news_obj->setIdnews($row["idnews"]);
            $news_obj->setContent($row["content"]);
            $news_obj->setIsDeleted($row["isDeleted"]);
            $news_obj->setPublishedForAll($row["publishedForAll"]);
            $news_obj->setPublishedBy($row["publishedBy"]);
            $news_obj->setDateTime($row["dateTime"]);
            array_push($news_array, $news_obj);
        }

        return $news_array;
    }
}


$newslIST = LoadNews();

foreach ($newslIST as $news) {

    echo "<div>
            <div style='height: auto; margin-top: 10px; background-color: #6c757d'> 
                ".$news->getContent()."
            </div>
        </div>
        ";
}

?>







