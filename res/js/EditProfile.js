$(document).ready(function(){
    //alert("akalanka")
    var methodAcademic = "loadAcademic";
    var methodProfessional = "loadProfessional";
    var methodSkills = "loadSkills";

    // $.ajax({
    //     type: "POST",
    //     url: "../Controller/ProfileController.php",
    //     data: '&method='+methodAcademic,
    //     cache: false,
    //     success: function(result){
    //         // console.log(result);
    //         var x = JSON.parse(result);
    //         var $output = $('#outputAcademic');
    //         for(var i = 0; i < x.length; i++) {
    //             $output.append('<div id="'+x[i].aq_id+'"></div>');
    //             $('#'+x[i].aq_id+'').append('<label>Course ID :</label>' + '<input type="text" readonly="readonly" id="textboxId"  value="'+x[i].aq_id+'" ><br>');
    //             $('#'+x[i].aq_id+'').append('<label>Course Name :</label>' + '<input type="text" readonly="readonly" size="60" id="textboxName" value="'+x[i].aq_title+'" ><br>');
    //             $('#'+x[i].aq_id+'').append('<label>Academic Level :</label>' + '<input type="text" id="textboxLevel" value="'+x[i].aq_level+'" ><br>');
    //             $('#'+x[i].aq_id+'').append('<label>Institute :</label>' + '<input type="text" size="60" id="textboxInstitute" value="'+x[i].aq_institute+'" ><br>');
    //             $('#'+x[i].aq_id+'').append('<label>Description :</label>' + '<input type="text" readonly="readonly" size="60" id="textboxDes" value="'+x[i].aq_description+'" ><br><br>');
    //         }
    //     }
    // });
    //
    // $.ajax({
    //     type: "POST",
    //     url: "../Controller/ProfileController.php",
    //     data: '&method='+methodProfessional,
    //     cache: false,
    //     success: function(result){
    //         // console.log(result);
    //         var x = JSON.parse(result);
    //         var $output = $('#outputProfessional');
    //         for(var i = 0; i < x.length; i++) {
    //             $output.append('<div id="'+x[i].pq_id+'"></div>');
    //             $('#'+x[i].pq_id+'').append('<label>Qualification ID :</label>' + '<input type="text" readonly="readonly" id="textboxId" value="'+x[i].pq_id+'" ><br>');
    //             $('#'+x[i].pq_id+'').append('<label>Title :</label>' + '<input type="text" readonly="readonly" size="60" id="textboxName" value="'+x[i].pq_title+'" ><br>');
    //             $('#'+x[i].pq_id+'').append('<label>Academic Level :</label>' + '<input type="text" id="textboxLevel" value="'+x[i].pq_level+'" ><br>');
    //             $('#'+x[i].pq_id+'').append('<label>Institute :</label>' + '<input type="text" size="60" id="textboxInstitute" value="'+x[i].pq_institute+'" ><br>');
    //             $('#'+x[i].pq_id+'').append('<label>Description :</label>' + '<input type="text" readonly="readonly" size="60" id="textboxDes" value="'+x[i].pq_description+'" ><br><br>');
    //         }
    //     }
    // });

    $.ajax({
        type: "POST",
        url: "../Controller/ProfileController.php",
        data: '&method='+methodSkills,
        cache: false,
        success: function(result){
            // console.log(result);
            var x = JSON.parse(result);
            var $output = $('#softSkills');
            for(var i = 0; i < x.length; i++) {
                $output.append('<div id="ss'+x[i].ss_id+'"></div>');
                $('#ss'+x[i].ss_id+'').append('<label>Skill :</label>' + '<input type="text" class="form-control" readonly="readonly" id="ss_' + +x[i].ss_id + '" value="'+x[i].soft_skill+'" ><br>');
                $('#ss'+x[i].ss_id+'').append('<label>Description :</label>' + '<textarea type="text" class="form-control" id="textboxDes'+ i +'" >');
                $('#ss'+x[i].ss_id+'').append('<div class="row" id=""> <a style="color:red;cursor: pointer;margin-left: 30px;margin-top: 10px"><i onclick="delQ(\'ss'+x[i].ss_id+'\')" class="fas fa-trash-alt"></i></a></div><br><br>');
                $("#textboxDes"+ i ).val(x[i].description);

            }
        }
    });
});

