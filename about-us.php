<!--Header Call-->
<?php include('header.php'); ?>

	<div id="site_content">	
				<!--Call Slider-->  	
		<?php include('slider.php');?>
	<div id="content">
	   <div class="content_item">
	   <?php
			include('config.php');
			$statement = $db->prepare("SELECT * FROM tbl_post WHERE cat_name='About Us' ORDER BY post_id DESC");
						$statement->execute();
						$result = $statement->fetchAll(PDO::FETCH_ASSOC);
						foreach($result as $row)
						{
						
							?>
		  <h1><?php echo $row['post_title'];?></h1> 		  
		  <div class="content_imagetext">
		    <div class="content_image">
		     <a class="lightview" data-lightview-group='products' href="uploads/<?php echo $row['post_image']; ?>"  title=""><img class="p_img" src="uploads/<?php echo $row['post_image']; ?>" alt="" width="150" height="150" /></a>
	        </div>
		    <p><?php echo $row['post_description'];?></p>
			<div class="button_small">
		      <a href="#">Read more</a>
		    </div>
		  </div><!--close content_imagetext-->
			
				<?php
						}
			?>					  
		</div><!--close content_item-->
    </div><!--close content-->  
		<?php include('sidebar.php'); ?>
		
	</div><!--close site_content-->  
	

<!--Footer Call-->
<?php include('footer.php'); ?>

	
		