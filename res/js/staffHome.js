
$(function(){
    $('.check input').on("change", function () {
        if ($(this).is(":checked")) {
            $(this).closest(".unit").addClass("selected");
        } else {
            $(this).closest(".unit").removeClass("selected");
        }
    });

    $('.head .check input').on("change", function () {
        if ($(this).is(":checked")) {
            $('.unit .check input:checkbox').not(this).trigger("click");
        } else {
            $('.unit .check input:checkbox').not(this).trigger("click");
        }
    });

})



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

window.onload = function () {
    var inputField = document.querySelector('.contacts-list-search');

    var xx = $('.allUnits').children('.unit');

    inputField.addEventListener('input', (event) => {
        // const result = document.querySelector('.result');
        // result.textContent = `You like ${event.target.value}`;
        var searchVal = event.target.value;
        xx.each(function (index, element) {

            console.log(element.querySelector('.stuName').innerHTML.trim()+"-"+searchVal);
            var i = 0;
            i = element.querySelector('.stuName').innerHTML.trim().search(searchVal);
            console.log(i);
            if(i>=0){
                element.style.visibility  = "visible";
                element.style.display  = "inline-block";
            }
            else {
                element.style.visibility  = "hidden";
                element.style.display  = "none";
            }

            if(searchVal == ""){
                element.style.visibility  = "visible";
                element.style.display  = "inline-block";
            }
        });
    });

    //Adding click event listner for all unit divs.. once click a unit user can view its owners profile
    xx.each(function (index, element) {
        element.addEventListener('click', (event) => {
            var unitID = element.querySelector('fieldset').getAttribute("id");
            //alert("Should open profile in new tab >>> "+unitID);
            //http://localhost:8080/cgu/View/ProfileView.php?profUid=IM/2014/030
            unitID = unitID.slice(0,2)+"/"+unitID.slice(2,6)+"/"+unitID.slice(6,unitID.length)
            window.open('../View/ProfileView.php?profUid='+unitID, '_blank');
        });
    });

    $("#editProfileBtn").click( function () {
        window.location.replace("../View/EditStaffProfile.php");
    });

    $('#iframeNewsView').hide();
    $("#viewNews").click(function(){
        if($("#iframeNewsAdd").is(":visible")){
            $("#viewNews").html("Publish New Item");
            document.getElementById('iframeNewsView').contentWindow.location.reload();
            $('#iframeNewsView').show();
            $('#iframeNewsAdd').hide();
        }
        else{
            $("#viewNews").html("View Published Items");
            $('#iframeNewsView').hide();
            $('#iframeNewsAdd').show();
        }
    });
}





