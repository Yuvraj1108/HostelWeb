/*************************************************************************************
    Global variables*/
 var dataResponse;    //response data taken from ID_token of google api
 var dataVerified;    //data recieved from user profile if it exists in database

 var flag1=false;   

/******************************************************************
*           Functions For Checking validity of fields             *
*                                                                 *
*******************************************************************/
function validateRollNo(field)
{
    if(field.length==0)
       return "Roll Number not Entered ";
   else if(/[^0-9]/.test(field))
       return "Only digits are allowed in Roll number."+"\n"; 
   if(field.length!=9)
        return "9 digits are required in Roll number."+"\n";
   /*var year=field.slice(0,4);
   var branch=field.slice(4,7);
   var number=field.slice(7,9);
   if((year!="1600")&&(year!="1700"))
     return "Invalid Roll Number";//+year;
   if((branch!="100")&&(branch!="200")&&(branch!="300"))
     return "Invalid Roll Number";//+branch;
   if(number>30)
     return "Invalid Number";//+number;*/
   return ""; 
}
function validateRoomNo(field)
{
	 if(field.length==0)
       return "Room Number not Entered ";
     else if(/[^0-9]/.test(field))
       return "Only digits are allowed in Roll number."+"\n"; 
     if(field>232)
        return "Invalid Room Number."+"\n";
     return ""; 
}
function validateName(field)
{
  if(field.length==0)
       return "Name not Entered ";
     else if(/[^a-zA-Z\s-]/.test(field))
       return "Only characters are allowed in Name."+"\n"; 

     return ""; 
}
function validateAddress(field)
{
  if(field.length==0)
       return "Address not Entered ";
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

function validatePIN(field)
{
   if(field.length==0)
       return "PIN not Entered!";
   else if(/[^0-9]/.test(field))
       return "Only digits are allowed in PIN."; 
   if(field.length!=6)
        return "6 digits are required in PIN.";
    return "";
}

function validateDate(field)
{
   if(field.length==0)
       return "Date Not Selected!";
    return "";
}
/*************************************************************************************
        Function to show student's profile information                                  */
function ShowStudnet(obj)
{
  	$('#Name').css("background-color","rgb(38,30,46)");
  	$('#Name').css("color","white");
    $('#Name').text("Welcome ");
    $('#Name').append(obj.Name);
    $('#RolNo').text(obj.RollNo);
    $('#RomNo').text(obj.RoomNo);
    $('#E_mail').text(obj.Email);
    $('#HNo').text(obj.HostelName);
}           
 /************************************************************************************
                        */
function verifyUserInDatabase(obj)
{
    xhrequest = new XMLHttpRequest();
    var dataToSend =JSON.stringify(obj);//javaScriptToQueryString(obj);//= JSON.stringify(dataResponse);
    xhrequest.onreadystatechange=function(){
    	if(this.readyState==4 && this.status==200)
    	{
    		dataVerified=JSON.parse(this.responseText);  //convert json data received to javaScript object
            if(dataVerified.Status==0)   //failed to connect to mysql server
			{
              $("#SignInError").text("Sorry,We could not connect to server");
              $("label#SignInError").show();  
			}
			else if(dataVerified.Status==1)  //failed to find database
			{
              $("#SignInError").text("Sorry,Required Database could not be found on server");
              $("label#SignInError").show();
			}
			else if(dataVerified.Status==2)  //data not recieved
			{ 
				        $("#SignInError").text("Error in sending your data to server");
                $("label#SignInError").show();
			}
			else if(dataVerified.Status==3)  
			{
                $("#SignInError").text("Error in retrieving your information");
                $("label#SignInError").show();
			}
			else if(dataVerified.Status==4)  //user found in student record
			{

			         $("#SignIn").hide();
               ShowStudnet(dataVerified);         //Should be changed
               $('#NewStudent').hide();

               $("#Profile").fadeIn();    	       //Should be chnaged
               $("#Internal").fadeIn();
			} 
			else if(dataVerified.Status==6)  //record does not found
			{
			    $("#SignIn").hide();
          flag1=true;
          $("#IAm").fadeIn();
			}
			else   //don't know something is wrong
			{
               $("#SignInError").text("Sorry, Something went wrong");
               $("label#SignInError").show();
			}
		}
		else
		{
           //$("#SignInError").text(this.readyState+" "+this.status);
           $("#SignInError").text("Just a moment..");
           $("label#SignInError").show();
		}
    };
    xhrequest.open("POST", "../PHP/VerifyUser.php", true);
    xhrequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhrequest.send("data="+dataToSend);
}   
 


 /************************************************************************************
          Function calls when user signs in*/

function onSignIn(googleUser) 
{
 
  var id_token = googleUser.getAuthResponse().id_token;
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange=function(){
        if(this.readyState==4 && this.status==200)
        {
               dataResponse=JSON.parse(this.responseText);
                if(dataResponse.aud=="140503907288-g665dccn1p9me9ihmt6sq6aho7vhqujc.apps.googleusercontent.com" && dataResponse.hd=="iitgoa.ac.in")
                {
                  $("label#SignInError").hide();
                  dataResponse.searchIn="Student";
                  verifyUserInDatabase(dataResponse);
                  //googleUser.disconnect();
                }
                else
                { 
                   $("#SignInError").text("Use your IIT Goa Email ID");
                   $("label#SignInError").show();
                }
        }
        else
        {
                //$("#SignInError").text(this.readyState+" "+this.status);
                $("#SignInError").text("Just a moment..."); 
                $("label#SignInError").show();
        }
    };
    xhr.open("GET", "https://www.googleapis.com/oauth2/v3/tokeninfo?id_token="+id_token, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send();
   googleUser.disconnect();
}
/**********************************************************************************************/
function signOut(id) 
{
  var auth2 = gapi.auth2.getAuthInstance();
  auth2.signOut().then(function () {
    //document.location.reload(true);
    $('#'+id).hide();
    $("label#SignInError").hide();
    $('#SignIn').show();
    //auth2.disconnect();
    document.location.reload(true);

  });
}
/********************************************************************************************/

$(function(){
	$("#IAm").hide();
  $("#Alert").hide();
	$("#Profile").hide();
	$("#NewStudent").hide();

	$('#IsStudent').click(function(){
		if(flag1==true)
		{
			$("#IAm").fadeOut();

			$("#NewStudent").fadeIn();
      $('#Full_Name').val(dataResponse.name);
		}
	});

  $('#IsStaff').click(function(){
    if(flag1==true)
    {
      $("#IAm").hide();
      $("#Alert").fadeIn(); 
    }
  });

	$('#NewStudent').on('submit',function(){
		var form = $(this);
	    data = new FormData(form[0]);
        
        var Msg="";
        var Msg1="";

        Msg=validateName(data.get('FullName'));
        Msg1+=Msg;
        if(Msg=="")
        {
          $("label#FullNameError").hide();
        }
      else
      {
          $("#FullNameError").text(Msg);
          $("label#FullNameError").show();
      }

        Msg=validateRollNo(data.get('RollNo'));
        Msg1+=Msg;
        if(Msg=="")
        {
    	    $("label#Roll_NoError").hide();
        }
    	else
    	{
    	    $("#Roll_NoError").text(Msg);
    	    $("label#Roll_NoError").show();
    	}

    	Msg=validateRoomNo(data.get('RoomNo'));
      Msg1+=Msg;
        if(Msg=="")
        {
    	    $("label#roomError").hide();
        }
    	else
    	{
    	    $("#roomError").text(Msg);
    	    $("label#roomError").show();
    	}

      Msg=validateContactNo(data.get('StudentContact'));
      Msg1+=Msg;
        if(Msg=="")
        {
          $("label#StudentContactError").hide();
        }
      else
      {
          $("#StudentContactError").text(Msg);
          $("label#StudentContactError").show();
      }

      Msg=validateAddress(data.get('Line1'));
      Msg1+=Msg;
        if(Msg=="")
        {
          $("label#Line1Error").hide();
        }
      else
      {
          $("#Line1Error").text(Msg);
          $("label#Line1Error").show();
      }

      Msg=validateAddress(data.get('Line2'));
      Msg1+=Msg;
        if(Msg=="")
        {
          $("label#Line2Error").hide();
        }
      else
      {
          $("#Line2Error").text(Msg);
          $("label#Line2Error").show();
      }

      Msg=validatePIN(data.get('PIN'));
      Msg1+=Msg;
        if(Msg=="")
        {
          $("label#PINError").hide();
        }
      else
      {
          $("#PINError").text(Msg);
          $("label#PINError").show();
      }

      Msg=validateContactNo(data.get('ParentContact'));
      Msg1+=Msg;
        if(Msg=="")
        {
          $("label#ParentContactError").hide();
        }
      else
      {
          $("#ParentContactError").text(Msg);
          $("label#ParentContactError").show();
      }


      Msg=validateEmail(data.get('ParentEmail'));
      Msg1+=Msg;
        if(Msg=="")
        {
          $("label#ParentEmailError").hide();
        }
      else
      {
          $("#ParentEmailError").text(Msg);
          $("label#ParentEmailError").show();
      }

      Msg=validateDate(data.get('DOB'));
      Msg1+=Msg;
        if(Msg=="")
        {
          $("label#DOBError").hide();
        }
        else
        {
          $("#DOBError").text(Msg);
          $("label#DOBError").show();
        }

       Msg=validateName(data.get('ParentName'));
        Msg1+=Msg;
        if(Msg=="")
        {
          $("label#ParentNameError").hide();
        }
      else
      {
          $("#ParentNameError").text(Msg);
          $("label#ParentNameError").show();
      }

    	if(Msg1=="")
    	{
    		var xhrequestStudent = new XMLHttpRequest();
    		xhrequestStudent.onreadystatechange=function(){
    			if(this.readyState==4 && this.status==200)
    			{
    				var dataRecieved = JSON.parse(this.responseText);
    				if(dataRecieved.Status==0)   //failed to connect to mysql server
    				{
                      $("#result").text("Sorry,We could not connect to server");
                      $("label#result").show();  
    				}
    				else if(dataRecieved.Status==1)  //failed to find database
    				{
                      $("#result").text("Sorry,Required Database does not found on server");
                      $("label#result").show();
    				}
    				else if(dataRecieved.Status==2)  //data not recieved
    				{ 
    					$("#result").text("Error in sending your data to server");
                        $("label#result").show();
    				}
    				else if(dataRecieved.Status==3)  //error in queryin sql
    				{
                        $("#result").text("Error in updating your information  ");
                        $("#result").append(dataRecieved.errorMsg);
                        $("label#result").show();
    				}
    				else if(dataRecieved.Status==4)  //successful entry
    				{
                       ShowStudnet(dataRecieved);         //Should be changed
                       $('#NewStudent').fadeOut();
    	                 $("#Profile").fadeIn();    	       //Should be chnaged
                       $("#Internal").fadeIn();    
    				} 
    				else   //don't know something is wrong
    				{
                       $("#result").text("Sorry, Something went wrong");
                       $("label#result").show();
    				}
    			}
    			else
    			{
                   //$("#result").text(this.readyState+" "+this.status);
                   $("#result").text("Just a moment...");
                   $("label#result").show();
    			}
    		};
    		xhrequestStudent.open("POST", "../PHP/NewStudent.php", true);
      		//xhrequestStudent.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      	xhrequestStudent.send(data);
    	}
    	return false;
	});

})