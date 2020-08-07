/****************************************************************
          Functions for checking validity of fields*/
function validate(field,name)
{
	if(field.length==0)
		return name+" not Entered."+"\n";
	else if(/[^a-zA-Z0-9,\ ]/.test(field))
       return "Only a-z,A-Z,0-9 and , are allowed in "+name;
    return ""; 
}


function validateEmail(field)
{
	if(field.length==0)
      return "Email ID not Entered!"
    else if(!((field.indexOf('.')>0)&&(field.indexOf('@')>0))||(/[^a-zA-Z0-9.@_]/.test(field)))
      return "Invalid Email ID!";
    return ""; 
}
function validateContactNo(field)
{
	 if(field.length==0)
       return "Contact Number not Entered!";
   else if(/[^0-9]/.test(field))
       return "Only digits are allowed in Contact number."; 
   if(field.length!=10)
        return "10 digits are required in Contact number.";
    return "";
}

function validateDate(field)
{
	 if(field.length==0)
       return "Date Not Selected!";
    return "";
}

function CompareDates(d1,d2)
{
	var DateOne = new Date(d1);
	var DateTwo = new Date(d2);
	if(DateOne<=DateTwo)
	{
		return "";
	}
	else
		return "Arrival Date can not be before departure";
}


/****************************************************************/
function ShowEntry(obj)
{
    $('#destination').text(obj.Destination);
    $('#reason').text(obj.Reason);
    $('#D_Date').text(obj.DepartureDate);
    $('#A_Date').text(obj.ArrivalDate);
    $('#P_Contact').text(obj.ParentContact);
    $('#P_Email').text(obj.ParentEmail);
    $('#Responsible_On').text(obj.Declaration);
    $('#ShowEntry').fadeIn();
}
function CheckEntry()
{
    xhrequest = new XMLHttpRequest();
        var Header=2; //for checking entry of student in database
        xhrequest.onreadystatechange=function(){
           if(this.readyState==4 && this.status==200)
           {
             var dataResponse=JSON.parse(this.responseText);
                 //var dataRecieved=this.responseText;
                 if(dataResponse.Status==0)
                 {
                     //$("#ChooseInOutError").text("Sorry, we could not connect to server");
                     $("#ChooseInOutError").text("Sorry, something went wrong");
                     $("label#ChooseInOutError").show();
                 }
                 else if(dataResponse.Status==1)
                 {
                     //$("#ChooseInOutError").text("Sorry, we could not connect to database");
                     $("#ChooseInOutError").text("Sorry, something went wrong");
                     $("label#ChooseInOutError").show();
                 }
                 else if(dataResponse.Status==2)
                 {
                     //$("#ChooseInOutError").text("Data not Recieved");
                     $("#ChooseInOutError").text("Sorry, something went wrong");
                     $("label#ChooseInOutError").show();
                 }
                 else if(dataResponse.Status==3)
                 {
                     //$("#ChooseInOutError").text("Error with database");
                     //$("#ChooseInOutError").append(dataResponse.errorMsg);
                     $("#ChooseInOutError").text("Sorry, something went wrong");
                     $("label#ChooseInOutError").show();
                 }
                 else if(dataResponse.Status==6)   //record found in databse
                 {
                     $("label#ChooseInOutError").hide();
                      ShowEntry(dataResponse);
                 }
                 else if(dataResponse.Status==7) //record does not found
                 {
                     $("label#ChooseInOutError").hide();  
                     $("#ChooseInOut").fadeIn();
                 }
                 else
                 {
                     //$("#ChooseInOutError").text("Don't know");
                     $("#ChooseInOutError").text("Sorry, something went wrong");
                     $("label#ChooseInOutError").show();
                 }
           }
           else
           {
                 //$("#ChooseInOutError").text(this.readyState+" "+this.status);
                 $("#ChooseInOutError").text("Just a moment...");
                 //$("label#ChooseInOutError").show();
                 //$("#ChooseInOutError").append(".");
                 //$("#ChooseInOutError").append(".");
                 //$("label#ChooseInOutError").show();
           }
        };
         xhrequest.open("POST", "../PHP/OutStation.php", true);
         xhrequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
         xhrequest.send("Header="+Header);
}

