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

$colname_rsDoctor = "-1";
if (isset($_POST['doc_username'])) {
  $colname_rsDoctor = $_POST['doc_username'];
}
mysql_select_db($database_hospital, $hospital);
$query_rsDoctor = sprintf("SELECT * FROM doctors WHERE doc_username LIKE %s", GetSQLValueString("%" . $colname_rsDoctor . "%", "text"));
$rsDoctor = mysql_query($query_rsDoctor, $hospital) or die(mysql_error());
$row_rsDoctor = mysql_fetch_assoc($rsDoctor);
$totalRows_rsDoctor = mysql_num_rows($rsDoctor);
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
<p>Search Doctors by Doctor Name</p>
<form id="form1" name="form1" method="post" action="">
  <label for="doc_username"></label>
  <input type="text" name="doc_username" id="doc_username" />
  <br/><br/>
  <input type="submit" name="submitBtn" id="submitBtn" value="Submit" class="btn btn-info" />
</form>
<p>&nbsp;</p>
<table class="table table-bordered table-striped table-hober table-condensed">
  <tr>
    <td>doc_id</td>
    <td>doc_pic</td>
    <td>name</td>
    <td>doc_username</td>
    <td>sex</td>
    <td>birthday</td>
    <td>designation</td>
    <td>speciality</td>
    <td>consulting_hour</td>
    <td>consulting_day</td>
    <td>room_no</td>
    <td>address</td>
    <td>email</td>
    <td>contact</td>
    <td>add_date</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_rsDoctor['doc_id']; ?></td>
      <td><?php echo $row_rsDoctor['doc_pic']; ?></td>
      <td><?php echo $row_rsDoctor['name']; ?></td>
      <td><?php echo $row_rsDoctor['doc_username']; ?></td>
      <td><?php echo $row_rsDoctor['sex']; ?></td>
      <td><?php echo $row_rsDoctor['birthday']; ?></td>
      <td><?php echo $row_rsDoctor['designation']; ?></td>
      <td><?php echo $row_rsDoctor['speciality']; ?></td>
      <td><?php echo $row_rsDoctor['consulting_hour']; ?></td>
      <td><?php echo $row_rsDoctor['consulting_day']; ?></td>
      <td><?php echo $row_rsDoctor['room_no']; ?></td>
      <td><?php echo $row_rsDoctor['address']; ?></td>
      <td><?php echo $row_rsDoctor['email']; ?></td>
      <td><?php echo $row_rsDoctor['contact']; ?></td>
      <td><?php echo $row_rsDoctor['add_date']; ?></td>
    </tr>
    <?php } while ($row_rsDoctor = mysql_fetch_assoc($rsDoctor)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($rsDoctor);
?>
