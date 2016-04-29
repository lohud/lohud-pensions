<?php
$pageref = "NYS Retirement 2014";
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
if($_GET['county']){
    $county = htmlentities($_GET['county']) ;
}
if($_GET['frm_muni']){
    $muni = htmlentities($_GET['frm_muni']) ;
}
if($_GET['frm_muni'] == "PORT AUTHORITY OF NY & NJ"){
    $muni = $_GET['frm_muni'] ;
}
if($_GET['frm_name']){
    $name = htmlentities($_GET['frm_name']) ;
}
if($_GET['frm_100k']=="yes"){
    $f100k = true; 
}
if($_GET['frm_local']=="yes"){
    $local = true; 
}
if($_GET['year']){
    $year = htmlentities($_GET['year']) ;
}
$from = " from state_fiscal14";
$select = "select id, type, fullname, annual_benefit, emp_name, county, system, tier, retire_date, years_credit";
$where = " where 1";
if($county&&!($county=="bing")&&!($county=="lohud")&&!($county=="all")&&!($county=="pks")){
    $where .= " and county ='" . $county . "'";
}
if($county=="lohud"){
    $where .= " and county in ('Westchester','Rockland','Putnam')";
}
if($county=="bing"){
    $where .=" and county in ('Broome','Chemung','Chenango','Cortland','Delaware','Otsego','Schuyler','Steuben','Tompkins','Tioga')";

}
if($county=="pks"){
    $where .=" and county in ('Dutchess','Ulster')";
}
if($muni&&!($muni=="all")){
    $where .= " and (emp_name = '" . $muni . "')";
}
if($name){
    $where .= " and fullname like '" . $name . "%'";
}
if($f100k){
    $where .= " and annual_benefit > 100000";
}
if($local){
    $where .= ' and left(loc_code,1) > 0 ';
}    
if(($year)&&!($year=="all")){
    $where .= ' and year(retire_date) =  ' . $year;
}
$order = " ORDER BY annual_benefit DESC";
$sql = "$select$from$where$order";

include('header.php');

require_once('Datagrid.php');
$params['hostname'] = 'localhost';
$params['username'] = 'php_user';
$params['password'] = 'datadesk';
$params['database'] = 'retire';
function getQueryStringLocal($startnum = null,$exception = null) {
    if ($startnum === null) {
        $startnum = !empty($_GET['start']) ? $_GET['start'] : 0;
    }
    $_GET['start'] = $startnum;
    $qs = '';
    foreach ($_GET as $k => $v) {
        if(!($k == $exception))
        $qs .= urlencode($k) . '=' . urlencode($v)  . '&';
    }
    // If the query string is just a question mark, lose it
    if ($qs == '?') {
        $qs = '';
    }
    return preg_replace('/&$/', '', $qs);
}
$grid = RGrid::Create($params, $sql);
$grid->showHeaders = true;
// $select = "select fullname, annual_benefit, emp_name, county, system, tier, retire_date, years_credit";
$grid->SetDisplayNames(array(   
    'id'                => 'Detail',  
    'type'              => 'Type',   
    'fullname'          => 'Name',
    'annual_benefit'    => 'Annual pension',
    'emp_name'          => 'Last employer',
    'county'            => 'County',
    'system'            => 'System',                             
    'tier'              => 'Tier',
    'retire_date'       => 'Retire date',
    'years_credit'      => 'Years credited',
));
$grid->NoSpecialChars('id');
$grid->SetPerPage(15);
$grid->AddCallback('RowCallback');
function RowCallback(&$row){ // The ampersand is so that any changes made are reflected in the final grid
    $row['id'] = '<a href = "retire_detail_2014.php?id=' . $row['id'] .'">Detail</a>';
    $row['annual_benefit'] = '$'. number_format($row['annual_benefit']);
    $row["retire_date"] = date("n/j/Y",strtotime($row["retire_date"]));
}
$grid->Display()
?>

