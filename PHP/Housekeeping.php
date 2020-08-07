<?php
session_start();
//require_once("SendMailOutStation.php");
//require_once("EmailIDs.php");
 /**************************************************************
   data recieved from front-end 
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
   //$Status=-1;

   /*************************************************************
          Connecting to MySql server and opening database*/
 
 
 require_once 'login.php';
 $db_server = mysqli_connect($db_hostname, $db_username, $db_password);
 if (!$db_server) 
 {
   $output['Status'] = 0;
   $output['errorCode'] = mysqli_connect_errno();
   $output['errorMsg'] = mysqli_connect_error();
   //$Status=0;
   $flag=1;
 } 
 if(!(mysqli_select_db($db_server,$db_database)))
 {
  $output['Status'] = 1;
  //$Status=1;
  $flag=1;  
 }
 /**************************************************************************/
if($flag==0)
{
   $ID=$_SESSION['ID'];

   // if(isset($_POST['Header'])&&($_POST['Header']==2))
   // {
   //     $query = "SELECT FeedbackID from $table_housekeeping where ID='$ID' and FeedbackDate=CURDATE()";
   //    $querytable = mysqli_query($db_server,$query);
   //    if(!$querytable)
   //       {
   //            $output['Status'] = 3; 
   //            $output['errorCode']=mysqli_errno($db_server);   //Error Code 1062 ==> Duplicate entry
   //            $output['errorMsg'] = mysqli_error($db_server);
   //       }
   //     else if(mysqli_num_rows($querytable)==1)
   //     {
   //       $Rslt = mysqli_fetch_assoc($querytable);
   //       $output['FeedbackID'] = $Rslt['FeedbackID'];
   //       $output['Status'] = 6;
   //       mysqli_free_result($querytable);

   //     }
   //     else
   //     {
   //      $output['Status'] = 7;
   //     }
   //     mysqli_close($db_server);
   // }

  if(isset($_POST['Header'])&&($_POST['Header']==1))
  {

    $Corridors=$_POST['Corridors'];
    $CommonRoom=$_POST['CommonRoom'];
    $Rooms=$_POST['Rooms'];
    $Accessories=$_POST['Accessories'];
    $Bathrooms=$_POST['Bathrooms'];
    $Toilets=$_POST['Toilets'];
    $Timing=$_POST['Timing'];
    $Overall=$_POST['Overall'];
    $Comment=sanitizeMySQL($db_server,$_POST['comment']);
    
    // $flagSequence = true;
    // if(isset($_POST['FeedbackID']))
    // {
    //        $FeedbackID = $_POST['FeedbackID'];
    //        $query4 = "DELETE from $table_housekeeping where FeedbackID='$FeedbackID'";
    //        // $query4.= "DELETE from SecurityFeedback2 where FeedbackID='$FeedbackID';";
    //        $delData = mysqli_query($db_server,$query4);
           
    //        if(!$delData)
    //        {
    //          $output['Status'] = 3; 
    //          $output['errorCode']=mysqli_errno($db_server);   //Error Code 1062 ==> Duplicate entry
    //          $output['errorMsg'] = mysqli_error($db_server).$query4;
    //          $flagSequence = false;
    //          //mysqli_rollback($db_server);
    //        }
    //        else
    //        {
             
    //          $output['Status'] = 9;
    //        }
    // }
    
    // if($flagSequence==true)
    // {
        $query = "INSERT INTO $table_housekeeping (ID,FeedbackDate,Corridors,CommonRoom,Rooms,Accessories,Bathrooms,Toilets,Timing,Overall,Comments) VALUES('$ID',CURDATE(),'$Corridors','$CommonRoom','$Rooms','$Accessories','$Bathrooms','$Toilets','$Timing','$Overall','$Comment')";
        if(!mysqli_query($db_server,$query))
          {
                $output['Status'] = 3; 
                $output['errorCode']=mysqli_errno($db_server);   //Error Code 1062 ==> Duplicate entry
                $output['errorMsg'] = mysqli_error($db_server);
                 //$Status=3;
          }
          else
          {
            $output['Status'] = 4;
          }
    // }
    
  }
  else
    $output['Status'] = 2;
}
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