$("#viewContent").click(function () {
    var faculty = $("#faculty").val();
    var degree = $("#degree").val();
    var method = "load";

    $.ajax({
        type: "POST",
        url: "../Controller/DegreeController.php",
        data: 'faculty='+faculty+'&degree='+degree+'&method='+method,
        cache: false,
        success: function(result){

            if(result == "inq success"){
                alert("Successfully Submitted");
            }
            if(result == "inq failed"){
                alert("Error... Please try again...!!");
            }
        }
    });
});



/*document.addEventListener('DOMContentLoaded', function() {

    var method = "load";

    $.ajax({
        type: "POST",
        url: "../Controller/DegreeController.php",
        data: '&method='+method,
        cache: false,
        success: function(result){
        }
    });

}, false);*/