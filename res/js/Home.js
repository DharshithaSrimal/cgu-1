$("#btnLogout").click(function(){

    $.ajax({
        type: "POST",
        url: "../Controller/LoginController.php",
        data: "method=logout",
        cache: false,
        success: function(result){
            if(result == "logout success"){
                window.location.replace("../View/Login.php");
            }
        }
    });

});

var method = "load";
$.ajax({
    type: "POST",
    url: "../Controller/UserController.php",
    data: '&method='+method,
    async:false,
    cache: false,
    success: function(result){

    }
});
