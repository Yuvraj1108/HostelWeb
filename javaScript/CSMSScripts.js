function isEmpty(field)
{
	if(field.length==0)
		return "yes";
	else
		return "no";
}
function checkEmpty(field,name)
{
	if(field.length==0)
		return name+" is empty!";
	else
		return "";
}


/******** Diplaying form for Complaints and suggestions***********/
var messform=false;
var hospform=false;
var maintform=false;
var messCompSubmit=false;  //will become true if mess comp is submitted
var hospCompSubmit=false;  //will become true if hosp comp is submitted
var maintCompSubmit=false; //will become true if maint comp is submitted
//mess complaint/suggestion form
$("#mess").click(function(){
	        //$('#ActiveForm').fadeIn();
	    $('#RightMessage').fadeOut();
	    if(messCompSubmit==false)
	    {
	        if(messform==false)
	        {
	          $("#mess").css("background-color","green");
	          if(hospform==true)
	          {
	          	$("#hosp").css("background-color","#112233");
	          	$("#HospComp").fadeOut("slow");
	          	 hospform=false;

	          }
	          else if(maintform==true)
	          {
	             $("#maint").css("background-color","#112233"); 
	             $("#MainComp").fadeOut("slow");
	             maintform=false;
	          }
			  $("#MessComp").fadeIn("slow");
			  messform=true;
			}
			else
			{
			  $("#mess").css("background-color","#112233");
			  $("#MessComp").fadeOut("slow");
			  messform=false;
			}
		}
	  }
	)	

//hospital complaint/suggestion form
$("#hosp").click(function(){
	        //$('#ActiveForm').fadeIn();
	    $('#RightMessage').fadeOut();
	    if(hospCompSubmit==false)
	    {
	        if(hospform==false)
	        {
	          $("#hosp").css("background-color","green");
	          if(messform==true)
	          {
	            $("#mess").css("background-color","#112233");
	            $("#MessComp").fadeOut("slow");
	            messform=false;
	          }
	          else if(maintform==true)
	          {
	          	  $("#maint").css("background-color","#112233");
	          	  $("#MainComp").fadeOut("slow");
	          	  maintform=false;

	          } 
			  $("#HospComp").fadeIn("slow");
			  hospform=true;			  
			}
			else
			{
			  $("#hosp").css("background-color","#112233");
			  $("#HospComp").fadeOut("slow");
			  hospform=false;
			}
		}
	 }
  )	

// maintenence comaplint/suggestion form	
$("#maint").click(function(){
	 var loc = "Room No. "+$("#RomNo").text()+" "+ $("#HNo").text();
     $("#maintLocation").val(loc);
	        //$('#ActiveForm').fadeIn();
	     $('#RightMessage').fadeOut();
	     if(maintCompSubmit==false)
	     {
	        if(maintform==false)
	        {
	          $("#maint").css("background-color","green");
	          if(messform==true)
	          {
	            $("#mess").css("background-color","#112233");
	            $("#MessComp").fadeOut("slow");
	            messform=false;
	          }
	          else if(hospform==true)
	          {
	             $("#hosp").css("background-color","#112233");
	             $("#HospComp").fadeOut("slow");
	             hospform=false;
	          }	        
			  $("#MainComp").fadeIn("slow");
			  maintform=true;
			}
			else
			{
			  $("#maint").css("background-color","#112233");
			  $("#MainComp").fadeOut("slow");
			  maintform=false;
			}
		}
	  }
	)	

