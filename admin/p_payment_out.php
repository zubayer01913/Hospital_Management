<?php require_once('../Connections/hospital.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$colname_rspatients = "-1";
if (isset($_GET['p_id'])) {
  $colname_rspatients = $_GET['p_id'];
}
mysql_select_db($database_hospital, $hospital);
$query_rspatients = sprintf("SELECT * FROM patients WHERE p_id = %s", GetSQLValueString($colname_rspatients, "int"));
$rspatients = mysql_query($query_rspatients, $hospital) or die(mysql_error());
$row_rspatients = mysql_fetch_assoc($rspatients);
$totalRows_rspatients = mysql_num_rows($rspatients);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
.align {
	text-align: center;
}
.align {
	text-align: center;
}
.align {
	text-align: right;
}
.margin {
	left: 30px;
}
.center {
	text-align: center;
}
.center {
	text-align: center;
}
.bold {
	font-weight: bold;
}
Heading {
	font-size: 36px;
}
.large_font {
	font-size: x-large;
}
.large_font .center {
	text-align: center;
}
</style>
</head>

<body leftmargin="20">
<p class="center"><span class="bold">LAB AID HOSPITAL</span></p>
<p class="center">Dhanmondi, Dhaka, Bangladesh</p>
<p class="center">Phone: 01700000000 , 01500000000</p>
<p class="bold">Payment Details	</p>
<p class="bold" align="right">Release Date: <?php echo $row_rspatients['release_date']; ?></p>

<style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 5px;
    text-align: left;
}
</style>

<table align="center"  style="width:75%">
<tr>
	<th>ID</th>
	<td> <?php echo $row_rspatients['p_id']; ?></td>
</tr>

<tr>
	<th>Name</th>
	<td> <?php echo $row_rspatients['p_name']; ?></td>
</tr>

<tr>
	<th>Age</th>
	<td> <?php echo $row_rspatients['age']; ?></td>
</tr>

<tr>
	<th>Treating Doctor</th>
	<td> <?php echo $row_rspatients['treating_doctor']; ?></td>
</tr>

<tr>
	<th>Disease Name</th>
	<td> <?php echo $row_rspatients['type_of_disease']; ?></td>
</tr>

<tr>
		<th>Room rent</th>
		<td><?php echo $row_rspatients['p_room_rent']; ?> Taka</td>
	<tr>
	
	<tr>
		<th>Medicine Cost </th>
		<td><?php echo $row_rspatients['p_medecine_cost']; ?> Taka</td>
	<tr>

	<tr>
		<th>Test Cost</th>
		<td><?php echo $row_rspatients['p_test_cost']; ?> Taka</td>
	<tr>
	
<tr>
		<th>Other Cost</th>
		<td><?php echo $row_rspatients['p_other_cost']; ?> Taka</td>
	<tr>
	
<tr>
		<th>Total</th>
		<td><?php echo $row_rspatients['p_total'];     echo $row_rspatients['p_room_rent']+ $row_rspatients['p_medecine_cost'] + $row_rspatients['p_test_cost'] + $row_rspatients['p_other_cost'];?> Taka</td>
	<tr>

</table>

<span class="center"><br>
</br>
</span>



<table  align="center" style="width:75%">

	
	
</table>

<p class="align">&nbsp;</p>
<p><a href="http://localhost/hospital_management/admin/index.php">Back to home</a></p>
<p class="align"><a href="payment_print.php">Print</a></p>
</body>
</html>
<?php
mysql_free_result($rspatients);
?>
