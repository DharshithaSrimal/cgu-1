$("#submitInquiry").click(function () {
    var inqType = "ANY";
    var msg_body = $("#composeInquiry").val();
    var receiver = $("#receiverList").val();
    var method = "inqSubmit";

    $.ajax({
        type: "POST",
        url: "../Controller/InquiryController.php",
        data: 'inqType='+inqType+'&msg_body='+msg_body+'&method='+method+'&receiver='+receiver,
        cache: false,
        success: function(result){

            if(result == "inq success"){
                //alert("Successfully Send");

            }
            if(result == "inq failed"){
                //alert("Error... Please try again...!!");
            }
        }
    });
});

function showMsg(msgs,thisUser){
    clearSection();
    //alert(msgs[0]["sender"]);
    msgs.forEach(function(item, index){
        var d_time = document.createElement("div");
        d_time.setAttribute("class","d_time");
        d_time.innerHTML = item["time"];

        var msg_text = document.createElement("div");
        msg_text.setAttribute("class","msg_text");
        msg_text.innerHTML = item["msg_body"];

        var pro_pic_frame = document.createElement("div");
        pro_pic_frame.setAttribute("class","pro_pic_frame");
        var img = document.createElement("img");
        img.setAttribute("class","pro_pic");
        img.setAttribute("src","../res/img/testImage.jpg");

        if(item["receiver_id"]== thisUser){
            var myMsg = document.createElement("div");
            myMsg.setAttribute("class","my");
            myMsg.appendChild(d_time);
            myMsg.appendChild(msg_text);
            pro_pic_frame.appendChild(img);
            myMsg.appendChild(pro_pic_frame);
        }
        else{
            var myMsg = document.createElement("div");
            myMsg.setAttribute("class","other");
            myMsg.appendChild(d_time);
            pro_pic_frame.appendChild(img);
            myMsg.appendChild(pro_pic_frame);
            myMsg.appendChild(msg_text);
        }

        var main_ele = document.getElementById("msg_div");
        main_ele.appendChild(myMsg);
    });
}

function clearSection(){
    document.getElementById("msg_div").innerHTML = '';
}
