window.onload =
    function () {
        $("#page1CreateAccount").show();
        $("#page2CreateAccount").hide();
        $("#page3CreateAccount").hide();
};

var user_id;
var fname;
var lname;
var gender;
var email;
var dob;
var tpnumber;
var password;
var user_role="student";


$("#btnNextCreateAccount").click(async function () {

    //if page1CreateAccount is visibale make it visible = false and make page2CreateAccount visible
    var page1visible = $("#page1CreateAccount").is(":visible")
    var page2visible = $("#page2CreateAccount").is(":visible")
    var page3visible = $("#page3CreateAccount").is(":visible")

        if(page1visible){

            let next1= false; let next2= false; let next3= false; let next4= false; let next5 = false;

             user_id=$("#indexNo").val();
             if(user_id != null || user_id != ""){ user_id.toUpperCase();}
             fname =$("#firstName").val();
             lname=$("#lastName").val();
             gender=$("input[name='gender']:checked").val();
             email=$("#email").val();
             dob=$("#birthDate").val();
             tpnumber=$("#phoneNumber").val();

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
             image =  await getBase64(image);

            // console.log(JSON.stringify(image));

             if(next1){
                 //let dataSet = '&method='+method+'&verCode='+verCode+'&user_id='+user_id+'&fname='+fname+'&lname='+lname+'&gender='+gender+'&email='+email+'&dob='+dob+'&tpnumber='+tpnumber+'&user_role='+user_role+'&image='+image+'&password='+password;
                 let dataSet = new FormData();
                 dataSet.append('method', method);
                 dataSet.append('verCode', verCode);
                 dataSet.append('user_id', user_id);
                 dataSet.append('fname', fname);
                 dataSet.append('lname', lname);
                 dataSet.append('gender', gender);
                 dataSet.append('email', email);
                 dataSet.append('dob', dob);
                 dataSet.append('tpnumber', tpnumber);
                 dataSet.append('user_role', user_role);
                 dataSet.append('password', password);
                 dataSet.append('image', image);
                 $.ajax({
                     type: "POST",
                     url: "../Controller/AccountController.php",
                     data: dataSet,
                     contentType: false,
                     processData: false,
                     success: function(result){
                         alert(result);
                         if(result == "Account created"){
                             window.location.replace("../View/Login.php");
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

 async function getBase64(file) {

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

     return dataURItoBlob(result);


 }

function dataURItoBlob(dataURI) {
    // convert base64 to raw binary data held in a string
    var byteString = atob(dataURI.split(',')[1]);

    // separate out the mime component
    var mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0]

    // write the bytes of the string to an ArrayBuffer
    var ab = new ArrayBuffer(byteString.length);
    var ia = new Uint8Array(ab);
    for (var i = 0; i < byteString.length; i++) {
        ia[i] = byteString.charCodeAt(i);
    }

    // write the ArrayBuffer to a blob, and you're done
    var bb = new Blob([ab],{ type: 'image/jpeg' });
    return bb;
}

 function showAlert(msg){
     var msg_string = "" ;
     msg.forEach(function(item,index){
         msg_string += item + (msg.length>1 & index!=(msg.length-1)?", ":"");
     });
     alert( msg_string + (msg.length>1?" are ":" is ")+"required");
 }
