<?php
ob_start();
session_start();
if($_SESSION['name']!='admin')
{
	header('location: login.php');
}
?>	
<?php
include('config.php');

if(isset($_POST['add_patient'])) {
	
		$username = $_POST['username'];
		$name = $_POST['name'];
		$sex = $_POST['sex'];
		$age = $_POST['age'];
		$contact = $_POST['contact'];
		$address = $_POST['address'];
		$email = $_POST['email'];
		$password = $_POST['password1'];
		
		 $emailCHecker = mysql_real_escape_string($email);
		 $emailCHecker = str_replace("`", "", $emailCHecker);
		 
	   // Database duplicate username check setup for use below in the error handling if else conditionals
		 $statement = $db->prepare("SELECT p_username FROM patients WHERE p_username=?");
		 $statement->execute(array($username));
		 $uname_check = $statement->rowCount();
		 
		 // Database duplicate e-mail check setup for use below in the error handling if else conditionals
		 $statement = $db->prepare("SELECT email FROM patients WHERE email=?");
		 $statement->execute(array($emailCHecker));
		 $email_check = $statement->rowCount();
	 
	try {
		if(empty ($_POST['username'])) {
			throw new Exception('User Name can not be empty');
		}
		//duplicate username check 
		if ($uname_check > 0)  {
			throw new Exception('Your User Name is already in use inside of our system. Please try another.');
		}
		
		if(!(preg_match("/^[A-Za-z][A-Za-z0-9]{5,21}$/", $username))) {
			throw new Exception('Please Enter The Valid User Name');
		}
		if(empty ($_POST['name'])) {
			throw new Exception('Name can not be empty');
		}
		
		if(empty ($_POST['sex'])) {
			throw new Exception('Gender can not be empty');
		}
		if(empty ($_POST['age'])) {
			throw new Exception('Age can not be empty');
		}
		
		if(empty ($_POST['blood_group'])) {
			throw new Exception('Blood Group can not be empty');
		}
		if(empty ($_POST['disease'])) {
			throw new Exception('Disease can not be empty');
		}
		if(empty ($_POST['treating_doctor'])) {
			throw new Exception('Treating Doctor can not be empty');
		}
		if(empty ($_POST['room_no'])) {
			throw new Exception('Room No can not be empty');
		}
		if(empty ($_POST['contact'])) {
			throw new Exception('Contact can not be empty');
		}
		if(empty ($_POST['p_status'])) {
			throw new Exception('Patient Status can not be empty');
		}
		
		if(empty ($_POST['total_bill'])) {
			throw new Exception('Total Bill can not be empty');
		}
		if(empty ($_POST['add_date'])) {
			throw new Exception('Admit Date can not be empty');
		}
		if(empty ($_POST['password1'])) {
			throw new Exception('Password can not be empty');
		}
		if(empty ($_POST['password2'])) {
			throw new Exception('Password can not be empty');
		}
		if($_POST['password1']!= $_POST['password2'] ) {
			throw new Exception('Password does not match');
		}
		
		
		//user login password convert md5 mode
		$password = md5($password);
		
	
		
		include('config.php');
		
		$uploaded_file = $_FILES["p_pic"]["name"];
			$file_basename = substr($uploaded_file, 0, strripos($uploaded_file, '.')); // strip extention
			$file_ext = substr($uploaded_file, strripos($uploaded_file, '.')); // strip name
			$f1 = $_POST['contact']. $file_ext;
			
			if(($file_ext!='.png')&&($file_ext!='.jpg')&&($file_ext!='.jpeg')&&($file_ext!='.gif'))
				throw new Exception("Only jpg, jpeg, png and gif format images are allowed to upload.");
			
		move_uploaded_file($_FILES["p_pic"]["tmp_name"],"../uploads/" . $f1);
			

			
		$statement = $db->prepare("INSERT INTO patients (p_pic, p_username,p_name,p_password,sex,age,blood_group,type_of_disease,treating_doctor,room_no,contact,p_status,total_bill,address,email,add_date) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
		$statement->execute(array($f1, $username,$name,$password,$sex,$age,$_POST['blood_group'],$_POST['disease'],$_POST['treating_doctor'],$_POST['room_no'],$_POST['contact'],$_POST['p_status'],$_POST['total_bill'],$address,$email,$_POST['add_date']));
		
		$success_message ='Patients Registration is Complete Successfully.';
	
	
	}
	
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
}

?>
<!--Call Hearder-->  	
<?php include('header.php');?>

	<h2>Add Patients</h2>
		<p>&nbsp;</p>
		<?php
		if(isset($error_message)) {echo "<div class='error'>".$error_message."</div>";}
		if(isset($success_message)) {echo "<div class='success'>".$success_message."</div>";}
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
			<td><input class="long" type="text" name="name" placeholder="Name"></td>
		</tr>
		<tr>
			<td><input class="short" type="text" name="username" placeholder="Username"></td>
		</tr>
		<tr>
			<td><input type="radio" name="sex" value="Male" checked="checked"> Male &nbsp; &nbsp; <input type="radio"name="sex" value="Female"> Female</td>
		</tr>
	
		<tr >
				<td><input class="short" type="text" name="age" placeholder="Age"></td>
		</tr>
		<tr>
			<td><input class="short" type="text" name="blood_group" placeholder="Blood Group"></td>
		</tr>
		<tr>
			<td><input class="short" type="text" name="disease" placeholder="Type of Disease"></td>
		</tr>
		<tr>
			<td><input class="short" type="text" name="treating_doctor" placeholder="Treating Doctor"></td>
		</tr>
		<tr>
			<td><input class="short" type="text" name="room_no" placeholder="Room Number"></td>
		</tr>
		<tr>
			<td><input  class="short" type="text" name="contact" placeholder="Contact Number"></td>
		</tr>
		<tr>
			<td><input  class="short" type="text" name="p_status" placeholder="Patient Status"></td>
		</tr>
		<tr>
			<td><input  class="short" type="text" name="total_bill" placeholder="Total Bill"></td>
		</tr>
		<tr class="address">
			<td><textarea class="short" name="address" placeholder="Address"></textarea></td>
		</tr>
		<tr>
			<td><input  class="short" type="text" name="email" placeholder="Email"></td>
		</tr>
		<tr>
			<td><input  class="short" type="text" name="add_date" placeholder="Admit Date"></td>
		</tr>
		<tr>
			<td><input  class="short" type="password" name="password1" placeholder="Password"></td>
		</tr>
		<tr>
			<td><input  class="short" type="password" name="password2" placeholder="Confirm Password"></td>
		</tr>
		<tr>
			<td><input type="submit" value="SAVE" name="add_patient"></td>
		</tr>
		</table>	
	</form>





<?php include("footer.php"); ?>			