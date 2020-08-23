$("#btnSoft").click(function () {
    var method = "assign_lecturer";
    var stu_id = $("#stu_id").val();
    var assign = $("#staff_id").val();

    let dataSet = new FormData();
    dataSet.append('method', method);
    dataSet.append('staff_id', assign);
    dataSet.append('stu_id', stu_id);
    console.log(assign);
    console.log(stu_id);
    $.ajax({
        type: "POST",
        url: "../Controller/AssignController.php",
        data: dataSet,
        contentType: false,
        processData: false,
        success: function(result){
            // alert(result);
            if(result == "Profile Updated"){
                alert("Assigning updated");
                window.location.replace("../View/ManageStudents.php");
            }
        }
    });
});