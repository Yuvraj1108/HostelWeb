<!DOCTYPE>
<html>
<?php

 $flag=0;
 require_once '../PHP/login.php';
 $db_server = mysqli_connect($db_hostname, $db_username, $db_password);
 mysqli_select_db($db_server,$db_database)
 ?>

<head>
	<title>Internal Website</title>
	<link rel="stylesheet" type="text/css" href="../CSS/header.css"/>
	<script src="https://apis.google.com/js/platform.js" async defer></script>
	<meta name="google-signin-client_id" content="140503907288-g665dccn1p9me9ihmt6sq6aho7vhqujc.apps.googleusercontent.com">
	<meta name="google-signin-hosted_domain" content="iitgoa.ac.in">
    <link rel="stylesheet" type="text/css" href="../CSS/navigation.css"/>
	<link rel="stylesheet" type="text/css" href="../CSS/content.css"/>
	<link rel="stylesheet" type="text/css" href="../CSS/formStyle.css"/>
	<link rel="stylesheet" type="text/css" href="../CSS/imageSlide.css"/>
	<link rel="stylesheet" type="text/css" href="../CSS/sideNavigation.css"/>
		<link rel="stylesheet" type="text/css" href="../CSS/messMenuStyles.css"/>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
	<div class="row">
		<div class="head">
			<div class="Title1">IIT GOA HOSTEL</div>
			<div class="Title2">GEC Campus Farmagudi,Ponda,Goa 403401</div>
		</div>
	</div>

    <div class="menu">
    	<span class="fa fa-bars modify"></span>
    </div>
 
    <div class="row">
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
			<li><a href="hostelrules.html"><span class="fa fa-book"></span>Hostel Rules</a></li>
			<li><a href="facilities.html"><span class="fa fa-users"></span>Facilities</a></li>
			<li><a href="internalw2.php"><span class="fa fa-pencil-square-o"></span>Internal Website</a></li>
		</ul>
	 </nav>
   </div>

	<div class="row">
    	<div class="column-100">
    		<div class="card" style="border-style: ridge;border-radius: 5px">
    		     <div class="Title4">Internal Website </div>
    	    </div>
    	</div>
    </div>



<div class="row" id = "StudentProfile"><!---->
		<div class="column-100" >
			<div class="container">
				<div class="card" style="background-color: #6a5acd;border-radius: 5px">
						<div class="card" style="box-shadow: 5px 5px 5px 5px #191970;">

							<!--<div class="Title3" id="activeThing">Login</div>-->
<!----------------------------------------Sign In link----------------------------------------------->
                      
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

                                    
                                    <div class="row">
                                    	<div class="col-50">
                                    		<div class="col-50" style="background-color:;width:">
								    			<label for ="Full_Name"><b>Full Name</b></label>
								    		</div>
								    		<div class="col-50" style="background-color:;width:">
                                    			<input type="text" id="Full_Name" name="FullName" value="">
									            <label class="error" for="Full_Name" id="FullNameError">This Field is required</label>
						        		 	</div>
						        		</div>
						        		<div class="col-50">
						        			<div class="col-50" style="background-color:;width:">
						        				<label for ="Roll_No"><b>Roll Number</b></label>
						        			</div>
						        			<div class="col-50" style="background-color:;width:">
                                    			<input type="text" id="Roll_No" name="RollNo" placeholder="Your Roll Number">
									            <label class="error" for="Roll_No" id="Roll_NoError">This Field is required</label>
						        		 	</div>
						        		</div>
						        	</div>


                                    <div class="row">
                                    	<div class="col-50">
                                    		<div class="col-50" style="background-color:;width:">
								    			<label for ="hostelNo"><b>Hostel</b></label>
								    		</div>
								    		<div class="col-50" style="background-color:;width:">
                                    			<select id="hostelNo" name="HostelNo">
									        	     <option value="1">Block B1</option>
									        	     <option value="2">Block B2</option>
									        	     <option value="3">Block B3</option>
									        	     <option value="4">Block G1</option>
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
                                     

                                         <label for ="StudentContact"><b>Contact Number</b></label>
									     <input type="text" id="StudentContact" name="StudentContact" placeholder="Contact Number"/>
									     <label class="error" for="StudentContact" id="StudentContactError">This Field is required</label>

									   <!-- <label for ="Address"><b>Address</b></label>
									   <input type="text" id="Address" name="Address" placeholder="Town/village, City, PIN, State"/>
									   <label class="error" for="Address" id="AddressError">This Field is required</label>
 -->
                                     <label for ="Permanent Address"><b>Address</b></label>   
                                    <div class="row">
                                    	<div class="col-50">
                                    		<div class="col-50" style="background-color:;width:">
								    			<label for ="Line1"><b>Address line 1</b></label>
								    		</div>
								    		<div class="col-50" style="background-color:;width:">
                                    			<input type="text" id="Line1" name="Line1" placeholder="Town/village/Street">
									            <label class="error" for="Line1" id="Line1Error">This Field is required</label>
						        		 	</div>
						        		</div>
						        		<div class="col-50">
						        			<div class="col-50" style="background-color:;width:">
						        				<label for ="Line2"><b>Address line 2</b></label>
						        			</div>
						        			<div class="col-50" style="background-color:;width:">
                                    			<input type="text" id="Line2" name="Line2" placeholder="City/District">
									            <label class="error" for="Line2" id="Line2Error">This Field is required</label>
						        		 	</div>
						        		</div>
						        	</div>

						        	<div class="row">
                                    	<div class="col-50">
                                    		<div class="col-50" style="background-color:;width:">
								    			<label for ="State"><b>State</b></label>
								    		</div>
								    		<div class="col-50" style="background-color:;width:">
                                    			<select id="State" name="State">
						        	     			<option value="Andra Pradesh">Andra Pradesh</option>
						        	     			<option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
						        	     			<option value="Arunachal Pradesh">Arunachal Pradesh</option>
						        	     			<option value="Assam">Assam</option>
						        	     			<option value="Bihar">Bihar</option>
						        	     			<option value="Chhattisgarh">Chhattisgarh</option>
						        	     			<option value="Chandigarh">Chandigarh</option>
						        	     			<option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
						        	     			<option value="Daman and Diu">Daman and Diu</option>
						        	     			<option value="Delhi ">Delhi </option>
						        	     			<option value="Goa">Goa</option>
						        	     			<option value="Gujarat">Gujarat</option>
                                                    <option value="Haryana">Haryana</option>
                                                    <option value="Himachal Pradesh">Himachal Pradesh</option>
                                                    <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                                                    <option value="Jharkhand">Jharkhand</option>
                                                    <option value="Karnataka">Karnataka</option>
                                                    <option value="Kerala">Kerala</option>
                                                    <option value="Lakshadeep">Lakshadeep</option>
                                                    <option value="Madya Pradesh">Madya Pradesh</option>
                                                    <option value="Maharashtra">Maharashtra</option>
                                                    <option value="Manipur">Manipur</option>
                                                    <option value="Meghalaya">Meghalaya</option>
                                                    <option value="Mizoram">Mizoram</option>
                                                    <option value="Nagaland">Nagaland</option>
                                                    <option value="Orissa">Orissa</option>
                                                    <option value="Punjab">Punjab</option>
                                                    <option value="Pondicherry">Pondicherry</option>
                                                    <option value="Rajasthan">Rajasthan</option>
                                                    <option value="Sikkim">Sikkim</option>
                                                    <option value="Tamil Nadu">Tamil Nadu</option>
                                                    <option value="Telagana">Telagana</option>
                                                    <option value="Tripura">Tripura</option>
                                                    <option value="Uttaranchal">Uttaranchal</option>
                                                    <option value="Uttar Pradesh">Uttar Pradesh</option>
                                                    <option value="West Bengal">West Bengal</option>

						        				</select>
						        		 	</div>
						        		</div>
						        		<div class="col-50">
						        			<div class="col-50" style="background-color:;width:">
						        				<label for ="PIN"><b>PIN</b></label>
						        			</div>
						        			<div class="col-50" style="background-color:;width:">
                                    			<input type="text" id="PIN" name="PIN" placeholder="PIN">
									            <label class="error" for="PIN" id="PINError">This Field is required</label>
						        		 	</div>
						        		</div>
						        	</div>


                                     
                                    <div class="row">
                                    	<div class="col-50">
                                    		<div class="col-50" style="background-color:;width:">
								    			<label for ="ParentName"><b>Parent Name</b></label>
								    		</div>
								    		<div class="col-50" style="background-color:;width:">
                                    			<input type="text" id="ParentName" name="ParentName" placeholder="Parent Name">
									            <label class="error" for="ParentName" id="ParentNameError">This Field is required</label>
						        		 	</div>
						        		</div>
						        		<div class="col-50">
						        			<div class="col-50" style="background-color:;width:">
						        				<label for ="ParentContact"><b>Parent Contact</b></label>
						        			</div>
						        			<div class="col-50" style="background-color:;width:">
                                    			<input type="text" id="ParentContact" name="ParentContact" placeholder="Parent Contact">
									            <label class="error" for="ParentContact" id="ParentContactError">This Field is required</label>
						        		 	</div>
						        		</div>
						        	</div>

									     <label for ="ParentEmail"><b>Parent's Email-ID</b></label>
									     <input type="text" id="ParentEmail" name="ParentEmail" placeholder="Email Id of parent"/>
									     <label class="error" for="ParentEmail" id="ParentEmailError">This Field is required</label>
                                    


									
                                    <label class="error" id="result"></label>

									<div class="row" style="padding-top:10px">
									<input type="submit" id="formNewStudent" name="formNewStudent" value="Proceed">
								    </div>
						        </form>
						    </div>
