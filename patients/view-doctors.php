<?php
ob_start();
session_start();
if($_SESSION['p_id']!="p_id")
{
	header('location: ../index.php');
}
include("../config.php");
?>

<?php

if(isset($_REQUEST['doc_id'])) {

	$doc_id = $_REQUEST['doc_id'];


$statement = $db->prepare("DELETE FROM doctors WHERE doc_id=?");
$statement->execute(array($doc_id));

$success_message2 = "Doctors Profile has been deleted successfully.";

}
?>


<?php include("header.php"); ?>

<h2>View  All Doctors</h2>
<p>&nbsp;</p>
<?php
if(isset($success_message2)) {echo "<div class='success'>".$success_message2."</div>";}
?>
<table class="tbl2" width="100%">
	<tr>
		<th width="5%">Serial</th>
		<th width="25%">Photo</th>
		<th width="20%">Username</th>
		<th width="20%">Designation</th>
		<th width="20%">Action</th>
	</tr>
	
	<?php
		/* ===================== Pagination Code Starts ================== */
		$adjacents = 7;
								
		$i=0;
		$statement = $db->prepare("SELECT * FROM doctors ORDER BY doc_id DESC");
		$statement->execute();
		$total_pages = $statement->rowCount();
	
			$targetpage = $_SERVER['PHP_SELF'];   //your file name  (the name of this file)
			$limit = 50;                                 //how many items to show per page
			$page = @$_GET['page'];
			if($page) 
				$start = ($page - 1) * $limit;          //first item to display on this page
			else
				$start = 0;
			
			$statement = $db->prepare("SELECT * FROM doctors ORDER BY doc_id DESC LIMIT $start, $limit");
			$statement->execute();
			$result = $statement->fetchAll(PDO::FETCH_ASSOC);		
			
			if ($page == 0) $page = 1;                  //if no page var is given, default to 1.
			$prev = $page - 1;                          //previous page is page - 1
			$next = $page + 1;                          //next page is page + 1
			$lastpage = ceil($total_pages/$limit);      //lastpage is = total pages / items per page, rounded up.
			$lpm1 = $lastpage - 1;   
			$pagination = "";
			if($lastpage > 1)
			{   
				$pagination .= "<div class=\"pagination\">";
				if ($page > 1) 
					$pagination.= "<a href=\"$targetpage?page=$prev\">&#171; previous</a>";
				else
					$pagination.= "<span class=\"disabled\">&#171; previous</span>";    
				if ($lastpage < 7 + ($adjacents * 2))   //not enough pages to bother breaking it up
				{   
					for ($counter = 1; $counter <= $lastpage; $counter++)
					{
						if ($counter == $page)
							$pagination.= "<span class=\"current\">$counter</span>";
						else
							$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";                 
					}
				}
				elseif($lastpage > 5 + ($adjacents * 2))    //enough pages to hide some
				{
					if($page < 1 + ($adjacents * 2))        
					{
						for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
						{
							if ($counter == $page)
								$pagination.= "<span class=\"current\">$counter</span>";
							else
								$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";                 
						}
						$pagination.= "...";
						$pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
						$pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";       
					}
					elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
					{
						$pagination.= "<a href=\"$targetpage?page=1\">1</a>";
						$pagination.= "<a href=\"$targetpage?page=2\">2</a>";
						$pagination.= "...";
						for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
						{
							if ($counter == $page)
								$pagination.= "<span class=\"current\">$counter</span>";
							else
								$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";                 
						}
						$pagination.= "...";
						$pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
						$pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";       
					}
					else
					{
						$pagination.= "<a href=\"$targetpage?page=1\">1</a>";
						$pagination.= "<a href=\"$targetpage?page=2\">2</a>";
						$pagination.= "...";
						for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
						{
							if ($counter == $page)
								$pagination.= "<span class=\"current\">$counter</span>";
							else
								$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";                 
						}
					}
				}
				if ($page < $counter - 1) 
					$pagination.= "<a href=\"$targetpage?page=$next\">next &#187;</a>";
				else
					$pagination.= "<span class=\"disabled\">next &#187;</span>";
				$pagination.= "</div>\n";       
			}
			/* ===================== Pagination Code Ends ================== */	
	
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
		$i++;
		?>
			
		<tr>
		<td><?php echo $i; ?></td>
		<td><a href="../uploads/<?php echo $row['doc_pic']; ?>"><img class="Pimg" src="../uploads/<?php echo $row['doc_pic']; ?>" alt="" width="150" height="150"/></a></td>
		<td><?php echo $row['doc_username']; ?></td>
		<td><?php echo $row['designation']; ?></td>
		<td>
			<a class="fancybox" href="#inline<?php echo $i; ?>">View</a>
			<div id="inline<?php echo $i; ?>" style="width:700px;display: none;">
				<h3 style="border-bottom:2px solid #808080;margin-bottom:10px;">View All Data</h3>
				<p>
					<form action="" method="post">
			
				
				
		<table class="tbl1">
		<tr>
			<td>Doctors Photo</td>
		</tr>
		<tr>
		<td><a href="../uploads/<?php echo $row['doc_pic']; ?>"><img  src="../uploads/<?php echo $row['doc_pic']; ?>" alt="Photo" width="230" height="280"/></a></td>
		</tr>
		<tr>
			<td>Name</td>
		</tr>
		<tr>
			<td><input class="short" type="text" name="name" value="<?php echo $name;?>" placeholder="Name"></td>
		</tr>

		<tr>
			<td>Gender</td>
		</tr>
		<tr>
			<td><input type="text" name="sex" value="<?php echo $sex;?>"></td>
		</tr>
		</tr>
		<tr>
			<td>Birthday</td>
		</tr>
		<tr>
				<td>
					<input  class="short" type="text" name="birthday" value="<?php echo $birthday;?>" placeholder="Birthday">	
				</td>
		</tr>
		<tr>
			<td>Designation</td>
		</tr>
		<tr>
			<td><input class="short" type="text" name="designation" value="<?php echo $designation;?>" placeholder="Designation"></td>
		</tr>
		<tr>
			<td>Speciality</td>
		</tr>
		<tr>
			<td><input class="short" type="text" name="speciality" value="<?php echo $speciality;?>" placeholder="Speciality"></td>
		</tr>
		<tr>
			<td>Cosulting Hours</td>
		</tr>
		<tr>
			<td><input class="short" type="text" name="consulting_hour" value="<?php echo $consulting_hour;?>" placeholder="Consulting Hour"></td>
		</tr>
		<tr>
			<td>Consulting Day</td>
		</tr>
		<tr>
			<td><input class="short" type="text" name="consulting_day" value="<?php echo $consulting_day;?>" placeholder="Consulting Day"></td>
		</tr>
		<tr>
			<td>Room No</td>
		</tr>
		<tr>
			<td><input class="short" type="text" name="room_no" value="<?php echo $room_no;?>" placeholder="Room No"></td>
		</tr>
		<tr>
			<td>Contact Number</td>
		</tr>
		<tr>
			<td><input  class="short" type="text" name="contact_num" value="<?php echo $contact_number;?>" placeholder="Contact Number"></td>
		</tr>
		
		<tr>
			<td>Address</td>
		</tr>			
		<tr class="address">
			<td><textarea class="short" name="address" value="" placeholder="Address"><?php echo $address;?></textarea></td>
		</tr>
		<tr>
			<td>Email</td>
		</tr>
		<tr>
			<td><input  class="short" type="text" name="email" value="<?php echo $email;?>"  placeholder="Email"></td>
		</tr>
				</p>
				</table></form>
	</div>
		
		</tr>
		
		<?php
	}
	?>
	
</table>

<div class="pagination">
<?php 
echo $pagination; 
?>
</div>

</br></br>

<?php include("footer.php"); ?>			