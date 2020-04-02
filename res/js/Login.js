
$("#submitLogin").click(function(){



    $.ajax({
        type: "POST",
        url: "LoginController.php",
        data: {'pw':"pw",'user':"user"},
        cache: false,
        success: function(result){
    
          alert(result);
    
        }
    });


}
