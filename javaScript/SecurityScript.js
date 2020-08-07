// var flagIsOld=false;
// var dataObtained;

$(function(){
    
    //$("#Notify").hide();
    //$("#HouseKeepingFeedback").hide();
    
    //checkFeedback();
    
    // $('#Edit').click(function(){
    //     $('#Notify').hide();
    //     $('#HouseKeepingFeedback').fadeIn()
    // })

	 $('#SecurityFeedback').on('submit',function(){
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
                      //$("#FeedbackError1").text("Sorry,We could not connect to server");
                      $("#FeedbackError1").text("Sorry,something went worng");
                      $("label#FeedbackError1").show();  
    				}
    				else if(dataRecieved.Status==1)  //failed to find database
    				{
                      //$("#FeedbackError1").text("Sorry,Required Database does not found on server");
                      $("#FeedbackError1").text("Sorry,something went worng");
                      $("label#FeedbackError1").show();
    				}
    				else if(dataRecieved.Status==2)  //data not recieved
    				{ 
    					//$("#FeedbackError1").text("Error in sending your data to server");
                        $("#FeedbackError1").text("Sorry,something went worng");
                        $("label#FeedbackError1").show();
    				}
    				else if(dataRecieved.Status==3)  //error in queryin sql
    				{
                       //$("#FeedbackError1").text("Error in updating your information  ");
                        //$("#FeedbackError").append(dataRecieved.errorMsg);
                        $("#FeedbackError1").text("Sorry,something went worng");
                        $("label#FeedbackError1").show();
    				}
    				else if(dataRecieved.Status==4)  //successful entry
    				{
    				   $("#SecurityFeedback").fadeOut();
                       //$("#FeedbackError").text("Successful");
                       $("label#FeedbackError1").hide();
                       $("#RightMessage4").fadeIn();   
    				} 
    				else   //don't know something is wrong
    				{
                       $("#FeedbackError1").text("Sorry, something went wrong");
                       $("label#FeedbackError1").show();
    				}
        		}
        		else
        		{ 
        			$("#FeedbackError1").text("Just a moment...");
                    $("label#FeedbackError1").show();
                    
        		}
        	};
        	xhr.open("POST", "../PHP/Security.php", true);
      		//xhrequestStudent.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      	    xhr.send(dataToSend);

        //}
        return false;
	});
});