<?php
 session_start();
 require_once("sendmail.php");
 require_once("EmailIDs.php");
/****************************************************
   Data Recieved from $_POST
   cmpSug,subject,content
 ****************************************************/
   require_once("login.php");
   $output=array();
   $flag = 0;

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


 function StoreData($table,$ID,$type,$subject,$statement,$image,$location="",$availability="",$flag,$server)
 {
   $MyOutput;
   if($flag==0)
   {
     $query="";
     if($location!="")
     {
       $query = "INSERT INTO ".$table." (ID,CSDate,Type,Subject,Location,Availability,Statement,Image) values('$ID',CURDATE(),'$type','$subject','$location','$availability','$statement','$image')";
     }
     else
     {
       $query = "INSERT INTO ".$table." (ID,CSDate,Type,Subject,Statement,Image) values('$ID',CURDATE(),'$type','$subject','$statement','$image')";
     }
     if(!mysqli_query($server,$query))
      {
          //$MyOutput = 3;
          $MyOutput['Status'] = 3; 
          $MyOutput['errorCode']=mysqli_errno($server);   //Error Code 1062 ==> Duplicate entry
          $MyOutput['errorMsg'] = mysqli_error($server).$query;
      }
      else   //sucessful entry
      {
        $MyOutput['Status'] = 4;
        //$MyOutput = 4;
        $getCSID = "SELECT CSID FROM ".$table." where ID='$ID' AND CSDate = CURDATE() AND Subject = '$subject' AND Statement = '$statement'";
        $querytoget=mysqli_query($server,$getCSID);
        $result1=mysqli_fetch_assoc($querytoget);
        $CSID = $result1['CSID']; //mysqli_query($db_server,"SELECT LAST_INSERT_ID()");
        $CSID = str_pad($CSID, 4, "0", STR_PAD_LEFT);
        $MyOutput['CSID'] = $CSID;
      }
    }
    else
    {
      $MyOutput['Status'] = 2;
      //$MyOutput = 2;
    }
    return $MyOutput;
 }  
 
 /***********************************Mess**************************************************/
   if(isset($_POST['messCmpSug'])&&
      isset($_POST['messSubject'])&&
      isset($_POST['messContent']))
   {
      $filename="";   //to store location and name of file uploaded
      $imageName="";

      $imageFile=0;   //flag for file upload status
      if($_FILES['messFile']['size']>0)
      { 
         //$s=$_FILES['messFile']['size'];
         $imageName=basename($_FILES['messFile']['name']);
         $filename =$PathToProject.basename($_FILES['messFile']['name']);
         if(move_uploaded_file($_FILES['messFile']['tmp_name'], $filename))
         {
          //$imageFile=1;   //file uploaded successfuly 
          $output['imageFile'] = 1;
         } 
         else
         {
           //$imageFile=2;   //error in uploading file
           $output['imageFile'] = 2;
           //$output['imageFile'] = $_FILES['messFile']['error'];
         }
      }
      else
      {
          //$imageFile=3;  //file was not uploaded by user
          $output['imageFile'] = 3;
      }
      //$n=0;
      $subject=$_POST['messCmpSug'].' from '.$_SESSION['Name'].' '.sanitizeMySQL($db_server,$_POST['messSubject']);

      $statement = sanitizeMySQL($db_server,$_POST['messContent']);
      
      $ID =$_SESSION['ID'];
      $result=StoreData('csmsmess',$ID,$_POST['messCmpSug'],$subject,$statement,$imageName,"","",$flag,$db_server);
      $output['Status'] = $result['Status'];
      if($output['Status']==3)
      {
         $output['errorMsg'] = $result['errorMsg'];
      }
      else 
      {
          $to=$MessSecy;
          $to2 = "";
          $ccStudent=$_SESSION['Email'];
          $ccHostelGS=$HostelGS;
          $from=$CSMSID;
          $from_name="CSMS IIT Goa Hostel";
         
          $body = '
            <html>
            <head>
              <title>CSMS</title>
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
               <h3 style="text-align:center;text-color:black">Complaint and Suggestion Management System<h3>
               <h4 style = "text-align:center;text-color:black">IIT Goa Hostel Council</h4>
               <hr style="color:#008080">
               <h4 style="text-color:black">Received a '.$_POST['messCmpSug'].' regarding Dining facility</h4>

          <table>
            <tr>
              <th>CSMSID</th>
              <td>MES'.$result['CSID'].'</td>
            </tr>
            <tr>
              <th>Name</th>
              <td>'.$_SESSION['Name'].'</td>
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
              <th>Contact</th>
              <td>'.$_SESSION['StudentContact'].'</td>
            </tr>
            <tr>
              <th>Filing Date</th>
              <td>'.date("l, d-m-Y").'</td>
            </tr>
            <tr>
              <th>Statement</th>
              <td>'.$_POST['messContent'].'</td>
            </tr>
          </table>
                <br>
          <p>Our team will look into your '.$_POST['messCmpSug'].' and take appropriate action</p>...
          <h4 style="text-color:black">Thank You</h4>
          <h5 style="text-color:black">Team CSMS<h5>
          <h5 style="text-color:black">IIT Goa Hostel Council<h5>
          </body>
        </html>';

          $attachment=$filename;
          $Mailing=smtpmailer($to,$to2,$ccStudent,$ccHostelGS,"",$from, $from_name, $subject, $body,$attachment);
          if($Mailing==true)
          {
            //$n=1;   //mail sent successfully
            $output['Mail'] = 1;
          }
          else
          {
            $output['Mail'] = 3;   //mail could not be sent
          }
      }
      
      //echo $n;
    }


 /********************************Hospital************************************************/
    else if(isset($_POST['hospCmpSug'])&&
            isset($_POST['hospSubject'])&&
            isset($_POST['hospContent']))
   {
     
      $filename="";   //to store location and name of file uploaded
      $imageName="";
      $imageFile=0;   //flag for file upload status
      if($_FILES['hospFile']['size']>0)
      { 
         //$s=$_FILES['messFile']['size'];
         $imageName = basename($_FILES['hospFile']['name']);
         $filename =$PathToProject.basename($_FILES['hospFile']['name']);
         if(move_uploaded_file($_FILES['hospFile']['tmp_name'], $filename))
         {
          //$imageFile=1;   //file uploaded successfuly 
          $output['imageFile'] = 1;
         } 
         else
         {
           //$imageFile=2;   //error in uploading file
           $output['imageFile'] = 2;
         }
      }
      else
      {
          //$imageFile=3;  //file was not uploaded by user
          $output['imageFile'] = 3;
      }
      //$n=0;
       $subject=$_POST['hospCmpSug'].' from '.$_SESSION['Name'].' '.sanitizeMySQL($db_server,$_POST['hospSubject']);
      $statement=sanitizeMySQL($db_server,$_POST['hospContent']);

      $to=$HospitalSecy;
      $to2="";
      $ccStudent=$_SESSION['Email'];
      $ccHostelGS=$HostelGS;
      $from=$CSMSID;
      $from_name="CSMS IIT Goa Hostel";
      
      $ID = $_SESSION['ID'];
      $result=StoreData('csmsmedical',$ID,$_POST['hospCmpSug'],$subject,$statement,$imageName,"","",$flag,$db_server);
      //echo $n;
      $output['Status'] = $result['Status'];
      if($output['Status']==3)
      {
         $output['errorMsg'] = $result['errorMsg'];
      }
      else 
      {

          $body = '
            <html>
            <head>
              <title>CSMS</title>
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
               <h3 style="text-align:center;text-color:black">Complaint and Suggestion Management System<h3>
               <h4 style = "text-align:center;text-color:black">IIT Goa Hostel Council</h4>
               <hr style="color:#008080">
               <h4 style="text-color:black">Received a '.$_POST['hospCmpSug'].' regarding Medical facility</h4>

          <table>
            <tr>
              <th>CSMSID</th>
              <td>MED'.$result['CSID'].'</td>
            </tr>
            <tr>
              <th>Name</th>
              <td>'.$_SESSION['Name'].'</td>
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
              <th>Contact</th>
              <td>'.$_SESSION['StudentContact'].'</td>
            </tr>
            <tr>
              <th>Filing Date</th>
              <td>'.date("l, d-m-Y").'</td>
            </tr>
            <tr>
              <th>Statement</th>
              <td>'.$_POST['hospContent'].'</td>
            </tr>
          </table>
                <br>
          <p>Our team will look into your '.$_POST['hospCmpSug'].' and take appropriate action</p>...
          <h4 style="text-color:black">Thank You</h4>
          <h5 style="text-color:black">Team CSMS<h5>
          <h5 style="text-color:black">IIT Goa Hostel Council<h5>
          </body>
        </html>';

          $attachment=$filename;
          $Mailing=smtpmailer($to,$to2,$ccStudent,$ccHostelGS,"",$from, $from_name, $subject, $body,$attachment);
          if($Mailing==true)
          {
            //$n=1;   //mail sent successfully
            $output['Mail'] = 1;

          }
          else
          {
            //$n=3;   //mail could not be sent
            $output['Mail'] = 2;
          }    

      } 
    

   }

 /**************************************Maintenence********************************/

  else if(isset($_POST['maintCmpSug'])&&
          isset($_POST['maintSubject'])&&
          isset($_POST['maintContent'])&&
          isset($_POST['maintLocation'])&&
          isset($_POST['maintAvailability']))
   {
     
      $filename="";   //to store location and name of file uploaded
      $imageFile=0;   //flag for file upload status
      $imageName="";
      if($_FILES['maintFile']['size']>0)
      { 
         //$s=$_FILES['messFile']['size'];
         $imageName =basename($_FILES['maintFile']['name']); 
         $filename =$PathToProject.basename($_FILES['maintFile']['name']);
         if(move_uploaded_file($_FILES['maintFile']['tmp_name'], $filename))
         {
          $imageFile=1;   //file uploaded successfuly 
          $output['imageFile'] = 1;
         } 
         else
         {
           $imageFile=2;   //error in uploading file
           $output['imageFile'] = 2;
         }
      }
      else
      {
          $imageFile=3;  //file was not uploaded by user
          $output['imageFile'] = 3;
      }
      //$n=0;
      $subject=$_POST['maintCmpSug'].' from '.$_SESSION['Name'].' '.sanitizeMySQL($db_server,$_POST['maintSubject']);
      $statement =sanitizeMySQL($db_server,$_POST['maintContent']);
      $location = sanitizeMySQL($db_server,$_POST['maintLocation']);
      $availability = sanitizeMySQL($db_server,$_POST['maintAvailability']);

      $to=$MaintenanceSecy;
      $to2=$MaintenanceSecy2;
      $ccStudent=$_SESSION['Email'];
      $ccHostelGS=$HostelGS;
      $from=$CSMSID;
      $from_name="CSMS IIT Goa Hostel";

      $ID = $_SESSION['ID'];
      $result=StoreData('csmsmaintenance',$ID,$_POST['maintCmpSug'],$subject,$statement,$imageName,$location,$availability,$flag,$db_server);
      $output['Status'] = $result['Status'];
      if($output['Status']==3)
      {
         $output['errorMsg'] = $result['errorMsg'];
      }
      
      else
      {
            $body = '
              <html>
              <head>
                <title>CSMS</title>
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
                 <h3 style="text-align:center;text-color:black">Complaint and Suggestion Management System<h3>
                 <h4 style = "text-align:center;text-color:black">IIT Goa Hostel Council</h4>
                 <hr style="color:#008080">
                 <h4 style="text-color:black">Received a '.$_POST['maintCmpSug'].' regarding Maintenance</h4>

            <table>
              <tr>
                <th>CSMSID</th>
                <td>MNT'.$result['CSID'].'</td>
              </tr>
              <tr>
                <th>Name</th>
                <td>'.$_SESSION['Name'].'</td>
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
                <th>Contact</th>
                <td>'.$_SESSION['StudentContact'].'</td>
              </tr>
              <tr>
                <th>Filing Date</th>
                <td>'.date("l, d-m-Y").'</td>
              </tr>
              <tr>
                <th>Problem Location </th>
                <td>'.$_POST['maintLocation'].'</td>
              </tr>
              <tr>
                <th>Student Availability </th>
                <td>'.$_POST['maintAvailability'].'</td>
              </tr>
              <tr>
                <th>Statement</th>
                <td>'.$_POST['maintContent'].'</td>
              </tr>
            </table>
                  <br>
            <p>Our team will look into your '.$_POST['maintCmpSug'].' and take appropriate action</p>...
            <h4 style="text-color:black">Thank You</h4>
            <h5 style="text-color:black">Team CSMS<h5>
            <h5 style="text-color:black">IIT Goa Hostel Council<h5>
            </body>
          </html>';

            $attachment=$filename;
            $Mailing=smtpmailer($to,$to2,$ccStudent,$ccHostelGS,"",$from, $from_name, $subject, $body,$attachment);
            if($Mailing==true)
            {
              //$n=1;   //mail sent successfully
              $output['Mail'] = 1;

            }
            else
            {
               //$n=3;   //mail could not be sent
              $output['Mail'] = 2;
            }

        }
      //echo $n;
  
   } 

 /**************************************************************************/
   else
   {
    $x=5;    //data not received
    //echo $x;
    $output['Status'] = 5;
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