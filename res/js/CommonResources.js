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
