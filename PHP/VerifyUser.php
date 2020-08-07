<?php
/**************************************************************
    For Sign In form data recieved as json object of ID_Token from google api 
        
  **************************************************************


  /*
  Status = 0 =>failed to connect to mysql server
  Status = 1 =>failed to get required database on server
  Status = 2 => data not recived from front-end
  Status = 3 => error in querying sql table
  Status = 4 => record found succesfully in table
  Status = 5 => record does not found ; invalid credentials
  
/**************************************************************/
   $output=array();  //array that will be retured to javaScript
   $flag=0;  //used to check sql conncetions  
/***************************************************************

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
/*************************************************************** /
                   Getting data from POST Array                 */

 if(isset($_POST['data']))
 { 
    $obj= json_decode($_POST['data'], false);
    if($flag==0)
    {

    	  $query_student="SELECT * FROM ".$db_table_Student." where ID='$obj->sub'";
        $queryUser=mysqli_query($db_server,$query_student);
        if(!$queryUser)
        {
            $output['Status']=3; 
            $output['errorCode'] = mysqli_errno($db_server);
            $output['errorMsg'] = mysqli_error($db_server);
        }
        else if(mysqli_num_rows($queryUser)==1)  //if there is exaclty one row in output
        {
           $result=mysqli_fetch_assoc($queryUser);
           $output['Status']=4;                 //student found in database
           $output['Name']=$result['Name'];
           $output['RollNo']=$result['RollNo'];
           $output['HostelNo']=$result["HostelNo"];
           $output['HostelName']=HostelName($result["HostelNo"]);
           $output['RoomNo']=$result['RoomNo'];
           $output['Email']=$result['Email'];
           $output['ID']=$result['ID'];
           $output['Gender']=$result['Gender'];
           $output['DOB'] = $result['DOB'];
           $output['StudentContact']=$result['StudentContact'];
           $output['ParentContact']=$result['ParentContact'];
           $output['ParentName']=$result['ParentName'];
           $output['ParentEmail']=$result['ParentEmail'];
           $output['Address']=$result['AddressLine1'].', City - '.$result['AddressLine2'].', State - '.$result['State'].', PIN : '.$result['PIN'] ;
           session_start();           //statrt login session of user if he successfully found
           $_SESSION['ID'] = $output['ID'];
           $_SESSION['Name'] = $output['Name'];
           $_SESSION['RollNo'] = $output["RollNo"];
           $_SESSION['HostelNo'] = $output["HostelNo"];
           $_SESSION['HostelName'] = $output['HostelName'];
           $_SESSION['RoomNo'] = $output["RoomNo"];
           $_SESSION['Email']  = $output["Email"];
           $_SESSION['Gender']  = $output["Gender"];
           $_SESSION['DOB'] = $output['DOB'];
           $_SESSION['StudentContact']  = $output["StudentContact"];
           $_SESSION['ParentContact']  = $output["ParentContact"];
           $_SESSION['ParentEmail']  = $output["ParentEmail"];  
           $_SESSION['ParentName']  = $output["ParentName"];  

        }
        else if($obj->searchIn=="All")
        {
              $query_staff="SELECT * FROM ".$db_table_Staff." where ID='$obj->sub'";
              $queryUser=mysqli_query($db_server,$query_staff);
              if(!$queryUser)
              {
                  $output['Status']=3; 
                  $output['errorCode'] = mysqli_errno($db_server);
                  $output['errorMsg'] = mysqli_error($db_server);
              }
              else if(mysqli_num_rows($queryUser)==1)  //if there is exaclty one row in output
              {
                 $result=mysqli_fetch_assoc($queryUser);
                 $output['Status']=5;                 //staff member found in database
                 $output['Name']=$result['Name'];
                 $output['Email']=$result['Email'];
                 $output['ID']=$result['ID'];
                 session_start();           //statrt login session of user if he successfully found
                 $_SESSION['ID'] = $output['ID'];
                 $_SESSION['Name'] = $output['Name'];
                 $_SESSION['Email']  = $output["Email"];  
              }
              else     //user does not exist in database
              {
                $output['Status'] = 6;
                session_start();
                $_SESSION['Name'] = $obj->name;
                $_SESSION['Email']  = $obj->email;
                $_SESSION['ID'] = $obj->sub;
              }        
        }
        else     //user does not exist in database
        {
          $output['Status'] = 6;
          session_start();
          //$_SESSION['Name'] = $obj->name;
          $_SESSION['Email']  = $obj->email;
          $_SESSION['ID'] = $obj->sub;
        }        
    }
  }   
 else   //data not recieved from front-end
 {
      $output['Status'] = 2;
 }
  echo json_encode($output);
?>