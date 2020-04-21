
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

            //console.log(element.querySelector('.stuName').innerHTML+"-"+searchVal);

            if((element.querySelector('.stuName').innerHTML).trim()!= searchVal){
                element.style.visibility  = "hidden";
                element.style.display  = "none";
            }
            else {
                element.style.visibility  = "visible";
                element.style.display  = "inline-block";

            }

            if(searchVal == ""){
                element.style.visibility  = "visible";
                element.style.display  = "inline-block";
            }
        });




    });

}