<?php
session_start();
require_once("SendMailOutStation.php");
require_once("EmailIDs.php");
 /**************************************************************
   data recieved from front-end 
  **************************************************************
  /*
  Status = 0 =>failed to connect to mysql server
  Status = 1 =>failed to get required database on server
  Status = 2 => data not recived from form
  Status = 3 => error in querying sql table
  Status = 4 => succesful entry and mail sent
  Status = 5 =>succesful entry but mail could not be sent
  Status = 6 => Entry record found in database
  Status = 7 => Entry record does not found in database bbfgb
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
 function Age($DOB)
 {
  $date2=date_create(date("Y-m-d"));
  $date1=date_create($DOB);
  $age = date_diff($date1,$date2);
  return ($age->format("%R%a"))/365;
 }
 function Declaration($ResponsibleOn)
 {
  $dec="";
  if($ResponsibleOn=="MyParents")
    $dec = "My Parents will be responsible for my journey and stay. The
institute will not be responsible for my stay outside the campus.";
  else if($ResponsibleOn=="MySelf")
    $dec = "I will be responsible for my journey and stay. The institute will not be responsible for my stay outside the campus.";
  return $dec;
 }

 /**************************************************************************/
if($flag==0)
{
  $ID = $_SESSION['ID']; 
  $Name = $_SESSION['Name'];

 if(isset($_POST['Destination'])&&
    isset($_POST['Reason'])&&
    isset($_POST['DepartureDate'])&&
    isset($_POST['ArrivalDate'])&&
    isset($_POST['ResponsibleOn'])&&
    isset($_POST['noOfDays'])&&
    isset($_POST['Header'])&&
    ($_POST['Header']==1)) {
      $Destination=sanitizeMySQL($db_server,$_POST['Destination']);
      $Reason=sanitizeMySQL($db_server,$_POST['Reason']);
      $DepartureDate=sanitizeMySQL($db_server,$_POST['DepartureDate']);
      $ArrivalDate=sanitizeMySQL($db_server,$_POST['ArrivalDate']);
      $ResponsibleOn=sanitizeMySQL($db_server,$_POST['ResponsibleOn']);
      $NumOfDays=sanitizeMySQL($db_server,$_POST['noOfDays']);
      $query="INSERT INTO outstation(ID,Destination,Departure,Arrival,Reason,ResponsibleOn) VALUES('$ID','$Destination','$DepartureDate','$ArrivalDate','$Reason','$ResponsibleOn')";
      if(!mysqli_query($db_server,$query))
      {
            $output['Status'] = 3; 
            $output['errorCode']=mysqli_errno($db_server);   //Error Code 1062 ==> Duplicate entry
            $output['errorMsg'] = mysqli_error($db_server);
             //$Status=3;
      }
      else
      {
        $query="SELECT EntryID FROM outstation where ID='$ID'";   
        $querytoget=mysqli_query($db_server,$query);
        $result1=mysqli_fetch_assoc($querytoget);
        $EntryNumber = $result1['EntryID']; //mysqli_query($db_server,"SELECT LAST_INSERT_ID()");
        $age = round(Age($_SESSION['DOB']));
        
        $toWarden = $Wardens[$_SESSION['HostelNo']];
        if(($age<18)||($ResponsibleOn=="MyParents"))
          $ccParent= $_SESSION['ParentEmail'];
        else 
          $ccParent="";

        $ccHallOffice = $HallOffice;
        $ccAcademic = $AcademicOffice;
        $ccStudent=$_SESSION['Email'];
        $ccHostelGS=$HostelGS;
        $ccWardenGirls ="";
        $ccGirlsNominee="";
        if($_SESSION['Gender']=="Female")
        {
          $toWarden = $Wardens[3];
          $ccGirlsNominee=$GirlsNominee;
          $ccWardenGirls=$Wardens[4];
        }

        $rep="";
        if($ResponsibleOn=="MyParents")
          $rep = "My Parents will be responsible for my journey and stay. The institute will not be responsible for my stay outside the campus.";
        else if($ResponsibleOn=="MySelf")
          $rep = "I will be responsible for my journey and stay. The institute will not be responsible for my stay outside the campus.";
        
        $from=$CSMSID;
        $from_name="IOMS IIT Goa Hostel";
        // $body='Following Student is going Out of Station'."\r\n".'Name : '.$_SESSION['Name']."\r\n".'Roll Number : '.$_SESSION['RollNo']."\r\n".'Hostel : '.$_SESSION['HostelName']."\r\n".'Room Number  :  '.$_SESSION['RoomNo']."\r\n".'Destination  :  '.$Destination."\r\n".'Departure Date  :  '.$DepartureDate."\r\n".'Arrival Date (Expected)  :  '.$ArrivalDate."\r\n".'Reason of Going  :  '.$Reason."\r\n".'Student Contact  :  '.$_SESSION['StudentContact']."\r\n".'Parent Contact  :  '.$_SESSION['ParentContact']."\r\n".$rep;
        $body = '
        <html>
        <head>
          <title>IOMS</title>
          <style>
      table {
        border-collapse: collapse;
        width: 100%;
      }
      td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
      }
      tr:nth-child(even) {
        background-color: #dddddd;
      }
          </style>
        </head>
        <body>
           <hr style="color:#008080">
           <h2 style="text-align:center;text-color:black">In Out Management System<h2>
           <h4 style = "text-align:center;text-color:black">IIT Goa Hostel Council</h4>
           <hr style="color:#008080">
           <h4 style="text-color:black">Received an entry </h4>
      <table>
        <tr>
          <th>Application Number</th>
          <td>'.$EntryNumber.'</td>
        </tr>
        <tr>
          <th>Application Date</th>
          <td>'.date("l, d-m-Y").'</td>
        </tr>
        <tr>
          <th>Name</th>
          <td>'.$_SESSION['Name'].'</td>
        </tr>
        <tr>
          <th>Age</th>
          <td>'.$age.' years</td>
        </tr>
        <tr>
          <th>Roll Number</th>
          <td>'.$_SESSION['RollNo'].'</td>
        </tr>
        <tr>
          <th>Hostel</th>
          <td>'.$_SESSION['HostelName'].'</td>
        </tr>
        <tr>
          <th>Room Number</th>
          <td>'.$_SESSION['RoomNo'].'</td>
        </tr>
        <tr>
          <th>Destination</th>
          <td>'.$Destination.'</td>
        </tr>
        <tr>
          <th>Departure Date</th>
          <td>'.$DepartureDate.'</td>
        </tr>
        <tr>
          <th>Expected Arrival Date</th>
          <td>'.$ArrivalDate.'</td>
        </tr>
        <tr>
          <th>Classes to be missed</th>
          <td>'.$NumOfDays.'</td>
        </tr>
        <tr>
          <th>Reason</th>
          <td>'.$Reason.'</td>
        </tr>
        <tr>
          <th>Student Contact</th>
          <td>'.$_SESSION['StudentContact'].'</td>
        </tr>
        <tr>
          <th>Parent Name</th>
          <td>'.$_SESSION['ParentName'].'</td>
        </tr>
        <tr>
          <th>Parent Contact</th>
          <td>'.$_SESSION['ParentContact'].'</td>
        </tr>
        <tr>
          <th>Declaration</th>
          <td>'.$rep.'</td>
        </tr>
      </table>
      <br>
      <p>Thanks for the intimation, we have received your application.</p>...
      <h4 style="text-color:black">Thank You</h4>
      <h5 style="text-color:black">Team IOMS<h5>
       <h5 style="text-color:black">IIT Goa Hostel Council<h5>
      </body>
    </html>';
          $subject="Leave Application ".$EntryNumber." by ".$_SESSION['Name'];
          $Mailing=smtpmailer($toWarden,$ccHallOffice,$ccAcademic,$ccStudent,$ccWardenGirls,$ccHostelGS,$ccGirlsNominee,$ccParent,$from, $from_name, $subject, $body);
          if($Mailing==true)
          {
            $output['Status'] =4;   //mail sent successfully
            //$Status=4;
          }
          else
          {
            $output['Status'] = 5;   //mail could not be sent
            //$Status=5;
          }
        
       }
    }
    else if(isset($_POST['Header'])&&(($_POST['Header']==2)||($_POST['Header']==3)))  
    { 
        //for checking entry of student in database
        $query_OutStation="SELECT * FROM outstation where ID='$ID'";
        $queryOutStation=mysqli_query($db_server,$query_OutStation);
        if(!$queryOutStation)
        {
            $output['Status']=3; 
            $output['errorCode'] = mysqli_errno($db_server);
            $output['errorMsg'] = mysqli_error($db_server);
        }
        else if(mysqli_num_rows($queryOutStation)==1)  //if there is exaclty one row in output
        {
           $result=mysqli_fetch_assoc($queryOutStation);
           if(($_POST['Header']==2))
           {
             $output['Status']=6;                 //entry found in OutStation table
             $output['Destination']=$result['Destination'];
             $output['Reason']=$result['Reason'];
             $output['DepartureDate']=$result['Departure'];
             $output['ArrivalDate']=$result['Arrival'];
             $output['Declaration'] = Declaration($result['ResponsibleOn']);
             $output['ParentContact']=$_SESSION['ParentContact'];//$result['ParentContact'];
             $output['ParentEmail']=$_SESSION['ParentEmail'];//$result['ParentEmail']; 
           }
           else if($_POST['Header']==3)
           {
              $ReturnDate=sanitizeMySQL($db_server,$_POST['ReturnDate']);
              $Destination=$result['Destination'];
              $Reason=$result['Reason'];
              $DepartureDate=$result['Departure'];
              $ArrivalDate=$result['Arrival'];
              $ResponsibleOn=$result['ResponsibleOn'];
              $EntryId = $result['EntryID'];
              //$ParentContact=$result['ParentContact'];
              //$ParentEmail=$result['ParentEmail'];
             
             $query2="INSERT INTO allentries VALUES('$ID','$EntryId','$Destination','$DepartureDate','$ArrivalDate','$Reason','$ResponsibleOn','$ReturnDate')";
            /***********************Send Return Email*******************/
                      //$EntryNumber = $db_server->insert_id; //mysqli_query($db_server,"SELECT LAST_INSERT_ID()");
                      $subject="Leave Application ".$EntryId." by ".$_SESSION['Name'];
                      $age = Age($_SESSION['DOB']);
                      
                      $toWarden = $Wardens[$_SESSION['HostelNo']];
                      if(($age<18)||($ResponsibleOn=="MyParents"))
                        $ccParent= $_SESSION['ParentEmail'];
                      else 
                      $ccParent="";
                      $ccHallOffice = $HallOffice;
                      $ccAcademic = $AcademicOffice;
                      $ccStudent=$_SESSION['Email'];
                      $ccHostelGS=$HostelGS;
                      $ccWardenGirls ="";
                      $ccGirlsNominee="";
                      if($_SESSION['Gender']=="Female")
                      {
                        $toWarden = $Wardens[3];
                        $ccGirlsNominee=$GirlsNominee;
                        $ccWardenGirls=$Wardens[4];
                      }

                      $rep="";
                      $body = '
        <html>
        <head>
          <title>IOMS</title>
          <style>
      table {
        border-collapse: collapse;
        width: 100%;
      }
      td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
      }
      tr:nth-child(even) {
        background-color: #dddddd;
      }
          </style>
        </head>
        <body>
           <hr style="color:#008080">
           <h2 style="text-align:center;text-color:black">In Out Management System<h2>
           <h4 style = "text-align:center;text-color:black">IIT Goa Hostel Council</h4>
           <hr style="color:#008080">
           <h4 style="text-color:black">Received return entry  </h4>
        <table>
        <tr>
          <th>Application Number</th>
          <td>'.$EntryId.'</td>
        </tr>
        <tr>
          <th>Name</th>
          <td>'.$_SESSION['Name'].'</td>
        </tr>
         <tr>
          <th>Return Date</th>
          <td>'.$ReturnDate.'</td>
        </tr>
      </table> 
       
      <br>
      <p>Student has retuned to hostel. Application closed!</p>...
      <h4 style="text-color:black">Thank You</h4>
      <h5 style="text-color:black">Team IOMS<h5>
      <h5 style="text-color:black">IIT Goa Hostel Council<h5>
      </body>
    </html>';
                       $from=$CSMSID;
                       $from_name="IOMS IIT Goa Hostel";
                       $Mailing=smtpmailer($toWarden,$ccHallOffice,$ccAcademic,$ccStudent,$ccWardenGirls,$ccHostelGS,$ccGirlsNominee,$ccParent,$from, $from_name, $subject, $body);
                        if($Mailing==true)
                        {
                          $output['Status'] =4;   //mail sent successfully
                          //$Status=4;
                        }
                        else
                        {
                          $output['Status'] = 5;   //mail could not be sent
                          //$Status=5;
                        }
            /***********************************************************/
              if(!mysqli_query($db_server,$query2))
              {
                    $output['Status'] = 3; 
                    $output['errorCode']=mysqli_errno($db_server);   //Error Code 1062 ==> Duplicate entry
                    $output['errorMsg'] = mysqli_error($db_server);
                     //$Status=3;
              }
              else
              {

                $query3 = "DELETE FROM outstation where ID = '$ID'";
                if(!mysqli_query($db_server,$query3))
                {
                    $output['Status'] = 3; 
                    $output['errorCode']=mysqli_errno($db_server);   //Error Code 1062 ==> Duplicate entry
                    $output['errorMsg'] = mysqli_error($db_server);
                     //$Status=3;463
                }
                else
                {
                   $output['Status']=8;
                }
              }
           }
        }
        else
        {
          $output['Status']=7;  //record does not found in databse
        }
    }
   else
   {
     $output['Status'] =2;
    //$Status=2;
   }
}

echo json_encode($output);
//echo $Status;
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
  return $