$("#btnPersonal").click(function () {

    var dataString = {}

    // dataString.stuNum = $("#stuNumber").val();
    dataString.fName = $("#fName").val();
    dataString.lName = $("#lName").val();
    dataString.email = $("#email").val();
    dataString.dob = $("#dob").val();
    dataString.mobile = $("#mobile").val();
    dataString.image =$('#pro_pic_ele').attr('src');
    // dataString.gender = $("#gender").val();

    dataString.method = "editPersonal";

    $.ajax({
        type: "POST",
        url: "../Controller/ProfileController.php",
        data: dataString,
        cache: false,
        success: function(result){

            if(result == "edit success"){
                alert("Successfully updated !")
                window.location.replace("../View/EditProfile.php");
            }
            if(result == "edit failed"){
                alert("Update failed !")
            }
        }
    });
});

$("#btnAcademic").click(function () {

    $('#outputAcademic').find('div').each(function(){
        var courseId = $(this).attr('id');

        var parentHtmlTag = $('#'+courseId);

        var level = parentHtmlTag.find('#textboxLevel').val();
        var institute = parentHtmlTag.find('#textboxInstitute').val();

        var dataString = {};

        dataString.level = level;
        dataString.institute = institute;
        dataString.courseId = courseId;
        dataString.method = "editAcademic";

        $.ajax({
            type: "POST",
            url: "../Controller/ProfileController.php",
            data: dataString,
            cache: false,
            success: function(result){
                alert(result);
                if(result == "edit success"){
                    alert("Successfully updated.....!!!")
                }
                if(result == "edit failed"){
                    alert("Update failed....!!!")
                }
            }
        });
    });
});

$("#btnProffessional").click(function () {

    $('#outputProfessional').find('div').each(function(){
        var courseId = $(this).attr('id');

        var parentHtmlTag = $('#'+courseId);

        var level = parentHtmlTag.find('#textboxLevel').val();
        var institute = parentHtmlTag.find('#textboxInstitute').val();

        var dataString = {};

        dataString.level = level;
        dataString.institute = institute;
        dataString.courseId = courseId;
        dataString.method = "editProfessional";

        $.ajax({
            type: "POST",
            url: "../Controller/ProfileController.php",
            data: dataString,
            cache: false,
            success: function(result){
                alert(result);
                if(result == "edit success"){
                    alert("Successfully updated.....!!!")
                }
                if(result == "edit failed"){
                    alert("Update failed....!!!")
                }
            }
        });
    });
});

$("#btnSoft").click(function () {
    saveSkillsAndQualifications();
    // $('#softSkills').find('div').each(function(){
    //     var courseId = $(this).attr('id');
    //
    //     var parentHtmlTag = $('#'+courseId);
    //
    //     var description = parentHtmlTag.find('#textboxDes').val();
    //
    //     var dataString = {};
    //
    //     dataString.description = description;
    //     dataString.courseId = courseId;
    //     dataString.method = "editSoft";
    //
    //     $.ajax({
    //         type: "POST",
    //         url: "../Controller/ProfileController.php",
    //         data: dataString,
    //         cache: false,
    //         success: function(result){
    //             alert(result);
    //             if(result == "edit success"){
    //                 alert("Successfully updated.....!!!")
    //             }
    //             if(result == "edit failed"){
    //                 alert("Update failed....!!!")
    //             }
    //         }
    //     });
    // });
});


var skillTypeID = "";
var skillType= "";
$("input[name=editSSMain]").focusout(function(){
    skillType = $(this).val();
    try{
        skillTypeID = document.querySelector('#editSSMain option[value="'+skillType+'"]').getAttribute('id');
    }
    catch (e) {
        skillTypeID = "";
    }

});


var AQprog = "";
var AQprogID = "";
var AQins = "";
$("input[name=editAQMain]").focusout(function(){
    AQprog = $(this).val();
    try{
        AQprogID = document.querySelector('#editAQMain option[value="'+$(this).val()+'"]').getAttribute('id');
    }
    catch (e) {
        AQprogID = "";
    }
});

$("input[name=editAQInstitiute]").focusout(function(){
    AQins = $(this).val();
});

$("#addAQ").click(function (){
    var desc = $("#editAQDescription").val();
    document.querySelector("#AQLoadingSection").innerHTML += "<div class=\"row\" id='"+AQprogID+"'><p><a style=\"color:red;cursor: pointer;\"><i  onclick=\"delQ('"+AQprogID+"')\" class=\"fas fa-trash-alt\"></i></a>&nbsp;&nbsp;"+AQprog+"-&nbsp;"+AQins+"&nbsp;("+desc+")</p></div>"
});

