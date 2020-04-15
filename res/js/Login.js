
$("#submitLogin").click(function(){

  var userName = $("#stuNumber").val();
  var pw = $("#password").val();
  var method = "login";

  $.ajax({
      type: "POST",
      url: "../Controller/LoginController.php",
      data: 'pw='+pw+'&userName='+userName+'&method='+method,
      cache: false,
      success: function(result){
          //alert(result)
          if(result == "login success"){
              window.location.replace("../View/Home.php");
          }
          if(result == "login failed"){
           $("#errorMsg").text("Login failed. Check user name and password again");
        }
      }
  });
});

