	
<?php
include('config.php');

if(isset($_POST['signup'])) {

		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$username = $_POST['username'];
		$sex = $_POST['sex'];
		$contact_num = $_POST['contact_num'];
		$address = $_POST['address'];
		$birthday = $_POST['birth_day']."-".$_POST['birth_month']."-".$_POST['birth_year'];
		$email = $_POST['email1'];
		$password = $_POST['password1'];
		
		 $emailCHecker = mysql_real_escape_string($email);
		 $emailCHecker = str_replace("`", "", $emailCHecker);
		 
	   // Database duplicate username check setup for use below in the error handling if else conditionals
		 $statement = $db->prepare("SELECT email FROM user_list WHERE username=?");
		 $statement->execute(array($username));
		 $uname_check = $statement->rowCount();
		 
		 // Database duplicate e-mail check setup for use below in the error handling if else conditionals
		 $statement = $db->prepare("SELECT email FROM user_list WHERE email=?");
		 $statement->execute(array($emailCHecker));
		 $email_check = $statement->rowCount();
	 
	try {
		if(empty ($_POST['firstname'])) {
			throw new Exception('Name can not be empty');
		}
		
		if(empty ($_POST['lastname'])) {
			throw new Exception('Name can not be empty');
		}
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
		if(empty ($_POST['user_type'])) {
			throw new Exception('User Type can not be empty');
		}
		
		if(empty ($_POST['job_cat'])) {
			throw new Exception('Job Category can not be empty');
		}
		if(empty ($_POST['sex'])) {
			throw new Exception('Gender can not be empty');
		}
		
		if(empty ($_POST['contact_num'])) {
			throw new Exception('Contact Number can not be empty');
		}

		
		if(empty ($_POST['address'])) {
			throw new Exception('Address can not be empty');
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
		
		if(empty ($_POST['email1'])) {
			throw new Exception('Email can not be empty');
		}
		if(empty ($_POST['email2'])) {
			throw new Exception('Email can not be empty');
		}
		
		if($_POST['email1']!= $_POST['email2'] ) {
			throw new Exception('Email does not match');
		}
		if(!(preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $email))) {
			throw new Exception('Please Enter Valid email address');
		}
		//duplicate email check 
		if ($email_check > 0){
			throw new Exception('Your Email address is already in use inside of our system. Please use another');
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
		$regi_date = date('Y-m-d');
		
		include('config.php');
		
			
		$statement = $db->prepare("INSERT INTO user_list (firstname,lastname,username,user_type,job_cat,sex,contact_num,address,birthday,email,password,regi_date) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");
		$statement->execute(array($_POST['firstname'],$_POST['lastname'],$username,$_POST['user_type'],$_POST['job_cat'],$_POST['sex'],$_POST['contact_num'],$_POST['address'],$birthday,$email,$password,$regi_date));
		
		$success_message ='Your Registration is Complete Successfully Please Login Now!.';
	
	
	}
	
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
}

?>
<!--Call Hearder-->  	
<?php include('header.php');?>

	<div id="site_content">		
	
		<div class="main2">
			<div class="main_registraion">
				<div class="login error success">
					<h2>Fill Up the Form</h2>
					<br>
					<?php
					if(isset($error_message)) {echo $error_message;}
					if(isset($success_message)) {echo $success_message;}
					?>
				</div>
			
				<div class="registration_box fix">
				<form action="" method="post">
					<table>
						<tr class="f_name">
							<td><p>First Name : *  <input type="text" name="firstname"></p></td>
						</tr>
						<tr class="l_name">
							<td>Last Name : *  <input type="text"name="lastname"></td>
						</tr>
						<tr class="username">
							<td><strong>User Name : * </strong> <input type="text" name="username"></td>
						</tr>
						<tr class="user_type">
							<td>User Type : *
								<select name="user_type">
									<option value=""><b>Select a User Type</b></option>
									<option value="General User">General User</option>
								</select>
							</td>
						</tr>
						<tr class="post_type">
							<td>Post Category : *
								<select name="job_cat">
									<option value="">Select a Post Category </option>
									<?php
									$statement = $db->prepare("SELECT * FROM job_post ORDER BY p_id ASC");
									$statement->execute();
									$result = $statement->fetchAll(PDO::FETCH_ASSOC);
									foreach($result as $row)
									{
										?>
										<option value="<?php echo $row['job_cat']; ?>"><?php echo $row['job_cat']; ?></option>
										<?php
									}
									?>
								</select>
							</td>
						</tr>
						<tr class="gender">
							<td>Gender : * <input type="radio" name="sex" value="male" checked="checked"> Male &nbsp; &nbsp; <input type="radio"name="sex" value="female"> Female</td>
						</tr>
						<tr class="contact">
							<td>Contact Number : *  <input type="text" name="contact_num"></td>
						</tr>
						
						<tr class="address">
							<td>Address : *  <textarea name="address"></textarea></td>
						</tr>
						<tr class="birthday">
							<td>Date of Birth : * 
							<select name="birth_month" id="birth_month">
							<option value="">   </option>
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
							<option value="">   </option>
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
							<option value=""> </option>
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
							</select> </td>
						</tr>
						<tr class="email">
							<td>Email : * <input name="email1" type="text" id="email1" value=" " size="32" maxlength="48"></td>
						</tr>
						<tr class="confirm_email">
							<td>Confirm Email : *  <input name="email2" type="text" id="email2" value="" size="32" maxlength="48"></td>
						</tr>
						<tr class="password">
							<td>Password : *  <input type="password" name="password1"></td>
						</tr>
						<tr class="confirm_pass">
							<td>Confirm Password : *  <input type="password" name="password2"></td>
						</tr>
						<tr class="login_button">
							<td><input type="submit" value="Submit" name="signup"></td>
						</tr>
					</table>
				</form>
				</div>
			</div>
		</div>
	</div><!--close site_content--> 
	
	<!--Call Footer-->  	
	<?php include('footer.php');?>	