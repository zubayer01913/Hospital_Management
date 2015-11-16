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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE patients SET p_room_rent=%s, p_medecine_cost=%s, p_test_cost=%s, p_other_cost=%s WHERE p_id=%s",
                       GetSQLValueString($_POST['p_room_rent'], "int"),
                       GetSQLValueString($_POST['p_medecine_cost'], "int"),
                       GetSQLValueString($_POST['p_test_cost'], "int"),
                       GetSQLValueString($_POST['p_other_cost'], "int"),
                       GetSQLValueString($_POST['p_id'], "int"));

  mysql_select_db($database_hospital, $hospital);
  $Result1 = mysql_query($updateSQL, $hospital) or die(mysql_error());

  $updateGoTo = "p_payment_out.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE patients SET p_room_rent=%s, p_medecine_cost=%s, p_test_cost=%s, p_other_cost=%s, release_date=%s WHERE p_id=%s",
                       GetSQLValueString($_POST['p_room_rent'], "int"),
                       GetSQLValueString($_POST['p_medecine_cost'], "int"),
                       GetSQLValueString($_POST['p_test_cost'], "int"),
                       GetSQLValueString($_POST['p_other_cost'], "int"),
                       GetSQLValueString($_POST['release_date'], "date"),
                       GetSQLValueString($_POST['p_id'], "int"));

  mysql_select_db($database_hospital, $hospital);
  $Result1 = mysql_query($updateSQL, $hospital) or die(mysql_error());

  $updateGoTo = "p_payment_out.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE patients SET p_room_rent=%s, p_medecine_cost=%s, p_test_cost=%s, p_other_cost=%s, release_date=%s WHERE p_id=%s",
                       GetSQLValueString($_POST['p_room_rent'], "int"),
                       GetSQLValueString($_POST['p_medecine_cost'], "int"),
                       GetSQLValueString($_POST['p_test_cost'], "int"),
                       GetSQLValueString($_POST['p_other_cost'], "int"),
                       GetSQLValueString($_POST['release_date'], "date"),
                       GetSQLValueString($_POST['p_id'], "int"));

  mysql_select_db($database_hospital, $hospital);
  $Result1 = mysql_query($updateSQL, $hospital) or die(mysql_error());
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
</style>
</head>

<body>
<p class="align">Payment Details input</p>
<p class="align">ID : <?php echo $row_rspatients['p_id']; ?></p>
<p class="align">Name :<?php echo $row_rspatients['p_name']; ?></p>
<p class="align">Age : <?php echo $row_rspatients['age']; ?></p>
<p class="align">Doctor : <?php echo $row_rspatients['treating_doctor']; ?></p>
<p class="align">Disease : <?php echo $row_rspatients['type_of_disease']; ?></p>
<p>&nbsp;</p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">P_room_rent:</td>
      <td><input type="text" name="p_room_rent" value="<?php echo htmlentities($row_rspatients['p_room_rent'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">P_medecine_cost:</td>
      <td><input type="text" name="p_medecine_cost" value="<?php echo htmlentities($row_rspatients['p_medecine_cost'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">P_test_cost:</td>
      <td><input type="text" name="p_test_cost" value="<?php echo htmlentities($row_rspatients['p_test_cost'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">P_other_cost:</td>
      <td><input type="text" name="p_other_cost" value="<?php echo htmlentities($row_rspatients['p_other_cost'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Release_date:</td>
      <td><input type="date" name="release_date" value="<?php echo htmlentities($row_rspatients['release_date'], ENT_COMPAT, 'utf-8'); ?>" size="32" required/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Update record" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="p_id" value="<?php echo $row_rspatients['p_id']; ?>" />
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rspatients);
?>
