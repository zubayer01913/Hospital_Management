<?php
ob_start();
session_start();
if($_SESSION['p_id']!="p_id")
{
	header('location: ../index.php');
}
include("../config.php");
?>

<?php
if(isset($_REQUEST['c_id'])) 
{
	$c_id = $_REQUEST['c_id'];
	
	$statement = $db->prepare("DELETE FROM contact WHERE c_id=?");
	$statement->execute(array($c_id));
	
	$success_message2 = "Message has been deleted successfully.";
	
	header('location:user-send-message.php');
}
?>



<?php include("header.php"); ?>

<h2>All User Send Message</h2>
<p>&nbsp;</p>
<?php
if(isset($success_message2)) {echo "<div class='success'>".$success_message2."</div>";}
?>
<table class="tbl2" width="100%">
	<tr>
		<th width="">Serial</th>
		<th width="">Name</th>
		<th width="">Email</th>
		<th width="">Message</th>
	</tr>
	
	<?php
	include("../config.php");
	$i=0;
	$statement = $db->prepare("SELECT * FROM contact  ORDER BY c_id DESC");
	$statement->execute();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	foreach($result as $row)
	{
		$i++;
		?>
		<tr>
			<td><?php echo $i; ?></td>
			<td><?php echo $row['your_name']; ?></td>
			<td><?php echo $row['your_email']; ?></td>
			<td>
			<a class="fancybox" href="#inline<?php echo $i; ?>">View</a>
				<div id="inline<?php echo $i; ?>" style="width:700px;display: none;">
					<h3 style="border-bottom:2px solid #808080;margin-bottom:10px;">View Message</h3>
					<?php echo $row['your_message'];?>
				</div>
		
				
		</tr>
		<?php
	}
	?>
	
</table>
</br></br></br></br>

<?php include("footer.php"); ?>			