<?php
header("Content-Type: application/json; charset=UTF-8");
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
// change db_username, db_password and db_name to suit your system

require('mysql_connect.php');


$json = array();
// Lets get the variables we passed
$id = isset($_GET['id']) ? (string) $_GET['id'] : '';
$var_changed = isset($_GET['var_changed']) ? (string) $_GET['var_changed'] : '';
$var_target = isset($_GET['var_target']) ? (string) $_GET['var_target'] : '';
// Cleans query string before we run the selects below.
// Allows A-Z, a-z, 0-9, whitespace, minus/hyphen, equals, ampersand, underscore, and period/full stop.
$id = preg_replace("/[^A-Za-z0-9\s\-\=\&\_\.]/","", $id);
$var_changed = mysql_real_escape_string($var_changed);
$var_target= mysql_real_escape_string($var_target);
if($id){
    $query = "SELECT emp_name FROM lkp_emps_2014 WHERE county = '" . $id . "'";  
}
if($query=="") {
echo("[{optionValue: 'all', optionDisplay: 'Choose a state to see counties'}]");
} else {
  $query .= " order by 1";
  $json[] = "{optionValue: 'all', optionDisplay: 'All'}";
  $sql = mysql_query($query);
  //echo $query;
  while ($rows = mysql_fetch_array($sql)) {
     $json[] = "{optionValue: '". addslashes($rows[0])."', optionDisplay: '". addslashes($rows[0])."'}";
  }
  echo '[' . implode(',', $json) . ']';
}
?>
