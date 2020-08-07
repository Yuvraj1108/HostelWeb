
var breakfast = false; //false => feedback can not be given
var lunch = false;
var snacks = false;
var dinner = false;
var day;

var breakfasttoggle = false;
var lunchtoggle = false;
var snackstoggle = false;
var dinnertoggle = false;


function MealToggle(i){
    MealTime();
    if (i==1 && breakfast){
        if (breakfasttoggle==false){
            document.getElementById("breakfastreveal").style.display = 'block';
        }
        else{
            document.getElementById("breakfastreveal").style.display = 'none';
        }
        breakfasttoggle = !breakfasttoggle;
    }
    if (i==2 && lunch ){
        if (lunchtoggle==false ){
            document.getElementById("lunchreveal").style.display = 'block';
        }
        else{
            document.getElementById("lunchreveal").style.display = 'none';
        }
        lunchtoggle = !lunchtoggle;
    }
    if (i==3 && snacks ){
        if (snackstoggle==false ){
            document.getElementById("snacksreveal").style.display = 'block';
        }
        else{
            document.getElementById("snacksreveal").style.display = 'none';
        }
        snackstoggle = !snackstoggle;
    }
    if (i==4 && dinner){
        if (dinnertoggle==false ){
            document.getElementById("dinnerreveal").style.display = 'block';
        }
        else{
            document.getElementById("dinnerreveal").style.display = 'none';
        }
        dinnertoggle = !dinnertoggle;
    }
}

function MealTime()   
{
    var d = new Date();
    var Offset = 330*60*1000;
    d.setTime(d.getTime()+Offset);
    var h=d.getUTCHours();
    var m=d.getUTCMinutes();
    day=d.getUTCDay();
    
   // alert(h+" "+m+" " +day);
    // /******** Goa time is UTC+5:30*******************



    if(h>=7 && h<12)
    {
     	breakfast=true;
    }
    else if(h>=12 && h<17)
    {
       	lunch = true;
    }
    else if(h>=17 && h<19)
    {
       snacks= true;
    }
    else if(h>=19 && h<=23)
    {
    	dinner = true;
    }
}

$(function(){
$('#MessFeedback').on('submit',function(){
    //alert("Hello");

    var data = $(this);
    MessData = new FormData(data[0]);

        // var text="";
        //  for(var pair of MessData.entries())
        //  {
        //      text+=pair[0]+','+pair[1]+'\n';
        //  }
        // alert(text);
        //alert(MessData);
        request = new XMLHttpRequest();
        request.onreadystatechange=function(){
            if(this.readyState == 4 && this.status == 200)
            {
               var dataObatined = JSON.parse(this.responseText);
               if(dataObatined.sqlerror=="")
               {
                 $('#MessFeedback').fadeOut();
                 $("label#MessError").hide();
                 $('#RightMessage2').fadeIn();
               }
               else
               {
                 //$("#MessError").text(dataObatined.sqlerror);
                 $("#MessError").text("Sorry, Something went wrong");
                 $("label#MessError").show();
                 
               }

            }
            else
            {
               //$("#MessError").text(this.readyState+" "+this.status);
               $("#MessError").text("Just a moment...");
               $("label#MessError").show();
            }
        };
        request.open("POST", "../PHP/MessProcess.php", true);
            //xhrequestStudent.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.send(MessData);

        return false;

})
});