<?php
ob_start();
session_start();
if($_SESSION['doc_id']!="doc_id")
{
	header('location: ../index.php');
}
include("../config.php");
?>

<?php

if(isset($_REQUEST['p_id'])) {

	$p_id = $_REQUEST['p_id'];


$statement = $db->prepare("DELETE FROM patients WHERE p_id=?");
$statement->execute(array($p_id));

$success_message2 = "Patients Profile has been deleted successfully.";

}
?>


<?php include("header.php"); ?>

<h2>View  All Patients</h2>
<p>&nbsp;</p>
<?php
if(isset($success_message2)) {echo "<div class='success'>".$success_message2."</div>";}
?>
<table class="tbl2" width="100%">
	<tr>
		<th width="2%">Serial</th>
		<th width="15%">Photo</th>
		<th width="18%">Name</th>
		<th width="12%">Type of Disease</th>
		<th width="15%">Treating Doctor</th>
		<th width="10%">Admit Date</th>
		<th width="20%">Action</th>
	</tr>
	
	<?php
		/* ===================== Pagination Code Starts ================== */
		$adjacents = 7;
								
		$i=0;
		$statement = $db->prepare("SELECT * FROM patients ORDER BY p_id DESC");
		$statement->execute();
		$total_pages = $statement->rowCount();
	
			$targetpage = $_SERVER['PHP_SELF'];   //your file name  (the name of this file)
			$limit = 50;                                 //how many items to show per page
			$page = @$_GET['page'];
			if($page) 
				$start = ($page - 1) * $limit;          //first item to display on this page
			else
				$start = 0;
			
			$statement = $db->prepare("SELECT * FROM patients ORDER BY p_id DESC LIMIT $start, $limit");
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
					$total_bill = $row['total_bill'];
					$address = $row['address'];
					$email = $row['email'];
					$add_date = $row['add_date'];
		$i++;
		?>
			
		<tr>
		<td><?php echo $i; ?></td>
		<td><a href="../uploads/<?php echo $row['p_pic']; ?>"><img class="Pimg" src="../uploads/<?php echo $row['p_pic']; ?>" alt="" width="150" height="150"/></a></td>
		<td><?php echo $row['p_name']; ?></td>
		<td><?php echo $row['type_of_disease']; ?></td>
		<td><?php echo $row['treating_doctor']; ?></td>
		<td><?php echo $row['add_date']; ?></td>
		<td>
			<a class="fancybox" href="#inline<?php echo $i; ?>">View</a>
			<div id="inline<?php echo $i; ?>" style="width:700px;display: none;">
				<h3 style="border-bottom:2px solid #808080;margin-bottom:10px;">View All Data</h3>
				<p>
	
	<form action="" method="post" enctype="multipart/form-data">
		<table class="tbl1">
		<tr>
			<td>Patients Photo</td>
		</tr>
		<tr>
		<td><a href="../uploads/<?php echo $row['p_pic']; ?>"><img  src="../uploads/<?php echo $row['p_pic']; ?>" alt="Photo" width="230" height="280"/></a></td>
		</tr>
		<tr>
			<td>Name</td>
		</tr>
		<tr>
			<td><input class="short" type="text" name="name" value="<?php echo $p_name;?>" placeholder="Name"></td>
		</tr>

		<tr>
			<td>Gender</td>
		</tr>
		<tr>
			<td><input type="text" name="sex" value="<?php echo $sex;?>"></td>
		</tr>
		</tr>
		<tr>
			<td>Age</td>
		</tr>
		<tr>
				<td>
					<input  class="short" type="text" name="age" value="<?php echo $age;?>" placeholder="Age">	
				</td>
		</tr>
		<tr>
			<td>Blood Group</td>
		</tr>
		<tr>
			<td><input class="short" type="text" name="blood_group" value="<?php echo $blood_group;?>" placeholder="Blood Group"></td>
		</tr>
		<tr>
			<td>Type of Disease</td>
		</tr>
		<tr>
			<td><input class="short" type="text" name="type_of_disease" value="<?php echo $type_of_disease;?>" placeholder="Type of Disease"></td>
		</tr>
		<tr>
			<td>Treating Doctor</td>
		</tr>
		<tr>
			<td><input class="short" type="text" name="treating_doctor" value="<?php echo $treating_doctor;?>" placeholder="Treating Doctor"></td>
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
			<td><input  class="short" type="text" name="contact" value="<?php echo $contact;?>" placeholder="Contact Number"></td>
		</tr>
			<tr>
			<td>Patients Status</td>
		</tr>
		<tr>
			<td><input  class="short" type="text" name="p_status" value="<?php echo $p_status;?>" placeholder="Patients Status"></td>
		</tr>
			<tr>
			<td>Total Bill</td>
		</tr>
		<tr>
			<td><input  class="short" type="text" name="total_bill" value="<?php echo $total_bill;?>" placeholder="Total Bill"></td>
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
		<tr>
			<td>Admit Date</td>
		</tr>
		<tr>
			<td><input  class="short" type="text" name="add_date" value="<?php echo $add_date;?>"  placeholder="Admit Date"></td>
		</tr>
	
		</table>	
	</form>

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