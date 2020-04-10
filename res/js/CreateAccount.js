window.onload =
    function () {
        $("#page1CreateAccount").show();
        $("#page2CreateAccount").hide();
        $("#page3CreateAccount").hide();
};

$("#btnNextCreateAccount").click(async function () {

    //if page1CreateAccount is visibale make it visible = false and make page2CreateAccount visible
    var page1visible = $("#page1CreateAccount").is(":visible")
    var page2visible = $("#page2CreateAccount").is(":visible")
    var page3visible = $("#page3CreateAccount").is(":visible")

    var user_id;
    var fname;
    var lname;
    var gender;
    var email;
    var dob;
    var tpnumber;
    var password;
    var user_role="student";


        if(page1visible){

            let next1= false; let next2= false; let next3= false; let next4= false; let next5 = false;

             user_id=$("#indexNo").val();
             fname =$("#firstName").val();
             lname=$("#lastName").val();
             gender=$("input[name='gender']:checked").val();
             email=$("#email").val();

            let msg  =[];

            if(user_id == null || user_id == ""){next1=false; msg.push("Student number");}else next1=true ;
            if(fname == null|| fname == ""){next2=false; msg.push("First name");} else next2=true ;
            if(lname == null|| lname == ""){next3=false; msg.push("Last name");} else next3=true ;
            if( gender == null|| gender == ""){next4=false; msg.push("Gender");} else next4=true ;
            if(email == null|| email == ""){next5=false; msg.push("Email");} else next5=true ;

            if(next1 && next2 && next3 && next4 && next5){
                $("#page1CreateAccount").hide();
                $("#page2CreateAccount").show();
                $("#page3CreateAccount").hide();
                $("#btnNextCreateAccount").text("Next");
            }
            else {
                showAlert(msg);
            }

        }

        if(page2visible){
            let next1;
            let msg  =[];

            password=$("#userPassword").val();

            if(password == null|| password == ""){next1=false; msg.push("Password");}else next1=true ;
            if(next1){
                $("#page1CreateAccount").hide();
                $("#page2CreateAccount").hide();
                $("#page3CreateAccount").show();

                $("#btnNextCreateAccount").text("Create account");
            }else
            {
                showAlert(msg);
            }


           // send verification code to student email
            let method = "verify_email";
                $.ajax({
                type: "POST",
                url: "../Controller/AccountController.php",
                data: '&method='+method+'&firstName='+fname+'&lastName='+lname+'&email='+email,
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


             let next1;
             let msg  =[];
             let verCode = $("#verificationCode").val();

             if(verCode == null ||  verCode == ""){next1=false; msg.push("Verification code");}else next1=true ;

             var method = "create_account";
             let image=document.querySelector('#userImage').files[0];
             image =  await getBlob(image);

             if(next1){
                 let dataString = '&method='+method+'&verCode='+verCode+'&user_id='+user_id+'&fname='+fname+'&lname='+lname+'&gender='+gender+'&email='+email+'&dob='+dob+'&tpnumber='+tpnumber+'&user_role='+user_role+'&image='+image+'&password='+password;

                 $.ajax({
                     type: "POST",
                     url: "../Controller/AccountController.php",
                     data: dataString,
                     //cache: false,
                     success: function(result){
                         alert(result)
                         if(result == ""){

                         }
                     }
                 });
             }
             else
             {
                 showAlert(msg);
             }
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

$("#btnResendVer").click(function () {
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
});

 async function getBlob(file) {

     var string64;
     var imgReader = new FileReader();

     let promise = new Promise((resolve, reject) => {
         imgReader.readAsDataURL(file);

         imgReader.onload = function(e) {
             string64 =  imgReader.result;
             resolve(string64);
         }
     });

     let result = await promise;

     //var byteString = atob(result.split(',')[1]);
     var byteCharacters = atob(result.split(',')[1]);
     var byteNumbers = new Array(byteCharacters.length);
     for (let i = 0; i < byteCharacters.length; i++) {
         byteNumbers[i] = byteCharacters.charCodeAt(i);
     }
     var byteArray = new Uint8Array(byteNumbers);

     var blob = new Blob([byteArray], { type: 'image/jpeg' });

     return blob;
 }

 function showAlert(msg){
     var msg_string = "" ;
     msg.forEach(function(item,index){
         msg_string += item + (msg.length>1 & index!=(msg.length-1)?", ":"");
     });
     alert( msg_string + (msg.length>1?" are ":" is ")+"required");
 }
