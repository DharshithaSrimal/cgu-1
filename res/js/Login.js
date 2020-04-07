
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


////////////////////// modal code start //////////////////////////////

var modal = document.getElementById("myModal");
var btn = document.getElementById("btnaboutUs");
var span = document.getElementsByClassName("close")[0];
btn.onclick = function() {
    modal.style.display = "block";
}
span.onclick = function() {
    modal.style.display = "none";
}
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

//////////////////////// modal code end //////////////////////////////