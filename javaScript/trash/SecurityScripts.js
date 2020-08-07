var flagIsOld = false;
var dataObtained; 

function SecurityGuardTime()   
{
    var d= new Date();
    var h=d.getUTCHours();
    var m=d.getUTCMinutes();
    var day=d.getUTCDay();
    //alert(d.getTimezoneOffset());
    /******** Goa time is UTC+5:30*******************
          So adding this offset to UTC time*/ 

    h=h+5; 
    if(h>23)
    {
        h=h-24;
        day=day+1;
        if(day==8)
            day=1;

    }
    m=m+30;
    if(m>59)
    {
        m=m-60;
        h=h+1;
        if(h==24)
        {
            h=0;
            day=day+1;
            if(day==8)
                day=1;
        }
    }
    day=day-1;
    if(day==0)
        day=6;
    else 
        day=day-1;
    return day;
}
function checkDateDifference(Dat)
{
    var d1 = new Date();
    var Offset = 330*60*1000;
    d1.setTime(d1.getTime()+Offset);
    var d2= new Date(Dat);
    var diff=d1.getDate()-d2.getDate();
    return diff;
}
function Timelimit()
{
   var d = new Date();
   var Offset = 330*60*1000;
   d.setTime(d.getTime()+Offset);
   if(d.getUTCHours()>=9 && d.getUTCHours()<=21)
    return 1;
  else
   return 0; 
}
/**************************************************************************************************
  Function to show questions */
