<?php
session_start();
  /**************************************************************
   data recieved from front-end 
   RollNo,HostelNo,RoomNo
  **************************************************************

  /*
  Status = 0 =>failed to connect to mysql server
  Status = 1 =>failed to get required database on server
  Status = 2 => data not recived from form
  Status = 3 => error in querying sql table
  Status = 4 => succesful entry
  /***************************************************************/

   $flag=0;
   $output=array();

   /*************************************************************
          Connecting to MySql server and opening database*/
 
 
 require_once 'login.php';
 $db_server = mysqli_connect($db_hostname, $db_username, $db_password);
 if (!$db_server) 
 {
   $output['Status'] = 0;
   $output['errorCode'] = mysqli_connect_errno();
   $output['errorMsg'] = mysqli_connect_error();
   $flag=1;
 } 
if(!(mysqli_select_db($db_server,$db_database)))
{
  $output['Status'] = 1;
  $flag=1;  
}

/***************************************************************/
if($flag==0)
{
  $ID=$_SESSION['ID'];
  $Hostel=$_SESSION['HostelNo'];

  if(isset($_POST['Day'])&&
     isset($_POST['Header'])&&
     ($_POST['Header']==1))
  {     
        $Day = $_POST['Day'];
        $query="SELECT * from GuardsDutyChart,HostelNames where DutyDay ='$Day' AND Hostel='$Hostel' and GuardsDutyChart.Hostel=HostelNames.HostelNo";
        $querySecurity=mysqli_query($db_server,$query);
        if(!$querySecurity)
        {
            $output['Status'] = 3; 
            $output['errorCode']=mysqli_errno($db_server);
            $output['errorMsg'] = mysqli_error($db_server);
        }
        else if(mysqli_num_rows($querySecurity)==1)  //found sucessfully
        {
           $result=mysqli_fetch_assoc($querySecurity);
           $output['Time1'] = $result['Time1'];
           $output['Time2'] = $result['Time2'];
           $output['Time3'] = $result['Time3'];
           $output['Time4'] = $result['Time4'];
           $output['Hostel'] = $result['HostelName'];
           $output['HostelNo'] = $result['HostelNo'];
           $output['DutyDay']  = $result['DutyDay'];
           $output['DutyDate'] = $result['DutyDate'];
           $output['Status'] = 4;
           mysqli_free_result($querySecurity);
        }
        else
        {
          $output['Status'] = 5;
        }
        mysqli_close($db_server);
  }

  else if(isset($_POST['Header'])&&
          ($_POST['Header']==2))
  {
    $query = "SELECT FeedbackID from SecurityFeedback1 where ID='$ID' and FeedbackDate=CURDATE()";
    $querytable = mysqli_query($db_server,$query);
    if(!$querytable)
       {
            $output['Status'] = 3; 
            $output['errorCode']=mysqli_errno($db_server);   //Error Code 1062 ==> Duplicate entry
            $output['errorMsg'] = mysqli_error($db_server);
       }
       else if(mysqli_num_rows($querytable)==1)
     {
       $Rslt = mysqli_fetch_assoc($querytable);
       $output['FeedbackID'] = $Rslt['FeedbackID'];
       $output['Status'] = 6;
       mysqli_free_result($querytable);

     }
     else
     {
      $output['Status'] = 7;
     }
     mysqli_close($db_server);
  }

  else if(isset($_POST['Header'])&&
          ($_POST['Header']==3))
  {
       //$flag = true;  
       $ID=$_SESSION['ID'];
       $DutyDay = $_POST['DutyDay'];
       $DutyDate = $_POST['DutyDate'];
       $HostelNo = $_POST['Hostel'];
       $Comment = sanitizeMySQL($db_server,$_POST['Comment']);
       $Time1Guard="";
       $Time1Rating="";
       $Time1Comment="";
       $Time2Guard="";
       $Time2Rating="";
       $Time2Comment="";
       $Time3Guard="";
       $Time3Rating="";
       $Time3Comment="";
       $Time4Guard="";
       $Time4Rating="";
       $Time4Comment="";
       if((isset($_POST['Time1Guard']))&&($_POST['Time1Guard']!=""))
       {
         $Time1Guard = sanitizeMySQL($db_server,$_POST['Time1Guard']);
         $Time1Rating = sanitizeMySQL($db_server,$_POST['Time1Rating']);
         $Time1Comment = sanitizeMySQL($db_server,$_POST['Time1Comment']);
       }

       if((isset($_POST['Time2Guard']))&&($_POST['Time2Guard']!=""))
       {
        $Time2Guard = sanitizeMySQL($db_server,$_POST['Time2Guard']);
        $Time2Rating = sanitizeMySQL($db_server,$_POST['Time2Rating']);
        $Time2Comment = sanitizeMySQL($db_server,$_POST['Time2Comment']);
       }
       
       if((isset($_POST['Time3Guard']))&&($_POST['Time3Guard']!=""))
       {
         $Time3Guard = sanitizeMySQL($db_server,$_POST['Time3Guard']);
         $Time3Rating = sanitizeMySQL($db_server,$_POST['Time3Rating']);
         $Time3Comment = sanitizeMySQL($db_server,$_POST['Time3Comment']);
       }

       if((isset($_POST['Time4Guard']))&&($_POST['Time4Guard']!=""))
       {
         $Time4Guard = sanitizeMySQL($db_server,$_POST['Time4Guard']);
         $Time4Rating = sanitizeMySQL($db_server,$_POST['Time4Rating']);
         $Time4Comment = sanitizeMySQL($db_server,$_POST['Time4Comment']);
       }
    
       $flagSequence = true;
       mysqli_autocommit($db_server, FALSE);
       if(isset($_POST['FeedbackID']))
       {   
           $FeedbackID = $_POST['FeedbackID'];
           $query4 = "DELETE from SecurityFeedback1 where FeedbackID='$FeedbackID'";
           // $query4.= "DELETE from SecurityFeedback2 where FeedbackID='$FeedbackID';";
           $delData = mysqli_query($db_server,$query4);
           
           $query5 = "DELETE from SecurityFeedback2 where FeedbackID='$FeedbackID';";
           $delData2 = mysqli_query($db_server,$query5);
           
           if(!($delData&&$delData2))
           {
             $output['Status'] = 3; 
             $output['errorCode']=mysqli_errno($db_server);   //Error Code 1062 ==> Duplicate entry
             $output['errorMsg'] = mysqli_error($db_server).$query4;
             $output['ID'] = "Hello";
             $flagSequence = false;
             mysqli_rollback($db_server);
           }
           else
           {
             
             $output['Status'] = 9;
             $output['ID'] = "Hell";
           }
           //error_log(print_r($delData, true));
       }
        if($flagSequence == true)
        {

          $query1 = "INSERT INTO SecurityFeedback1 (ID,FeedbackDate,Comment) values('$ID',CURDATE(),'$Comment')";
          if(!mysqli_query($db_server,$query1))
            {
                $output['Status'] = 3; 
                $output['errorCode']=mysqli_errno($db_server);   //Error Code 1062 ==> Duplicate entry
                $output['errorMsg'] = mysqli_error($db_server).$query1;
                mysqli_rollback($db_server);
            }
            else   //sucessful entry
            {
               $query2 = "SELECT FeedbackID from SecurityFeedback1 where FeedbackID = @@Identity";
               $query2table = mysqli_query($db_server,$query2);
               if(!$query2table)
               {
                $output['Status'] = 3; 
                $output['errorCode']=mysqli_errno($db_server);   
                $output['errorMsg'] = mysqli_error($db_server).$query2;
                mysqli_rollback($db_server);
               }
               else
               {
                $obtainedResult = mysqli_fetch_assoc($query2table);
                $FeedbackID = $obtainedResult['FeedbackID'];
                mysqli_free_result($query2table);
                $query3="";
                if($Time1Guard!="")
                {
                   $query3 = "INSERT INTO securityfeedback2 values('$FeedbackID','$DutyDay','$DutyDate','$HostelNo','$Time1Guard','$Time1Rating','$Time1Comment');";
                }
                if($Time2Guard!="")
                {
                   $query3.= "INSERT INTO securityfeedback2 values('$FeedbackID','$DutyDay','$DutyDate','$HostelNo','$Time2Guard','$Time2Rating','$Time2Comment');";
                }
                if($Time3Guard!="")
                {
                   $query3.= "INSERT INTO securityfeedback2 values('$FeedbackID','$DutyDay','$DutyDate','$HostelNo','$Time3Guard','$Time3Rating','$Time3Comment');";
                }
                if($Time4Guard!="")
                {
                   $query3.= "INSERT INTO securityfeedback2 values('$FeedbackID','$DutyDay','$DutyDate','$HostelNo','$Time4Guard','$Time4Rating','$Time4Comment');";
                }
                //if($query3!="")
                //{
                  if(!mysqli_multi_query($db_server,$query3))
                  {
                   $output['Status'] = 3; 
                   $output['errorCode']=mysqli_errno($db_server);   //Error Code 1062 ==> Duplicate entry
                   $output['errorMsg'] = mysqli_error($db_server).$query3;
                   mysqli_rollback($db_server);
                  }
                  else   //sucessful entry
                  {
                    $output['Status'] = 8;  
                    mysqli_commit($db_server);
                  }
                //}
              }
            }
          }
          mysqli_close($db_server);
  }
  else
  {
    $output['Status'] =2;
  }
}
//mysqli_close($db_server);
echo json_encode($output);

/***************************************************************
                 Function For Sanitizing data 
***************************************************************/


function sanitizeString($var)
{
  $var = stripslashes($var);
  $var = htmlentities($var);
  $var = strip_tags($var);
  return $var;
}
function sanitizeMySQL($server,$var)
{
  $var = mysqli_real_escape_string($server,$var);
  $var = sanitizeString($var);
  return $var;
} 
?>