var PQprog = "";
var PQprogID = "";
var PQins = "";

$("input[name=editPQMain]").focusout(function(){
    PQprog = $(this).val();
    try{
        PQprogID = document.querySelector('#editPQMain option[value="'+$(this).val()+'"]').getAttribute('id');
    }
    catch (e) {
        PQprogID = "";
    }
});

$("input[name=editPQMain]").focusout(function(){
    PQprog = $(this).val();
});
$("input[name=editPQInstitiute]").focusout(function(){
    PQins = $(this).val();
});

$("#addPQ").click(function (){
    var desc = $("#editPQDescription").val();
    document.querySelector("#PQLoadingSection").innerHTML += "<div id='"+PQprogID+"' class=\"row\"><p><a style=\"color:red;cursor: pointer;\"><i onclick=\"delQ('"+PQprog.replace(/[,\s]/g, '')+PQins.replace(/[,\s]/g, '')+"')\" class=\"fas fa-trash-alt\"></i></a>&nbsp;&nbsp;"+PQprog+"-&nbsp;"+PQins+"&nbsp;("+desc+")</p></div>"
});


$("#addSS").click(function () {

    //check whether skill type is already added
    var skillDesc = $("#editSSDescription").val();
    let x = $('#softSkills').children();

    var exist = false;
    for(var i = 0; i < x.length; i++){
        //console.log(x[i]);
        //console.log(x[i].children[1].getAttribute("value"));
        if(skillType == x[i].children[1].getAttribute("value")){
            exist = true;
        }
    }

    if(exist){
        alert("This skill type already exist");
    }
    else {
        var output = $('#softSkills');
        var mainDiv =$("<div id='ss"+skillTypeID+"'></div>");
        mainDiv.append('<label>Skill :</label>' + '<input type="text" class="form-control" readonly="readonly" id="ss_' + skillTypeID + '" value="'+skillType+'" ><br>');
        mainDiv.append('<label>Description :</label>' + '<textarea type="text" class="form-control" id="textboxDes'+ i +'" >');
        mainDiv.append('<div class="row" id=""> <a style="color:red;cursor: pointer;margin-left: 30px;margin-top: 10px"><i onclick="delQ(\'ss'+skillTypeID+'\')" class="fas fa-trash-alt"></i></a></div><br><br>');
        output.append(mainDiv);
        $("#textboxDes"+ i ).val(skillDesc);
    }
});

function delQ(id){
    try{
        $("#PQLoadingSection #"+id).remove();
        $("#AQLoadingSection #"+id).remove();
        $("#softSkills #"+id).remove();
    }catch (e) {
    }
}

function saveSkillsAndQualifications(){
    var method = "update_stu_skills_Qual";

    var academic_qualifications = new Array();
    var professional_qualifications = new Array();
    var skills = new Array();

    $("#AQLoadingSection").children().each(function(){
        var content = $(this).text().split("-");
        var aQTitile = content[0].trim();;
        var x = content[1].replace(")", "").split("(");
        var aQIns= x[0].trim();
        var aQDesc= x[1].trim();
        var aQID = $(this).attr("id");

        academic_qualifications.push(new Array(aQID,aQTitile,aQIns,aQDesc));

    });

    $("#PQLoadingSection").children().each(function(){
        var content = $(this).text().split("-");
        var pQTitile = content[0].trim();;
        var x = content[1].replace(")", "").split("(");
        var pQIns= x[0].trim();
        var pQDesc= x[1].trim();
        var pQId= $(this).attr("id");

        professional_qualifications.push(new Array(pQTitile,pQIns,pQDesc,pQId));

    });


    $("#softSkills").children().each(function(){
        var skillID =  this.children[1].getAttribute("id").substring(3);
        var skillType = this.children[1].getAttribute("value");
        var desc= this.children[4].value;
        skills.push(new Array(skillID,skillType,desc));

    });

    let dataSet = new FormData();
    dataSet.append('method', method);
    dataSet.append('academic_qualifications', JSON.stringify(academic_qualifications));
    dataSet.append('professional_qualifications',  JSON.stringify(professional_qualifications));
    dataSet.append('skills', JSON.stringify(skills));

    $.ajax({
        type: "POST",
        url: "../Controller/EditProfileController.php",
        data: dataSet,
        contentType: false,
        processData: false,
        success: function(result){
            // alert(result);
            if(result == "Profile Updated"){
                alert("Profile Updated");
                window.location.replace("../View/Profile.php");
            }
        }
    });


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
