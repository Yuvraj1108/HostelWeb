<!DOCTYPE>
<html>
<?php

 $flag=0;
 require_once '../PHP/login.php';
 $db_server = mysqli_connect($db_hostname, $db_username, $db_password);
 mysqli_select_db($db_server,$db_database)
 ?>
<?php
//error handler function
function customError($errno, $errstr) {
  echo "<b>Error:</b> [$errno] $errstr";
}

//set error handler
set_error_handler("customError");

?>


<!-- <?php
	// $currid = $_SESSION['ID']
	// $query = "SELECT BREAKFAST, LUNCH, SNACKS, DINNER from rating_records where DAY='$day_today' order by DATEOFFORMATION DESC LIMIT 1;";
	// if ( $result = mysqli_query($db_server,$query)) {
	// 	echo "";}
	// else {
	// 	echo  nl2br ("Error submitting form result2: " . mysqli_error($db_server)."\n== $query ==\n");}
	// $row = mysqli_fetch_assoc($result);
								
?>  -->
<head>
	<title>Mess Feedback</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://apis.google.com/js/platform.js" async defer></script>
	<meta name="google-signin-client_id" content="140503907288-g665dccn1p9me9ihmt6sq6aho7vhqujc.apps.googleusercontent.com">
	<meta name="google-signin-hosted_domain" content="iitgoa.ac.in">
	<link rel="stylesheet" type="text/css" href="../CSS/header.css"/>
	<link rel="stylesheet" type="text/css" href="../CSS/navigation.css"/>
	<link rel="stylesheet" type="text/css" href="../CSS/sideNavigation.css"/>
	<link rel="stylesheet" type="text/css" href="../CSS/content.css"/>
	<link rel="stylesheet" type="text/css" href="../CSS/formStyle.css"/>
	<link rel="stylesheet" type="text/css" href="../CSS/messMenuStyles.css"/>
	<link rel="stylesheet" type="text/css" href="../CSS/imageSlide.css"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<script src="../javaScript/newMessScript.js"></script>
	<script src="../javaScript/SignInAllScripts.js"></script>

</head>
<body>


	<!--<div class="row" style="height:20px">
	</div>-->
	 <div class="row">
		<div class="head">
			<div class="Title1">IIT GOA HOSTEL</div>
			<div class="Title2">GEC Campus Farmagudi,Ponda,Goa 403401</div>
		</div>
	</div>

	<div class="menu">
		<span class="fa fa-bars modify"></span>
	</div>

	<nav class="topNavigation">
		<ul>
			<li><a href="index.html"><span class="fa fa-home"></span>Home</a></li>
			<li><a href="about.html"><span class="fa fa-info"></span>About</a></li>
			<li><a href="#"><span class="fa fa-users"></span>Council</a>
			<ul>
				<li><a href="presentCouncil.html">Present</a></li>
				<li><a href="council2018_2019.html">2018-2019</a></li>
				<li><a href="council2017_2018.html">2017-2018</a></li>
				<li><a href="council2016_2017.html">2016-2017</a></li>
			</ul>
			</li>
			<li><a href="#"><span class="fa fa-book"></span>Constitution</a></li>
			<li><a href="CSMS.html"><span class="fa fa-pencil-square-o"></span>CSMS</a></li>
			<li><a href="#"><span class="fa fa-pencil-square-o"></span>Feedback</a>
			<ul>
				<li><a href="newMessFeedback.php">Mess</a></li>
				<li><a href="SecurityFeedback.html">Security</a></li>
				<li><a href="HouseKeepingFeedback.html">House Keeping</a></li>
			</ul>
			</li>
			<li><a href="IOMS.html"><span class="fa fa-pencil-square-o"></span>IOMS</a></li>
		</ul>
	</nav>

   <div class="row">
		<div class="column-100">
			<div class="card" style="border-style: ridge;border-radius: 5px">
				 <div class="Title4">Feedback For Mess</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="column-100">
			<div class="container">
				<div class="card" style="background-color: #6a5acd;border-radius: 5px">
					<div class="card" style="box-shadow: 5px 5px 5px 5px #191970;">

