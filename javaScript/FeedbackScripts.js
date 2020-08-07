var housekeepingDiv = false;
var diningDiv = false;
var securityDiv = false;


$("#HousekpngFeedback").click(function(){
	        //$('#ActiveForm').fadeIn();
	     $('#RightMessage1').fadeOut();
	     if(housekeepingDiv==false)
	      {
	          $("#HousekpngFeedback").css("background-color","green");
	          if(diningDiv==true)
	          {
	           	$("#DiningFeedback").css("background-color","#112233");
	           	$("#Dining").slideUp("slow");
	           	diningDiv=false;

	          }
	          else if(securityDiv==true)
	          {
	           	$("#SecurityFeedbackKey").css("background-color","#112233");
	           	$("#Security").slideUp("slow");
	           	securityDiv=false;

	          }
			  $("#Housekeeping").slideDown("slow");
			  housekeepingDiv=true;
			}
			else
			{			  
			  $("#Housekeeping").slideUp("slow");
			  $("#HousekpngFeedback").css("background-color","#112233");
			  housekeepingDiv=false;
			}
	    }
	);

$("#DiningFeedback").click(function(){
	        //$('#ActiveForm').fadeIn();
	     $('#RightMessage2').fadeOut();
	     if(diningDiv==false)
	      {
	          $("#DiningFeedback").css("background-color","green");
	          if(securityDiv==true)
	          {
	           	$("#SecurityFeedbackKey").css("background-color","#112233");
	           	$("#Security").fadeOut("slow");
	           	securityDiv=false;

	          }
	          else if(housekeepingDiv==true)
	          {
	           	$("#HousekpngFeedback").css("background-color","#112233");
	           	$("#Housekeeping").fadeOut("slow");
	           	housekeepingDiv=false;

	          }
			  $("#Dining").slideDown("slow");
			  diningDiv=true;
			}
			else
			{
			  
			  $("#Dining").slideUp("slow");
			  $("#DiningFeedback").css("background-color","#112233");
			  diningDiv=false;
			}
	  }
	);
$("#SecurityFeedbackKey").click(function(){
	        //$('#ActiveForm').fadeIn();
	     $('#RightMessage4').fadeOut();
	     if(securityDiv==false)
	      {
	          $("#SecurityFeedbackKey").css("background-color","green");
	          if(diningDiv==true)
	          {
	           	$("#DiningFeedback").css("background-color","#112233");
	           	$("#Dining").slideUp("slow");
	           	diningDiv=false;

	          }
	          else if(housekeepingDiv==true)
	          {
	           	$("#HousekpngFeedback").css("background-color","#112233");
	           	$("#Housekeeping").slideUp("slow");
	           	housekeepingDiv=false;

	          }
			  $("#Security").slideDown("slow");
			  securityDiv=true;
		  }
			else
			{
			  $("#SecurityFeedbackKey").css("background-color","#112233");
			  $("#Security").slideUp("slow");
			  securityDiv=false;
			}
	  }
	);

$(function(){
	$('#Housekeeping').hide();
	$('#Dining').hide();
	$('#Security').hide();
	//alert("Hello");
});	
