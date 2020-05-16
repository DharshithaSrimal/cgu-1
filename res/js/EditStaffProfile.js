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



var AQprog = "";
var AQins = "";
$("input[name=editAQMain]").focusout(function(){
    AQprog = $(this).val();
});
$("input[name=editAQInstitiute]").focusout(function(){
    AQins = $(this).val();
});
$("#addAQ").click(function (){
    var desc = $("#editAQDescription").val();
    document.querySelector("#AQLoadingSection").innerHTML += "<div class=\"row\" id='"+AQprog.replace(/[,\s]/g, '')+AQins.replace(/[,\s]/g, '')+"'><p><a style=\"color:red;cursor: pointer;\"><i  onclick=\"delQ('"+AQprog.replace(/[,\s]/g, '')+AQins.replace(/[,\s]/g, '')+"')\" class=\"fas fa-trash-alt\"></i></a>&nbsp;&nbsp;"+AQprog+"-&nbsp;"+AQins+"&nbsp;(\""+desc+"\")</p></div>"
});



var PQprog = "";
var PQins = "";
$("input[name=editPQMain]").focusout(function(){
    PQprog = $(this).val();
});
$("input[name=editPQInstitiute]").focusout(function(){
    PQins = $(this).val();
});


$("#addPQ").click(function (){
    var desc = $("#editPQDescription").val();
    document.querySelector("#PQLoadingSection").innerHTML += "<div id='"+PQprog.replace(/[,\s]/g, '')+PQins.replace(/[,\s]/g, '')+"' class=\"row\"><p><a style=\"color:red;cursor: pointer;\"><i onclick=\"delQ('"+PQprog.replace(/[,\s]/g, '')+PQins.replace(/[,\s]/g, '')+"')\" class=\"fas fa-trash-alt\"></i></a>&nbsp;&nbsp;"+PQprog+"-&nbsp;"+PQins+"&nbsp;(\""+desc+"\")</p></div>"
});

function delQ(id){
    alert("#" + id);
    $("#" + id).remove();
}


$("#saveProfileBtn").click(async function(){


    var method = "update_profile";
    let image=document.querySelector('#file-input').files[0];
    image =  await getBase64(image);
    var fname= $("#editFname").val();
    var lname=$("#editLname").val();
    var email=$("#editEmail").val();
    var tpnumber =$("#editPhone").val();

    var faculty_pos = $("#editFacPos").text();
    var fac=$("#editFac").text();
    var cgu_pos=$("#editCguPos").text();

    var service_period =$("#editServicePeriod").val()+" "+$("#editServicePeriod1").val();
    var academic_qualifications =$("#editAQ").val();
    var professional_qualifications =$("#editPQ").val();
    var specialized_areas =$("#editSA").val();


    let dataSet = new FormData();
    dataSet.append('method', method);
    dataSet.append('fname', fname);
    dataSet.append('lname', lname);
    dataSet.append('email', email);
    dataSet.append('tpnumber', tpnumber);
    dataSet.append('academic_position', faculty_pos);
    dataSet.append('password', fac);
    dataSet.append('image', image);
    dataSet.append('cgu_position', cgu_pos);
    dataSet.append('experience', service_period);
    dataSet.append('image', academic_qualifications);
    dataSet.append('image', professional_qualifications);
    dataSet.append('image', specialized_areas);

    $.ajax({
        type: "POST",
        url: "../Controller/EditProfileController.php",
        data: dataSet,
        contentType: false,
        processData: false,
        success: function(result){
            alert(result);
            if(result == "Profile Updated"){
                window.location.replace("../View/Profile.php");
            }
        }
    });


});


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