<?php

if($loadingPositon == "header"){
    echo("
        <nav class=\"navbar navbar-light navbar-expand-md\">
        <div class=\"container-fluid\"><a class=\"navbar-brand\" href=\"#\">Career Guidance Unit - UOK</a><button data-toggle=\"collapse\" class=\"navbar-toggler\" data-target=\"#navcol-1\"><span class=\"sr-only\">Toggle navigation</span><span class=\"navbar-toggler-icon\"></span></button>
            <div class=\"collapse navbar-collapse\"
                id=\"navcol-1\">
                <ul class=\"nav navbar-nav\">
                    <li class=\"nav-item\" role=\"presentation\"><a class=\"nav-link\" href=\"../View/Profile.php\">About Us</a></li>
                    <li class=\"nav-item\" role=\"presentation\"><a class=\"nav-link\" href=\"#\">Contact Us</a></li>
                    <li class=\"nav-item\" role=\"presentation\"><a class=\"nav-link\" href=\"#\">My Profile</a></li>
                </ul>
                <button id=\"btnLogout\">Log out now</button>
            </div>
        </div>
        </nav>
        <link rel='stylesheet' href='../res/1-bootstrap-4.4.1-dist/css/bootstrap.css'>
        <link rel='stylesheet' href='../res/1-bootstrap-4.4.1-dist/css/bootstrap-grid.css'>
    ");
}

if($loadingPositon == "footer"){
    echo("

        <script src='../res/2-jquery/jquery-3.3.1.min.js'></script>
        <script src='../res/1-bootstrap-4.4.1-dist/js/bootstrap.min.js'></script>
    ");
}

?>