<?php require_once('../Connections/hospital.php'); ?>

<?php
ob_start();
session_start();
if($_SESSION['doc_id']!="doc_id")
{
	header('location: login.php');
}
?>


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
if (isset($_POST['p_name'])) {
  $colname_rspatients = $_POST['p_name'];
}
mysql_select_db($database_hospital, $hospital);
$query_rspatients = sprintf("SELECT * FROM patients WHERE p_name LIKE %s", GetSQLValueString("%" . $colname_rspatients . "%", "text"));
$rspatients = mysql_query($query_rspatients, $hospital) or die(mysql_error());
$row_rspatients = mysql_fetch_assoc($rspatients);
$totalRows_rspatients = mysql_num_rows($rspatients);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<p>Search patient by patient name
</p>
<form id="form1" name="form1" method="post" action="">
  <p>
    <label for="p_name"></label>
    <input type="text" name="p_name" id="p_name" />
    <input type="submit" name="submitBtn" id="submitBtn" value="Submit" />
  </p>
  <p>&nbsp;</p>
  <table border="1">
    <tr>
      <td>p_id</td>
      <td>p_pic</td>
      <td>p_username</td>
      <td>p_name</td>
      <td>p_password</td>
      <td>age</td>
      <td>sex</td>
      <td>blood_group</td>
      <td>type_of_disease</td>
      <td>treating_doctor</td>
      <td>room_no</td>
      <td>contact</td>
      <td>p_status</td>
      <td>total_bill</td>
      <td>address</td>
      <td>email</td>
      <td>add_date</td>
    </tr>
    <?php do { ?>
      <tr>
        <td><?php echo $row_rspatients['p_id']; ?></td>
        <td><?php echo $row_rspatients['p_pic']; ?></td>
        <td><?php echo $row_rspatients['p_username']; ?></td>
        <td><?php echo $row_rspatients['p_name']; ?></td>
        <td><?php echo $row_rspatients['p_password']; ?></td>
        <td><?php echo $row_rspatients['age']; ?></td>
        <td><?php echo $row_rspatients['sex']; ?></td>
        <td><?php echo $row_rspatients['blood_group']; ?></td>
        <td><?php echo $row_rspatients['type_of_disease']; ?></td>
        <td><?php echo $row_rspatients['treating_doctor']; ?></td>
        <td><?php echo $row_rspatients['room_no']; ?></td>
        <td><?php echo $row_rspatients['contact']; ?></td>
        <td><?php echo $row_rspatients['p_status']; ?></td>
        <td><?php echo $row_rspatients['total_bill']; ?></td>
        <td><?php echo $row_rspatients['address']; ?></td>
        <td><?php echo $row_rspatients['email']; ?></td>
        <td><?php echo $row_rspatients['add_date']; ?></td>
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
