<?php
ob_start();
session_start();
if(isset($_SESSION['p_username']))
{
	$username=$_SESSION['p_username'];
	
}
else {
	header('location:../index.php');
}
include("../config.php");
?>


	
<?php
include('config.php');

if(isset($_POST['add_patient'])) {
	
	
	
	try {
			$uploaded_file = $_FILES["p_pic"]["name"];
			$file_basename = substr($uploaded_file, 0, strripos($uploaded_file, '.')); // strip extention
			$file_ext = substr($uploaded_file, strripos($uploaded_file, '.')); // strip name
			$f1 = $_POST['contact']. $file_ext;
			
			if(($file_ext!='.png')&&($file_ext!='.jpg')&&($file_ext!='.jpeg')&&($file_ext!='.gif'))
				throw new Exception("Only jpg, jpeg, png and gif format images are allowed to upload.");
			
		move_uploaded_file($_FILES["p_pic"]["tmp_name"],"../uploads/" . $f1);
			
	
		$username = $_SESSION['p_username'];
		
		$statement = $db->prepare("UPDATE patients SET p_pic=?, p_name=?,sex=?,age=?,blood_group=?,type_of_disease=?,treating_doctor=?,room_no=?,contact=?,p_status=?,address=?,email=? WHERE p_username=?");
		$statement->execute(array($f1,$_POST['name'],$_POST['sex'],$_POST['age'],$_POST['blood_group'],$_POST['disease'],$_POST['treating_doctor'],$_POST['room_no'],$_POST['contact'],$_POST['p_status'],$_POST['address'],$_POST['email'],$username));
		
		$success_message = "Patients Profile has been changed successfully.";
		
	
	}
	
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
}

?>
<!--Call Hearder-->  	
<?php include('header.php');?>

	<h2>Edit Patients</h2>
		<p>&nbsp;</p>
		<?php
		if(isset($error_message)) {echo "<div class='error'>".$error_message."</div>";}
		if(isset($success_message)) {echo "<div class='success'>".$success_message."</div>";}
		?>
	<?php
				
					$statement = $db->prepare("SELECT * FROM patients WHERE p_username=? ORDER By p_id");
					$statement->execute(array($username));
					$result = $statement->fetchAll(PDO::FETCH_ASSOC);
					
				foreach($result as $row)
				{
					$p_pic = $row['p_pic'];
					$p_name = $row['p_name'];
					$sex = $row['sex'];
					$age = $row['age'];
					$blood_group = $row['blood_group'];
					$type_of_disease = $row['type_of_disease'];
					$treating_doctor = $row['treating_doctor'];
					$room_no = $row['room_no'];
					$contact = $row['contact'];
					$p_status = $row['p_status'];
					$address = $row['address'];
					$email = $row['email'];
				}
				?>
	<form action="" method="post" enctype="multipart/form-data">

			
		<table class="tbl1">
		
		<tr>
			<td>Add Images</td>
		</tr>
		<tr>
			<td><input type="file" name="p_pic"></td>
		</tr>
		<tr>
			<td><input class="long" type="text" name="name" value="<?php echo $p_name;?>" placeholder="Name"></td>
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
			<td><input class="short" type="text" name="disease" value="<?php echo $type_of_disease;?>" placeholder="Type of Disease"></td>
		</tr>
		<tr>
			<td><input class="short" type="text" name="treating_doctor" value="<?php echo $treating_doctor;?>" placeholder="Treating Doctor"></td>
		</tr>
		<tr>
			<td><input class="short" type="text" name="room_no" value="<?php echo $room_no;?>" placeholder="Room Number"></td>
		</tr>
		<tr>
			<td><input  class="short" type="text" name="contact" value="<?php echo $contact;?>" placeholder="Contact Number"></td>
		</tr>
		<tr>
			<td><input  class="short" type="text" name="p_status" value="<?php echo $p_status;?>" placeholder="Patient Status"></td>
		</tr>
	
		<tr class="address">
			<td><textarea class="short" name="address" value="" placeholder="Address"><?php echo $address;?></textarea></td>
		</tr>
		<tr>
			<td><input  class="short" type="text" name="email" value="<?php echo $email;?>" placeholder="Email"></td>
		</tr>
	
		<tr>
			<td><input type="submit" value="SAVE" name="add_patient"></td>
		</tr>

		</table>

	</form>


<?php include("footer.php"); ?>			