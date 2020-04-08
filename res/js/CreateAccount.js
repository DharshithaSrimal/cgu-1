window.onload =
    function () {
        $("#page1CreateAccount").show();
        $("#page2CreateAccount").hide();
        $("#page3CreateAccount").hide();
};

$("#btnNextCreateAccount").click(function () {

    //if page1CreateAccount is visibale make it visible = false and make page2CreateAccount visible
    var page1visible = $("#page1CreateAccount").is(":visible")
    var page2visible = $("#page2CreateAccount").is(":visible")
    var page3visible = $("#page3CreateAccount").is(":visible")


        if(page1visible){

            $("#page1CreateAccount").hide();
            $("#page2CreateAccount").show();
            $("#page3CreateAccount").hide();
            $("#btnNextCreateAccount").text("Next");
        }

        if(page2visible){

            $("#page1CreateAccount").hide();
            $("#page2CreateAccount").hide();
            $("#page3CreateAccount").show();

            $("#btnNextCreateAccount").text("Create account");


            //send verification code to student email
            let method = "verify_email";
            let firstName = $("#firstName").val();
            let lastName =$("#lastName").val();
            let email =$("#email").val();
                $.ajax({
                type: "POST",
                url: "../Controller/AccountController.php",
                data: '&method='+method+'&firstName='+firstName+'&lastName='+lastName+'&email='+email,
                //cache: false,
                success: function(result){
                    //alert(result)
                    if(result == ""){
                       // window.location.replace("../View/Login.php");
                    }

                }
            });
        }
         if(page3visible){

        }

    }
);

$("#btnBackPage2").click(function () {
    $("#page1CreateAccount").show();
    $("#page2CreateAccount").hide();
    $("#page3CreateAccount").hide();
    $("#btnNextCreateAccount").text("Next");
});

$("#btnBackPage3").click(function () {
    $("#page1CreateAccount").hide();
    $("#page2CreateAccount").show();
    $("#page3CreateAccount").hide();
    $("#btnNextCreateAccount").text("Next");
});