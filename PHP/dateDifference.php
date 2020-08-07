<?php
function Age($DOB)
 {
  $date2=date_create(date("Y-m-d"));
  $date1=date_create($DOB);
  $age = date_diff($date1,$date2);
  return ($age->format("%R%a"))/365;
 }
 $age= Age('1997-08-02');
 echo $age;
?>