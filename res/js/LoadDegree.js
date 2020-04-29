$("#faculty").change(function(){ /* WHEN YOU CHANGE AND SELECT FROM THE SELECT FIELD */
    var faculty = $("#faculty").val();
    var method = "loadDegree";
   
    $.ajax({ /* THEN THE AJAX CALL */
      type: "POST", /* TYPE OF METHOD TO USE TO PASS THE DATA */
      url: "../Controller/DegreeController.php", /* PAGE WHERE WE WILL PASS THE DATA */
      dataType: "json",
      data: 'faculty='+faculty+'&method='+method, /* THE DATA WE WILL BE PASSING */
      success: function(object){ /* GET THE TO BE RETURNED DATA */
        //$("#show").html(result); /* THE RETURNED DATA WILL BE SHOWN IN THIS DIV */
        //var newObj = JSON.parse((object) );
        
      }
    });

  });
