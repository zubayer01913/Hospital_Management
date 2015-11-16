<?php
ob_start();
session_start();
if(isset($_SESSION['doc_username']))
{
	$username=$_SESSION['doc_username'];
	
}
else {
	header('location:../index.php');
}
include("../config.php");
?>


	
<?php
include('config.php');


if(isset($_POST['update_doctors'])) {
	
	$birthday = $_POST['birthday'];
	
	try {
	
			$uploaded_file = $_FILES["doc_pic"]["name"];
			$file_basename = substr($uploaded_file, 0, strripos($uploaded_file, '.')); // strip extention
			$file_ext = substr($uploaded_file, strripos($uploaded_file, '.')); // strip name
			$f1 = $_POST['contact']. $file_ext;
			
			if(($file_ext!='.png')&&($file_ext!='.jpg')&&($file_ext!='.jpeg')&&($file_ext!='.gif'))
				throw new Exception("Only jpg, jpeg, png and gif format images are allowed to upload.");
			
		move_uploaded_file($_FILES["doc_pic"]["tmp_name"],"../uploads/" . $f1);
			
		$username = $_SESSION['doc_username'];
		
		$statement = $db->prepare("UPDATE doctors SET  doc_pic=?, name=?,  sex=?, birthday=?, designation=?, speciality=?, consulting_hour=?, consulting_day=?, room_no=?, contact=?, address=?, email=? WHERE doc_username=?");
		$statement->execute(array($f1, $_POST['name'],$_POST['sex'],$birthday,$_POST['designation'],$_POST['speciality'],$_POST['consulting_hour'],$_POST['consulting_day'],$_POST['room_no'],$_POST['contact'],$_POST['address'],$_POST['email'],$username));
		
		$success_message = "Doctors Profile has been changed successfully.";
		
	
	}
	
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
}

?>
<!--Call Hearder-->  	
<?php include('header.php');?>

	<h2>Update Your Profile</h2>
		<p>&nbsp;</p>
		<?php
		if(isset($error_message)) {echo "<div class='error'>".$error_message."</div>";}
		if(isset($success_message)) {echo "<div class='success'>".$success_message."</div>";}
		?>
	<?php
				
					$statement = $db->prepare("SELECT * FROM doctors WHERE doc_username=? ORDER By doc_id");
					$statement->execute(array($username));
					$result = $statement->fetchAll(PDO::FETCH_ASSOC);
					
				foreach($result as $row)
				{
					$doc_pic = $row['doc_pic'];
					$name = $row['name'];
					$sex = $row['sex'];
					$birthday = $row['birthday'];
					$designation = $row['designation'];
					$speciality = $row['speciality'];
					$consulting_hour = $row['consulting_hour'];
					$consulting_day = $row['consulting_day'];
					$room_no = $row['room_no'];
					$contact_number = $row['contact'];
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
			<td><input type="file" name="doc_pic"></td>
		</tr>
		<tr>
			<td><input class="short" type="text" name="name" value="<?php echo $name;?>" placeholder="Name"></td>
		</tr>


		<tr>
			<td><input type="text" name="sex" value="<?php echo $sex;?>"></td>
		</tr>
		</tr>
		<tr >
				<td><input  class="short" type="text" name="birthday" value="<?php echo $birthday;?>" placeholder="Birthday"></td>
				
		</tr>
		<tr>
			<td><input  class="short" type="text" name="designation" value="<?php echo $designation;?>" placeholder="Designation"></td>
		</tr>
		<tr>
			<td><input  class="short" type="text" name="speciality" value="<?php echo $speciality;?>" placeholder="Speciality"></td>
		</tr>
		<tr>
			<td><input  class="short" type="text" name="consulting_hour" value="<?php echo $consulting_hour;?>" placeholder="Consulting hour"></td>
		</tr>
		<tr>
			<td><input  class="short" type="text" name="consulting_day" value="<?php echo $consulting_day;?>" placeholder="Consulting day"></td>
		</tr>
		<tr>
			<td><input  class="short" type="text" name="room_no" value="<?php echo $room_no;?>" placeholder="Room No"></td>
		</tr>
		<tr>
			<td><input  class="short" type="text" name="contact" value="<?php echo $contact_number;?>" placeholder="Contact Number"></td>
		</tr>
	
					
		<tr class="address">
			<td><textarea class="short" name="address" value="" placeholder="Address"><?php echo $address;?></textarea></td>
		</tr>
		<tr>
			<td><input  class="short" type="text" name="email" value="<?php echo $email;?>"  placeholder="Email"></td>
		</tr>
		
	
		<tr>
			<td><input type="submit" value="SAVE" name="update_doctors"></td>
		</tr>

		</table>

	</form>


<?php include("footer.php"); ?>			