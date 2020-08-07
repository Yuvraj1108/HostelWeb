<?php
session_start();
  /**************************************************************
   data recieved from front-end 
   RollNo,HostelNo,RoomNo
  **************************************************************

  /*
  Status = 0 =>failed to connect to mysql server
  Status = 1 =>failed to get required database on server
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

/*************************************************************** /
                                   */

      if($flag==0)  //if sql connection is established and database found
      {
         $ID = $_SESSION['ID'];  
         $Name = $_SESSION['Name']; 
         $Email = $_SESSION['Email'];
         $query_new_user="INSERT INTO staff VALUES('$ID','$Name','$Email')";
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
          $output['Email'] = $Email;
          $output['ID'] = $ID;
          
        }
      }
 /*************Finaly send data to javaScript***************************/   
    echo json_encode($output); 
?>
