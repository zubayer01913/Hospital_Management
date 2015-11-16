<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_hospital = "localhost";
$database_hospital = "hospital";
$username_hospital = "rimon";
$password_hospital = "123456";
$hospital = mysql_pconnect($hostname_hospital, $username_hospital, $password_hospital) or trigger_error(mysql_error(),E_USER_ERROR); 
?>