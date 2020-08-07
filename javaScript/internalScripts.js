var CSMSRow=false;
var FeedbackRow=false;
var IOMSRow=false;

$("#ButtonCSMS").click(function(){

            if(CSMSRow==false)
	        {
	          $("#ButtonCSMS").css("background-color","green");
	          if(FeedbackRow==true)
	          {
	          	$("#ButtonFeedback").css("background-color","#112233");
	          	$("#RowFeedback").slideUp("slow");
	          	 FeedbackRow=false;

	          }
	          else if(IOMSRow==true)
	          {
	             $("#ButtonIOMS").css("background-color","#112233"); 
	             $("#RowIOMS").slideUp("slow");
	             IOMSRow=false;
	          }
			  $("#RowCSMS").slideDown("slow");
			  CSMSRow=true;
			}
			else
			{
			  $("#ButtonCSMS").css("background-color","#112233");
			  $("#RowCSMS").slideUp("slow");
			  CSMSRow=false;
			}

})

$("#ButtonFeedback").click(function(){

            if(FeedbackRow==false)
	        {
	          $("#ButtonFeedback").css("background-color","green");
	          if(CSMSRow==true)
	          {
	          	$("#ButtonCSMS").css("background-color","#112233");
	          	$("#RowCSMS").slideUp("slow");
	          	 CSMSRow=false;

	          }
	          else if(IOMSRow==true)
	          {
	             $("#ButtonIOMS").css("background-color","#112233"); 
	             $("#RowIOMS").slideUp("slow");
	             IOMSRow=false;
	          }
			  $("#RowFeedback").slideDown("slow");
			  FeedbackRow=true;
			}
			else
			{
			  $("#ButtonFeedback").css("background-color","#112233");
			  $("#RowFeedback").slideUp("slow");
			  FeedbackRow=false;
			}

})

$("#ButtonIOMS").click(function(){

            if(IOMSRow==false)
	        {
	          $("#ButtonIOMS").css("background-color","green");

	          if(CSMSRow==true)
	          {
	          	$("#ButtonCSMS").css("background-color","#112233");
	          	$("#RowCSMS").slideUp("slow");
	          	 CSMSRow=false;

	          }
	          else if(FeedbackRow==true)
	          {
	             $("#ButtonFeedback").css("background-color","#112233"); 
	             $("#RowFeedback").slideUp("slow");
	             FeedbackRow=false;
	          }
			  $("#RowIOMS").slideDown("slow");
			  IOMSRow=true;
			}
			else
			{
			  $("#ButtonIOMS").css("background-color","#112233");
			  $("#RowIOMS").slideUp("slow");
			  IOMSRow=false;
			}

})
$(function(){
	$('#Internal').hide();
	$('#StaffProfile').hide();
})