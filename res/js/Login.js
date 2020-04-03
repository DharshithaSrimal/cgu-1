
$("#submitLogin").click(function(){

  var userName = $("#stuNumber").val();
  var pw = $("#password").val();

  $.ajax({
      type: "POST",
      url: "../Controller/LoginController.php",
      data: 'pw='+pw+'&userName='+userName,
      cache: false,
      success: function(result){
  
        alert(result);
  
      }
  });


});
