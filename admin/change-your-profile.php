<?php
ob_start();
session_start();
if($_SESSION['name']!='admin')
{
	header('location: ../index.php');
}
include("../config.php");
?>

<?php
if(isset($_POST['form1'])) {
	
	try {
	
		if(empty($_POST['old'])) {
			throw new Exception("Old Password field can not be empty");
		}
		
		if(empty($_POST['new1'])) {
			throw new Exception("New Password field can not be empty");
		}
		
		if(empty($_POST['new2'])) {
			throw new Exception("Confirm Password field can not be empty");
		}
		
		$statement = $db->prepare("SELECT * FROM admin WHERE id=1");
		$statement->execute();
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row)
		{
			
			$old_password = md5($_POST['old']);
			if($old_password != $row['password'])
			{
				throw new Exception("Old Password is wrong.");
			}
					
		}
		
		if($_POST['new1'] != $_POST['new2'])
		{
			throw new Exception("New Password and Confirm Password does not match.");
		}
		
		
		$new_final_password = md5($_POST['new1']);
		
		$statement = $db->prepare("UPDATE admin SET username=?, name=?, password=?  WHERE id=1");
		$statement->execute(array($_POST['username'],$_POST['name'],$new_final_password,));
		
		$success_message = "Admin Profile has been changed successfully.";
		
	
	}
	
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
	
	
}
?>

<?php include("header.php"); ?>
<h2>Change Your Profile</h2>
<p>&nbsp;</p>
<?php
if(isset($error_message)) {echo "<div class='error'>".$error_message."</div>";}
if(isset($success_message)) {echo "<div class='success'>".$success_message."</div>";}
?>
<form action="" method="post">

	<?php
	$statement = $db->prepare("SELECT * FROM admin WHERE id=1 ORDER BY id ASC");
	$statement->execute();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	foreach($result as $row)
	{
		$old_username=$row['username'];
		$old_name=$row['name'];	
	}
	?>
	
<table class="tbl1">
<tr>
	<td>New Username</td>
</tr>
<tr>
	<td><input class="short" type="text" name="username" value="<?php echo $old_username;?>"></td>
</tr>
<tr>
	<td>Name</td>
</tr>
<tr>
	<td><input class="short" type="text" name="fullname" value="<?php echo $old_name;?>"></td>
</tr>
<tr>
	<td>Old Password</td>
</tr>
<tr>
	<td><input class="short" type="password" name="old"></td>
</tr>
<tr>
	<td>New Password</td>
</tr>
<tr>
	<td><input class="short" type="password" name="new1"></td>
</tr>
<tr>
	<td>Confirm Password</td>
</tr>
<tr>
	<td><input class="short" type="password" name="new2"></td>
</tr>
<tr>
	<td><input type="submit" value="UPDATE" name="form1"></td>
</tr>
</table>	
</form>

<h2>View Your Profile</h2>
<p>&nbsp;</p>
<table class="tbl2" width="100%">
	<tr>
		<th width="10%">ID. No</th>
		<th width="30%">Username</th>
		<th width="50%">Name</th>
	</tr>
	
	<?php
	$i=0;
	$statement = $db->prepare("SELECT * FROM admin WHERE id=1 ORDER BY id ASC");
	$statement->execute();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	foreach($result as $row)
	{
		$i++;
		?>
			
		<tr>
			<td><?php echo $i;?></td>
			<td><?php echo $row['username']; ?></td>
			<td><?php echo $row['name']; ?></td>
		</tr>
		<?php
	}
	?>
	
</table>

<?php include("footer.php"); ?>			