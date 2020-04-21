
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

window.onload = function () {

    $('#IM2014030star1half').prop( "checked", true );
    $('#IM2014014star3half').prop( "checked", true );

}