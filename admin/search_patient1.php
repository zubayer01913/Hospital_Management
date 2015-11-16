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
if (isset($_POST['p_id'])) {
  $colname_rspatients = $_POST['p_id'];
}
mysql_select_db($database_hospital, $hospital);
$query_rspatients = sprintf("SELECT * FROM patients WHERE p_id LIKE %s", GetSQLValueString("%" . $colname_rspatients . "%", "text"));
$rspatients = mysql_query($query_rspatients, $hospital) or die(mysql_error());
$row_rspatients = mysql_fetch_assoc($rspatients);
$totalRows_rspatients = mysql_num_rows($rspatients);
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
<p>Search patient by patient name
</p>
<form id="form1" name="form1" method="post" action="">
  <p>
    <label for="p_id"></label>
    <input type="text" name="p_id" id="p_id" />
	<br/><br/>
    <input type="submit" name="submitBtn" id="submitBtn" value="Submit" class="btn btn-info" />
  </p>
  <p>&nbsp;</p>
  <table class="table table-bordered table-striped table-hober table-condensed">
    <tr>
      <td>ID</td>
      <td>name</td>
      <td>age</td>
      <td>sex</td>
      <td>type_of_disease</td>
      <td>treating_doctor</td>
      <td>add_date</td>
	  <td>payment</td>
    </tr>
    <?php do { ?>
      <tr>
        <td><?php echo $row_rspatients['p_id']; ?></td>
        <td><?php echo $row_rspatients['p_name']; ?></td>
        <td><?php echo $row_rspatients['age']; ?></td>
        <td><?php echo $row_rspatients['sex']; ?></td>
        <td><?php echo $row_rspatients['type_of_disease']; ?></td>
        <td><?php echo $row_rspatients['treating_doctor']; ?></td>
        <td><?php echo $row_rspatients['add_date']; ?></td>
		<td class="warning"><a href="p_payment_in.php?p_id=<?php echo $row_rspatients['p_id']; ?>"> payment</a> </td>
      </tr>
      <?php } while ($row_rspatients = mysql_fetch_assoc($rspatients)); ?>
  </table>
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rspatients);
?>
