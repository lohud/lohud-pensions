<?php
$id = htmlentities($_GET['id']);

require('mysql_connect2.php');

$from = " from state_fiscal14";
$select = "select *";
$where = " where id =" . $id;


$order = "";
$sql = "$select$from$where$order";
$pageref = "NYS Retirement 2014";
$result = mysql_query($sql) or die('Error, query failed:' . $sql);
$row = mysql_fetch_array($result);

include('header.php')   
?>

<h3 class = "pcase">State retiree detail -- Fiscal 2014</h3>
<table class = "sofT" border>
	<tr>
		<td class = "helpHed">Name</td>
		<td class = "helpBod"><? echo($row['fullname']); ?></td>
		<td class = "helpHed">Last employer</td>
		<td class = "helpBod"><? echo($row['emp_name']);?></td>	
	</tr>
	<tr>
		<td class = "helpHed">Annual Benefit</td>
		<td class = "helpBod"><? echo(number_format($row['annual_benefit']));?></td>
		<td class = "helpHed">System/Tier</td>
		<td class = "helpBod"><? echo($row['system'] . "/" . $row['tier']);?> (System 2 = police, fire)</td>	
	</tr>
	<tr>
		<td class = "helpHed">Retirement date</td>
		<td class = "helpBod"><? echo(date("n/j/Y",strtotime($row['retire_date'])));?></td>
		<td class = "helpHed">Years of employment credited</td>
		<td class = "helpBod"><? echo($row['years_credit']);?></td>	
	</tr>
	<tr>
		<td class = "helpHed">Date of membership in retirement system</td>
		<td class = "helpBod"><? echo(date("n/j/Y",strtotime($row['memb_date'])));?></td>
		<td class = "helpHed">Final Average Salary used to calculate benefit</td>
		<td class = "helpBod"><? echo(number_format($row['final_avg_salary']));?></td>	
	</tr>
</table>
</body>