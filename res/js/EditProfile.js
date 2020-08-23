function autocomplete(inp, arr) {
    /*the autocomplete function takes two arguments,
    the text field element and an array of possible autocompleted values:*/
    var currentFocus;
    /*execute a function when someone writes in the text field:*/
    inp.addEventListener("input", function(e) {
        var a, b, i, val = this.value;
        /*close any already open lists of autocompleted values*/
        closeAllLists();
        if (!val) { return false;}
        currentFocus = -1;
        /*create a DIV element that will contain the items (values):*/
        a = document.createElement("DIV");
        a.setAttribute("id", this.id + "autocomplete-list");
        a.setAttribute("class", "autocomplete-items");
        /*append the DIV element as a child of the autocomplete container:*/
        this.parentNode.appendChild(a);
        /*for each item in the array...*/
        for (i = 0; i < arr.length; i++) {
          /*check if the item starts with the same letters as the text field value:*/
          if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
            /*create a DIV element for each matching element:*/
            b = document.createElement("DIV");
            /*make the matching letters bold:*/
            b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
            b.innerHTML += arr[i].substr(val.length);
            /*insert a input field that will hold the current array item's value:*/
            b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
            /*execute a function when someone clicks on the item value (DIV element):*/
            b.addEventListener("click", function(e) {
                /*insert the value for the autocomplete text field:*/
                inp.value = this.getElementsByTagName("input")[0].value;
                /*close the list of autocompleted values,
                (or any other open lists of autocompleted values:*/
                closeAllLists();
            });
            a.appendChild(b);
          }
        }
    });
    /*execute a function presses a key on the keyboard:*/
    inp.addEventListener("keydown", function(e) {
        var x = document.getElementById(this.id + "autocomplete-list");
        if (x) x = x.getElementsByTagName("div");
        if (e.keyCode == 40) {
          /*If the arrow DOWN key is pressed,
          increase the currentFocus variable:*/
          currentFocus++;
          /*and and make the current item more visible:*/
          addActive(x);
        } else if (e.keyCode == 38) { //up
          /*If the arrow UP key is pressed,
          decrease the currentFocus variable:*/
          currentFocus--;
          /*and and make the current item more visible:*/
          addActive(x);
        } else if (e.keyCode == 13) {
          /*If the ENTER key is pressed, prevent the form from being submitted,*/
          e.preventDefault();
          if (currentFocus > -1) {
            /*and simulate a click on the "active" item:*/
            if (x) x[currentFocus].click();
          }
        }
    });
    function addActive(x) {
      /*a function to classify an item as "active":*/
      if (!x) return false;
      /*start by removing the "active" class on all items:*/
      removeActive(x);
      if (currentFocus >= x.length) currentFocus = 0;
      if (currentFocus < 0) currentFocus = (x.length - 1);
      /*add class "autocomplete-active":*/
      x[currentFocus].classList.add("autocomplete-active");
    }
    function removeActive(x) {
      /*a function to remove the "active" class from all autocomplete items:*/
      for (var i = 0; i < x.length; i++) {
        x[i].classList.remove("autocomplete-active");
      }
    }
    function closeAllLists(elmnt) {
      /*close all autocomplete lists in the document,
      except the one passed as an argument:*/
      var x = document.getElementsByClassName("autocomplete-items");
      for (var i = 0; i < x.length; i++) {
        if (elmnt != x[i] && elmnt != inp) {
          x[i].parentNode.removeChild(x[i]);
        }
      }
    }
    /*execute a function when someone clicks in the document:*/
    document.addEventListener("click", function (e) {
        closeAllLists(e.target);
    });
  }
  
  /*An array containing all the country names in the world:*/
  var countries = ["IT","Management","SE","MIT","Computer Science","AI","Big Data", "Data Science"];
  
  /*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
  autocomplete(document.getElementById("myInput"), countries);

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

$("#updateTags").click(function(){
    var tags = $("#tags").val();

    var dataString = {};
    dataString.tags = tags;
    dataString.method = "insertTags";

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
})

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