/*******************************************************************************************************/
$(function(){
	$("#OutStation").hide();
    $("#ShowEntry").hide();
    $("#ChooseInOut").hide();
    $("#ReturnForm").hide();
    CheckEntry();

    $("#Out").click(function(){
      $("#ChooseInOut").hide();
      $("#OutStation").fadeIn();
    });

    $("#Return").click(function(){
        $("#Return").hide();
        $("#ReturnForm").fadeIn();
    });

    $('#ReturnForm').on('submit',function(){
         var ReturnFormData = $(this);
         DataToSend = new FormData(ReturnFormData[0]);
         DataToSend.append("Header",3);    // to make return entry in database

         var Msg2 = "";
         Msg2 = validateDate(DataToSend.get('ReturnDate'));
         if(Msg2=="")
         {
            $("label#ReturnDateError").hide();
            xhrReturn = new XMLHttpRequest();
             xhrReturn.onreadystatechange=function(){
                if(this.readyState==4 && this.status==200)
                {
                        var dataReasult=JSON.parse(this.responseText);
                         //var dataRecieved=this.responseText;
                         if(dataReasult.Status==0)
                         {
                             //$("#ReturnFormError").text("Sorry, we could not connect to server");
                             $("#ReturnFormError").text("Sorry, something went wrong");
                             $("label#ReturnFormError").show();
                         }
                         else if(dataReasult.Status==1)
                         {
                             //$("#ReturnFormError").text("Sorry, we could not connect to database");
                             $("#ReturnFormError").text("Sorry, something went wrong");
                             $("label#ReturnFormError").show();
                         }
                         else if(dataReasult.Status==2)
                         {
                             //$("#ReturnFormError").text("Data not Recieved");
                             $("#ReturnFormError").text("Sorry, something went wrong");
                             $("label#ReturnFormError").show();
                         }
                         else if(dataReasult.Status==3)
                         {
                             //$("#ReturnFormError").text("Error with database");
                             $("#ReturnFormError").text("Sorry, something went wrong");
                             $("#ReturnFormError").text(dataReasult.errorMsg);
                             $("label#ReturnFormError").show();
                         }
                         else if(dataReasult.Status==8)   //record found in database and successful return entry
                         {
                             
                             $("p#msg2").hide();
                             $("#ShowEntry").hide();
                             $("#ReturnForm").hide();
                             $("label#ReturnFormError").hide();
                             $("#RightMessage3").fadeIn("Slow");
                             $("#RightMessage3").fadeOut("Slow");
                             $("#ChooseInOut").fadeIn("Slow");

                         }
                         else if(dataReasult.Status==7) //record does not found
                         {
                             //$("#ReturnFormError").text("Record does not found");
                             $("#ReturnFormError").text("Sorry, something went wrong");
                             $("label#ReturnFormError").show(); 
                         }
                         else
                         {
                             //$("#ReturnFormError").text("Don't know");
                             $("#ReturnFormError").text("Sorry, something went wrong");
                             $("label#ReturnFormError").show();
                         }
                   }
                   else
                   {
                         //$("#ChooseInOutError").text(this.readyState+" "+this.status);
                         $("#ReturnFormError").text("Just a moment...");
                         $("label#ReturnFormError").show();
                         $("#ReturnFormError").append(".");
                         $("#ReturnFormError").append(".");
                         //$("label#ChooseInOutError").show();
                   }
               };
               xhrReturn.open("POST", "../PHP/OutStation.php", true);
               //xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
               xhrReturn.send(DataToSend);
               return false;
         }
         else
         {
            $("#ReturnDateError").text(Msg2);
            $("label#ReturnDateError").show();
         }
         return false;         
    });

	$('#OutStation').on('submit',function(){
		var formdata = $(this);
		data = new FormData(formdata[0]);
        data.append("Header",1);  //for adding new data to table

        var Msg="";
        var Msg1="";
        Msg=validate(data.get('Destination'),"Destination");
        Msg1+=Msg;
        if(Msg=="")
        {
    	    $("label#DestinationError").hide();
        }
    	else
    	{
    	    $("#DestinationError").text(Msg);
    	    $("label#DestinationError").show();
    	}

    	Msg=validate(data.get('Reason'),"Reason");
        Msg1+=Msg;
        if(Msg=="")
        {
    	    $("label#ReasonError").hide();
        }
    	else
    	{
    	    $("#ReasonError").text(Msg);
    	    $("label#ReasonError").show();
    	}
        
        var d1=false,d2=false;
    	Msg=validateDate(data.get('DepartureDate'));
        Msg1+=Msg;
        if(Msg=="")
        {
    	    $("label#DepartureDateError").hide();
    	    d1=true;
        }
    	else
    	{
    	    $("#DepartureDateError").text(Msg);
    	    $("label#DepartureDateError").show();
    	    d1=false;
    	}

    	Msg=validateDate(data.get('ArrivalDate'));
        Msg1+=Msg;
        if(Msg=="")
        {
    	    $("label#ArrivalDateError").hide();
    	    d2=true;
        }
    	else
    	{
    	    $("#ArrivalDateError").text(Msg);
    	    $("label#ArrivalDateError").show();
    	    d2=false;
    	}
          
        if(d1==true&&d2==true)
        {
	    	Msg=CompareDates(data.get('DepartureDate'),data.get('ArrivalDate'));
	        Msg1+=Msg;
	        if(Msg==true)
	        {
	    	    $("label#InvalidDateError").hide();
	        }
	    	else
	    	{
	    	    $("#InvalidDateError").text(Msg);
	    	    $("label#InvalidDateError").show();
	    	}
	    }
        
        if(Msg1=="")
        {
        	// var text="";
	        // for(var pair of data.entries())
	        // {
	        //     text+=pair[0]+','+pair[1]+'\n';
	        // }
	        // alert(text);
	        xhr = new XMLHttpRequest();
	        xhr.onreadystatechange=function(){
              if(this.readyState==4 && this.status==200)
              {
                 var dataRecieved=JSON.parse(this.responseText);
                 //var dataRecieved=this.responseText;
                 if(dataRecieved.Status==0)
                 {
                 	 //$("#OutStationError").text("Sorry, we could not connect to server");
                     $("#OutStationError").text("Sorry, something went wrong");
			         $("label#OutStationError").show();
                 }
                 else if(dataRecieved.Status==1)
                 {
                 	 //$("#OutStationError").text("Sorry, we could not connect to database");
                     $("#OutStationError").text("Sorry, something went wrong");
			         $("label#OutStationError").show();
                 }
                 else if(dataRecieved.Status==2)
                 {
                 	 //$("#OutStationError").text("Data not Recieved");
                     $("#OutStationError").text("Sorry, something went wrong");
			         $("label#OutStationError").show();
                 }
                 else if(dataRecieved.Status==3)
                 {
                 	 //$("#OutStationError").text("Error with database");
                     //$("#OutStationError").text(dataRecieved.errorMsg);
                     $("#OutStationError").text("Sorry, something went wrong");
			         $("label#OutStationError").show();
                 }
                 else if(dataRecieved.Status==4)
                 {
                 	 //$("#OutStationError").text("Successful");
			         $("label#OutStationError").hide();
			         $("#OutStation").fadeOut();
			         $("#RightMessage3").fadeIn();

                 }
                 else if(dataRecieved.Status==5)
                 {
                 	 //$("#OutStationError").text("Mail Could Not be sent");
                     $("#OutStationError").text("Sorry, something went wrong");
			         $("label#OutStationError").show();
                 }
                 else
                 {
                 	 $("#OutStationError").text("Sorry, something went wrong");
			         $("label#OutStationError").show();
                 }
              }
              else
              {
                  //$("#OutStationError").text(this.readyState+" "+this.status);
                  $("#OutStationError").text("Just a moment...");
			      $("label#OutStationError").show();
              }
	        };
	        xhr.open("POST", "../PHP/OutStation.php", true);
      		//xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      	    xhr.send(data);
        }
         
        return false;
	});
})