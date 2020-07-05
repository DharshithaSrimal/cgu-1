window.onload = function() {
   // $('#ele_IM-2014-030').click();
}

$(document).ready(function() {
    $('#composeInquiry').summernote();
    $(".navbar-icon-top").css("padding-bottom","20px");
    $('#main').css("padding-bottom","40px");
});

$("#submitInquiry").click(function () {
    var inqType = "ANY";
    var msg_body = $('#composeInquiry').summernote('code');
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

    // location.reload();

    setTimeout(window.location.href = "http://localhost:8080/cgu/View/Inquiry.php?newMsg="+receiver.split("/").join('-'),2000)
});

function showMsg(msgs,thisUser,x){
    $("#NewMessageHeading").hide();
    $("#receiverList").children().removeAttr("selected");
    $("#receiverList").find("#"+x).attr("selected","selected");
    $("#ele_"+x).find(".badge").hide();
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

    msgRead(x.toString().split("-").join("/"),thisUser.toString().split("-").join("/"));
}

function msgRead(senderID,receiverID){
    $.ajax({
        type: "POST",
        url: "../Controller/InquiryController.php",
        data: 'senderID='+senderID+'&receiverID='+receiverID+'&method=setReadMsg',
        cache: false,
        success: function(result){
            console.log(result);
        }
    });
}

function clearSection(){
    document.getElementById("msg_div").innerHTML = '';
}

function newMessage(){
    clearSection();
    $("#NewMessageHeading").show();
}

function getMessageNotifications(receiverID){
    var method = "unreadCount";
    userList = $(".list-group").children().find(".badge").hide();
    $.ajax({
        type: "POST",
        url: "../Controller/InquiryController.php",
        data: 'receiverID='+receiverID.toString().split("-").join("/")+'&method='+method,
        cache: false,
        success: function(result){
            //count = parseInt(result);
            var counts= JSON.parse(result);
           // console.log(counts["IM/2014/030"])
            if (true){
                var userList = $(".list-group").children();
                userList.each(function () {
                    var id = $(this).attr("id").split("-").join('/');
                    id = id.substring(4, id.length);
                    console.log(counts[id]);
                    if(parseInt(counts[id]) > 0){
                        $(this).find(".badge").show();
                        $(this).find(".badge").text(counts[id]);
                    }
                });

            }
        }
    });

}