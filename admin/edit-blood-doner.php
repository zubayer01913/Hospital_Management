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

if(isset($_REQUEST['b_id'])) {

	$b_id = $_REQUEST['b_id'];
}
?>
	
<?php
include('config.php');

if(isset($_POST['add_blood_doner'])) {
	
	
	
	try {
			$uploaded_file = $_FILES["b_pic"]["name"];
			$file_basename = substr($uploaded_file, 0, strripos($uploaded_file, '.')); // strip extention
			$file_ext = substr($uploaded_file, strripos($uploaded_file, '.')); // strip name
			$f1 = $_POST['contact']. $file_ext;
			
			if(($file_ext!='.png')&&($file_ext!='.jpg')&&($file_ext!='.jpeg')&&($file_ext!='.gif'))
				throw new Exception("Only jpg, jpeg, png and gif format images are allowed to upload.");
			
		move_uploaded_file($_FILES["b_pic"]["tmp_name"],"../uploads/" . $f1);
			
	
			
		$statement = $db->prepare("UPDATE blood SET b_pic=?, b_name=?,sex=?,age=?,blood_group=?,stock=?,contact=?,b_status=?,address=?,email=?,add_date=? WHERE b_id=?");
		$statement->execute(array($f1,$_POST['name'],$_POST['sex'],$_POST['age'],$_POST['blood_group'],$_POST['stock'],$_POST['contact'],$_POST['b_status'],$_POST['address'],$_POST['email'],$_POST['add_date'],$b_id));
		
		$success_message = "Blood Doner Profile has been changed successfully.";
		
	
	}
	
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
}

?>
<!--Call Hearder-->  	
<?php include('header.php');?>

	<h2>Edit Blood Doner</h2>
		<p>&nbsp;</p>
		<?php
		if(isset($error_message)) {echo "<div class='error'>".$error_message."</div>";}
		if(isset($success_message)) {echo "<div class='success'>".$success_message."</div>";}
		?>
	<?php
				
					$statement = $db->prepare("SELECT * FROM blood WHERE b_id=? ORDER By b_id");
					$statement->execute(array($b_id));
					$result = $statement->fetchAll(PDO::FETCH_ASSOC);
					
				foreach($result as $row)
				{
					$b_pic = $row['b_pic'];
					$b_name = $row['b_name'];
					$sex = $row['sex'];
					$age = $row['age'];
					$blood_group = $row['blood_group'];
					$stock = $row['stock'];
					$contact = $row['contact'];
					$b_status = $row['b_status'];
					$address = $row['address'];
					$email = $row['email'];
					$add_date = $row['add_date'];	
				}
				?>
	<form action="" method="post" enctype="multipart/form-data">

			
		<table class="tbl1">
		
		<tr>
			<td>Add Images</td>
		</tr>
		<tr>
			<td><input type="file" name="b_pic"></td>
		</tr>
		<tr>
			<td><input class="long" type="text" name="name" value="<?php echo $b_name;?>" placeholder="Name"></td>
		</tr>
		
		<tr>
			<td><input type="text" name="sex" value="<?php echo $sex;?>"></td>
		</tr>
	
		<tr >
				<td><input class="short" type="text" name="age" value="<?php echo $age;?>" placeholder="Age"></td>
		</tr>
		<tr>
			<td><input class="short" type="text" name="blood_group" value="<?php echo $blood_group;?>" placeholder="Blood Group"></td>
		</tr>
		<tr>
			<td><input class="short" type="text" name="stock" value="<?php echo $stock;?>" placeholder="Blood Stock"></td>
		</tr>
		</tr>
		<tr>
			<td><input  class="short" type="text" name="contact" value="<?php echo $contact;?>" placeholder="Contact Number"></td>
		</tr>
		<tr>
			<td><input  class="short" type="text" name="b_status" value="<?php echo $b_status;?>" placeholder="Doner Status"></td>
		</tr>
	
		<tr class="address">
			<td><textarea class="short" name="address" value="" placeholder="Address"><?php echo $address;?></textarea></td>
		</tr>
		<tr>
			<td><input  class="short" type="text" name="email" value="<?php echo $email;?>" placeholder="Email"></td>
		</tr>
		<tr>
			<td><input  class="short" type="text" name="add_date" value="<?php echo $add_date;?>" placeholder="Admit Date"></td>
		</tr>
	
		<tr>
			<td><input type="submit" value="SAVE" name="add_blood_doner"></td>
		</tr>

		</table>

	</form>


<?php include("footer.php"); ?>			