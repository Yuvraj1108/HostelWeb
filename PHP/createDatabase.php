<?php

 $flag=0;
 require_once 'login.php';
 $db_server = mysqli_connect($db_hostname, $db_username, $db_password);
 if (!$db_server) 
 { 
   echo "Failed to connect to server. ".mysqli_connect_error();
   $flag=1;
 } 

 $createDatabase = "CREATE DATABASE IF NOT EXISTS ".$db_database;
 //$createTable = "CREATE TABLE ".$db_table."(RollNo varchar(10) NOT NULL PRIMARY KEY,Name varchar(35) NOT NULL,HostelNo varchar(2) NOT NULL,RoomNo varchar(5) NOT NULL,Email varchar(45) NOT NULL,Password varchar(33) NOT NULL)";
 $createTable = "CREATE TABLE  IF NOT EXISTS Student(ID varchar(30) NOT NULL PRIMARY KEY,RollNo varchar(10) NOT NULL,Name varchar(35) NOT NULL,Gender varchar(8) NOT NULL,DOB DATE NOT NULL, HostelNo varchar(15) NOT NULL,RoomNo varchar(5) NOT NULL,Email varchar(45) NOT NULL,StudentContact varchar(10) NOT NULL,ParentName varchar(35) NOT NULL,ParentContact varchar(10) NOT NULL,ParentEmail varchar(30) NOT NULL,AddressLine1 varchar(35) NOT NULL,AddressLine2 varchar(35) NOT NULL,State varchar(35) NOT NULL,PIN varchar(6) NOT NULL);";

$createTable.= "CREATE TABLE IF NOT EXISTS HostelNames(HostelNo varchar(15) NOT NULL,HostelName varchar(30) NOT NULL);";

 $createTable.= "CREATE TABLE IF NOT EXISTS Staff(ID varchar(30) NOT NULL PRIMARY KEY,Name varchar(35) NOT NULL,Email varchar(45) NOT NULL);";


 $createTable.= "CREATE TABLE IF NOT EXISTS OutStation(ID varchar(30) NOT NULL,EntryID int NOT NULL AUTO_INCREMENT PRIMARY KEY,Destination varchar(60) NOT NULL,Departure DATE NOT NULL,Arrival DATE NOT NULL,Reason varchar(60) NOT NULL,ResponsibleOn varchar(500) NOT NULL);";


$createTable.= "CREATE TABLE IF NOT EXISTS AllEntries(ID varchar(30) NOT NULL,EntryID int NOT NULL,Destination varchar(60) NOT NULL,Departure DATE NOT NULL,Arrival DATE NOT NULL,Reason varchar(60) NOT NULL,ResponsibleOn varchar(500) NOT NULL,ReturnDate DATE NOT NULL);";


$createTable.= "CREATE TABLE IF NOT EXISTS Housekeeping(ID varchar(30) NOT NULL,FeedbackDate DATE NOT NULL,FeedbackID int NOT NULL AUTO_INCREMENT PRIMARY KEY, Corridors varchar(10) default 'NA',CommonRoom varchar(10) default 'NA',Rooms varchar(10) default 'NA',Accessories varchar(10) default 'NA',Bathrooms varchar(10) default 'NA',Toilets varchar(10) default 'NA',Timing varchar(10) default 'NA',Overall varchar(10) default 'NA',Comments varchar(200) default 'NA');";

$createTable.= "CREATE TABLE IF NOT EXISTS Security(ID varchar(30) NOT NULL,FeedbackDate DATE NOT NULL,FeedbackID int NOT NULL AUTO_INCREMENT PRIMARY KEY, Q1 varchar(10) default 'NA',Q2 varchar(10) default 'NA',Q3 varchar(10) default 'NA',Q4 varchar(10) default 'NA',Q5 varchar(10) default 'NA',Q6 varchar(10) default 'NA',Comments varchar(200) default 'NA');";

$createTable.= "CREATE TABLE IF NOT EXISTS Security_questions(QuestionNum varchar(5) NOT NULL,Question varchar(200) default 'NA');";

// $createTable.= "CREATE TABLE IF NOT EXISTS GuardsDutyChart(Day varchar(20) NOT NULL,Hostel varchar(20) NOT NULL,Time1 varchar(30) NOT NULL,Time2 varchar(30),Time3 varchar(30),Time4 varchar(30));";

$createTable.= "CREATE TABLE IF NOT EXISTS CSMSMaintenance(ID varchar(30) NOT NULL,CSID int NOT NULL AUTO_INCREMENT PRIMARY KEY,CSDate Date NOT NULL,Type varchar(15) NOT NULL,Subject varchar(30) NOT NULL,Location varchar(50) NOT NULL,Availability varchar(100) NOT NULL,Statement varchar(300) NOT NULL,Image varchar(20));";

