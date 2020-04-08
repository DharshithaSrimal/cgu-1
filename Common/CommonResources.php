<?php

if($loadingPositon == "header"){
    echo("
        <link rel='stylesheet' href='../res/1-bootstrap-4.4.1-dist/css/bootstrap.css'>
        <link rel='stylesheet' href='../res/1-bootstrap-4.4.1-dist/css/bootstrap-grid.css'>
        <link rel='stylesheet' href='../res/fontawesome-free-5.13.0-web/css/all.css'>
    ");
}

if($loadingPositon == "footer"){
    echo("
        <script src='../res/2-jquery/jquery-3.3.1.min.js'></script>
        <script src='../res/1-bootstrap-4.4.1-dist/js/bootstrap.min.js'></script>
    ");
}

?>