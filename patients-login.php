<?php

if(isset($_POST['form_login'])) {

	try {
		if(empty ($_POST['username'])) {
			throw new Exception('User Name can not be empty');
		}
		
		if(empty ($_POST['password'])) {
			throw new Exception('Password can not be empty');
		
		}

		
		$password = $_POST['password'];  //user login password convert md5 mode
		$password = md5($password);
		
		include('config.php');
		
		$num=0;
		$statement = $db->prepare("SELECT * FROM patients WHERE p_username=? and p_password=?  ORDER BY p_id");
		$statement->execute(array($_POST['username'],$password));		
		$num = $statement->rowCount();
		
		if($num>0)
		{	
			session_start();
			
			$_SESSION['p_id'] = "p_id";
			$_SESSION['p_username'] = $_POST['username'];
			
			header('location: patients/index.php');
			
		}
		else
		{
			throw new Exception ('User Name , Password  are Invalid');
		
		}
	
	}
	
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
	
}

?>





<!--Call Hearder-->  	
<?php include('header2.php');?>
<div id="site_content">	
	<div class="main2">
		
<div class="login2">
				<h2>Patient Login Page</h2>
		</div>
		<div class="header2">
			<div class="logo2 error">
				</br>
				<?php
					if(isset($error_message)) {echo $error_message;}
				?>
			</div>
		
			<div class="login_box2">
				<form action="" method="post">
				
				<div class="username2">
					<b>User Name  : <input type="text"name="username"></b>
				</div>
				<div class="password2">
					<b>Password  : <input type="password" name="password"></b>
				</div>
				
				<div class="login_button2">
					<p><input type="submit" value="Login" name="form_login"></p>
				</div>
				</br>
				</form>
			</div>
		</div>
	</div>
</div><!--close site_content--> 
	
<!--Call Footer-->  	
<?php include('footer2.php');?>	


