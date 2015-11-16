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

if(isset($_POST['add_doctor'])) {
	
		$username = $_POST['username'];
		$name = $_POST['name'];
		$sex = $_POST['sex'];
		$birthday = $_POST['birth_day']."-".$_POST['birth_month']."-".$_POST['birth_year'];
		$contact = $_POST['contact'];
		$address = $_POST['address'];
		$email = $_POST['email'];
		$password = $_POST['password1'];
		
		 $emailCHecker = mysql_real_escape_string($email);
		 $emailCHecker = str_replace("`", "", $emailCHecker);
		 
	   // Database duplicate username check setup for use below in the error handling if else conditionals
		 $statement = $db->prepare("SELECT doc_username FROM doctors WHERE doc_username=?");
		 $statement->execute(array($username));
		 $uname_check = $statement->rowCount();
		 
		 // Database duplicate e-mail check setup for use below in the error handling if else conditionals
		 $statement = $db->prepare("SELECT email FROM doctors WHERE email=?");
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
		if(empty ($_POST['birth_month'])) {
			throw new Exception('Birth Month can not be empty');
		}
		
		if(empty ($_POST['birth_day'])) {
			throw new Exception('Birth Day can not be empty');
		}
		
		if(empty ($_POST['birth_year'])) {
			throw new Exception('Birth Year can not be empty');
		}
		
		if(empty ($_POST['designation'])) {
			throw new Exception('Designation can not be empty');
		}
		if(empty ($_POST['speciality'])) {
			throw new Exception('Speciality can not be empty');
		}
		if(empty ($_POST['consulting_hour'])) {
			throw new Exception('Consulting Hour can not be empty');
		}
		if(empty ($_POST['consulting_day'])) {
			throw new Exception('Consulting Day can not be empty');
		}
		if(empty ($_POST['room_no'])) {
			throw new Exception('Room No can not be empty');
		}
		if(empty ($_POST['contact'])) {
			throw new Exception('Contact Number can not be empty');
		}
		if(empty ($_POST['email'])) {
			throw new Exception('Email  can not be empty');
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
		$add_date = date('Y-m-d');
	
		
		include('config.php');
		
		$uploaded_file = $_FILES["doc_pic"]["name"];
			$file_basename = substr($uploaded_file, 0, strripos($uploaded_file, '.')); // strip extention
			$file_ext = substr($uploaded_file, strripos($uploaded_file, '.')); // strip name
			$f1 = $_POST['contact']. $file_ext;
			
			if(($file_ext!='.png')&&($file_ext!='.jpg')&&($file_ext!='.jpeg')&&($file_ext!='.gif'))
				throw new Exception("Only jpg, jpeg, png and gif format images are allowed to upload.");
			
		move_uploaded_file($_FILES["doc_pic"]["tmp_name"],"../uploads/" . $f1);
			

			
		$statement = $db->prepare("INSERT INTO doctors (doc_pic, name,doc_username,sex,birthday,designation,speciality,consulting_hour,consulting_day,room_no,contact,address,email,doc_password,add_date) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
		$statement->execute(array($f1, $username,$name,$sex,$birthday,$_POST['designation'],$_POST['speciality'],$_POST['consulting_hour'],$_POST['consulting_day'],$_POST['room_no'],$_POST['contact'],$_POST['address'],$email,$password,$add_date));
		
		$success_message ='Doctors Registration is Complete Successfully.';
	
	
	}
	
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
}

?>
<!--Call Hearder-->  	
<?php include('header.php');?>

	<h2>Add Doctors</h2>
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
			<td><input type="file" name="doc_pic"></td>
		</tr>
		<tr>
			<td><input class="long" type="text" name="name" placeholder="Username"></td>
		</tr>
		<tr>
			<td><input class="short" type="text" name="username" placeholder="Name"></td>
		</tr>
		<tr>
			<td><input type="radio" name="sex" value="Male" checked="checked"> Male &nbsp; &nbsp; <input type="radio"name="sex" value="Female"> Female</td>
		</tr>
	
		<tr >
				<td>
						<select name="birth_month" id="birth_month">
						<option value=""> &nbsp; Month &nbsp; </option>
						<option value="01">January</option>
						<option value="02">February</option>
						<option value="03">March</option>
						<option value="04">April</option>
						<option value="05">May</option>
						<option value="06">June</option>
						<option value="07">July</option>
						<option value="08">August</option>
						<option value="09">September</option>
						<option value="10">October</option>
						<option value="11">November</option>
						<option value="12">December</option>
						</select> 
						<select name="birth_day" id="birth_day">
						<option value="">&nbsp; Day &nbsp; </option>
						<option value="01">1</option>
						<option value="02">2</option>
						<option value="03">3</option>
						<option value="04">4</option>
						<option value="05">5</option>
						<option value="06">6</option>
						<option value="07">7</option>
						<option value="08">8</option>
						<option value="09">9</option>
						<option value="10">10</option>
						<option value="11">11</option>
						<option value="12">12</option>
						<option value="13">13</option>
						<option value="14">14</option>
						<option value="15">15</option>
						<option value="16">16</option>
						<option value="17">17</option>
						<option value="18">18</option>
						<option value="19">19</option>
						<option value="20">20</option>
						<option value="21">21</option>
						<option value="22">22</option>
						<option value="23">23</option>
						<option value="24">24</option>
						<option value="25">25</option>
						<option value="26">26</option>
						<option value="27">27</option>
						<option value="28">28</option>
						<option value="29">29</option>
						<option value="30">30</option>
						<option value="31">31</option>
						</select> 
						<select name="birth_year" id="birth_year">
						<option value=""> &nbsp; Year &nbsp; </option>
						<option value="2010">2010</option>
						<option value="2009">2009</option>
						<option value="2008">2008</option>
						<option value="2007">2007</option>
						<option value="2006">2006</option>
						<option value="2005">2005</option>
						<option value="2004">2004</option>
						<option value="2003">2003</option>
						<option value="2002">2002</option>
						<option value="2001">2001</option>
						<option value="2000">2000</option>
						<option value="1999">1999</option>
						<option value="1998">1998</option>
						<option value="1997">1997</option>
						<option value="1996">1996</option>
						<option value="1995">1995</option>
						<option value="1994">1994</option>
						<option value="1993">1993</option>
						<option value="1992">1992</option>
						<option value="1991">1991</option>
						<option value="1990">1990</option>
						<option value="1989">1989</option>
						<option value="1988">1988</option>
						<option value="1987">1987</option>
						<option value="1986">1986</option>
						<option value="1985">1985</option>
						<option value="1984">1984</option>
						<option value="1983">1983</option>
						<option value="1982">1982</option>
						<option value="1981">1981</option>
						<option value="1980">1980</option>
						<option value="1979">1979</option>
						<option value="1978">1978</option>
						<option value="1977">1977</option>
						<option value="1976">1976</option>
						<option value="1975">1975</option>
						<option value="1974">1974</option>
						<option value="1973">1973</option>
						<option value="1972">1972</option>
						<option value="1971">1971</option>
						<option value="1970">1970</option>
						<option value="1969">1969</option>
						<option value="1968">1968</option>
						<option value="1967">1967</option>
						<option value="1966">1966</option>
						<option value="1965">1965</option>
						<option value="1964">1964</option>
						<option value="1963">1963</option>
						<option value="1962">1962</option>
						<option value="1961">1961</option>
						<option value="1960">1960</option>
						<option value="1959">1959</option>
						<option value="1958">1958</option>
						<option value="1957">1957</option>
						<option value="1956">1956</option>
						<option value="1955">1955</option>
						<option value="1954">1954</option>
						<option value="1953">1953</option>
						<option value="1952">1952</option>
						<option value="1951">1951</option>
						<option value="1950">1950</option>
						<option value="1949">1949</option>
						<option value="1948">1948</option>
						<option value="1947">1947</option>
						<option value="1946">1946</option>
						<option value="1945">1945</option>
						<option value="1944">1944</option>
						<option value="1943">1943</option>
						<option value="1942">1942</option>
						<option value="1941">1941</option>
						<option value="1940">1940</option>
						<option value="1939">1939</option>
						<option value="1938">1938</option>
						<option value="1937">1937</option>
						<option value="1936">1936</option>
						<option value="1935">1935</option>
						<option value="1934">1934</option>
						<option value="1933">1933</option>
						<option value="1932">1932</option>
						<option value="1931">1931</option>
						<option value="1930">1930</option>
						<option value="1929">1929</option>
						<option value="1928">1928</option>
						<option value="1927">1927</option>
						<option value="1926">1926</option>
						<option value="1925">1925</option>
						<option value="1924">1924</option>
						<option value="1923">1923</option>
						<option value="1922">1922</option>
						<option value="1921">1921</option>
						<option value="1920">1920</option>
						<option value="1919">1919</option>
						<option value="1918">1918</option>
						<option value="1917">1917</option>
						<option value="1916">1916</option>
						<option value="1915">1915</option>
						<option value="1914">1914</option>
						<option value="1913">1913</option>
						<option value="1912">1912</option>
						<option value="1911">1911</option>
						<option value="1910">1910</option>
						<option value="1909">1909</option>
						<option value="1908">1908</option>
						<option value="1907">1907</option>
						<option value="1906">1906</option>
						<option value="1905">1905</option>
						<option value="1904">1904</option>
						<option value="1903">1903</option>
						<option value="1902">1902</option>
						<option value="1901">1901</option>
						<option value="1900">1900</option>
						</select> 
				</td>
		</tr>
		<tr>
			<td><input class="short" type="text" name="designation" placeholder="Designation"></td>
		</tr>
		<tr>
			<td><input class="short" type="text" name="speciality" placeholder="Speciality"></td>
		</tr>
		<tr>
			<td><input class="short" type="text" name="consulting_hour" placeholder="Consulting Hour"></td>
		</tr>
		<tr>
			<td><input class="short" type="text" name="consulting_day" placeholder="Consulting Day"></td>
		</tr>
		<tr>
			<td><input  class="short" type="text" name="room_no" placeholder="Room Number"></td>
		</tr>
		<tr>
			<td><input  class="short" type="text" name="contact" placeholder="Contact Number"></td>
		</tr>
			
		<tr class="address">
			<td><textarea class="short" name="address" placeholder="Address"></textarea></td>
		</tr>
		<tr>
			<td><input  class="short" type="text" name="email" placeholder="Email"></td>
		</tr>
		
		<tr>
			<td><input  class="short" type="password" name="password1" placeholder="Password"></td>
		</tr>
		<tr>
			<td><input  class="short" type="password" name="password2" placeholder="Confirm Password"></td>
		</tr>
		<tr>
			<td><input type="submit" value="SAVE" name="add_doctor"></td>
		</tr>
		</table>	
	</form>





<?php include("footer.php"); ?>			