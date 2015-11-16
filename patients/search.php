<?php require_once('Connections/doctors.php'); ?>
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

$colname_rsDoctors = "-1";
if (isset($_POST['doc_id'])) {
  $colname_rsDoctors = $_POST['doc_id'];
}
mysql_select_db($database_doctors, $doctors);
$query_rsDoctors = sprintf("SELECT * FROM doctors WHERE doc_id = %s", GetSQLValueString($colname_rsDoctors, "int"));
$rsDoctors = mysql_query($query_rsDoctors, $doctors) or die(mysql_error());
$row_rsDoctors = mysql_fetch_assoc($rsDoctors);
$totalRows_rsDoctors = mysql_num_rows($rsDoctors);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
 <p>Search Doctors </p>
 <form id="form1" name="form1" method="post" action="">
   <label for="doc_id"></label>
   <input type="text" name="doc_id" id="doc_id" />
   <input type="submit" name="submitBtn" id="submitBtn" value="Search" />
 </form>
 <p>&nbsp;</p>
<table border="1">
   <tr>
     <td>doc_id</td>
     <td>name</td>
     <td>designation</td>
     <td>speciality</td>
     <td>consulting_hour</td>
     <td>consulting_day</td>
     <td>room_no</td>
     <td>contact</td>
   </tr>
   <?php do { ?>
     <tr>
       <td><?php echo $row_rsDoctors['doc_id']; ?></td>
       <td><?php echo $row_rsDoctors['name']; ?></td>
       <td><?php echo $row_rsDoctors['designation']; ?></td>
       <td><?php echo $row_rsDoctors['speciality']; ?></td>
       <td><?php echo $row_rsDoctors['consulting_hour']; ?></td>
       <td><?php echo $row_rsDoctors['consulting_day']; ?></td>
       <td><?php echo $row_rsDoctors['room_no']; ?></td>
       <td><?php echo $row_rsDoctors['contact']; ?></td>
     </tr>
     <?php } while ($row_rsDoctors = mysql_fetch_assoc($rsDoctors)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($rsDoctors);
?>
