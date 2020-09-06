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
var user_role;
var facID;
var degID;

$("#user_role").change(function () {
    user_role =$("#user_role").is(":checked") == true?"student":"lecturer";
    if(user_role=="lecturer"){
        $("label[for='birthDate']").hide();
        $("#birthDate").hide();

        $("input[name='gender']").hide();
        $("#gender_group").hide();

        $("label[for='indexNo']").text("Employee ID No*");
        $("#indexNo").attr("placeholder","eg: 42153");//
        $("#indexNo").attr("maxlength","5")

    }
    else if(user_role=="student"){
        $("label[for='birthDate']").show();
        $("#birthDate").show();

        $("input[name='gender']").show();
        $("#gender_group").show()

        $("label[for='indexNo']").text("Student No*");
        $("#indexNo").attr("placeholder","eg: HS/2013/866");//

    }
});


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
             user_role =$("#user_role").is(":checked") == true?"student":"lecturer";

            facId = document.querySelector('#faculty option[value="'+$("input[name=faculty]").val()+'"]').getAttribute('id');
            degID = document.querySelector('#degree option[value="'+$("input[name=degree]").val()+'"]').getAttribute('id');

            let msg  =[];

            if(user_id == null || user_id == ""){next1=false; msg.push(user_role=="student"?"Student number":"Employee ID No");}else next1=true ;
            if(fname == null|| fname == ""){next2=false; msg.push("First name");} else next2=true ;
            if(lname == null|| lname == ""){next3=false; msg.push("Last name");} else next3=true ;
            if( (gender == null|| gender == "") && user_role=="student"){next4=false; msg.push("Gender");} else next4=true ;
            if(email == null|| email == ""){next5=false; msg.push("Email");} else next5=true ;

           if(next1 && next2 && next3 && next4 && next5 && allowNext()){//next1 && next2 && next3 && next4 && next5 && allowNext()
                $("#page1CreateAccount").hide();
                $("#page2CreateAccount").show();
                $("#page3CreateAccount").hide();
                $("#btnNextCreateAccount").text("Next");
            }
            else {

               if(!next1 && !next2 && !next3 && !next4 && !next5){
                   showAlert(msg);
               }
               if(!allowNext()){
                   alert("Please correct invalid inputs");
               }


            }

        }

        if(page2visible){
            let next1;
            let msg  =[];

            password=$("#userPassword").val();

            if(password == null|| password == ""){next1=false; msg.push("Password");}else next1=true ;
           if(next1 && allowNext()){//next1 && allowNext()
                $("#page1CreateAccount").hide();
                $("#page2CreateAccount").hide();
                $("#page3CreateAccount").show();

                $("#btnNextCreateAccount").text("Create account");
            }else
            {
                if(!next1){
                    showAlert(msg);
                }
                if(!allowNext()){
                    alert("Please correct invalid inputs");
                }
            }


           // send verification code to student email
            if(email!=""){
                let method = "verify_email";
                $.ajax({
                    type: "POST",
                    url: "../Controller/AccountController.php",
                    data: '&method='+method+'&firstName='+fname+'&lastName='+lname+'&email='+email,
                    //cache: false,
                    success: function(result){
                        console.log(result)
                        if(result == ""){
                            // window.location.replace("../View/Login.php");
                        }
                    }
                });
            }
        }
         if(page3visible){

             let next1;
             let msg  =[];
             let verCode = $("#verificationCode").val();

             if(verCode == null ||  verCode == ""){next1=false; msg.push("Verification code");}else next1=true ;

             var method = "create_account";
             let image=document.querySelector('#userImage').files[0];
             if(typeof image === "undefined"){
                 image = "";
             }
             else {
                 image =  await getBase64(image);
             }

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
                 dataSet.append('facID', facID);
                 dataSet.append('degID', degID);
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
             console.log(result)
            if(result == ""){
                // window.location.replace("../View/Login.php");
            }
        }
    });
    return false;
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



function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#pro_pic_ele')
                .attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}

$('#indexNo').change(function(){
    stuNoValidation($(this));
});


$('#email').change(function(){
    emailValidation($(this));
});

$('#lastName').change(function(){
    nameValidation($(this));
});

$('#firstName').change(function(){
    nameValidation($(this));
});

$('#phoneNumber').change(function(){
    phoneValidation($(this));
});

var errorCount =  [];

