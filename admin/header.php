<?php
ob_start();
if($_SESSION['name']!='admin')
{
	header('location: login.php');
}
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Hospital Management</title>
	<link rel="stylesheet" href="style-admin.css">
	<script type='text/javascript'>
	function confirmDelete()
	{
		return confirm("Do you sure want to delete this data?");
	}
	</script>
		<!--Deliver Permission Code by Java Script-->
	<script>
		function confirm_deliver() {
			return confirm('are you sure! you want to Approver This Order?') ;}
	</script>
	<!-- Fancybox jQuery -->
	<script type="text/javascript" src="../fancybox/jquery-1.9.0.min.js"></script>
	<script type="text/javascript" src="../fancybox/jquery.fancybox.js"></script>
	<script type="text/javascript" src="../fancybox/main.js"></script>
	<link rel="stylesheet" type="text/css" href="../fancybox/jquery.fancybox.css" />
	<!-- //Fancybox jQuery -->
	
	<!-- CKEditor Start -->
	<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
	<!-- // CKEditor End -->
</head>
<body>


	<div id="wrapper">
		<div id="header">
			<h1>Admin Panel</h1>
		</div>
		<div id="container">
			<div id="sidebar">
				<h2>User Options</h2>
				<ul>
					<li><a href="index.php">Home</a></li>
					<li><a href="change-your-profile.php">Edit Profile</a></li>
					<li><a href="logout.php">Logout</a></li>
				</ul>
				<h2>Page Options</h2>
				<ul>
					<li><a href="post-add.php">Add Post</a></li>
					<li><a href="post-view.php">View Post</a></li>
					<li><a href="manage-category.php">Manage Category</a></li>

				</ul>
				<h2>Doctor</h2>
				<ul>
					<li><a href="add-doctors.php">Add Doctor</a></li>
					<li><a href="view-doctors.php">Show All Doctor</a></li>
                    <li><a href="search_doctor.php">Search Doctor</a></li>
				</ul>
				<h2>Patient</h2>
				<ul>
					<li><a href="add-patients.php">Add Patient</a></li>
					<li><a href="view-patients.php">Show All Patient</a></li>
					<li><a href="search_patient.php">Search Patient</a></li>
                    <li><a href="search_patient1.php">Payment</a></li>
				</ul>
				<h2>Blood Donor</h2>
				<ul>
					<li><a href="add-blood-doner.php">Add Blood Doner</a></li>
					<li><a href="view-blood-doner.php">Show All Blood Doner</a></li>
					<li><a href="search_blood_donor.php">Search Blood Doner</a></li>
				</ul>
				<h2>Contact Us</h2>
				<ul>
					<li><a href="user-send-message.php">View Message</a></li>
				</ul>
				<p>&nbsp;</p>
			</div>
			<div id="content">