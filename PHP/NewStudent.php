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

function HostelName($HostelNo)
{
    $HostelNames=array('x','Block B1','Block B2','Block B3','Block G1');
   return $HostelNames[$HostelNo];
}
 // function RoomNo($HostelNo,$RoomNo,$Floor)
 // {
 //   if($HostelNo==1)
 //     return $Floor.'-'.$RoomNo;
 //   else if($HostelNo==2||$HostelNo==3)
 //    return $RoomNo;
 // }

/*************************************************************** /
                   Getting data from POST Array                 */
  if(isset($_POST['RollNo'])&&
     isset($_POST['FullName'])&&
     isset($_POST['RoomNo'])&&
     isset($_POST['HostelNo'])&&
     isset($_POST['Gender'])&&
     isset($_POST['DOB'])&&
     isset($_POST['StudentContact'])&&
     isset($_POST['Line1'])&&
     isset($_POST['Line2'])&&
     isset($_POST['State'])&&
     isset($_POST['PIN'])&&
     isset($_POST['ParentContact'])&&
     isset($_POST['ParentName'])&&
     isset($_POST['ParentEmail']))
  {
      
      $Name=sanitizeMySQL($db_server,$_POST['FullName']);
      $RollNo=sanitizeMySQL($db_server,$_POST['RollNo']);
      $HostelNo=sanitizeMySQL($db_server,$_POST['HostelNo']);
      $RoomNo=sanitizeMySQL($db_server,$_POST['RoomNo']);
      //$Floor = sanitizeMySQL($db_server,$_POST['Floor']);
      //$RoomNo=RoomNo($HostelNo,$RoomNo,$Floor);
      //$HostelNo=HostelName($HostelNo);
      $Gender = sanitizeMySQL($db_server,$_POST['Gender']);
      $DOB =$_POST['DOB'];
      $StudentContact = sanitizeMySQL($db_server,$_POST['StudentContact']);
      $ParentContact = sanitizeMySQL($db_server,$_POST['ParentContact']);
      $Line1 = sanitizeMySQL($db_server,$_POST['Line1']);
      $Line2 = sanitizeMySQL($db_server,$_POST['Line2']);
      $State = sanitizeMySQL($db_server,$_POST['State']);
      $PIN = sanitizeMySQL($db_server,$_POST['PIN']);
      $ParentName=sanitizeMySQL($db_server,$_POST['ParentName']);
      $ParentEmail = sanitizeMySQL($db_server,$_POST['ParentEmail']);

      
      if($flag==0)  //if sql connection is established and database found
      {
         $ID = $_SESSION['ID'];  
         //$Name = $_SESSION['Name']; 
         $Email = $_SESSION['Email'];
        $query_new_user="INSERT INTO student VALUES('$ID','$RollNo','$Name','$Gender','$DOB','$HostelNo','$RoomNo','$Email','$StudentContact','$ParentName','$ParentContact','$ParentEmail','$Line1','$Line1','$State','$PIN')";
        if(!mysqli_query($db_server,$query_new_user))
        {
            $output['Status'] = 3; 
            $output['errorCode']=mysqli_errno($db_server);   //Error Code 1062 ==> Duplicate entry
            $output['errorMsg'] = mysqli_error($db_server);
        }
        else   //sucessful entry
        {
          $output['Status'] = 4; 
          //send data to front-end 
          $output['Name'] = $Name;
          $output['RollNo'] = $RollNo;
          $output['HostelNo'] = $HostelNo;
          $output['HostelName'] = HostelName($HostelNo);
          $output['RoomNo'] = $RoomNo;
          $output['Email'] = $Email;
          $output['ID'] = $ID;
          $output['Gender'] = $Gender;
          $output['DOB'] = $DOB;
          $output['StudentContact'] = $StudentContact;
          $output['Address'] = $Line1.', City - '.$Line2.', State - '.$State.', PIN : '.$PIN ;
          $output['ParentEmail'] = $ParentEmail;
          $output['ParentName'] = $ParentName;
          $output['ParentContact'] = $ParentContact;
          //start login session too
          $_SESSION['RollNo'] = $RollNo;
          $_SESSION['Name'] = $Name;
          $_SESSION['HostelNo'] = $HostelNo;
          $_SESSION['HostelName'] = HostelName($HostelNo);
          $_SESSION['RoomNo'] = $RoomNo;
          $_SESSION['Gender'] = $Gender;
          $_SESSION['DOB'] = $DOB;
          $_SESSION['StudentContact'] = $StudentContact;
          $_SESSION['Address'] = $Line1.', City - '.$Line2.', State - '.$State.', PIN : '.$PIN ;
          $_SESSION['ParentName'] = $ParentContact;
          $_SESSION['ParentContact'] = $ParentContact;
          $_SESSION['ParentEmail'] = $ParentEmail;
        }
      }
  }
  else
  { 
    $output['Status'] = 2;
    // Data not recieved;
  }
 /*************Finaly send data to javaScript***************************/   
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
