<?php
error_reporting(E_ALL);

require('mysql_connect.php');


$tb = "state_fiscal15";
$county = htmlentities(strtolower($_REQUEST["county"]));
$muni = htmlentities(strtolower($_REQUEST["muni"]));
$q = htmlentities(strtolower($_REQUEST["q"]));
$from = " from " . $tb;
$select = "select distinct fullname ";
$where = " where fullname like '{$q}%' ";
if($county&&!($county=="bing")&&!($county=="lohud")&&!($county=="all")){
    $where .= " and county ='" . $county . "'";
}
if($county=="lohud") {
    $where .= " and county in  ('Westchester','Rockland','Putnam')";
}
if($county=="bing") {
    $where .=" and county in ('Broome','Chemung','Chenango','Cortland','Delaware','Otsego','Schuyler','Steuben','Tompkins','Tioga')";
}
if($muni&&!($muni=="all")) {
    $where .= " and (emp_name = '" . $muni . "')";
}
$order = " ORDER BY 1";
$query = "$select$from$where$order LIMIT 0,10";
$sql = mysql_query($query);
while ($rows = mysql_fetch_array($sql)) {
echo $rows["fullname"] . "\n";
}
?>