<!------------------------------------------------Profile------------------------------------------------->
						    <div id="Profile">

	                            <div class="row" style="background-color:#dcdcdc">
									<div class="Title3" id="Name"></div>
								</div>

								<div class="row">
									<div claas="column-100" style="text-align: right">
										<a href="#" onclick="signOut('Profile');">Sign out</a>
									</div>
								</div>

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
												    	<div class="label1"><h3>Hostel</h3></div>
													</div>
												    <div class="col-50" style="background-color:;width:">
												    	<div class="label1" id="HNo"></div>
													</div>
											</div>
									</div>	                                     

	                            <div class="row" style="background-color:">
	                                        <div class="column-33">
									    		<div class="row" style="padding-top:10px;width:">
													<input type="button" name="ButtonCSMS" id="ButtonCSMS" value="CSMS">
												</div>
											</div>
											<div class="column-33">
												<div class="row" style="padding-top:10px">
													<input type="button" name="ButtonFeedback" id="ButtonFeedback" value="Feedback">
												</div>
											</div>
											<div class="column-33">
												<div class="row" style="padding-top:10px">
													<input type="button" name="ButtonIOMS" id="ButtonIOMS" value="IOMS">
												</div>
											</div>
							    </div>

                                </div>
						</div>
				</div>
	    	</div>
   		</div>
	</div>

<div class="row" id = "StaffProfile"><!---->
	<div class="column-100" >
		<div class="container">
			<div class="card" style="background-color: #6a5acd;border-radius: 5px">
				<div class="card" style="box-shadow: 5px 5px 5px 5px #191970;">

				    <div class="row" style="background-color:#dcdcdc">
							<div class="Title3" id="StaffName"></div>
					</div>

						    <div class="row">
							  <div claas="column-100" style="text-align: right">
								<a href="#" onclick="signOut('Profile');">Sign out</a>
							  </div>
						    </div>
                        
                                <!-- <div class="message" id="Alert1">
						        	<h2 style="color:red"><span class="fa fa-exclamation-triangle" aria-hidden="true"></span>The page is under development!</h2>
						        	<div class="row">
										<div claas="column-100" style="text-align: center">
											<a href="#" onclick="signOut('Alert');">Sign out</a>
										</div>
								     </div>
							    </div> -->
 

						</div>
					</div>
				</div>
		</div>
</div>			

<div id=Internal>


