<?php
$body = '
        <html>
        <head>
          <title>CSMS</title>
        </head>
        <body>
           <h2>Received a '.$_POST['messCmpSug'].' regarding Maintenance</h2>

			<table style="width:100%">
			  <tr>
			    <th>Name:</th>
			    <td>'.$_SESSION['Name'].'</td>
			  </tr>
			  <tr>
			    <th>Roll Number:</th>
			    <td>'.$_SESSION['RollNo'].'</td>
			  </tr>
			  <tr>
			    <th>Hostel:</th>
			    <td>'.$_SESSION['HostelName'].'</td>
			  </tr>
			  <tr>
			    <th>Room Numner:</th>
			    <td>'.$_SESSION['RoomNo'].'</td>
			  </tr>
			  <tr>
			    <th>Contact:</th>
			    <td>'.$_SESSION['StudentContact'].'</td>
			  </tr>
			  <tr>
			    <th>Statement</th>
			    <td>'.$_POST['messContent'].'</td>
			  </tr>
			</table>
			</body>
			</html>'

?>