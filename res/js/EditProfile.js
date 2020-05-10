$(document).ready(function(){
    //alert("akalanka")
    var methodAcademic = "loadAcademic";
    var methodProfessional = "loadProfessional";
    var methodSkills = "loadSkills";

    $.ajax({
        type: "POST",
        url: "../Controller/ProfileController.php",
        data: '&method='+methodAcademic,
        cache: false,
        success: function(result){
            // console.log(result);
            var x = JSON.parse(result);
            var $output = $('#outputAcademic');
            for(var i = 0; i < x.length; i++) {
                $output.append('<div id="'+x[i].aq_id+'"></div>');
                $('#'+x[i].aq_id+'').append('<label>Course ID :</label>' + '<input type="text" readonly="readonly" id="textboxId"  value="'+x[i].aq_id+'" ><br>');
                $('#'+x[i].aq_id+'').append('<label>Course Name :</label>' + '<input type="text" readonly="readonly" size="60" id="textboxName" value="'+x[i].aq_title+'" ><br>');
                $('#'+x[i].aq_id+'').append('<label>Academic Level :</label>' + '<input type="text" id="textboxLevel" value="'+x[i].aq_level+'" ><br>');
                $('#'+x[i].aq_id+'').append('<label>Institute :</label>' + '<input type="text" size="60" id="textboxInstitute" value="'+x[i].aq_institute+'" ><br>');
                $('#'+x[i].aq_id+'').append('<label>Description :</label>' + '<input type="text" readonly="readonly" size="60" id="textboxDes" value="'+x[i].aq_description+'" ><br><br>');
            }
        }
    });

    $.ajax({
        type: "POST",
        url: "../Controller/ProfileController.php",
        data: '&method='+methodProfessional,
        cache: false,
        success: function(result){
            // console.log(result);
            var x = JSON.parse(result);
            var $output = $('#outputProfessional');
            for(var i = 0; i < x.length; i++) {
                $output.append('<div id="'+x[i].pq_id+'"></div>');
                $('#'+x[i].pq_id+'').append('<label>Qualification ID :</label>' + '<input type="text" readonly="readonly" id="textboxId" value="'+x[i].pq_id+'" ><br>');
                $('#'+x[i].pq_id+'').append('<label>Title :</label>' + '<input type="text" readonly="readonly" size="60" id="textboxName" value="'+x[i].pq_title+'" ><br>');
                $('#'+x[i].pq_id+'').append('<label>Academic Level :</label>' + '<input type="text" id="textboxLevel" value="'+x[i].pq_level+'" ><br>');
                $('#'+x[i].pq_id+'').append('<label>Institute :</label>' + '<input type="text" size="60" id="textboxInstitute" value="'+x[i].pq_institute+'" ><br>');
                $('#'+x[i].pq_id+'').append('<label>Description :</label>' + '<input type="text" readonly="readonly" size="60" id="textboxDes" value="'+x[i].pq_description+'" ><br><br>');
            }
        }
    });

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
                $output.append('<div id="'+x[i].ss_id+'"></div>');
                $('#'+x[i].ss_id+'').append('<label>Skill :</label>' + '<input type="text" readonly="readonly" id="textbox' + i + '" value="'+x[i].soft_skill+'" ><br>');
                $('#'+x[i].ss_id+'').append('<label>Description :</label>' + '<input type="text" id="textboxDes" value="'+x[i].description+'" ><br><br>');
            }
        }
    });
});

$("#btnPersonal").click(function () {

    var dataString = {}

    dataString.stuNum = $("#stuNumber").val();
    dataString.fName = $("#fName").val();
    dataString.lName = $("#lName").val();
    dataString.email = $("#email").val();
    dataString.dob = $("#dob").val();
    dataString.mobile = $("#mobile").val();
    dataString.gender = $("#gender").val();

    dataString.method = "editPersonal";

    $.ajax({
        type: "POST",
        url: "../Controller/ProfileController.php",
        data: dataString,
        cache: false,
        success: function(result){
            // alert(result);
            if(result == "edit success"){
                alert("Successfully updated.....!!!")
            }
            if(result == "edit failed"){
                alert("Update failed....!!!")
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

    $('#softSkills').find('div').each(function(){
        var courseId = $(this).attr('id');

        var parentHtmlTag = $('#'+courseId);

        var description = parentHtmlTag.find('#textboxDes').val();

        var dataString = {};

        dataString.description = description;
        dataString.courseId = courseId;
        dataString.method = "editSoft";

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