<div class="row" id = "RowCSMS">
		<div class="column-100">
			<div class="container">
				<div class="card" style="background-color: #6a5acd;border-radius: 5px">
						<div class="card" style="box-shadow: 5px 5px 5px 5px #191970;">
							<div class="row" style="background-color:#dcdcdc">
									<div class="Title3">Complaint And Suggestion Management System</div>
						    </div>

						    <div class="row" style="background-color:">
	                                        <div class="column-33">
									    		<div class="row" style="padding-top:10px;width:">
													<input type="button" name="Mess" id="mess" value="Register Dining Complaint/Suggestion ">
												</div>
											</div>
											<div class="column-33">
												<div class="row" style="padding-top:10px">
													<input type="button" name="Hosp" id="hosp" value="Register Medical Complaint/Suggestion ">
												</div>
											</div>
											<div class="column-33">
												<div class="row" style="padding-top:10px">
													<input type="button" name="Main" id="maint" value="Register Maintenance Complaint/Suggestion ">
												</div>
											</div>
							</div>
	 


			                     
	                                  <div id="ActiveForm"> 
	                                    	<!--------------- Mess complaint/suggetion form ---------------------->
								        <form id="MessComp" action="">
								        	<label for="mess_cmp_sug">Complaint/Suggestion</label>
								        	<select id="mess_cmp_sug" name="messCmpSug">
								        	     <option value="Complaint">Complaint</option>
								        	     <option value="Suggestion">Suggestion</option>
								        	</select> 

								        	<label for="mess_sub">Subject</label>
								        	<select id="mess_sub" name="messSubject">
								        	     <option value="Related to Food Quality">Related to Food Quality</option>
								        	     <option value="Related to Food Quantity">Related to Food Quantity</option>
								        	     <option value="Related to Sitting facility">Related to Sitting Facility</option>
								        	     <option value="Related to Sitting facility">Related to Timing</option>
								        	     <option value="Related to Equipments">Related to Equipment</option>
								        	     <option value="Related to Hygiene">Related to Hygien</option>
								        	     <option value="Related to Mess Menu">Related to Mess Menu</option>
								        	     <option value="Miscellaneous">Miscellaneous</option>
								        	</select> 

								        	<label for="mess_content">Content</label>
								        	<textarea rows="5" cols="50" id="mess_content" name="messContent"></textarea>

								        	<label class="error" id="messContentError"></label>

								        	<label for="file">Upload Images (If any)</label>
								        	<input type="file" name="messFile" id="messFile" accept="image/*" />
								        	<label class="error" id="messFileError"></label>

								        	<div class="row" style="padding-top:10px">
											<input type="submit" name="Mess" id="MessSubmit" value="Submit">
										    </div>

								        </form>

	                                    <!------------------ Hospital Compalint/suggestion form----------------->
								        <form id="HospComp" action="">
								        	<label for="hosp_cmp_sug">Complaint/Suggestion</label>
								        	<select id="hosp_cmp_sug" name="hospCmpSug">
								        	     <option value="Complaint">Complaint</option>
								        	     <option value="Suggestion">Suggestion</option>
								        	</select> 

								        	<label for="hosp_sub">Subject</label>
								        	<select id="hosp_sub" name="hospSubject">
								        	     <option value="Related to Doctor unavailability">Related to Doctor unavailability</option>
								        	     <option value="Related to Nurse unavailability">Related to Nurse unavailability</option>
								        	     <option value="Non-Satisfactory treatment at Dispencery">Non-Satisfactory treatment at Dispencery</option>
								        	     <option value="Non-Satisfactory treatment at Hospital">Non-Satisfactory treatment at Hospital</option>
								        	     <option value="Related to Vehicle for Hospital">Related to Vehicle for Hospital</option>
								        	     <option value="Miscellaneous">Miscellaneous</option>
								        	   
								        	</select> 

								        	<label for="hosp_content">Content</label>
								        	<textarea rows="5" cols="50" id="hosp_content" name="hospContent"></textarea>

								        	<label class="error" id="hospContentError"></label>

								        	<label for="file">Upload Images (If any)</label>
								        	<input type="file" name="hospFile" accept="image/*" />
								        	<label class="error" id="hospFileError"></label>

								        	<div class="row" style="padding-top:10px">
											<input type="submit" name="Hosp" id="HospSubmit" value="Submit">
										    </div>

								        </form>

								        <!-----------------maintenence Compalint/suggestion form--------------->

								        <form id="MainComp" action="">
								        	<label for="maint_cmp_sug">Complaint/Suggestion</label>
								        	<select id="maint_cmp_sug" name="maintCmpSug">
								        	     <option value="Complaint">Complaint</option>
								        	     <option value="Suggestion">Suggestion</option>
								        	</select> 

								        	<label for="maint_sub">Subject</label>
								        	<select id="maint_sub" name="maintSubject">
								        	     <option value="Related to Electrical Appliances">Related to Electrical Appliances</option>
								        	     <option value="Related to Room Furniture">Related to Room Furniture</option>
								        	     <option value="Related to Electricity">Related to Electricity</option>
								        	     <option value="Related to Wi-fi">Related to Wi-fi</option>
								        	     <option value="Related to Drinking Water">Related to Drinking Water</option>
								        	     <option value="Related to Water">Related to Water</option>
								        	     <option value="Related to Rest Room">Related to Rest Room</option>
								        	     <option value="Related to Washing Machine">Related to Washing Machine</option>
								        	     <option value="Related to Common Facilities">Related to Common Facilities</option>
								        	     <option value="Miscellaneous">Miscellaneous</option>

								        	   
								        	</select> 

                                            <label for="maint_location">Problem location</label>
                                            <input type="text" id="maintLocation" name="maintLocation" value=""/>
                                            <label class="error" id="maintLocationError"></label>

                                            <label for="maint_availability">Your availability</label>
                                            <input type="text" id="maintAvailability" name="maintAvailability" placeholder="when will you be available ? (mention atleast two times) "/>
                                            <label class="error" id="maintAvailabilityError"></label>

								        	<label for="maint_content">Content</label>
								        	<textarea rows="5" cols="50" id="maint_content" name="maintContent"></textarea>

								        	<label class="error" id="maintContentError"></label>

								        	<label for="file">Upload Images (If any)</label>
								        	<input type="file" name="maintFile" accept="image/*" />
								        	<label class="error" id="maintFileError"></label>

								        	<div class="row" style="padding-top:10px">
											<input type="submit" name="Maint" id="MaintSubmit" value="Submit">
										    </div>
								        </form>
								      </div>

								      <div class="message" id="RightMessage">
								        	<h2 id="msg1" style="color:green"><span class="fa fa-check-circle"></span>Complaint Submitted Successfully!</h2>
								        	<p id="msg2" style="color:green">We will try to solve as soon as possible.</p>
								      </div>
						</div>
					</div>
				</div>
			</div>
</div>

