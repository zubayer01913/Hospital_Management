<?php

if(isset($_POST['contact_submitted'])) {

	try {
		if(empty ($_POST['your_name'])) {
			throw new Exception('Name can not be empty');
		}
		
		if(empty ($_POST['your_email'])) {
			throw new Exception('Email can not be empty');
		}
		
		if(!(preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $_POST['your_email']))) {
			throw new Exception("Please enter a valid email address.");
		}
		
		if(empty ($_POST['your_message'])) {
			throw new Exception('Message can not be empty');
		}
		
		
		$c_date = date('Y-m-d');
		
		include('config.php');
		
		$statement = $db->prepare("INSERT INTO contact (your_name,your_email,your_message,c_date) VALUES (?,?,?,?)");
		$statement->execute(array($_POST['your_name'],$_POST['your_email'],$_POST['your_message'],$c_date));
		
		$success_message ='Your Message has been Send successfully.';
	
	
	}
	
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
}

?>


<!--Header Call-->
<?php include('header2.php'); ?>


	<div id="site_content">	
	<!--Call Slider-->  	
	
			<?php
				if(isset($error_message)) {echo "<div class='error'>".$error_message."</div>";}
				if(isset($success_message)) {echo "<div class='success'>".$success_message."</div>";}
			?>			
	
	  <div id="content">
        <div class="content_item">
		  <div class="form_settings">
		  <form action="" method="POST">
            <h2>Send Message</h2>    
				<p><span>Name</span><input class="contact" type="text" name="your_name" value="" placeholder="Enter Your Name here ..."/></p>
				<p><span>Email Address</span><input class="contact" type="text" name="your_email" value="" placeholder="Enter Your E-mail here ..." /></p>
				<p><span>Message</span><textarea class="contact textarea" rows="8" cols="50" name="your_message" placeholder="Enter Your Message here ..."></textarea></p>
		
				<p style="padding-top: 15px"><span>&nbsp;</span><input class="submit" type="submit" name="contact_submitted" value="Send" /></p>
          </div><!--close form_settings-->
		  </form>
		</div><!--close content_item-->
      </div><!--close content-->   
	</div><!--close site_content-->  
	

<!--Footer Call-->
<?php include('footer2.php'); ?>
	
		