function ShowQuestions(obj)
{   
    name='';
    //for(var i=1;i<=4;i++)
    //{ 
        var diff = checkDateDifference(obj.DutyDate);
        if(diff==1)
        {    
            $('#Questions').append('<label><b>Following guards were on duty on '+obj.DutyDay+' '+obj.DutyDate+' at '+obj.Hostel+'</label>');
            if(obj.Time1!="")
            {
                $('#Questions').append('<label><b>Your rating for Mr. '+obj.Time1+ '</b></label>');
                $('#Questions').append('<div class="row"><div class="col-16"><input type="radio" name="Time1Rating" value="Very Poor"> Very Poor</div><div class="col-16"><input type="radio" name="Time1Rating" value="Poor"> Poor</div><div class="col-16"><input type="radio" name="Time1Rating" value="Average"> Average</div><div class="col-16"><input type="radio" name="Time1Rating" value="Good"> Good</div><div class="col-16"><input type="radio" name="Time1Rating" value="Very Good"> Very Good</div><div class="col-16"><input type="radio" name="Time1Rating" value="NA" checked> NA</div></div>');
                $('#Questions').append('<label><b>Your comment for Mr. '+obj.Time1+ '</b></label>');
                $('#Questions').append('<input type="text" name="Time1Comment" placeholder="Your valuable comment"/>');
            }

            if(obj.Time2!="")
            {
                $('#Questions').append('<label><b>Your rating for Mr. '+obj.Time2+ '</b></label>');
                $('#Questions').append('<div class="row"><div class="col-16"><input type="radio" name="Time2Rating" value="Very Poor"> Very Poor</div><div class="col-16"><input type="radio" name="Time2Rating" value="Poor"> Poor</div><div class="col-16"><input type="radio" name="Time2Rating" value="Average"> Average</div><div class="col-16"><input type="radio" name="Time2Rating" value="Good"> Good</div><div class="col-16"><input type="radio" name="Time2Rating" value="Very Good"> Very Good</div><div class="col-16"><input type="radio" name="Time2Rating" value="NA" checked> NA</div></div>');
                $('#Questions').append('<label><b>Your comment for Mr. '+obj.Time2+ '</b></label>');
                $('#Questions').append('<input type="text" name="Time2Comment" placeholder="Your valuable comment"/>');
            }

            if(obj.Time3!="")
            {
                $('#Questions').append('<label><b>Your rating for Mr. '+obj.Time3+ '</b></label>');
                $('#Questions').append('<div class="row"><div class="col-16"><input type="radio" name="Time3Rating" value="Very Poor"> Very Poor</div><div class="col-16"><input type="radio" name="Time3Rating" value="Poor"> Poor</div><div class="col-16"><input type="radio" name="Time3Rating" value="Average"> Average</div><div class="col-16"><input type="radio" name="Time3Rating" value="Good"> Good</div><div class="col-16"><input type="radio" name="Time3Rating" value="Very Good"> Very Good</div><div class="col-16"><input type="radio" name="Time3Rating" value="NA" checked> NA</div></div>');
                $('#Questions').append('<label><b>Your comment for Mr. '+obj.Time3+ '</b></label>');
                $('#Questions').append('<input type="text" name="Time3Comment" placeholder="Your valuable comment"/>');
            }

            if(obj.Time4!="")
            {
                $('#Questions').append('<label><b>Your rating for Mr. '+obj.Time4+ '</b></label>');
                $('#Questions').append('<div class="row"><div class="col-16"><input type="radio" name="Time4Rating" value="Very Poor"> Very Poor</div><div class="col-16"><input type="radio" name="Time4Rating" value="Poor"> Poor</div><div class="col-16"><input type="radio" name="Time4Rating" value="Average"> Average</div><div class="col-16"><input type="radio" name="Time4Rating" value="Good"> Good</div><div class="col-16"><input type="radio" name="Time4Rating" value="Very Good"> Very Good</div><div class="col-16"><input type="radio" name="Time4Rating" value="NA" checked> NA</div></div>');
                $('#Questions').append('<label><b>Your comment for Mr. '+obj.Time4+ '</b></label>');
                $('#Questions').append('<input type="text" name="Time4Comment" placeholder="Your valuable comment"/>');
            }

            $('#Questions').append('<label><b>Any other comment regarding security service</b></label>');
            //$('#Questions').append('<input type="text" name="Comment" placeholder="Your valuable comment"/>');
            $('#Questions').append('<textarea rows="5" cols="50" id="Comment" name="Comment"></textarea>');
        }
        else
        {
            $("label#QuestionError").hide();
            $("#SecurityFeedback").hide();
            $("#WrongMessage").show();
            $("#sub_button").hide();
        }

    //}
}
/************************************************************************************************/
var dataRecieved;
/***********************************************************************************************/
function getSecurityGuards(day)
{
    var Days=['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'];
    var Day = Days[day]  //in today's form we are asking feedback of yestersay's guards
    var Header = 1 // request for getting names of guards from sql database
    request = new XMLHttpRequest();
    //alert(Day);
    request.onreadystatechange=function()
    {
        if(this.readyState==4 && this.status==200)
        {
            dataRecieved = JSON.parse(this.responseText);
            if(dataRecieved.Status==0)
             {
                 $("#QuestionError").text("Sorry, we could not connect to server");
                 $("label#QuestionError").show();
             }
             else if(dataRecieved.Status==1)
             {
                 $("#QuestionError").text("Sorry, we could not connect to database");
                 $("label#QuestionError").show();
             }
             else if(dataRecieved.Status==2)
             {
                 $("#QuestionError").text("Data not Recieved");
                 $("label#QuestionError").show();
             }
             else if(dataRecieved.Status==3)
             {
                 $("#QuestionError").text("Error with database");
                 $("label#QuestionError").show();
             }
             else if(dataRecieved.Status==4)   //record found in databse
             {
                 $("label#QuestionError").hide();
                 ShowQuestions(dataRecieved);
                 //$('#Questions').show();
                 //$('#SecurityFeedback').show();
                 //return dataRecieved;
             }
             else if(dataRecieved.Status==5)   //record found in databse
             {
                 //$("#QuestionError").text("Nothing can be found in database");
                 $("label#QuestionError").hide();
                 $("#SecurityFeedback").hide();
                 $("#WrongMessage").show();
                 $("#sub_button").hide();
             }
             else
             {
                 $("#QuestionError").text("Don't know");
                 $("label#QuestionError").show();
             }                 
        }
        else
        {
            $("#QuestionError").text("Just a moment...");
            //$("#QuestionError").text(this.readyState + " "+ this.status);
            $("label#QuestionError").show();
        }
    };
    request.open("POST", "../PHP/SecurityFeedback.php", true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send("Header="+Header+"&Day="+Day);
}
/***********************************************************************************************
    For checking if this feedback entry is duplicate*/
/**********************************************************************************************/
function checkFeedback()
{
    xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
        if(this.readyState==4 && this.status == 200)
        {
                dataObtained = JSON.parse(this.responseText);
                if(dataObtained.Status==0)
                 {
                     $("#NotifyError").text("Sorry, we could not connect to server");
                     $("label#NotifyError").show();
                 }
                 else if(dataObtained.Status==1)
                 {
                     $("#NotifyError").text("Sorry, we could not connect to database");
                     $("label#NotifyError").show();
                 }
                 else if(dataObtained.Status==2)
                 {
                     $("#NotifyError").text("Data not Recieved");
                     $("label#NotifyError").show();
                 }
                 else if(dataObtained.Status==3)
                 {
                     $("#QuestionError").text("Error with database");
                     $("label#NotifyError").show();
                 }
                 else if(dataObtained.Status==6)   //record found in database
                 {
                     $("label#NotifyError").hide();
                     //$("p#msg2").append(dataObtained.FeedbackID);

                     $("#Notify").fadeIn();
                     flagIsOld = true;
                     
                 }
                 else if(dataObtained.Status==7)
                 {
                     $("label#NotifyError").hide();
                     flagIsOld = false;
                     $('#SecurityFeedback').show();
                     //$("#SecurityFeedback").fadeIn();
                 }
                 else
                 {
                     $("#NotifyError").text("Don't know");
                     $("label#NotifyError").show();
                 }                 
            }
            else
            {
                $("#NotifyError").text("Just a moment...");
                //$("#QuestionError").text(this.readyState + " "+ this.status);
                $("label#NotifyError").show();
            }

        };
        xhr.open("POST", "../PHP/SecurityFeedback.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("Header="+2);

}

/***********************************************************************************************/
$(function(){

    //$('Questions').hide();
    $('#Notify').hide();
    $('#SecurityFeedback').hide();
    var timel = Timelimit();
    //alert(timel);
    if(timel==1)
    {
        getSecurityGuards(SecurityGuardTime());

        checkFeedback();
    }
    else
    {
       $('#Timeline').show(); 
    }
        /*if(flagIsOld==false)
        {
           $('#SecurityFeedback').show();
        }*/
        //alert(dataObtained.Status);

        $('#Edit').click(function(){
            $('#Notify').hide();
            $('#SecurityFeedback').fadeIn()
        })

        $('#SecurityFeedback').on('submit',function(){
            var data = $(this);
            formdata= new FormData(data[0]);
            formdata.append('Hostel',dataRecieved.HostelNo);
            formdata.append('DutyDay',dataRecieved.DutyDay);
            formdata.append('DutyDate',dataRecieved.DutyDate);
            formdata.append('Time1Guard',dataRecieved.Time1);
            formdata.append('Time2Guard',dataRecieved.Time2);
            formdata.append('Time3Guard',dataRecieved.Time3);
            formdata.append('Time4Guard',dataRecieved.Time4);

            if(flagIsOld==true)
            {
                formdata.append('FeedbackID',dataObtained.FeedbackID);
                //alert(dataObtained.Status);
            }

            formdata.append('Header',3);
            
            xmlrequest = new XMLHttpRequest();
            xmlrequest.onreadystatechange=function(){
                if(this.readyState==4 && this.status ==200)
                {
                    var dataObtainedData = JSON.parse(this.responseText);
                         if(dataObtainedData.Status==0)
                         {
                             $("#QuestionError").text("Sorry, we could not connect to server");
                             $("label#QuestionError").show();
                         }
                         else if(dataObtainedData.Status==1)
                         {
                             $("#QuestionError").text("Sorry, we could not connect to database");
                             $("label#QuestionError").show();
                         }
                         else if(dataObtainedData.Status==2)
                         {
                             $("#QuestionError").text("Data not Recieved");
                             $("label#QuestionError").show();
                         }
                         else if(dataObtainedData.Status==3)
                         {
                             $("#QuestionError").text("Error with database");
                             $("label#QuestionError").show();
                         }
                         else if(dataObtainedData.Status==8)   //record found in databse
                         {
                             $("label#QuestionError").hide();
                             $('#SecurityFeedback').fadeOut();
                             $('#RightMessage').fadeIn();
                             //ShowQuestions(dataRecieved);
                             //$('#Questions').show();
                             //return dataRecieved;
                         }
                         // else if(dataObtainedData.Status==9)
                         // {
                         //     $("#QuestionError").text("Data not deleted");
                         //     $("label#QuestionError").show();
                         // }
                         else
                         {
                             $("#QuestionError").text("Don't know");
                             $("label#QuestionError").show();
                         }                 
                    }
                    else
                    {
                        $("#QuestionError").text("Just a moment...");
                        //$("#QuestionError").text(this.readyState + " "+ this.status);
                        $("label#QuestionError").show();
                    }

                };

                xmlrequest.open("POST", "../PHP/SecurityFeedback.php", true);
                //xhrequestStudent.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlrequest.send(formdata);

            
            /*var text="";
            for(var pair of formdata.entries())
            {
                text+=pair[0]+','+pair[1]+'\n';
            }
            alert(text);*/

            return false;
        })
    
})