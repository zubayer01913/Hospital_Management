<?php
ob_start();
session_start();
if($_SESSION['name']!='admin')
{
	header('location: ../index.php');
}
include("../config.php");
?>

<?php

if(!isset($_REQUEST['id'])) {
	header("location: post-view.php");
}
else {
	$id = $_REQUEST['id'];
}
?>


<?php

if(isset($_POST['form1'])) {


	try {
	
		if(empty($_POST['post_title'])) {
			throw new Exception("Title can not be empty.");
		}
		
		if(empty($_POST['post_details'])) {
			throw new Exception("Description can not be empty.");
		}		
		
		if(empty($_POST['c_name'])) {
			throw new Exception("Category Name can not be empty.");
		}

	
		
		
		if(empty($_FILES["post_pic"]["name"])) {
						
			$statement = $db->prepare("UPDATE post SET post_title=?, post_details=?, c_name=?  WHERE post_id=?");
			$statement->execute(array($_POST['post_title'],$_POST['post_details'],$_POST['c_name'],$id));
			
		}
		else {
			
			$up_filename=$_FILES["post_pic"]["name"];
			$file_basename = substr($up_filename, 0, strripos($up_filename, '.')); 
			$file_ext = substr($up_filename, strripos($up_filename, '.'));
			$f1 = $id . $file_ext;
		
			if(($file_ext!='.png')&&($file_ext!='.jpg')&&($file_ext!='.jpeg')&&($file_ext!='.gif'))
				throw new Exception("Only jpg, jpeg, png and gif format images are allowed to upload.");
			
			
			$statement = $db->prepare("SELECT * FROM post WHERE post_id=?");
			$statement->execute(array($id));
			$result = $statement->fetchAll(PDO::FETCH_ASSOC);
			foreach($result as $row)
			{
				$real_path = "../uploads/".$row['post_pic'];
				unlink($real_path);
			}
			move_uploaded_file($_FILES["post_pic"]["tmp_name"],"../uploads/" . $f1);
			
			
			$statement = $db->prepare("UPDATE post SET post_title=?, post_details=?, post_pic=?, c_name=?  WHERE post_id=?");
			$statement->execute(array($_POST['post_title'],$_POST['post_details'],$f1,$_POST['c_name'],$id));
			
		}
		
		$success_message = "Post is updated successfully.";
		
		
	
	}
	
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}


}

?>



<?php
$statement = $db->prepare("SELECT * FROM post WHERE post_id=?");
$statement->execute(array($id));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach($result as $row)
{
	$post_title = $row['post_title'];
	$post_details = $row['post_details'];
	$post_pic = $row['post_pic'];
	$c_name = $row['c_name'];

}
?>


<?php include("header.php"); ?>
<h2>Edit Post</h2>
<p>&nbsp;</p>
<?php
if(isset($error_message)) {echo "<div class='error'>".$error_message."</div>";}
if(isset($success_message)) {echo "<div class='success'>".$success_message."</div>";}
?>


<form action="post-edit.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
<!--<input type="hidden" name="id" value="<?php echo $id; ?>">-->
<table class="tbl1">
<tr><td>Title</td></tr>
<tr><td><input class="long" type="text" name="post_title" value="<?php echo $post_title; ?>"></td></tr>
<tr><td>Description</td></tr>
<tr>
<td>
<textarea name="post_details" cols="30" rows="10"><?php echo $post_details; ?></textarea>
<script type="text/javascript">
	if ( typeof CKEDITOR == 'undefined' )
	{
		document.write(
			'<strong><span style="color: #ff0000">Error</span>: CKEditor not found</strong>.' +
			'This sample assumes that CKEditor (not included with CKFinder) is installed in' +
			'the "/ckeditor/" path. If you have it installed in a different place, just edit' +
			'this file, changing the wrong paths in the &lt;head&gt; (line 5) and the "BasePath"' +
			'value (line 32).' ) ;
	}
	else
	{
		var editor = CKEDITOR.replace( 'post_details' );
		//editor.setData( '<p>Just click the <b>Image</b> or <b>Link</b> button, and then <b>&quot;Browse Server&quot;</b>.</p>' );
	}

</script>
</td>
</tr>
<tr><td>Previous Featured Image Preview</td></tr>
<tr><td><img src="../uploads/<?php echo $post_pic; ?>" alt="" width="200"></td></tr>
<tr><td>New Featured Image</td></tr>
<tr><td><input type="file" name="post_pic"></td></tr>
<tr><td>Select a Category</td></tr>
<tr>
<td>
<select name="c_name">
<option value="">Select a Category</option>
<?php
$statement = $db->prepare("SELECT * FROM category ORDER BY c_name ASC");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach($result as $row)
{

	if($row['c_name'] == $c_name)
	{
		?><option value="<?php echo $row['c_name']; ?>" selected><?php echo $row['c_name']; ?></option><?php
	}
	else
	{
		?><option value="<?php echo $row['c_name']; ?>"><?php echo $row['c_name']; ?></option><?php
	}
		
	
	
}
?>
</select>
</td>
</tr>
<tr><td><input type="submit" value="UPDATE" name="form1"></td></tr>
</table>	
</form>
</br></br></br></br>
<?php include("footer.php"); ?>			