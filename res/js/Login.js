
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

          if(result == "login success"){
              window.location.replace("../View/Login.php");
          }
  
      }
  });


});