<div class="row" id = "RowFeedback">
		<div class="column-100">
			<div class="container">
				<div class="card" style="background-color: #6a5acd;border-radius: 5px">
						<div class="card" style="box-shadow: 5px 5px 5px 5px #191970;">
							<div class="row" style="background-color:#dcdcdc">
									<div class="Title3">Feedback For Services</div>
						    </div>
						                 <div class="row" style="background-color:">
	                                        <div class="column-33">
									    		<div class="row" style="padding-top:10px;width:">
													<input type="button" name="DiningFeedback" id="DiningFeedback" value="Dining Facility Feedback">
												</div>
											</div>
											<div class="column-33">
												<div class="row" style="padding-top:10px">
													<input type="button" name="HousekpngFeedback" id="HousekpngFeedback" value="Housekeeping Service Feedback">
												</div>
											</div>
											<div class="column-33">
												<div class="row" style="padding-top:10px">
													<input type="button" name="SecurityFeedbackKey" id="SecurityFeedbackKey" value="Security Service Feedback">
												</div>
											</div>
							            </div>

 <!----------------------------------------------------------------------------------------------------------------------->                                       
                <div id="Dining">
                      <form id="MessFeedback" action="">
							<div id="breakfastfoldup" class="foldup_button" style="background-image:url('../Images/breakfast.png');" onclick="MealToggle(1)">
								BREAKFAST
							</div>
							<div id="breakfastreveal" class="reveal">

							<?php
								$jd = cal_to_jd(CAL_GREGORIAN,date("m"),date("d"),date("Y"));
								$day_today =  jddayofweek($jd,1);
								$query = "SELECT BR1, BR2, BR3, BR4, BR5, BR6, BR7, BR8, BR9,BR10,BR11,BR12,BR13,BR14,BR15 from mess_menu where DAY='$day_today' order by DATEOFFORMATION DESC LIMIT 1;";
								if ( $result = mysqli_query($db_server,$query)) {
									echo "";}
								else {
									echo  nl2br ("Error submitting form result2: " . mysqli_error($db_server)."\n== $query ==\n");}
								$row = mysqli_fetch_assoc($result);
								echo "<div class='row'>";
								for($i=1;$i<=6;$i++){
									if ($i==5) {echo "</div><div class='row'>";}
									$queryi = "Select ITEM_NAME from menu_items where CODE='{$row["BR$i"]}'";
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
									$query = "SELECT LU1, LU2, LU3, LU4, LU5, LU6, LU7, LU8, LU9, LU10, LU11, LU12, LU13, LU14, LU15 from mess_menu where DAY='$day_today' order by DATEOFFORMATION DESC LIMIT 1;";
									if ( $result = mysqli_query($db_server,$query)) {
										echo "";}
									else {
										echo  nl2br ("Error submitting form result2: " . mysqli_error($db_server)."\n== $query ==\n");}
									$row = mysqli_fetch_assoc($result);
									echo "<div class='row'>";
									for($i=1;$i<=9;$i++){
										if ($i==5) {echo "</div><div class='row'>";}
										$queryi = "Select ITEM_NAME from menu_items where CODE='{$row["LU$i"]}'";
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
									$query = "SELECT SN1, SN2, SN3, SN4, SN5, SN6, SN7, SN8, SN9, SN10, SN11, SN12, SN13, SN14, SN15 from mess_menu where DAY='$day_today' order by DATEOFFORMATION DESC LIMIT 1;";
									if ( $result = mysqli_query($db_server,$query)) {
										echo "";}
									else {
										echo  nl2br ("Error submitting form result2: " . mysqli_error($db_server)."\n== $query ==\n");}
									$row = mysqli_fetch_assoc($result);
									echo "<div class='row'>";
									for($i=1;$i<=4;$i++){
										if ($i==5) {echo "</div><div class='row'>";}
										$queryi = "Select ITEM_NAME from menu_items where CODE='{$row["SN$i"]}'";
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
									$query = "SELECT DI1,DI2,DI3,DI4,DI5,DI6,DI7,DI8,DI9,DI10,DI11,DI12,DI13,DI14,DI15 from mess_menu where DAY='$day_today' order by DATEOFFORMATION DESC LIMIT 1;";
									if ( $result = mysqli_query($db_server,$query)) {
										echo "";}
									else {
										echo  nl2br ("Error submitting form result2: " . mysqli_error($db_server)."\n== $query ==\n");}
									$row = mysqli_fetch_assoc($result);
									echo "<div class='row'>";
									for($i=1;$i<=9;$i++){
										if ($i==5) {echo "</div><div class='row'>";}
										$queryi = "Select ITEM_NAME from menu_items where CODE='{$row["DI$i"]}'";
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
								<center style="clear:both;"><h1>General Queries</h1></center>
								
								<?php
									$result = mysqli_query($db_server,"Select * from question_records");
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
							    <input type="submit" name="MessFeedback" value="Submit">
							</div>								
						</form>

						 <div class="message" id="RightMessage2">
				        	<h2 id="msg1" style="color:green"><span class="fa fa-check-circle"></span>Feedback Submitted Successfully!</h2>
				        	<p id="msg2" style="color:green">Thanks For Your Feedback!</p>
						 </div>      
        </div>

<!-- ----------------------------------------------------------------------------------------------------------------------------- -->
							        <div id="Housekeeping">
							            	<label class="error" id="NotifyError"></label>
									          <!-- <div class="message" id="Notify">
								        	 <h2 id="msg1" style="color:green"><span class="fa fa-check-circle"></span>You Have Already Submitted Your Feedback!</h2>
								        	 <p id="msg2" style="color:green">Giving again will overwrite it!</p>

								        	 <div class="row" style="padding-top:10px">
											    <input type="button" id="Edit" name="Edit" value="Chnage My Feedback">
									         </div>								        	
								              </div> -->

								       <form action="" id="HouseKeepingFeedback">
										<div id="Questions">
										</div>

										
										<label for ="Corridors"><b>Cleanliness of Corridors</b></label>
						                     <div class="row">
						                     	 <div class="col-16"><input type="radio" name="Corridors" value="1"> Very Poor</div>			
										     	 <div class="col-16"><input type="radio" name="Corridors" value="2"> Poor</div>
											     <div class="col-16"><input type="radio" name="Corridors" value="3"> Average</div>
											 	 <div class="col-16"><input type="radio" name="Corridors" value="4"> Good</div>
											     <div class="col-16"><input type="radio" name="Corridors" value="5"> Very Good</div>
											     <div class="col-16"><input type="radio" name="Corridors" value="NA" checked> NA</div>
											 </div>
										<label for ="CommonRoom"><b>Cleanliness of Common Room</b></label>
						                     <div class="row">
						                     	 <div class="col-16"><input type="radio" name="CommonRoom" value="1"> Very Poor</div>			
										     	 <div class="col-16"><input type="radio" name="CommonRoom" value="2"> Poor</div>
											     <div class="col-16"><input type="radio" name="CommonRoom" value="3"> Average</div>
											 	 <div class="col-16"><input type="radio" name="CommonRoom" value="4"> Good</div>
											     <div class="col-16"><input type="radio" name="CommonRoom" value="5"> Very Good</div>
											     <div class="col-16"><input type="radio" name="CommonRoom" value="NA" checked> NA</div>
											 </div>
										<label for ="Rooms"><b>Cleanliness of Rooms</b></label>
						                     <div class="row">
						                     	 <div class="col-16"><input type="radio" name="Rooms" value="1"> Very Poor</div>
						                     	 <div class="col-16"><input type="radio" name="Rooms" value="2"> Poor</div>
											     <div class="col-16"><input type="radio" name="Rooms" value="3"> Average</div>
											 	 <div class="col-16"><input type="radio" name="Rooms" value="4"> Good</div>
											     <div class="col-16"><input type="radio" name="Rooms" value="5"> Very Good</div>
											     <div class="col-16"><input type="radio" name="Rooms" value="NA" checked> NA</div>
											 </div>
										<label for ="Accessories"><b>Cleanliness of Fans/Windows/Tables etc.</b></label>
						                     <div class="row">
						                     	 <div class="col-16"><input type="radio" name="Accessories" value="1"> Very Poor</div>			
										     	 <div class="col-16"><input type="radio" name="Accessories" value="2"> Poor</div>
											     <div class="col-16"><input type="radio" name="Accessories" value="3"> Average</div>
											 	 <div class="col-16"><input type="radio" name="Accessories" value="4"> Good</div>
											     <div class="col-16"><input type="radio" name="Accessories" value="5"> Very Good</div>
											     <div class="col-16"><input type="radio" name="Accessories" value="NA" checked> NA</div>
											 </div>
										<label for ="Bathrooms"><b>Cleanliness of Bathrooms</b></label>
						                     <div class="row">
						                     	 <div class="col-16"><input type="radio" name="Bathrooms" value="1"> Very Poor</div>			
										     	 <div class="col-16"><input type="radio" name="Bathrooms" value="2"> Poor</div>
											     <div class="col-16"><input type="radio" name="Bathrooms" value="3"> Average</div>
											 	 <div class="col-16"><input type="radio" name="Bathrooms" value="4"> Good</div>
											     <div class="col-16"><input type="radio" name="Bathrooms" value="5"> Very Good</div>
											     <div class="col-16"><input type="radio" name="Bathrooms" value="NA" checked> NA</div>
											 </div>
									    <label for ="Toilets"><b>Cleanliness of Toilets</b></label>
						                     <div class="row">
						                     	 <div class="col-16"><input type="radio" name="Toilets" value="1"> Very Poor</div>			
										     	 <div class="col-16"><input type="radio" name="Toilets" value="2"> Poor</div>
											     <div class="col-16"><input type="radio" name="Toilets" value="3"> Average</div>
											 	 <div class="col-16"><input type="radio" name="Toilets" value="4"> Good</div>
											     <div class="col-16"><input type="radio" name="Toilets" value="5"> Very Good</div>
											     <div class="col-16"><input type="radio" name="Toilets" value="NA" checked> NA</div>
											 </div>
									    <label for ="Timing"><b>The timing of Housekeeping service </b></label>
						                     <div class="row">
						                     	 <div class="col-16"><input type="radio" name="Timing" value="1"> Very Poor</div>			
										     	 <div class="col-16"><input type="radio" name="Timing" value="2"> Poor</div>
											     <div class="col-16"><input type="radio" name="Timing" value="3"> Average</div>
											 	 <div class="col-16"><input type="radio" name="Timing" value="4"> Good</div>
											     <div class="col-16"><input type="radio" name="Timing" value="5"> Very Good</div>
											     <div class="col-16"><input type="radio" name="Timing" value="NA" checked> NA</div>
											 </div>    
										<label for ="Overall"><b>Overall Housekeeping Service  </b></label>
						                     <div class="row">
						                     	 <div class="col-16"><input type="radio" name="Overall" value="1"> Very Poor</div>			
										     	 <div class="col-16"><input type="radio" name="Overall" value="2"> Poor</div>
											     <div class="col-16"><input type="radio" name="Overall" value="3"> Average</div>
											 	 <div class="col-16"><input type="radio" name="Overall" value="4"> Good</div>
											     <div class="col-16"><input type="radio" name="Overall" value="5"> Very Good</div>
											     <div class="col-16"><input type="radio" name="Overall" value="NA" checked> NA</div>
											 </div> 

									    <label for="commennt"><b>Your Valuable Comment</b></label>
									     <textarea rows="5" cols="50" id="comment" name="comment"></textarea>
					                     
					                     <label class="error" id="FeedbackError"></label>

					                     <div class="row" style="padding-top:10px">
										    <input type="submit" name="Housekeeping" value="Submit">
										 </div>
									</form>

									<div class="message" id="RightMessage1">
								        	<h2 id="msg1" style="color:green"><span class="fa fa-check-circle"></span>Feedback Submitted Successfully!</h2>
								        	<p id="msg2" style="color:green">Thanks For Your Feedback!</p>
								    </div>
							     </div>
<!-- -------------------------------------------------------------------------------------------------------------------------------------------------- -->
							     <div id="Security">
							     <form action="" id="SecurityFeedback">
										<!-- <div id="Questions">
										</div> -->

										
										<label for ="Security_Q1"><b> Alertness of security personnel</b></label>
						                     <div class="row">
						                     	 <div class="col-16"><input type="radio" name="Security_Q1" value="1"> Very Poor</div>			
										     	 <div class="col-16"><input type="radio" name="Security_Q1"  value="2"> Poor</div>
											     <div class="col-16"><input type="radio" name="Security_Q1" value="3"> Average</div>
											 	 <div class="col-16"><input type="radio" name="Security_Q1"  value="4"> Good</div>
											     <div class="col-16"><input type="radio" name="Security_Q1"  value="5"> Very Good</div>
											     <div class="col-16"><input type="radio" name="Security_Q1"  value="NA" checked> NA</div>
											 </div>
										<label for ="Security_Q2" ><b> Etiquettes of security personnel</b></label>
						                     <div class="row">
						                     	 <div class="col-16"><input type="radio" name="Security_Q2" value="1"> Very Poor</div>			
										     	 <div class="col-16"><input type="radio" name="Security_Q2" value="2"> Poor</div>
											     <div class="col-16"><input type="radio" name="Security_Q2" value="3"> Average</div>
											 	 <div class="col-16"><input type="radio" name="Security_Q2" value="4"> Good</div>
											     <div class="col-16"><input type="radio" name="Security_Q2" value="5"> Very Good</div>
											     <div class="col-16"><input type="radio" name="Security_Q2" value="NA" checked> NA</div>
											 </div>
										<label for ="Security_Q3"><b>Response of security personnel</b></label>
						                     <div class="row">
						                     	 <div class="col-16"><input type="radio" name="Security_Q3" value="1"> Very Poor</div>
						                     	 <div class="col-16"><input type="radio" name="Security_Q3" value="2"> Poor</div>
											     <div class="col-16"><input type="radio" name="Security_Q3" value="3"> Average</div>
											 	 <div class="col-16"><input type="radio" name="Security_Q3" value="4"> Good</div>
											     <div class="col-16"><input type="radio" name="Security_Q3" value="5"> Very Good</div>
											     <div class="col-16"><input type="radio" name="Security_Q3" value="NA" checked> NA</div>
											 </div>
										<label for ="Security_Q4"><b>Helpfulness of security personnel</b></label>
						                     <div class="row">
						                     	 <div class="col-16"><input type="radio" name="Security_Q4" value="1"> Very Poor</div>			
										     	 <div class="col-16"><input type="radio" name="Security_Q4" value="2"> Poor</div>
											     <div class="col-16"><input type="radio" name="Security_Q4" value="3"> Average</div>
											 	 <div class="col-16"><input type="radio" name="Security_Q4" value="4"> Good</div>
											     <div class="col-16"><input type="radio" name="Security_Q4" value="5"> Very Good</div>
											     <div class="col-16"><input type="radio" name="Security_Q4" value="NA" checked> NA</div>
											 </div>
											 <label for ="Security_Q5"><b>The occurrence of drugs and alcohol consumption despite security presence
</b></label>
						                     <div class="row">
						                     	<div class="col-16"><input type="radio" name="Security_Q5" value="1"> Non-existant</div>
						                     	<div class="col-16"><input type="radio" name="Security_Q5" value="2"> 
						                     	Low</div>
						                     	<div class="col-16"><input type="radio" name="Security_Q5" value="3"> Moderate</div>
						                     	 <div class="col-16"><input type="radio" name="Security_Q5" value="4"> High</div>			
																					     											 	 											     
											    <div class="col-16"><input type="radio" name="Security_Q5" value="NA" checked> NA</div>
											 </div>
									    <!-- <label for ="Friendliness"><b>Friendliness of security personnels</b></label>
						                     <div class="row">
						                     	 <div class="col-16"><input type="radio" name="Friendliness" value="1"> Very Poor</div>			
										     	 <div class="col-16"><input type="radio" name="Friendliness" value="2"> Poor</div>
											     <div class="col-16"><input type="radio" name="Friendliness" value="3"> Average</div>
											 	 <div class="col-16"><input type="radio" name="Friendliness" value="4"> Good</div>
											     <div class="col-16"><input type="radio" name="Friendliness" value="5"> Very Good</div>
											     <div class="col-16"><input type="radio" name="Friendliness" value="NA" checked> NA</div>
											 </div> -->
									    <!-- <label for ="Timing"><b>Timing of security service </b></label>
						                     <div class="row">
						                     	 <div class="col-16"><input type="radio" name="Timing" value="1"> Very Poor</div>			
										     	 <div class="col-16"><input type="radio" name="Timing" value="2"> Poor</div>
											     <div class="col-16"><input type="radio" name="Timing" value="3"> Average</div>
											 	 <div class="col-16"><input type="radio" name="Timing" value="4"> Good</div>
											     <div class="col-16"><input type="radio" name="Timing" value="5"> Very Good</div>
											     <div class="col-16"><input type="radio" name="Timing" value="NA" checked> NA</div>
											 </div>  -->   
										<label for ="Security_Q6"><b> Overall security Service  </b></label>
						                     <div class="row">
						                     	 <div class="col-16"><input type="radio" name="Security_Q6" value="1"> Very Poor</div>			
										     	 <div class="col-16"><input type="radio" name="Security_Q6" value="2"> Poor</div>
											     <div class="col-16"><input type="radio" name="Security_Q6" value="3"> Average</div>
											 	 <div class="col-16"><input type="radio" name="Security_Q6" value="4"> Good</div>
											     <div class="col-16"><input type="radio" name="Security_Q6" value="5"> Very Good</div>
											     <div class="col-16"><input type="radio" name="Security_Q6" value="NA" checked> NA</div>
											 </div> 

									    <label for="Seurity_commennt"><b>Your Valuable Comment</b></label>
									     <textarea rows="5" cols="50" id="Security_comment" name="Security_comment"></textarea>
					                     
					                     <label class="error" id="FeedbackError1"></label>

					                     <div class="row" style="padding-top:10px">
										    <input type="submit" name="Security" value="Submit">
										 </div>
									</form>

									<div class="message" id="RightMessage4">
								        	<h2 id="msg1" style="color:green"><span class="fa fa-check-circle"></span>Feedback Submitted Successfully!</h2>
								        	<p id="msg2" style="color:green">Thanks For Your Feedback!</p>
								    </div>
							     </div>
							     <!-- </div> -->


						 </div>
						</div>
					</div>
				</div>
</div>

<div class="row" id = "RowIOMS">
		<div class="column-100">
			<div class="container">
				<div class="card" style="background-color: #6a5acd;border-radius: 5px">
						<div class="card" style="box-shadow: 5px 5px 5px 5px #191970;">
							<div class="row" style="background-color:#dcdcdc">
									<div class="Title3">In Out Management System</div>
						    </div>
                            
                            <div id="TandC">
						            	<label><b>Scenarios for Application</b></label>
										<ul style="margin-left:20px;color: green">
											<li>There is <b> No Academic leave</b> during the semester.</li>
											<li>If any student who wishes to go on leave, then he/she is responsible for their own and the institute does not take any responsibility of that student. The institute will not conduct any additional lectures, labs or quizzes for those missed one.</li>
											<li>If any student is taking leave on academic/medical grounds, then he/sheneeds to attach the copy of the approval from Academics for perusal.</li>						            							            		
						            </ul>
						            <label><b>Mess Rebate</b></label>
						            <ul style="margin-left:20px;color: green">
						            <li> Additionally, a full rebate will be given to the students for <b>a minimum period of 2 days and maximum of 30 days</b> in a year <b>only</b> in case a prior application has been sent to the caterer through Hall Office via email, at least <b>8 days before the actual leave dates</b>. The student, in this case, would get a rebate for each day applied for the rebate.</li>		
						            </ul>
						            </div>
						            <div id="TandC">
						            	<label><b>Terms and Conditions</b></label>
						            	<ul style="margin-left:20px;color: red">
						            		<li>Institute is not responsible for any mishappenings during your time away from the campus</li>
						            		<li>If according to our database, you are under 18 years, an email will be sent to your parents regarding your departure and your parents will be responsible for your journey and away time, no matter what you have selected in 'Person who will take my responsibility'.</li>

						            		<li>If you are 18 or older, we will inform your parents only when you select 'My Parents' in the field asking 'Person taking your responsibility'.</li>
						            		
						            	</ul>
						            </div>
						    <div id="ChooseInOut">
							        	<div class="row" style="padding-top:10px;width:">
											<input type="button" name="Out" id="Out" value="Make Out Entry">
										</div>
	                     			</div>


	                     			<div class="row">
							        		<label class="error" id="ChooseInOutError"></label>
							        </div>

	                     			<div id="ShowEntry">
	                     				<div class="row" style="background-color:">
											<div class="col-50" style="background-color:;width:">
													<div class="col-50" style="background-color:;width:">
												    	<div class="label1"><h3>Destination</h3></div>
													</div>
												    <div class="col-50" style="background-color:;width:">
												    	<div class="label1" id="destination"></div>
													</div>
											</div>
											<div class="col-50" style="background-color:;width:">
													<div class="col-50" style="background-color:;width:">
												    	<div class="label1"><h3>Reason</h3></div>
													</div>
												    <div class="col-50" style="background-color:;width:">
												    	<div class="label1" id="reason"></div>
													</div>
											</div>
									    </div>
	                     				<div class="row" style="background-color:">
											<div class="col-50" style="background-color:;width:">
													<div class="col-50" style="background-color:;width:">
												    	<div class="label1"><h3>Departure date from institute</h3></div>
													</div>
												    <div class="col-50" style="background-color:;width:">
												    	<div class="label1" id="D_Date"></div>
													</div>
											</div>
											<div class="col-50" style="background-color:;width:">
													<div class="col-50" style="background-color:;width:">
												    	<div class="label1"><h3>Return date to institute(Expected)</h3></div>
													</div>
												    <div class="col-50" style="background-color:;width:">
												    	<div class="label1" id="A_Date"></div>
													</div>
											</div>
									    </div>
										
									    <div class="row" style="background-color:">
											<div class="col-50" style="background-color:;width:">
													<div class="col-50" style="background-color:;width:">
												    	<div class="label1"><h3>Parent's Contact No.</h3></div>
													</div>
												    <div class="col-50" style="background-color:;width:">
												    	<div class="label1" id="P_Contact"></div>
													</div>
											</div>
											<div class="col-50" style="background-color:;width:">
													<div class="col-50" style="background-color:;width:">
												    	<div class="label1"><h3>Parent's Email</h3></div>
													</div>
												    <div class="col-50" style="background-color:;width:">
												    	<div class="label1" id="P_Email"></div>
													</div>
											</div>
									    </div>
									    <div class="row" style="background-color:">
									  
									    	<div class="col-25" style="background-color:;width:">
												    <div class="label1"><h3>Declaration</h3></div>
										    </div>
											 <div class="column-80" style="background-color:;width:">
											    	<div class="label1" id="Responsible_On"></div>
										     </div>									        
									    </div>

									    <div class="row" style="padding-top:10px;width:">
											<input type="button" name="Return" id="Return" value="Make Return Entry">
										</div>
	                     			</div>
                                    
                                    <form action="" id="ReturnForm">
                                    	<div class="row">
                                         	 <div class="column-50">
                                         	 	<div class="col-50">
		                                         	<label for ="ReturnDate"><b>Return date to institute(Actual)</b></label>
		                                         </div>
		                                         <div class="col-50">
											         <label><input type="date"id="ReturnDate" name="ReturnDate"></label>
											         <label class="error" for="ReturnDate" id="ReturnDateError">This Field is required</label>
											     </div>
										     </div>
										 </div>

										 <label class="error" id="ReturnFormError"></label>

										 <div class="row" style="padding-top:10px">
							                 <input type="submit" name="FormReturn" id="FormReturn" value="Submit">
							             </div>
                                    </form>

									<form action="" id="OutStation">
										 <label for ="Destination"><b>Destination</b></label>
									     <input type="text" id="Destination" name="Destination" placeholder="Place where you are going"/>
									     <label class="error" for="Destination" id="DestinationError">This Field is required</label>
                                         
                                         <div class="row">
                                         	 <div class="col-50">
                                         	 	<div class="col-50">
		                                         	<label for ="DepartureDate"><b>Departure date form institute</b></label>
		                                         </div>
		                                         <div class="col-50">
											         <label><input type="date"id="DepartureDate" name="DepartureDate"></label>
											         <label class="error" for="DepartureDate" id="DepartureDateError">This Field is required</label>
											     </div>
										     </div>
										      <div class="col-50">
                                         	 	<div class="col-50">
		                                         	<label for ="ArrivalDate"><b>Return date to institute(Expected)</b></label>
		                                         </div>
		                                         <div class="col-50">
											         <label><input type="date" id="ArrivalDate" name="ArrivalDate"></label>
											         <label class="error" for="ArrivalDate" id="ArrivalDateError"></label>
											     </div>
										     </div>
										 </div>
										 <label class="error" id="InvalidDateError"></label>

										 <label for ="Reason"><b>Reason</b></label>
									     <input type="text" id="Reason" name="Reason" placeholder="Reason of going"/>
									     <label class="error" for="Reason" id="ReasonError">This Field is required</label>
						           
										<div class="row" style="background-color:">
											<div class="col-50" style="background-color:;width:">
													<div class="col-50" style="background-color:;width:">
												    	<div class="label1"><label for="Declaration"><b>Person taking your responsibility</b></label></div>
													</div>
												    <select id="rep" name="ResponsibleOn">
													<option value="MySelf">My Self</option>
													<option value="MyParents">My Parents</option>
													</select>
											</div>
											<div class="col-50" style="background-color:;width:">
													<div class="col-50" style="background-color:;width:">
												    	<div class="label1"><label for="noOfDays"><b>No. of classes going to be missed</b></label></div>
														<input type="text" id="noOfDays" name="noOfDays" placeholder="No. of classes"/>
													</div>
												    
											</div>
									    </div>
                                         <label class="error" id="OutStationError"></label>

									     <div class="row" style="padding-top:10px">
							                 <input type="submit" name="FormOutStation" id="FormOutStation" value="Submit">
							             </div>
									</form>

									 <div class="message" id="RightMessage3">
								        	<h2 id="msg1" style="color:green"><span class="fa fa-check-circle"></span>Successful Entry!</h2>
								        	<p id="msg2" style="color:green">Have a nice journey.</p>
								     </div>
						    </div>
						</div>
					</div>
				</div>
</div>

<div class="row" id="RowInfo">
<div class="col-100" >
	<div class="container">
	<div class="row">
			<div class="column-33">
				<div class="container">
					<div class="card" style="background-color: #6a5acd;border-radius: 5px">
						<div class="card" style="box-shadow: 5px 5px 5px 5px #191970;height:30%;">
	                            <div class="row" style="background-color:#dcdcdc">
								        <div class="Title5" id="info">Announcements</div>
							    </div>
	                     <!-- <div style="overflow-y: scroll"> -->

	                      <!-- <div class="row">
						    <label>Form <a href="#"style="text-decoration: none;color:green">Opt for News Paper</a> will close on February 9, 2019, 11:59 PM</label>
					      </div>
					      <div class="row">
						    <label>Form <a href="#"style="text-decoration: none;color:green">Veg Non-veg Information</a> will close on February 9, 2019, 11:59 PM</label>
						</div>
						
						-->
						<label><a href="https://forms.gle/NJ98epYcsQMZ4wHi7" style="text-decoration: none"><span class="fa fa-pencil-square-o"></span>Poll for reshuffling </a></label>
					
						<ul class="fa-ul">
						    <li style = "color:green"><i class="fa-li fa fa-check-square"></i>Proposal for Night Canteen has been approved by the authorities. It will be opening shortly.</li>
						</ul>
						    
					   </div>
		                 </div>
		        </div>
		    </div>
		    <div class="column-33">
				<div class="container">
					<div class="card" style="background-color: #6a5acd;border-radius: 5px">
					   <div class="card" style="box-shadow: 5px 5px 5px 5px #191970;height:30%;">
	                         <div class="row" style="background-color:#dcdcdc">
								     <div class="Title5" id="info">Meeting/Poll Reports</div>
							 </div>

                          <div style="overflow-x: scroll;height:95%"> 
                          <!-- <marquee behavior="scroll" direction="up"> -->
                          <div class="row">
						          <label><a href="../FILES/Poll result.pdf" style="text-decoration: none"><span class="fa fa-pencil-square-o"></span>Poll regarding allowance or disallowance of boys access to girls' hostel and vice versa</a></label>
					        </div>	
                          <div class="row">
						          <label><a href="../FILES/Minutes of Mess Council meeting.pdf" style="text-decoration: none"><span class="fa fa-pencil-square-o"></span>Minutes of mess council meeting</a></label>
					        </div>
                          <div class="row">
						          <label><a href="../FILES/ReshufflingPollReport.pdf" style="text-decoration: none"><span class="fa fa-pencil-square-o"></span>Poll Regarding Reshuffling</a></label>
					        </div>
                          <div class="row">
						          <label><a href="../FILES/MinutesOfGBM3.pdf" style="text-decoration: none"><span class="fa fa-pencil-square-o"></span>General Body Meeting dated April 18, 2019</a></label>
					        </div> 
                             <div class="row">
						          <label><a href="../FILES/HCM5.pdf" style="text-decoration: none"><span class="fa fa-pencil-square-o"></span>Hostel Committee Meeting dated January 10, 2019</a></label>
					        </div> 
                             <div class="row">
						          <label><a href="../FILES/HCM4.pdf" style="text-decoration: none"><span class="fa fa-pencil-square-o"></span>Hostel Council Meeting dated November 24, 2018</a></label>
					        </div> 
                             <div class="row">
						          <label><a href="../FILES/GBM2.pdf" style="text-decoration: none"><span class="fa fa-pencil-square-o"></span>General Body Meeting dated September 26, 2018</a></label>
					        </div> 
                             <div class="row">
						          <label><a href="../FILES/GBM1.pdf" style="text-decoration: none"><span class="fa fa-pencil-square-o"></span>General Body Meeting dated September 25, 2018</a></label>
					        </div> 
							 <div class="row">
						          <label><a href="../FILES/HCM3.pdf" style="text-decoration: none"><span class="fa fa-pencil-square-o"></span>Hostel Council Meeting dated September 16, 2018</a></label>
					        </div> 

                             <div class="row">
						          <label><a href="../FILES/HCM2.pdf" style="text-decoration: none"><span class="fa fa-pencil-square-o"></span>Hostel Council Meeting dated August 28, 2018</a></label>
					        </div> 

							 <div class="row">
						         <label><a href="../FILES/MessCommitteeMeeting.pdf" style="text-decoration: none"><span class="fa fa-pencil-square-o"></span>Mess Committee Meeting dated July 27, 2018</a></label>
					        </div> 
	                       <div class="row">
						         <label><a href="../FILES/HCM1.pdf" style="text-decoration: none"><span class="fa fa-pencil-square-o"></span>Hostel Council Meeting dated July 23, 2018</a></label>
					       </div>
                           <!-- </marquee> -->
					        
	                            
		                    </div>
		                </div>
		              </div>
		            </div>
		    </div>
		    <div class="column-33">
				<div class="container">
					<div class="card" style="background-color: #6a5acd;border-radius: 5px">
					      <div class="card" style="box-shadow: 5px 5px 5px 5px #191970;height:30%;">
	                         <div class="row" style="background-color:#dcdcdc">
								    <div class="Title5" id="info">Council Information</div>
							 </div>
							 <div class="row">
						         <label><a href="../FILES/Council.pdf" style="text-decoration: none"><span class="fa fa-pencil-square-o"></span>Council Members</a></label>
					         </div>
							 <div class="row">
						         <label><a href="../FILES/WebTeam.pdf" style="text-decoration: none"><span class="fa fa-pencil-square-o"></span>Constitution of Web Team</a></label>
					         </div>
	                         <div class="row">
						         <label><a href="../FILES/WR Appointment.pdf" style="text-decoration: none"><span class="fa fa-pencil-square-o"></span>Appointment of Wing Representatives</a></label>
					         </div>
					          <div class="row">
						         <label><a href="../FILES/QSI.pdf" style="text-decoration: none"><span class="fa fa-pencil-square-o"></span>Appointment of Quality Standard In-charges</a></label>
					         </div>
		                  </div>
		            </div>
		        </div>
</div>
</div>
</div>
</div>
</div>

</div>
<!-- <footer style="background-color:rgb(38,30,46);text-align: center;color:white">&copy; Copyright 2019 Web Team - IIT Goa Hostel Council</footer> -->
</body>
</html>

<script src="../javaScript/menu.js"></script>
<!-- <script src="../javaScript/formScripts.js"></script> -->
<script src="../javaScript/SignInScripts_up.js"></script>
<script src="../javaScript/CSMSScripts.js"></script>
<script src="../javaScript/internalScripts.js"></script>
<script src="../javaScript/OutStationScripts.js"></script>
<script src="../javaScript/HouseKeepingScripts.js"></script>
<script src="../javaScript/FeedbackScripts.js"></script>
<script src="../javaScript/SecurityScript.js"></script>
<script src="../javaScript/newMessScript.js"></script>
