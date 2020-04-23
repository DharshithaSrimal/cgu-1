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
            console.log(result);
            var x = JSON.parse(result);
            var $output = $('#AcademicDetails');
            for(var i = 0; i < x.length; i++) {
                $output.append('<tr><td>Skill ID</td>' + '<td>'+x[i].aq_id+'</td></tr>');
                $output.append('<tr><td>Title</td>' + '<td>'+x[i].aq_title+'</td></tr>');
                $output.append('<tr><td>Academic Level</td>' + '<td>'+x[i].aq_level+'</td></tr>');
                $output.append('<tr><td>Institute</td>' + '<td>'+x[i].aq_institute+'</td></tr>');
                $output.append('<tr><td>Description</td>' + '<td>'+x[i].aq_description+'</td></tr>');
                $output.append('<tr style="border-bottom:1px solid black"><td colspan="100%"></td></tr>');

            }
        }
    });

    $.ajax({
        type: "POST",
        url: "../Controller/ProfileController.php",
        data: '&method='+methodProfessional,
        cache: false,
        success: function(result){
            console.log(result);
            var x = JSON.parse(result);
            var $output = $('#ProfessionalDetails');
            for(var i = 0; i < x.length; i++) {
                $output.append('<tr><td>Skill ID</td>' + '<td>'+x[i].pq_id+'</td></tr>');
                $output.append('<tr><td>Title</td>' + '<td>'+x[i].pq_title+'</td></tr>');
                $output.append('<tr><td>Academic Level</td>' + '<td>'+x[i].pq_level+'</td></tr>');
                $output.append('<tr><td>Institute</td>' + '<td>'+x[i].pq_institute+'</td></tr>');
                $output.append('<tr><td>Description</td>' + '<td>'+x[i].pq_description+'</td></tr>');
                $output.append('<tr style="border-bottom:1px solid black"><td colspan="100%"></td></tr>');
            }
        }
    });

    $.ajax({
        type: "POST",
        url: "../Controller/ProfileController.php",
        data: '&method='+methodSkills,
        cache: false,
        success: function(result){
            console.log(result);
            var x = JSON.parse(result);
            var $output = $('#SoftSkills');
            for(var i = 0; i < x.length; i++) {
                $output.append('<tr><td>Institute</td>' + '<td>'+x[i].soft_skill+'</td></tr>');
                $output.append('<tr><td>Description</td>' + '<td>'+x[i].description+'</td></tr>');
                $output.append('<tr style="border-bottom:1px solid black"><td colspan="100%"></td></tr>');
            }
        }
    });

});