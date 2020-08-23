$(document).ready(function(){
    //alert("akalanka")
    var methodAcademic = "loadAcademic";
    var methodProfessional = "loadProfessional";
    var methodSkills = "loadSkills_proView";

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
        data: '&method='+methodSkills+'&profUid='+ $("#id_div").val(),
        cache: false,
        success: function(result){
            // console.log(result);
            var x = JSON.parse(result);
            var $output = $('#softSkills');
            for(var i = 0; i < x.length; i++) {
                $output.append('<div id="ss'+x[i].ss_id+'" style=""></div>');
                $('#ss'+x[i].ss_id+'').append('<br><div style="display: inline-flex"><input type="text" class="form-control" readonly="readonly" id="ss_' + +x[i].ss_id + '" value="'+x[i].soft_skill+'" ></div><br>');
                $('#ss'+x[i].ss_id+'').append('<label style="margin-top:10px ">Description :</label>' + '<textarea readonly type="text" class="form-control" id="textboxDes'+ i +'" >');
                $("#textboxDes"+ i ).val(x[i].description);

            }
        }
    });


    drawStarRating("",3);
    // drawStarRating("AQ",2.5);
    // drawStarRating("PQ",3.5);
    // drawStarRating("SQ",3);

});

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

//
// function drawStarRating(Rating) {
// //#IM2014030star1half
//     starRating = Rating;
//     console.log(Rating);
//     starRating = Rating==0.5?"starhalf":starRating;
//     starRating = Rating==1?"star1":starRating;
//     starRating = Rating==1.5?"star1half":starRating;
//     starRating = Rating==2?"star2":starRating;
//     starRating = Rating==2.5?"star2half":starRating;
//     starRating = Rating==3?"star3":starRating;
//     starRating = Rating==3.5?"star3half":starRating;
//     starRating = Rating==4?"star4":starRating;
//     starRating = Rating==4.5?"star4half":starRating;
//     starRating = Rating==5?"star5":starRating;
//
//     var id = '#'+starRating;
//     $(id).prop( "checked", true );
//
//      id = '#AQ'+starRating;
//     $(id).prop( "checked", true );
//
//      id = '#PQ'+starRating;
//     $(id).prop( "checked", true );
//
//      id = '#SQ'+starRating;
//     $(id).prop( "checked", true );
// }




function drawStarRating(elementID,Rating) {
//#IM2014030star1half
    starRating = Rating;
    console.log(Rating);
    starRating = Rating==0.5?"starhalf":starRating;
    starRating = Rating==1?"star1":starRating;
    starRating = Rating==1.5?"star1half":starRating;
    starRating = Rating==2?"star2":starRating;
    starRating = Rating==2.5?"star2half":starRating;
    starRating = Rating==3?"star3":starRating;
    starRating = Rating==3.5?"star3half":starRating;
    starRating = Rating==4?"star4":starRating;
    starRating = Rating==4.5?"star4half":starRating;
    starRating = Rating==5?"star5":starRating;

    var id = '#'+elementID+""+starRating;
    console.log(id);
    $(id).prop( "checked", true );
}


$('#rateprofile').click(function (){

    var starRating = "";

    if(document.getElementById("starhalf").checked){starRating="0.5"}
    if(document.getElementById("star1").checked){starRating="1"}
    if(document.getElementById("star1half").checked){starRating="1.5"}
    if(document.getElementById("star2").checked){starRating="2"}
    if(document.getElementById("star2half").checked){starRating="2.5"}
    if(document.getElementById("star3").checked){starRating="3"}
    if(document.getElementById("star3half").checked){starRating="3.5"}
    if(document.getElementById("star4").checked){starRating="4"}
    if(document.getElementById("star4half").checked){starRating="4.5"}
    if(document.getElementById("star5").checked){starRating="5"}
//starRating
    $.ajax({
        type: "POST",
        url: "../Controller/ProfileController.php",
        data: '&method=updateRatiing&profUid='+ $("#id_div").val()+"&rating="+starRating,
        cache: false,
        success: function(result){
            window.location.replace("../View/Home.php");
        }
    });

});

$('#commentprofile').click(function (){
    window.open('../View/Inquiry.php', '_blank');
});