<!----------------------------------------SignIn------------------------------------------------------------------>                     
                    <div id="Login">
                            	<div class="row" id="SignIn">
                     	            <div class="row">
                     	                 <lable><b>Sign In using your IIT Goa Email ID</b></lable>
                     	             </div>

	                     	         <div class="row">
	                     	         	<div class="column-33">
	                     	         	</div>
		                     	        <div class="column-33">
		                                  <div class="g-signin2" data-width="290" data-height="50"  data-onsuccess="onSignIn"></div>
		                                </div>
		                                <div class="column-33">
		                                </div>
                                     </div>
                                     <div class="row">
                        	             <label class="error" id="SignInError"></label>
                                    </div>
                                </div>

	                            <div class="row" id="IAm">
	                            	  <div class="row" style="padding-top:10px">
											<input type="button" id="IsStudent" name="IsStudent" value="I am a Student ">
									  </div>
									   <div class="row" style="padding-top:10px">
											<input type="button" id="IsStaff" name="IsStaff" value="I am a Faculty/Staff Member">
									  </div>
									  <label class="error" id="IAmError"></label>
	                            </div>

                                <div class="message" id="Alert">
						        	<h2 style="color:red"><span class="fa fa-exclamation-triangle" aria-hidden="true"></span>This facility is only for students!</h2>
						        	<div class="row">
										<div claas="column-100" style="text-align: center">
											<a href="#" onclick="signOut('Alert');">Sign out</a>
										</div>
								    </div>
								</div>
 
							    <form action="" id="NewStudent" >
                                    <div class="row" style="background-color:#dcdcdc">
							             <div class="Title3" id="info">Update Your Profile</div>
						            </div>

									<label for ="Roll_No"><b>Roll Number</b></label>
									<input type="text" id="Roll_No" name="RollNo" placeholder="Your Roll Number"/>
									<label class="error" for="Roll_No" id="Roll_NoError">This Field is required</label>
                                    
                                    <label for ="hostelNo"><b>Hostel</b></label>
                                    <select id="hostelNo" name="HostelNo">
						        	     <option value="1">Boys Hostel-1 (GEC Hostel)</option>
						        	     <option value="2">Boys Hostel-2 (New Hostel)</option>
						        	     <option value="3">Girls Hostel-1 (New Hostel)</option>
						        	</select>

                                    <div class="row">
                                    	<div class="col-50">
                                    		<div class="col-50">
												<label for ="floor"><b>Floor</b></label>
											</div>
											<div class="col-50">
												<select id="floor" name="Floor">
						        	      		<option value="G">Ground</option>
						        	     			<option value="F">First</option>
						        	     			<option value="S">Second</option>
						        				</select>
											</div>
								        </div>
                                    	<div class="col-50">
                                    		<div class="col-50">
												<label for ="room"><b>Room Number</b></label>
											</div>
											<div class="col-50">
												<input type="text" id="room" name="RoomNo" placeholder="Your Room Number"/>
												<label class="error" for="room" id="roomError">This Field is required</label>
											</div>
								        </div>
								    </div>

								    <div class="row">
                                    	<div class="col-50">
                                    		<div class="col-50" style="background-color:;width:">
								    			<label for ="gender"><b>Gender</b></label>
								    		</div>
								    		<div class="col-50" style="background-color:;width:">
                                    			<select id="gender" name="Gender">
						        	     			<option value="Male">Male</option>
						        	     			<option value="Female">Female</option>
						        				</select>
						        		 	</div>
						        		</div>
						        		<div class="col-50">
						        			<div class="col-50" style="background-color:;width:">
						        				<label for ="dob"><b>Date Of Birth</b></label>
						        			</div>
						        			<div class="col-50" style="background-color:;width:">
												 <label><input type="date" name="DOB"></label>
                                                 <label class="error" id="DOBError"></label>
											</div>
						        		</div>
						        	</div>
						        	
                                     <label for ="StudentContact"><b>Your Contact Number</b></label>
									     <input type="text" id="StudentContact" name="StudentContact" placeholder="Contact Number"/>
									     <label class="error" for="StudentContact" id="StudentContactError">This Field is required</label>

                                    <label for ="ParentContact"><b>Parent's Contact Number</b></label>
									     <input type="text" id="ParentContact" name="ParentContact" placeholder="Contact Number"/>
									     <label class="error" for="ParentContact" id="ParentContactError">This Field is required</label>

									     <label for ="ParentEmail"><b>Parent's Email-ID</b></label>
									     <input type="text" id="ParentEmail" name="ParentEmail" placeholder="Email Id of parent"/>
									     <label class="error" for="ParentEmail" id="ParentEmailError">This Field is required</label>
									
                                    <label class="error" id="result"></label>

									<div class="row" style="padding-top:10px">
									<input type="submit" id="formNewStudent" name="formNewStudent" value="Proceed">
								    </div>
						        </form>
						    </div>
