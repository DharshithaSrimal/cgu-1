<?php
include_once '../Common/DbCon.php';
include_once '../Model/News.php';
include_once '../Model/User.php';

session_start();

function LoadNews(){

    $news_array = array();
    $con = DbCon::connection();
    $sql="";
    if(unserialize($_SESSION['current_user'])->getRole()=='lecturer' || unserialize($_SESSION['current_user'])->getRole()=='admin'){
        $sql="SELECT * FROM news WHERE publishedBy =\"".unserialize($_SESSION['current_user'])->getUser_id()."\" AND isDeleted =0";
    }

    if(unserialize($_SESSION['current_user'])->getRole()=='student'){
        $sql="SELECT * FROM news WHERE (publishedBy = (select staff_id FROM student_counselor WHERE stu_id = '".unserialize($_SESSION['current_user'])->getUser_id()."') AND isDeleted =0) OR (publishedForAll = 1  AND isDeleted =0)";
    }

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
?>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.css" rel="stylesheet">

<?php
$newslIST =  array_reverse(LoadNews()); ;
$deleteButtonContent = "";

if(unserialize($_SESSION['current_user'])->getRole()=='lecturer' || unserialize($_SESSION['current_user'])->getRole()=='admin'){
    $deleteButtonContent = "<input style=\"display:inline-flex;Float:right\"  class=\"btn btn-info\" id=\"publishNews\" type=\"button\" value=\"Delete\" onclick=\'deleteNews()\'>";
}

foreach ($newslIST as $news) {

    echo "<div style='background-color: #dfdfdf;padding:10px;margin-top: 10px;'>
            
            <div style='display:inline-flex;Float:left'> Published on ".$news->getDateTime()." by ".$news->getPublishedBy()." </div>
            ".$deleteButtonContent."
            <div style='display:inline-flex;height: auto;'>
                ".$news->getContent()."
            </div>
        </div>
        ";
}

?>

<script>

    function deleteNews(){
        var r = confirm("Are you sure want to delete this ?");
        if (r == true) {

        } else {

        }
    }
</script>







