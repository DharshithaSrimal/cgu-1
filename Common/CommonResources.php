<?php

$profile_only_button_section = "";
if((isset($_SESSION["current_user"]) && $_SESSION["current_user"]!= null)){
    $profile_only_button_section = " <div class=\"collapse navbar-collapse\" id=\"navbarSupportedContent\">
    <ul class=\"navbar-nav mr-auto\">
    <!--
      <li class=\"nav-item\">
        <a class=\"nav-link\" href=\"#\">
          <i class=\"fa fa-envelope-o\">
            <span class=\"badge badge-danger\">11</span>
          </i>
          Link
        </a>
      </li>
      <li class=\"nav-item\">
        <a class=\"nav-link disabled\" href=\"#\">
          <i class=\"fa fa-envelope-o\">
            <span class=\"badge badge-warning\">11</span>
          </i>
          Disabled
        </a>
      </li>
      <li class=\"nav-item dropdown\">
        <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDropdown\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
          <i class=\"fa fa-envelope-o\">
            <span class=\"badge badge-primary\">11</span>
          </i>
          Dropdown
        </a>
        <div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdown\">
          <a class=\"dropdown-item\" href=\"#\">Action</a>
          <a class=\"dropdown-item\" href=\"#\">Another action</a>
          <div class=\"dropdown-divider\"></div>
          <a class=\"dropdown-item\" href=\"#\">Something else here</a>
        </div>
      </li>
      -->
    </ul>
    <ul class=\"navbar-nav \">
      <li class=\"nav-item active\">
        <a class=\"nav-link\" href=\"../View/Home.php\">
          <i class=\"fa fa-home\"></i>
          Home
          <span class=\"sr-only\">(current)</span>
          </a>
      </li>
      <li class=\"nav-item\">
        <a class=\"nav-link\" href=\"../View/Inquiry.php\">
          <i class=\"fa fa-bell\">
            <span class=\"badge badge-info\">11</span>
          </i>
          Messages
        </a>
      </li>
      <li class=\"nav-item\">
        <a class=\"nav-link\" href=\"../View/Profile.php\">
          <i class=\"fa fa-user\">
            <!-- <span class=\"badge badge-success\">11</span> -->
          </i>
          Profile
        </a>
      </li>
    <li class=\"nav-item\">
      <a class=\"nav-link\" href=\"#\">
        <i class=\"fa fa-sign-out-alt\" id=\"btnLogout\">
        </i>
        Logout
      </a>
    </li>
    </ul>
    <!-- <form class=\"form-inline my-2 my-lg-0\">
      <input class=\"form-control mr-sm-2\" type=\"text\" placeholder=\"Search\" aria-label=\"Search\">
      <button class=\"btn btn-outline-success my-2 my-sm-0\" type=\"submit\">Search</button>
    </form> -->
  </div>";
}
else{
    $profile_only_button_section = "";
}

