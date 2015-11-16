  <div class="sidebar_container">        		
		<div class="sidebar">
          <div class="sidebar_item">
            <h2>Notice</h2>
			 <?php
			include('config.php');
			$statement = $db->prepare("SELECT * FROM tbl_post WHERE cat_name='Notice' ORDER BY post_id DESC");
						$statement->execute();
						$result = $statement->fetchAll(PDO::FETCH_ASSOC);
						foreach($result as $row)
						{
						
							?>
            <h3><?php echo $row['post_date'];?></h3>
            <h4><?php echo $row['post_title'];?></h4>
            <p><?php echo $row['post_description'];?></p> 
			<?php
						}
			?>						
		  </div><!--close sidebar_item--> 
        </div><!--close sidebar-->
        <div class="sidebar">
          <div class="sidebar_item">
            <h2>Contact Info</h2>
            <p>Phone: +88-01914840253</p>
            <p>Email: <a href="mailto:ariful@gmail.com">ariful@gmail.com</a></p>
          </div><!--close sidebar_item--> 
        </div><!--close sidebar-->
       </div><!--close sidebar_container-->	