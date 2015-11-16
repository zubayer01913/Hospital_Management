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

$colname_rsblood = "-1";
if (isset($_POST['blood_group'])) {
  $colname_rsblood = $_POST['blood_group'];
}
mysql_select_db($database_hospital, $hospital);
$query_rsblood = sprintf("SELECT * FROM blood WHERE blood_group = %s", GetSQLValueString($colname_rsblood, "text"));
$rsblood = mysql_query($query_rsblood, $hospital) or die(mysql_error());
$row_rsblood = mysql_fetch_assoc($rsblood);
$totalRows_rsblood = mysql_num_rows($rsblood);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">	
		<link rel="stylesheet" type="text/css" href="css/bootstrap-theme.css">
<title>Untitled Document</title>
</head>

<body>
<p>Search blood donor by blood group</p>
<form id="form1" name="form1" method="post" action="">
  <label for="blood_group"></label>
  <input type="text" name="blood_group" id="blood_group" />
  <br/><br/>
  <input type="submit" name="submitBtn" id="submitBtn" value="Submit" class="btn btn-info" />
</form>
<p>&nbsp;</p>
<table class="table table-bordered table-striped table-hober table-condensed">
  <tr>
    <td>b_id</td>
    <td>b_pic</td>
    <td>b_username</td>
    <td>b_name</td>
    <td>sex</td>
    <td>age</td>
    <td>blood_group</td>
    <td>stock</td>
    <td>contact</td>
    <td>b_status</td>
    <td>address</td>
    <td>email</td>
    <td>add_date</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_rsblood['b_id']; ?></td>
      <td><?php echo $row_rsblood['b_pic']; ?></td>
      <td><?php echo $row_rsblood['b_username']; ?></td>
      <td><?php echo $row_rsblood['b_name']; ?></td>
      <td><?php echo $row_rsblood['sex']; ?></td>
      <td><?php echo $row_rsblood['age']; ?></td>
      <td><?php echo $row_rsblood['blood_group']; ?></td>
      <td><?php echo $row_rsblood['stock']; ?></td>
      <td><?php echo $row_rsblood['contact']; ?></td>
      <td><?php echo $row_rsblood['b_status']; ?></td>
      <td><?php echo $row_rsblood['address']; ?></td>
      <td><?php echo $row_rsblood['email']; ?></td>
      <td><?php echo $row_rsblood['add_date']; ?></td>
      
    </tr>
    <?php } while ($row_rsblood = mysql_fetch_assoc($rsblood)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($rsblood);
?>
