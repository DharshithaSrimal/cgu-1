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


function showUnreadCount(receiverID){

    var method = "unreadCount";
    userList = $(".list-group").children().find(".badge").hide();
    $.ajax({
        type: "POST",
        url: "../Controller/InquiryController.php",
        data: 'receiverID='+receiverID.toString().split("-").join("/")+'&method='+method,
        cache: false,
        success: function(result){
            var counts= JSON.parse(result);

            if (true){
                var userList = $(".list-group").children();
                var total = null;

                for (var c in counts) {
                    total = total + parseInt(counts[c]);
                }

                $('#unreadCount').text(total);
            }



        }
    });




}


// .navbar-dark .navbar-nav .nav-link:hover, .navbar-dark .navbar-nav .nav-link:focus {
//     color: white;
// }
//
// .navbar-dark .navbar-nav .nav-link {
//     color: var(--main-color2);
// }


//
// $('.nav-item').click(function(){
//    //this.attr('color','white');
//     $(".navbar-nav").children().each(function(){
//        console.log("");
//     });
// });


