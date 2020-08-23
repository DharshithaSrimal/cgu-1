$("#delete").click(function () {
    var method = "delete_user";
    var stu_id = $("#stu_id").val();

    let dataSet = new FormData();
    dataSet.append('method', method);
    dataSet.append('stu_id', stu_id);
    console.log(stu_id);
    $.ajax({
        type: "POST",
        url: "../Controller/UserController.php",
        data: dataSet,
        contentType: false,
        processData: false,
        success: function(result){
            // alert(result);
            if(result == "User Deleted"){
                alert("User Deleted");
                window.location.replace("../View/ManageStaff.php");
            }
        }
    });
});