if($loadingPositon == "header"){
//    echo("
//        <nav class=\"navbar navbar-light navbar-expand-md\">
//        <div class=\"container-fluid\"><a class=\"navbar-brand\" href=\"#\">Career Guidance Unit - UOK</a><button data-toggle=\"collapse\" class=\"navbar-toggler\" data-target=\"#navcol-1\"><span class=\"sr-only\">Toggle navigation</span><span class=\"navbar-toggler-icon\"></span></button>
//            <div class=\"collapse navbar-collapse\"
//                id=\"navcol-1\">
//                <ul class=\"nav navbar-nav\">
//                    <li class=\"nav-item\" role=\"presentation\"><a class=\"nav-link\" href=\"../View/Profile.php\">My Profile</a></li>
//                    <li class=\"nav-item\" role=\"presentation\"><a class=\"nav-link\" href=\"#\">Mentors</a></li>
//                    <li class=\"nav-item\" role=\"presentation\"><a class=\"nav-link\" href=\"#\">Communicate</a></li>
//                </ul>
//                <button id=\"btnLogout\">Log out now</button>
//            </div>
//        </div>
//        </nav>
//        <link rel='stylesheet' href='../res/1-bootstrap-4.4.1-dist/css/bootstrap.css'>
//        <link rel='stylesheet' href='../res/1-bootstrap-4.4.1-dist/css/bootstrap-grid.css'>
//        <link rel='stylesheet' href='../res/fontawesome-free-5.13.0-web/css/all.css'>
//    ");
    echo("

<link rel='stylesheet' href='../res/1-bootstrap-4.4.1-dist/css/bootstrap.css'>
<link rel='stylesheet' href='../res/1-bootstrap-4.4.1-dist/css/bootstrap-grid.css'>
<link rel='stylesheet' href='../res/fontawesome-free-5.13.0-web/css/all.css'>
<link rel='stylesheet' href='../res/css/CommonResources.css'>
<script src='../res/2-jquery/jquery-3.3.1.min.js'></script>
<nav class=\"navbar navbar-icon-top navbar-expand-lg navbar-dark bg-dark\">
  <a class=\"navbar-brand\" href=\"#\"><img width=\"300px\" src=\"../res/img/CGUL.png\"></a>
  <h4 id=\"navHeading\">Student Relationship Management System</h4>
  <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarSupportedContent\" aria-controls=\"navbarSupportedContent\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
    <span class=\"navbar-toggler-icon\"></span>
  </button>
  ".$profile_only_button_section."
</nav>
");
}

if($loadingPositon == "footer"){
    echo("

<div id=\"myModal\" class=\"modal\">
      <div class=\"modal-content\">
         <span class=\"close\">&times;</span>
        <p>About The Career Guidance Unit of University Of Kelaniya</p>
        <p>
            The objective of this unit is to prepare the students for their professional life. Making the students aware of employment opportunities available in the country and instructing them about the specific course units they should follow and soft skills they should acquire during their undergraduate life are the broad goals of this unit.

            The aim of the Career Guidance Unit is to prepare students for the outside world and to assist them in finding employment.

            Currently employers are looking for more attributes than simply the Degree. They are searching for a comprehensive graduate. Further the work life highly search for soft skills such as interpersonal skills, communication skills, presentation skills, time management, teamwork, and organizational abilities. The Career Guidance Unit helps the students of the University of Kelaniya to develop these skills.

            This unit gives the chance to the students to identify their goals and to go on that path by providing information, mentoring, advising them, training them and empowering them to achieve their goals.

            Creating links between private and public sector institutions with university students, identifying vocational needs and job opportunities of the industry and making students aware of them are the hallmark of this unit.
        </p>
       
      </div>
</div>

<footer class=\"page-footer\">

    <div class=\"container\">
  
        <div class=\"row mt-3\">
            <div class=\"col-md-6\">
               <br>

                <div class=\"col-md-12\">
                 
                     <div class='row'>
                        <h6 >About SRM System</h6>
                        <a  id=\"btnaboutUs\" href='#'>
                             <i class=\"fas fa-info-circle\"></i>
                        </a>
                    </div>
   
                    <div class='row'>
                        <h6 >Get connected with us on social network!</h6>
                        <a class=\"fb-ic\" target=\"_blank\"  href='https://www.facebook.com/Career-Guidance-Unit-University-of-Kelaniya-415298392551417'>
                            <i class=\"fab fa-facebook-f\" > </i>
                        </a>
                    </div>
                    
                    <div class='row'>
                        <h6 >Visit website</h6>
                        <a class=\"fb-ic\" target=\"_blank\"  href='https://units.kln.ac.lk/cgu/'>
                          <i class=\"fas fa-globe\"></i>
                        </a>
                    </div>
                </div>
               

            </div>
          
            <div class=\"col-md-6\">

                <!-- Links -->
                <br>
                <h6 class=\"text-uppercase font-weight-bold\">Contact</h6>
                <hr class=\"deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto\" style=\"width: 60px;\">
                <p>
                    <i class=\"fas fa-home mr-3\"></i>       Career Guidance Unit,
                                                              University of Kelaniya,
                                                              Dalugama, Kelaniya,
                                                              Sri Lanka, 11600.
                </p>
                <p>
                    <i class=\"fas fa-envelope mr-3\"></i> careers@kln.ac.lk</p>
                <p>
                    <i class=\"fas fa-phone mr-3\"></i> +94 (0) 112 917 711</p>
                <p>
                    <i class=\"fas fa-print mr-3\"></i> +94 (0) 112 917 711</p>

            </div>
            
        </div>
    </div>
    <div class=\"footer-copyright text-center\">© 2020 Copyright: Designed and developed by Nayomi Thalagahage
    </div>

</footer>
        <script src='../res/1-bootstrap-4.4.1-dist/js/bootstrap.min.js'></script>
        <script src='../res/js/CommonResources.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js'></script> 
    ");
}

?>