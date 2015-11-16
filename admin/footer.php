<?php
ob_start();
if($_SESSION['name']!='admin')
{
	header('location: login.php');
}
?>

</div>
		</div>
		
	</div>
		<div class="footer_text">
			<h3>Copyright &copy; 2015. All Right Reserved.</h3>
			<p>Designed by rimon & biplob</p>
		</div>
	
</body>
</html>