<!----------------------------------------------------------------------------------------------------------------------------------->

					<div id="Profile">
                        <div class="row" style="background-color:#dcdcdc">
									<div class="Title3" id="Name"></div>
								</div>

								<div class="row">
									<div claas="column-100" style="text-align: right">
										<a href="#" onclick="signOut('Profile');">Sign out</a>
									</div>
								</div>

                                <div id="StudentProfile">
	                                <div class="row" style="background-color:">
											<div class="col-50" style="background-color:;width:">
													<div class="col-50" style="background-color:;width:;">
												    	<div class="label1"><h3>Roll Number</h3></div>
												    	<!--<h2>Roll Number</h2>-->
													</div>
												    <div class="col-50" style="background-color:;width:">
												    	<div class="label1" id="RolNo"></div>
													</div>
											</div>
											<div class="col-50" style="background-color:;width:">
													<div class="col-50" style="width:">
												    	<div class="label1"><h3>Room Number</h3></div>
													</div>
												    <div class="col-20" style="width:">
												    	<div class="label1" id="RomNo"></div>
													</div>
											</div>
									</div>

									<div class="row" style="background-color:">
											<div class="col-50" style="background-color:;width:">
													<div class="col-50" style="background-color:;width:">
												    	<div class="label1"><h3>E-mail</h3></div>
													</div>
												    <div class="col-50" style="background-color:;width:">
												    	<div class="label1" id="E_mail"></div>
													</div>
											</div>
											<div class="col-50" style="background-color:;width:">
													<div class="col-50" style="background-color:;width:">
												    	<div class="label1"><h3>Hostel Number</h3></div>
													</div>
												    <div class="col-50" style="background-color:;width:">
												    	<div class="label1" id="HNo"></div>
													</div>
											</div>
									</div>
							    </div>

						<form id="MessFeedback" action="">
							<div id="breakfastfoldup" class="foldup_button" style="background-image:url('../Images/breakfast.png');" onclick="MealToggle(1)">
								BREAKFAST
							</div>
							<div id="breakfastreveal" class="reveal">

							<?php
								$jd = cal_to_jd(CAL_GREGORIAN,date("m"),date("d"),date("Y"));
								$day_today =  jddayofweek($jd,1);
								$query = "SELECT BR1, BR2, BR3, BR4, BR5, BR6, BR7, BR8, BR9,BR10,BR11,BR12,BR13,BR14,BR15 from Mess_Menu where DAY='$day_today' order by DATEOFFORMATION DESC LIMIT 1;";
								if ( $result = mysqli_query($db_server,$query)) {
									echo "";}
								else {
									echo  nl2br ("Error submitting form result2: " . mysqli_error($db_server)."\n== $query ==\n");}
								$row = mysqli_fetch_assoc($result);
								echo "<div class='row'>";
								for($i=1;$i<=6;$i++){
									if ($i==5) {echo "</div><div class='row'>";}
									$queryi = "Select ITEM_NAME from Menu_items where CODE='{$row["BR$i"]}'";
									if ( $resulti = mysqli_query($db_server,$queryi)) {
										echo "";}
									else {
										echo  nl2br ("Error submitting form result2: " . mysqli_error($db_server)."\n== $queryi ==\n");}
									$rowi = mysqli_fetch_assoc($resulti);
									$name = $rowi["ITEM_NAME"];
									$id = $row["BR$i"];
									if (trim($name) != ""){
									echo <<<EOD
									<div class="col-25">
										<center>$name</center>
										<input class="slider" type="range" name="$id" min="-50" max="50" value="0" >
									</div>
EOD;
								}
									
								}
								echo "</div>"
								?>
							</div>
							
							<div id="lunchfoldup" class="foldup_button"  style="background-image:url('../Images/lunch.jpg');" onclick="MealToggle(2)">
								LUNCH
							</div>
							<div id="lunchreveal" class="reveal">
								<?php
									$query = "SELECT LU1, LU2, LU3, LU4, LU5, LU6, LU7, LU8, LU9, LU10, LU11, LU12, LU13, LU14, LU15 from Mess_Menu where DAY='$day_today' order by DATEOFFORMATION DESC LIMIT 1;";
									if ( $result = mysqli_query($db_server,$query)) {
										echo "";}
									else {
										echo  nl2br ("Error submitting form result2: " . mysqli_error($db_server)."\n== $query ==\n");}
									$row = mysqli_fetch_assoc($result);
									echo "<div class='row'>";
									for($i=1;$i<=9;$i++){
										if ($i==5) {echo "</div><div class='row'>";}
										$queryi = "Select ITEM_NAME from Menu_items where CODE='{$row["LU$i"]}'";
										if ( $resulti = mysqli_query($db_server,$queryi)) {
											echo "";}
										else {
											echo  nl2br ("Error submitting form result2: " . mysqli_error($db_server)."\n== $queryi ==\n");
										}
										$rowi = mysqli_fetch_assoc($resulti);
										$name = $rowi["ITEM_NAME"];
										$id = $row["LU$i"];
										if (trim($name) != ""){
										echo <<<EOD
										<div class="col-25">
											<center>$name</center>
											<input class="slider" type="range" name="$id" min="-50" max="50" value="0" >
										</div>
EOD;
									}
										
									}
									echo "</div>";
									?>
								</div>
							<div id="snacksfoldup" class="foldup_button" style="background-image:url('../Images/snacks.jpg');" onclick="MealToggle(3)">
								SNACKS
							</div>
							<div id="snacksreveal" class="reveal">
								
								<?php
									$query = "SELECT SN1, SN2, SN3, SN4, SN5, SN6, SN7, SN8, SN9, SN10, SN11, SN12, SN13, SN14, SN15 from Mess_Menu where DAY='$day_today' order by DATEOFFORMATION DESC LIMIT 1;";
									if ( $result = mysqli_query($db_server,$query)) {
										echo "";}
									else {
										echo  nl2br ("Error submitting form result2: " . mysqli_error($db_server)."\n== $query ==\n");}
									$row = mysqli_fetch_assoc($result);
									echo "<div class='row'>";
									for($i=1;$i<=4;$i++){
										if ($i==5) {echo "</div><div class='row'>";}
										$queryi = "Select ITEM_NAME from Menu_items where CODE='{$row["SN$i"]}'";
										if ( $resulti = mysqli_query($db_server,$queryi)) {
											echo "";}
										else {
											echo  nl2br ("Error submitting form result2: " . mysqli_error($db_server)."\n== $queryi ==\n");}
										$rowi = mysqli_fetch_assoc($resulti);
										$name = $rowi["ITEM_NAME"];
										$id = $row["SN$i"];
										if (trim($name) != ""){
										echo <<<EOD
										<div class="col-25">
											<center>$name</center>
											<input class="slider" type="range" name="$id" min="-50" max="50" value="0" >
										</div>
EOD;
									}
										
									}
									echo "</div>";
									?>
								</div>
							<div id="dinnerfoldup" class="foldup_button" style="background-image:url('../Images/dinner.jpg');" onclick="MealToggle(4)">
								DINNER
							</div>
							<div id="dinnerreveal" class="reveal">
								
								<?php
									$query = "SELECT DI1,DI2,DI3,DI4,DI5,DI6,DI7,DI8,DI9,DI10,DI11,DI12,DI13,DI14,DI15 from Mess_Menu where DAY='$day_today' order by DATEOFFORMATION DESC LIMIT 1;";
									if ( $result = mysqli_query($db_server,$query)) {
										echo "";}
									else {
										echo  nl2br ("Error submitting form result2: " . mysqli_error($db_server)."\n== $query ==\n");}
									$row = mysqli_fetch_assoc($result);
									echo "<div class='row'>";
									for($i=1;$i<=9;$i++){
										if ($i==5) {echo "</div><div class='row'>";}
										$queryi = "Select ITEM_NAME from Menu_items where CODE='{$row["DI$i"]}'";
										if ( $resulti = mysqli_query($db_server,$queryi)) {
											echo "";}
										else {
											echo  nl2br ("Error submitting form result2: " . mysqli_error($db_server)."\n== $queryi ==\n");}
										$rowi = mysqli_fetch_assoc($resulti);
										$name = $rowi["ITEM_NAME"];
										$id = $row["DI$i"];
										if (trim($name) != ""){
										echo <<<EOD
										<div class="col-25">
											<center>$name</center>
											<input class="slider" type="range" name="$id" min="-50" max="50" value="0" >
										</div>
EOD;
									}
										
									}
									echo "</div>";
									?>
							</div>
							<div>
								<center style="clear:both;"><h1>General Queries</h1></center></br>
								
								<?php
									$result = mysqli_query($db_server,"Select * from Question_Records");
									while($row = mysqli_fetch_assoc($result)) {

										$qid = $row["QUESTIONID"];
										$qtext = $row["QUESTION"];
										if (trim($qtext) != ""){
										echo <<<EOD
										<label><b>{$qtext}</b></label>
								
											<div class="row">
												<div class="col-16" ><input type="radio" name="{$qid}" value=0  checked> No Opinion</div>
												<div class="col-16" ><input type="radio" name="{$qid}" value=1  > Horrible</div>
												<div class="col-16" ><input type="radio" name="{$qid}" value=2 > Poor</div>
												<div class="col-16" ><input type="radio" name="{$qid}" value=3 > Average</div>
												<div class="col-16" ><input type="radio" name="{$qid}" value=4 > Very Good</div>
												<div class="col-16" ><input type="radio" name="{$qid}" value=5 > Excellent</div>
											</div>
										

EOD;
										}
										} 

								?>
							</div>
								<label for="commennt"><b>Your Valuable Comment</b></label>
							    <textarea rows="5" cols="50" name="comment"></textarea>
							
                            <label class="error" id="MessError"></label>
                            <div class="row" style="padding-top:10px">
										    <input type="submit" value="Submit">
							</div>								
						</form>

						<div class="message" id="RightMessage">
				        	<h2 id="msg1" style="color:green"><span class="fa fa-check-circle"></span>Feedback Submitted Successfully!</h2>
				        	<p id="msg2" style="color:green">Thanks For Your Feedback!</p>
						 </div>
                         
                        

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<footer style="background-color:rgb(38,30,46);text-align: center;color:white">&copy; Copyright 2019 Web Team IIT GOA</footer>
</body>


</html>