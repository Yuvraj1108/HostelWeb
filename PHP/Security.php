<?php
session_start();
/**************************************************************
   data recieved from front-end 
  **************************************************************

  /*
  Status = 0 =>failed to connect to mysql server
  Status = 1 =>failed to get required database on server
  Status = 2 => data not recived from form
  Status = 3 => error in querying sql table
  Status = 4 => succesful entry
  ****************************************************************/

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
  if(isset($_POST['Header'])&&($_POST['Header']==1))
  {
    $Q1=$_POST['Security_Q1'];
    $Q2=$_POST['Security_Q2'];
    $Q3=$_POST['Security_Q3'];
    $Q4=$_POST['Security_Q4'];
    $Q5=$_POST['Security_Q5'];
    $Q6=$_POST['Security_Q6'];
    $Comment=sanitizeMySQL($db_server,$_POST['Security_comment']);

     $query = "INSERT INTO $table_security (ID,FeedbackDate,Q1,Q2,Q3,Q4,Q5,Q6,Comments) VALUES('$ID',CURDATE(),'$Q1','$Q2','$Q3','$Q4','$Q5','$Q6','$Comment')";
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
  }
  else
  {
    $output['Status'] = -2;    //undeterministic state
  }
}
else
{
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