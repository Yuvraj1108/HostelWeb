<?php

 $flag=0;
 require_once '../PHP/login.php';
 $db_server = mysqli_connect($db_hostname, $db_username, $db_password);

 mysqli_select_db($db_server,$db_database);

 ?>


<?php


$query = "SELECT * FROM mess_menu ORDER BY DATEOFFORMATION DESC LIMIT 7";
if ( $result = mysqli_query($db_server,$query)) {
	echo "";}
else {
	echo  nl2br ("Error submitting form result2: " . mysqli_error($db_server)."\n== $query ==\n");}


$outp = array();
while($row = mysqli_fetch_assoc($result)){
    $storage = array();
    $breakfast = array();
    $lunch = array();
    $snacks = array();
    $dinner = array();
    
    foreach ($row as $column => $value){

        $queryi = "Select ITEM_NAME from menu_items where CODE='{$value}'";
		if ( $resulti = mysqli_query($db_server,$queryi)) {
			echo "";}
		else {
		    echo  nl2br ("Error submitting form result2: " . mysqli_error($db_server)."\n== $queryi ==\n");}
        
        $name = mysqli_fetch_assoc($resulti)["ITEM_NAME"];

        
        if (strpos($column, 'BR') !== false) {
            $breakfast[$name] = $value;
        }
        if (strpos($column, 'LU') !== false) {
            $lunch[$name] = $value;
        }
        if (strpos($column, 'SN') !== false) {
            $snacks[$name] = $value;
        }
        if (strpos($column, 'DI') !== false) {
            $dinner[$name] = $value;
        }
    }

    $storage = array( "Breakfast"=> $breakfast,"Lunch"=> $lunch,"Snacks"=> $snacks,"Dinner"=> $dinner);
    $outp[$row["DAY"]] = $storage;   
 
}

$json_output = json_encode($outp, JSON_FORCE_OBJECT);
if (!debug_backtrace()) {
    echo $json_output;
}

?>