$createTable.= "CREATE TABLE IF NOT EXISTS CSMSMess(ID varchar(30) NOT NULL,CSID int NOT NULL AUTO_INCREMENT PRIMARY KEY,CSDate Date NOT NULL,Type varchar(15) NOT NULL,Subject varchar(30) NOT NULL,Statement varchar(300) NOT NULL,Image varchar(20));";

$createTable.= "CREATE TABLE IF NOT EXISTS CSMSMedical(ID varchar(30) NOT NULL,CSID int NOT NULL AUTO_INCREMENT PRIMARY KEY,CSDate Date NOT NULL,Type varchar(15) NOT NULL,Subject varchar(30) NOT NULL,Statement varchar(300) NOT NULL,Image varchar(20));";


//$createTable.= "CREATE TABLE IF NOT EXISTS SecurityFeedback1(ID varchar(30) NOT NULL,FeedbackDate DATE NOT NULL,FeedbackID int NOT NULL AUTO_INCREMENT PRIMARY KEY,Comment varchar(300))

//CREATE TABLE IF NOT EXISTS SecurityFeedback2(FeedbackID int NOT NULL,DutyDay varchar(15) NOT NULL,DutyDate DATE NOT NULL,Hostel varchar(20) NOT NULL,GuardName varchar(25) NOT NULL,Rating varchar(10),Comment varchar(200));";

 
 if($flag==0)
 {   
   $result = mysqli_query($db_server,$createDatabase);
 	 if(!$result)
    {
  	  echo "Error In creating database. ".mysqli_error($db_server);
    }
    else
    {
    	echo "Dtabase created succesfully.";
    	if(!(mysqli_select_db($db_server,$db_database)))
		{
  			echo "Error in connecting to  database. ".mysqli_error($db_server);
		}
		else
		{
 	       $result = mysqli_multi_query($db_server,$createTable);
           if(!$result)
           {
  	           echo "Error In creating table. ".mysqli_error($db_server);
           }
           else
           {
    	       echo "Table created succesfully.";
           }
        }
    }
 }

/*mysqli_select_db($db_server,$db_database);
 $create="CREATE TABLE IF NOT EXISTS Menu_items (
  ITEM_NAME VARCHAR(50)  NOT NULL,
  CODE VARCHAR(7) PRIMARY KEY NOT NULL,
  CURR_RATING DEC(5,2),
  ITEM_WEIGHT INTEGER
  )";
if (mysqli_query($db_server,$create)) {
      echo  nl2br ("Table Menu Items created successfully \n");
} else {
    echo  nl2br ("Error creating table: " . mysqli_error($db_server)."\n");
}

$create="CREATE TABLE IF NOT EXISTS Rating_Records (
  IDENTITY VARCHAR(50)  NOT NULL,
  TIMEOFENTRY TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  COMMENTS VARCHAR(300),
  BREAKFAST BOOLEAN NOT NULL DEFAULT 0,
  LUNCH BOOLEAN NOT NULL DEFAULT 0,
  SNACKS BOOLEAN NOT NULL DEFAULT 0,
  DINNER BOOLEAN NOT NULL DEFAULT 0,
  
  Q1 SMALLINT NOT NULL DEFAULT 3,
  Q2 SMALLINT NOT NULL DEFAULT 3,
  Q3 SMALLINT NOT NULL DEFAULT 3,
  Q4 SMALLINT NOT NULL DEFAULT 3,
  Q5 SMALLINT NOT NULL DEFAULT 3,
  Q6 SMALLINT NOT NULL DEFAULT 3,
  Q7 SMALLINT NOT NULL DEFAULT 3
  )";

if (mysqli_query($db_server,$create)) {
      echo  nl2br ("Table Rating Records created successfully \n");
} else {
    echo  nl2br ("Error creating table Rating Records: " . mysqli_error($db_server)."\n");
}

$create="CREATE TABLE IF NOT EXISTS Question_Records (
  QUESTIONID VARCHAR(50)  NOT NULL,
  QUESTION VARCHAR(300)
  );
  INSERT INTO Question_Records values('Q1','Quality of Ingredients');
  INSERT INTO Question_Records values('Q2','Quality of Drinking Water');
  INSERT INTO Question_Records values('Q3','Timing of Mess');
  INSERT INTO Question_Records values('Q4','Insects removal arrangement');
  INSERT INTO Question_Records values('Q5','Service by Staff');
  INSERT INTO Question_Records values('Q6','Overall Mess Facilities');
  INSERT INTO Question_Records values('Q7','Reserved for Future use');";
  
  
if (mysqli_multi_query($db_server,$create)) {
      echo  nl2br ("Table Question_records created successfully \n");
} else {
    echo  nl2br ("Error creating table Question_records : " . mysqli_error($db_server)."\n");
}*/

?>