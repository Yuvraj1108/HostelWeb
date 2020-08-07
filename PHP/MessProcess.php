
<?php
session_start();
 $flag=0;
 $output = array();

 require_once 'login.php';
 $output['phperror'] = "";
 $output['sqlerror'] = "";
 $db_server = mysqli_connect($db_hostname, $db_username, $db_password);
 mysqli_select_db($db_server,$db_database)
 ?>
<?php
//error handler function

$identity = $_SESSION['ID'];

$extra = array("Q1","Q2","Q3","Q4","Q5","Q6","Q7","breakfast","lunch","snacks","dinner","comment");
$meal_eaten = array( "BREAKFAST" => false, "LUNCH" => false, "DINNER" => false, "SNACKS" => false);
require_once("MessMenu.php");
#error_log("stage1");
#error_log($json_output);
#error_log( implode(',', $_POST));

$jd = cal_to_jd(CAL_GREGORIAN,date("m"),date("d"),date("Y"));
$day =  jddayofweek($jd,1);
                           
     
$query1 = "select BREAKFAST,LUNCH,SNACKS,DINNER from rating_records where identity = '$identity' and CAST(TIMEOFENTRY AS DATE) =curdate();";
$result = mysqli_query($db_server,$query1);
#error_log("stage2");
if(!($result)) {
    #error_log(mysqli_error($db_server). "\n== $query1 ==\n");
    #error_log("stage3A");
}
else{
    $result_arr = mysqli_fetch_assoc($result);   
    #error_log(json_encode($result_arr, JSON_FORCE_OBJECT));
        #error_log("stage3B");
        foreach( $_POST as $stuff_name => $val ) {
            error_log("$stuff_name=>$val");
            if (in_array( $stuff_name,$extra) !== false) {
                error_log("$stuff_name=>$val" . "extra");
                $query1="SELECT * FROM Rating_Records where identity = '$identity' and CAST(TIMEOFENTRY AS DATE) =curdate();";
                $query2 = "UPDATE Rating_Records set $stuff_name='$val' where identity= '$identity' and CAST(TIMEOFENTRY AS DATE) =curdate();";
                $test_result = mysqli_query($db_server,$query1);
                if (! $test_result) error_log(mysqli_error($db_server)."\n");#$output["sqlerror"] += 
                if (mysqli_num_rows($test_result) == 0) {
                    $query1 ="insert into Rating_Records (identity) values('$identity')";
                    if(!mysqli_query($db_server,$query1)){
                       error_log(mysqli_error($db_server). "\n== $query1 ==\n");
                    }
                }

                if (!mysqli_query($db_server,$query2)) {
                    error_log(mysqli_error($db_server)."\n== $query2 ==\n");
                }
                
            
            }
            else{
                #error_log("$stuff_name=>$val" . "notextra");
                if ($val!= '0') {

                    if( in_array($stuff_name, $outp[$day]["Breakfast"]) and $result_arr["BREAKFAST"]=='1' ){
                        continue;                
                    }
                    else {
                        $meal_eaten["BREAKFAST"] = true;
                    }
                    if( in_array($stuff_name, $outp[$day]["Lunch"]) and $result_arr["LUNCH"]=='1' ){
                        continue;                
                    }
                    else {
                        $meal_eaten["LUNCH"] = true;
                    }
                    if( in_array($stuff_name, $outp[$day]["Snacks"]) and $result_arr["SNACKS"]=='1' ){
                        continue;                
                    }
                    else {
                        $meal_eaten["SNACKS"] = true;
                    }
                    if( in_array($stuff_name, $outp[$day]["Dinner"]) and $result_arr["DINNER"]=='1' ){
                        continue;                
                    }
                    else {
                        $meal_eaten["DINNER"] = true;
                    }
                    $getitem_wieght = "Select ITEM_WEIGHT from Menu_items where CODE = '$stuff_name';";
                    if (!($resultme = mysqli_query($db_server,$getitem_wieght))) {
                        #error_log(mysqli_error($db_server)."\n== $getitem_weight ==\n");
                    }
                    $row = mysqli_fetch_assoc($resultme);
                    $Item_weight = $row["ITEM_WEIGHT"];
                    $plusone = $Item_weight + 1;
                    $query="update Menu_items set CURR_RATING=(CURR_RATING* {$Item_weight} + {$val})/($plusone), ITEM_WEIGHT=$plusone where CODE= '$stuff_name'; ";
                    if (!mysqli_query($db_server,$query)) {
                        #error_log(mysqli_error($db_server)."\n== $query ==\n");
                    }
                }
            }
        }

        foreach( $meal_eaten as $curr_meal => $has_eaten){
            if ($has_eaten){
                $query2 = "UPDATE Rating_Records set $curr_meal=1 where identity= '$identity' and CAST(TIMEOFENTRY AS DATE) =curdate();";
                #error_log("Updating");
                if(!mysqli_query($db_server,$query2)){
                        error_log(mysqli_error($db_server). "\n== $query1 ==\n");
                    }
            }
        }
}
echo json_encode($output);
#error_log("stagefinal");


?>