/************************Submitting forms********************************/
$(function(){

    
     
    $('#MessComp').on('submit',function(){

        $("label#messContentError").hide();
        $("label#messFileError").hide();

        var form1=$(this);
        messdata = new FormData(form1[0]);

		var messContent=$("textarea#mess_content").val();
		var msg1=isEmpty(messContent);
		if(msg1=="yes")
		{
			$("#messContentError").stext("Content is empty!");
			$("label#messContentError").show();

			
		}	
		else if(msg1=="no")
		{
			var messRequest= new XMLHttpRequest();
		    messRequest.onreadystatechange=function()
		    { 
			        if(this.readyState==4 && this.status==200)
			        {
			        	var messResponse = JSON.parse(this.responseText);
			        	if(messResponse.Status == 0)
			        	{
			        	   //$("#messFileError").text("Sorry,we could not connect to server");
			        	   $("#messFileError").text("Sorry, something went wrong");
			               $("label#messFileError").show();
			        	}
			        	else if(messResponse.Status == 1)
			        	{
			        	   //$("#messFileError").text("Sorry,we could not found database");
			        	   $("#messFileError").text("Sorry, something went wrong");
			               $("label#messFileError").show();
			        	}
			        	else if(messResponse.Status == 3)
			        	{
                          //$("#messFileError").text("Error with database");
                          //$("#messFileError").text(messResponse.errorMsg);
                           $("#messFileError").text("Sorry, something went wrong");
			               $("label#messFileError").show();
			        	}
			            else if(messResponse.Status == 4 && messResponse.Mail ==1)    //if everything goes well
			           { 
			          	messCompSubmit=true;
			          	$('#MessComp').fadeOut();
			          	$('#RightMessage').fadeIn();
			          	var CompSug=$("select#mess_cmp_sug").val();
                        if(CompSug=="Suggestion")
                        {
                           $("#msg1").text("Suggestion Submitted Successfully!");
                           $("#msg2").text("We will look forward for consideration");
                        }                       
      		             
			          }          
			          else if(messResponse.Status==5)  // if Data is not recieved by server
			          {
			          	//$("#messFileError").text("Data not recieved");
			            $("#messFileError").text("Sorry, something went wrong");
			            $("label#messFileError").show();
			          }
			          else
			          {
			          	$("#messFileError").text("Sorry, something went wrong ");
			          	//$("#messFileError").append(messResponse.imageFile);
			            $("label#messFileError").show();
			          }
			        }
			        else
			        {
			           //$("#messFileError").text("Just a moment...");
			           $("#messFileError").text("Just a moment...");
			           /*$("#messFileError").append("  ");
			           $("#messFileError").append(this.readyState);
			           $("#messFileError").append("  ");
			           $("#messFileError").append(this.status);*/
			           $("label#messFileError").show();
			        } 
			    };
			     messRequest.open("POST" ,"../PHP/CSMS.php", true);
                 messRequest.send(messdata);
		}	
		else
		{
		    $("#messFileError").text(msg1);
			$("label#messFileError").show();
		}
		return false;
	});


	$('#HospComp').on('submit',function(){

		$("label#hospContentError").hide();
        $("label#hospFileError").hide();

        
        var form2=$(this);
        hospdata = new FormData(form2[0]);

		var hospContent=$("textarea#hosp_content").val();
		var msg2=isEmpty(hospContent);
		if(msg2=="yes")
		{
			$("#hospContentError").text("Content is empty!");
			$("label#hospContentError").show();			
		}	
		else if(msg2=="no")
		{
            var hospRequest= new XMLHttpRequest();
		    hospRequest.onreadystatechange=function()
		    { 
		    	    var hospResponse = JSON.parse(this.responseText)
			        if(this.readyState==4 && this.status==200)
			        {
			          if(hospResponse.Status == 0)
			          {
			          	//$("#hospFileError").text("Sorry,we could not connect server");
			          	$("#hospFileError").text("Sorry,something went wrong");
			            $("label#hospFileError").show();
			          }
			          else if(hospResponse.Status ==1)
			          {
			          	//$("#hospFileError").text("Sorry,we could not found database");
			          	$("#hospFileError").text("Sorry,something went wrong");
			            $("label#hospFileError").show();
			          }
			          else if(hospResponse.Status == 3)
			          {
                        //$("#hospFileError").text("Error with database");
                        $("#hospFileError").text("Sorry,something went wrong");
			            $("label#hospFileError").show();
			          }
			          else if(hospResponse.Status == 4 && hospResponse.Mail ==1)    //if everything goes well
			          { 
			          	hospCompSubmit=true;
			          	$('#HospComp').fadeOut();
                        $('#RightMessage').fadeIn();
                        var CompSug=$("select#hosp_cmp_sug").val();
                        if(CompSug=="Suggestion")
                        {
                           $("#msg1").text("Suggestion Submitted Successfully!");
                           $("#msg2").text("We will look forward for consideration");
                        }      			             
			          }          
			          else if(hospResponse.Status==5)  // if Data is not recieved by server
			          {
			          	//$("#hospFileError").text("Data not recieved");
			          	$("#hospFileError").text("Sorry,something went wrong");
			            $("label#hospFileError").show();
			          }
			          else
			          {
			          	$("#hospFileError").text("Sorry,something went wrong");
			            $("label#hospFileError").show();
			          }
			        }
			        else
			        {
			           $("#hospFileError").text("Just a moment...");
			           /*$("#hospFileError").text(this.readyState);
			           $("#hospFileError").append("  ");
			           $("#hospFileError").append(this.status);*/
			           $("label#hospFileError").show();
			        } 
			    };
			     hospRequest.open("POST" ,"../PHP/CSMS.php", true);
                 hospRequest.send(hospdata);
		}	
		else
		{
		    $("#hospContentError").text(msg2);
			$("label#hospContentError").show();
		}

		
        return false;

	});


	$('#MainComp').on('submit',function(){

		$("label#maintContentError").hide();
        $("label#maintFileError").hide();

		var form3=$(this);
		maintdata = new FormData(form3[0]);
	
		var msg4="";
		var msg3 = checkEmpty(maintdata.get('maintLocation'),'Location');
		msg4+=msg3;
		if(msg3=="")
		{
			$("label#maintLocationError").hide();
		}
		else
		{
			$("#maintLocationError").text(msg3);
			$("label#maintLocationError").show();
		}
		var msg3 = checkEmpty(maintdata.get('maintAvailability'),'Availability');
		msg4+=msg3;
		if(msg3=="")
		{
			$("label#maintAvailabilityError").hide();
		}
		else
		{
			$("#maintAvailabilityError").text(msg3);
			$("label#maintAvailabilityError").show();
		}
		msg3= checkEmpty(maintdata.get('maintContent'),'Content');
		msg4+=msg3;
		if(msg3=="")
		{
			$("label#maintContentError").hide();
		}
		else
		{
			$("#maintContentError").text(msg3);
			$("label#maintContentError").show();
		}
	    if(msg4=="")
		{
			var maintRequest= new XMLHttpRequest();
		    maintRequest.onreadystatechange=function()
		    { 
			        if(this.readyState==4 && this.status==200)
			        { 
			        	var dataMaint = JSON.parse(this.responseText);
			        	if(dataMaint.Status == 0)
			        	{
			              //$("#maintFileError").text("Sorry,we could not connet to server");
			              $("#maintFileError").text("Sorry,something went wrong");
			              $("label#maintFileError").show();
			        	}
			        	else if(dataMaint.Status == 1)
			        	{
			        	  //$("#maintFileError").text("Sorry,we could not find database");
			        	  $("#maintFileError").text("Sorry,something went wrong");
			              $("label#maintFileError").show();
			        	}
			        	else if(dataMaint.Status == 3)
			        	{
			        	  //$("#maintFileError").text("Error,with database");
			        	  //$("#maintFileError").text(dataMaint.errorMsg);
			        	  $("#maintFileError").text("Sorry,something went wrong");
			              $("label#maintFileError").show();
			        	}

			          else if(dataMaint.Status==4 && dataMaint.Mail ==1)    //if everything goes well
			          { 
			          	maintCompSubmit=true;
			          	$('#MainComp').fadeOut();
                        $('#RightMessage').fadeIn();
                        var CompSug=$("select#maint_cmp_sug").val();
                        if(CompSug=="Suggestion")
                        {
                           $("#msg1").text("Suggestion Submitted Successfully!");
                           $("#msg2").text("We will look forward for consideration");
                        }      			             
			          }
			          else if(dataMaint.Status==5)  // if Data is not recieved by server
			          {
			          	//$("#maintFileError").text("Data not recieved");
			          	$("#maintFileError").text("Sorry,something went wrong");
			            $("label#maintFileError").show();
			          }
			          else
			          {
			          	$("#maintFileError").text("Sorry,something went wrong");
			            $("label#maintFileError").show();
			          }
			        }
			        else
			        {
			           $("#maintFileError").text("Just a moment...");
			           /*$("#hospFileError").text(this.readyState);
			           $("#hospFileError").append("  ");
			           $("#hospFileError").append(this.status);*/
			           $("label#maintFileError").show();
			        } 
			    };
			     maintRequest.open("POST" ,"../PHP/CSMS.php", true);
                 maintRequest.send(maintdata);
			
		}	
		else
		{
		    $("#maintContentError").text(msg3);
			$("label#maintContentError").show();
		}

	
        return false;

	});

});