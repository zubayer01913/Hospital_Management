<?php
ob_start();
session_start();
if($_SESSION['doc_id']!="doc_id")
{
	header('location: login.php');
}
?>
<?php include("header.php"); ?>
<h2> Welcome to Admin Panel</h2>
<div style="font-weight:bold;color:#3d9ccd;font-size:28px;text-align:center;padding-top:50px; line-height:35px;">
	Welcome to the dashboard of <br>
	Hospital Management<br><p style="font-size:18px;">Designed by rimon & biplob<p>
</div>
<?php include("footer.php"); ?>			