$('#userPassword').change(function(){
    var isValid = passwordValidation($(this));
    if(!isValid){
        $("#userPasswordError").show();
        $("#userPasswordError").text("Password must contains Minimum 8 characters and at least 1 uppercase character, at least 1 lowercase character, at least 1 number and at least 1 special character");
        //     At least 1 uppercase character.
        //     At least 1 lowercase character.
        //     At least 1 digit.
        //     At least 1 special character.
        //     Minimum 8 characters.

        errorCount.push("pass1");
        return false;
    }
    else {
        $("#userPasswordError").hide();
        errorCount.forEach(function(item,index){
            if(item == "pass1"){
                errorCount.splice(index, 1);
            }
        });
    }
});//matchPasswords

$('#reEnterPassword').change(function(){
    var isValid = matchPasswords( $("#userPassword"),$(this));
    if(!isValid){
        $("#reEnterPasswordError").show();
        $("#reEnterPasswordError").text("The passwords you enter don't match");
        errorCount.push("pass2");
        return false;
    }
    else {
        $("#reEnterPasswordError").hide();
        errorCount.forEach(function(item,index){
            if(item == "pass2"){
                errorCount.splice(index, 1);
            }
        });
    }
});

function stuNoValidation(txt){

    user_role =$("#user_role").is(":checked") == true?"student":"lecturer";

    if(user_role=="student"){
        var stuNoformat = /(.*\/){2}/; // there should be 3 forward slashes in stu number
        if(txt.val().match(stuNoformat) || txt.val()=="")
        {
            $("#indexNoError").hide();
            errorCount.forEach(function(item,index){
                if(item == "stu"){
                    errorCount.splice(index, 1);
                }
            });
            return true;
        }
        else
        {
            $("#indexNoError").show();
            $("#indexNoError").text("Invalid index number");
            txt.focus();
            errorCount.push("stu");
            return false;
        }
    }
    else {
        var staffNoformat = /(^[0-9])/;
        if(txt.val().match(staffNoformat) || txt.val()=="")
        {
            $("#indexNoError").hide();
            errorCount.forEach(function(item,index){
                if(item == "stu"){
                    errorCount.splice(index, 1);
                }
            });
            return true;
        }
        else
        {
            $("#indexNoError").show();
            $("#indexNoError").text("Invalid index number");
            txt.focus();
            errorCount.push("stu");
            return false;
        }
    }
}


function emailValidation(txt)
{
    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if(txt.val().match(mailformat))
    {
        $("#emailError").hide();
        errorCount.forEach(function(item,index){
            if(item == "email"){
                errorCount.splice(index, 1);
            }
        });
        return true;
    }
    else
    {
        $("#emailError").show();
        $("#emailError").text("Invalid email address!");
        txt.focus();
        errorCount.push("email");
        return false;
    }
}

function nameValidation(txt){

    var nameformat =  /[^a-zA-Z]/;

    var id = txt.attr("id")+"Error";

    if(!txt.val().match(nameformat))
    {
        $("#"+id+"").hide();
        errorCount.forEach(function(item,index){
            if(item == "name"){
                errorCount.splice(index, 1);
            }
        });
        return true;
    }
    else
    {
        $("#"+id+"").show();
        $("#"+id+"").text("Name cannot contain special characters");
        txt.focus();
        errorCount.push("name");
        return false;
    }
}

function phoneValidation(txt){

    var numberformat =  /(^[0-9])/;

    var id = txt.attr("id")+"Error";

    if(txt.val().match(numberformat) || txt.val()=="")
    {
        $("#"+id+"").hide();
        errorCount.forEach(function(item,index){
            if(item == "phone"){
                errorCount.splice(index, 1);
            }
        });
        return true;
    }
    else
    {
        $("#"+id+"").show();
        $("#"+id+"").text("Invalid phone number");
        txt.focus();
        errorCount.push("phone");
        return false;
    }
}

function allowNext() {
    if(errorCount.length==0){
        return true
    }
    else {
        return false;
    }
}

function passwordValidation(text){
    var res;
    var str =  text.val();
    if (str.match(/[a-z]/g) && str.match(
        /[A-Z]/g) && str.match(
        /[0-9]/g) && str.match(
        /[^a-zA-Z\d]/g) && str.length >= 8)
        res = true;
    else
        res = false;

    return res;
}

//     At least 1 uppercase character.
//     At least 1 lowercase character.
//     At least 1 digit.
//     At least 1 special character.
//     Minimum 8 characters.


function matchPasswords(pass1,pass2){
    return (pass1.val()===pass2.val())?true:false;
}


