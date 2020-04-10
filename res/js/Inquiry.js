$("#submitInquiry").click(function () {
    var inqType = $("#inquiryType").val();
    var inqBody = $("#composeInquiry").val();
    var method = "inqSubmit";

    $.ajax({
        type: "POST",
        url: "../Controller/InquiryController.php",
        data: 'inqType='+inqType+'&inqBody='+inqBody+'&method='+method,
        cache: false,
        success: function(result){

            if(result == "inq success"){
                alert("Successfully Submitted");
            }
            if(result == "inq failed"){
                alert("Error... Please try again...!!");
            }
        }
    });
});