// var flagIsOld=false;
// var dataObtained;
// function checkFeedback()
// {
//     xhr = new XMLHttpRequest();
//     xhr.onreadystatechange = function(){
//         if(this.readyState==4 && this.status == 200)
//         {
//                 dataObtained = JSON.parse(this.responseText);
//                 if(dataObtained.Status==0)
//                  {
//                      $("#NotifyError").text("Sorry, we could not connect to server");
//                      $("label#NotifyError").show();
//                  }
//                  else if(dataObtained.Status==1)
//                  {
//                      $("#NotifyError").text("Sorry, we could not connect to database");
//                      $("label#NotifyError").show();
//                  }
//                  else if(dataObtained.Status==2)
//                  {
//                      $("#NotifyError").text("Data not Recieved");
//                      $("label#NotifyError").show();
//                  }
//                  else if(dataObtained.Status==3)
//                  {
//                      $("#QuestionError").text("Error with database");
//                      //$("#NotifyError").text(dataObtained.errorMsg);
//                      $("label#NotifyError").show();
//                  }
//                  else if(dataObtained.Status==6)   //record found in database
//                  {
//                      $("label#NotifyError").hide();

//                      $("#Notify").fadeIn();
//                      flagIsOld = true;
                     
//                  }
//                  else if(dataObtained.Status==7)
//                  {
//                      $("label#NotifyError").hide();
//                      flagIsOld = false;
//                      $('#HouseKeepingFeedback').show();
//                  }
//                  else
//                  {
//                      $("#NotifyError").text("Don't know");
//                      $("label#NotifyError").show();
//                  }                 
//             }
//             else
//             {
//                 $("#NotifyError").text("Just a moment...");
//                 //$("#QuestionError").text(this.readyState + " "+ this.status);
//                 $("label#NotifyError").show();
//             }

//         };
//         xhr.open("POST", "../PHP/Housekeeping.php", true);
//         xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//         xhr.send("Header="+2);
// }

$(function(){
    
    $("#Notify").hide();
    //$("#HouseKeepingFeedback").hide();
    
    //checkFeedback();
    
    // $('#Edit').click(function(){
    //     $('#Notify').hide();
    //     $('#HouseKeepingFeedback').fadeIn()
    // })

	$('#HouseKeepingFeedback').on('submit',function(){
		var form = $(this);
		dataToSend = new FormData(form[0]);

        // if(flagIsOld==true)
        // {
        //     dataToSend.append('FeedbackID',dataObtained.FeedbackID);
        // }
        	xhr = new XMLHttpRequest();
        	dataToSend.append("Header",1);  // header 1 indicate it is entry in the sql database
        	xhr.onreadystatechange=function()
        	{
        		if(this.readyState==4 &&  this.status==200)
        		{
                    //alert(this.responseText);
        			var dataRecieved = JSON.parse(this.responseText);
                    if(dataRecieved.Status==0)   //failed to connect to mysql server
    				{
                      //$("#FeedbackError").text("Sorry,We could not connect to server");
                      $("#FeedbackError").text("Sorry,something went worng");
                      $("label#FeedbackError").show();  
    				}
    				else if(dataRecieved.Status==1)  //failed to find database
    				{
                      //$("#FeedbackError").text("Sorry,Required Database does not found on server");
                      $("#FeedbackError").text("Sorry,something went worng");
                      $("label#FeedbackError").show();
    				}
    				else if(dataRecieved.Status==2)  //data not recieved
    				{ 
    					//$("#FeedbackError").text("Error in sending your data to server");
                        $("#FeedbackError").text("Sorry,something went worng");
                        $("label#FeedbackError").show();
    				}
    				else if(dataRecieved.Status==3)  //error in queryin sql
    				{
                        //$("#FeedbackError").text("Error in updating your information  ");
                        //$("#FeedbackError").append(dataRecieved.errorMsg);
                        $("#FeedbackError").text("Sorry,something went worng");
                        $("label#FeedbackError").show();
    				}
    				else if(dataRecieved.Status==4)  //successful entry
    				{
    				   $("#HouseKeepingFeedback").fadeOut();
                       //$("#FeedbackError").text("Successful");
                       $("label#FeedbackError").hide();
                       $("#RightMessage1").fadeIn();   
    				} 
    				else   //don't know something is wrong
    				{
                       $("#FeedbackError").text("Sorry, something went wrong");
                       $("label#FeedbackError").show();
    				}
        		}
        		else
        		{ 
        			$("#FeedbackError").text("Just a moment...");
                    $("label#FeedbackError").show();
                    
        		}
        	};
        	xhr.open("POST", "../PHP/Housekeeping.php", true);
      		//xhrequestStudent.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      	    xhr.send(dataToSend);

        //}
        return false;
	});
});