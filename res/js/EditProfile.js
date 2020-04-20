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
            var $output = $('#outputAcademic');
            for(var i = 0; i < x.length; i++) {
                //$output.append($('<label>').html(x[i].aq_id));
                $output.append('<label>Skill ID :</label>' + '<input type="text"' + i + '" id="textbox' + i + '" value="'+x[i].aq_id+'" ><br>');
                $output.append('<label>Soft Skill :</label>' + '<input type="text" ' + i + '" id="textbox' + i + '" value="'+x[i].aq_title+'" ><br>');
                $output.append('<label>Academic Level :</label>' + '<input type="text"' + i + '" id="textbox' + i + '" value="'+x[i].aq_level+'" ><br>');
                $output.append('<label>Institute :</label>' + '<input type="text"' + i + '" id="textbox' + i + '" value="'+x[i].aq_institute+'" ><br>');
                $output.append('<label>Description :</label>' + '<input type="text"' + i + '" id="textbox' + i + '" value="'+x[i].aq_description+'" ><br><br>');
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
            var $output = $('#outputProfessional');
            for(var i = 0; i < x.length; i++) {
                //$output.append($('<label>').html(x[i].aq_id));
                $output.append('<label>Qualification ID :</label>' + '<input type="text"' + i + '" id="textbox' + i + '" value="'+x[i].pq_id+'" ><br>');
                $output.append('<label>Title :</label>' + '<input type="text" ' + i + '" id="textbox' + i + '" value="'+x[i].pq_title+'" ><br>');
                $output.append('<label>Academic Level :</label>' + '<input type="text"' + i + '" id="textbox' + i + '" value="'+x[i].pq_level+'" ><br>');
                $output.append('<label>Institute :</label>' + '<input type="text"' + i + '" id="textbox' + i + '" value="'+x[i].pq_institute+'" ><br>');
                $output.append('<label>Description :</label>' + '<input type="text"' + i + '" id="textbox' + i + '" value="'+x[i].pq_description+'" ><br><br>');
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
            var $output = $('#softSkills');
            for(var i = 0; i < x.length; i++) {
                //$output.append($('<label>').html(x[i].aq_id));
                $output.append('<input type="hidden"' + i + '" id="textbox' + i + '" value="'+x[i].ss_id+'" >');
                $output.append('<label>Skill :</label>' + '<input type="text" ' + i + '" id="textbox' + i + '" value="'+x[i].soft_skill+'" ><br>');
                $output.append('<label>Description :</label>' + '<input type="text"' + i + '" id="textbox' + i + '" value="'+x[i].description+'" ><br><br>');
            }
        }
    });

});