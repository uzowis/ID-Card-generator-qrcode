<?php 
// connect to the database


include('controllers/config.php');
require_once 'phpqrcode/qrlib.php';

$qr_path = 'qrcodes/';
$qr_code = $qr_path.uniqid().".png";
$v_url = "http://localhost/pcrc-reg/dashboard/admin/verify.php?u=";  // For Development only
//$v_url = "https://www.iwofordventuresltd.com/pcrc-reg/dashboard/admin/verify.php?u=";  // For Production
$salt = time();
$array = str_split($salt, 2);



$fileSizeError_sign = '';
$fileSizeError_photo = '';
$fileTypeError_sign = '';
$fileTypeError_photo = '';
$error_email = '';
$error_user = '';
$error_id = '';
$error_phone = '';
$error_pwd= '';
$error_pwd_change ="";
$error_photo = '';
$error_sign = '';
$login_error = '';
$success = "";
$download = '';
$date_of_reg = date("Y/m/d");


// REGISTER USER
if (isset($_POST['reg']) && isset($_FILES['passport']['name']) && isset($_FILES['sign']['name'])) {
	if(!empty($_POST['fname']) &&  (!empty($_POST['lname']))&&  (!empty($_POST['gender'])) && (!empty($_POST['email'])) &&  (!empty($_POST['pwd']))&&  (!empty($_POST['cpwd'])) &&  (!empty($_POST['username'])) && (!empty($_POST['phone'])) && (!empty($_FILES['passport'])) &&  (!empty($_FILES['sign'])) &&  (!empty($_POST['command'])) &&  (!empty($_POST['division'])) && (!empty($_POST['position']))){
		
		// receive all input values from the form
	  $fname = mysqli_real_escape_string($db, $_POST['fname']);
	  $lname = mysqli_real_escape_string($db, $_POST['lname']);
	  $gender = mysqli_real_escape_string($db, $_POST['gender']);
	  $email = mysqli_real_escape_string($db, $_POST['email']);
	  $username = mysqli_real_escape_string($db, $_POST['username']);
	  $n_id = mysqli_real_escape_string($db, $_POST['n_id']);
	  $phone = mysqli_real_escape_string($db, $_POST['phone']);
	  $pwd1 = mysqli_real_escape_string($db, $_POST['pwd']);
	  $cpwd = mysqli_real_escape_string($db, $_POST['cpwd']);
	  $pwd = md5($pwd1);
	  $user_id = "PCRC/STAFF/".$array[3].$array[4];
	  $command = mysqli_real_escape_string($db, $_POST['command']);
	  $position = mysqli_real_escape_string($db, $_POST['position']);
	  $division = mysqli_real_escape_string($db, $_POST['division']);
	  $v_url .= $user_id;
	  $photos_dir = 'photos/';
	  $sign_dir = 'signatures/';
	  $photos_filename = $photos_dir.basename($_FILES['passport']['name']);
	  $sign_filename = $sign_dir.basename($_FILES['sign']['name']);
	  
	  
	  // Select File type
	  $photosFileType = strtolower(pathinfo($photos_filename,PATHINFO_EXTENSION));
	  $signFileType = strtolower(pathinfo($sign_filename,PATHINFO_EXTENSION));
	  
	  // Change the Image name to custom
	  $passport = $salt.".".$photosFileType;
	  $sign = $salt.".".$signFileType;
	  
	  $_FILES['passport']['name'] = $passport;
	  $_FILES['sign']['name'] = $sign;
	  
	  // Restrict file size to 1MB
	  $photosFilesize = $_FILES['passport']['size'];
	  $photosFilesize = round($photosFilesize / 1024);
	  $signFilesize = $_FILES['sign']['size'];
	  $signFilesize = round($signFilesize / 1024);
	  
	 
	  
	  if ($photosFilesize > 1024) {
		  $fileSizeError_photo ="Maximum file size Exceeded";
	  }elseif($signFilesize > 1024){
		  $fileSizeError_sign ="Maximum file size Exceeded";
		  
	  }else{
		  
		  // Valid File Extensions
		  $extensions_arr = array("jpg", "jpeg", "png", 'JPEG', "JPG");
		  
		  // Validate password correspondence 
		  if ($pwd1 != $cpwd){
			  $error_pwd ="Passwords Don't Match";
		  }else{
			  
				// Validate Multiple registration  
				$query_email = mysqli_query($db, "SELECT email FROM user WHERE email='$email'");
				$query_user = mysqli_query($db, "SELECT username FROM user WHERE username='$username'");
				$query_id = mysqli_query($db, "SELECT n_id FROM user WHERE n_id='$n_id'");
				$query_phone = mysqli_query($db, "SELECT phone FROM user WHERE phone='$phone'");
				
				if (mysqli_num_rows($query_email) > 0) {
					$error_email = "Email Address already exist";
				}elseif (mysqli_num_rows($query_user) > 0){
					$error_user = "Username already used!";
				}elseif(mysqli_num_rows($query_phone) > 0){
					$error_phone = "Phone Number already in use, try again!";
				}else{
				  
						// Check Extensions
					if(in_array($photosFileType, $extensions_arr)){
						if(in_array($signFileType, $extensions_arr)){
						  // Insert into db
							$query = "INSERT INTO user (user_id, fname, lname, gender, email, username, n_id, phone, pwd, passport, sign, command, position, division, qr_code, salt, date_of_reg) VALUES('$user_id','$fname', '$lname', '$gender', '$email', '$username', '$n_id', '$phone', '$pwd', '$passport', '$sign','$command', '$position', '$division', '$qr_code', '$salt', '$date_of_reg')";
							if (mysqli_query($db, $query)){
								// move images to their respective folders in server
								move_uploaded_file($_FILES['passport']['tmp_name'], $photos_dir.$passport);
								move_uploaded_file($_FILES['sign']['tmp_name'], $sign_dir.$sign);
							  
								// Generate and move QR-CODE into qrcodes/ folder in server.
								QRcode::png($v_url, $qr_code, 'L', 10, 2);
								
								$success = "Congrats! ".$fname.", Your registration was successful";
								
							}else{
								echo "<br>Query Unsuccessful ".mysqli_error($db);
							}
						 
						}else{
							$fileTypeError_sign = "Invalid File Type. File must be in (JPEG, JPG, PNG) format";
						}
					}else{
						$fileTypeError_photo = "Invalid File Type. File must be in (JPEG, JPG, PNG) format";
						
					}
			
				}
				
			}
		}
	}
  
  
}

// Sign in
if (isset($_POST['sign_in']) && (!empty($_POST['email'])) && (!empty($_POST['pwd']))){
	$email = $_POST['email'];
	$pwd = $_POST['pwd'];
	$pwd = md5($pwd);
	$query_user = "SELECT * FROM user WHERE email='$email' AND pwd='$pwd'";
	$result = mysqli_query($db, $query_user);
	
	if (mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_array($result)){
			session_start();
			$_SESSION['id'] = $row['id'];
					
		}
		
		header('location: dashboard/');
		  
	}else{
		$login_error .= "Account Not Found, Try again";
	}
		  
	
}

// Update User Profile
if (isset($_POST['update'])){
	if(!empty($_POST['phone']) &&  (!empty($_POST['command'])) && (!empty($_POST['position'])) && (!empty($_POST['division'])) ){
		
	  $id = $_SESSION['id'];
	  $query_id  = mysqli_query($db, "SELECT * FROM user WHERE id='$id'");
	  $fetch_id = mysqli_fetch_array($query_id);
	  $pwd = $fetch_id['pwd'];
	  
	  $old_pwd = mysqli_real_escape_string($db, $_POST['old_pwd']);
	  $old_pwd = md5($old_pwd);
	  $cpwd = mysqli_real_escape_string($db, $_POST['cpwd']);
	  $new_pwd1 = mysqli_real_escape_string($db, $_POST['new_pwd']);
	  $new_pwd = md5($new_pwd1);
	  
	  $n_id = mysqli_real_escape_string($db, $_POST['n_id']);
	  $phone = mysqli_real_escape_string($db, $_POST['phone']);
	  $command = mysqli_real_escape_string($db, $_POST['command']);
	  $position = mysqli_real_escape_string($db, $_POST['position']);
	  $division = mysqli_real_escape_string($db, $_POST['division']);
	  
	  
	  // Update Profile Info and Passwords 
	  if (!empty($old_pwd) && !empty($new_pwd) && !empty($cpwd)){
		  
		  if ($pwd != $old_pwd){
			  $error_pwd_change ="Incorrect Password";
		  }elseif($new_pwd1 != $cpwd){
			  $error_pwd = "Passwords dont Match!";
		  }else{
			  
			  // Insert into db
				$query = "UPDATE user SET pwd='$new_pwd' WHERE id='$id'";
				if (mysqli_query($db, $query)){
								
					$success = "Update was Successful";
					
				}else{
					echo "<br>Query Unsuccessful ".mysqli_error($db);
				}
				
			}
			
		}else{
			// Validate Multiple registration  
				$query_phone = mysqli_query($db, "SELECT phone FROM user WHERE phone='$phone' AND id='$id'");
				
				if (mysqli_num_rows($query_phone) > 0) {
					
				}
			  // Insert into db
				$query = "UPDATE user SET phone='$phone', command='$command', position='$position',  n_id='$n_id', division='$division' WHERE id='$id'";
				if (mysqli_query($db, $query)){
								
					$success = "Updattte was Successful";
					
				}else{
					echo "<br>Query Unsuccessful ".mysqli_error($db);
				}
		}
		
		
	}
}


// Update Passport and Signature
if (isset($_POST['upload'])){
	  $id = $_SESSION['id'];
	  
	  $photos_dir = '../photos/';
	  $sign_dir = '../signatures/';
	  $photos_filename = $photos_dir.basename($_FILES['passport']['name']);
	  $sign_filename = $sign_dir.basename($_FILES['sign']['name']);
	  
	  // Select File type
	  $photosFileType = strtolower(pathinfo($photos_filename,PATHINFO_EXTENSION));
	  $signFileType = strtolower(pathinfo($sign_filename,PATHINFO_EXTENSION));
	  
	  // Change the Image name to custom
	  $passport = $salt.".".$photosFileType;
	  $sign = $salt.".".$signFileType;
	  
	  $_FILES['passport']['name'] = $passport;
	  $_FILES['sign']['name'] = $sign;
	  
	  // Restrict file size to 1MB
	  $photosFilesize = $_FILES['passport']['size'];
	  $photosFilesize = round($photosFilesize / 1024);
	  $signFilesize = $_FILES['sign']['size'];
	  $signFilesize = round($signFilesize / 1024);
	  
	  // Valid File Extensions
	  $extensions_arr = array("jpg", "jpeg", "png", 'JPEG', "JPG");

	
	if(!empty($_FILES['passport']['name']) ){
		if ($photosFilesize > 1024) {
		  $fileSizeError_photo ="Maximum file size Exceeded";
	  }else{
		  if(in_array($photosFileType, $extensions_arr)){
			  // Insert into db
				$query = "UPDATE user SET passport='$passport' WHERE id='$id'";
				if (mysqli_query($db, $query)){
					// move images to their respective folders in server
					move_uploaded_file($_FILES['passport']['tmp_name'], $photos_dir.$passport);
					
					header('location: index.php');
					
				}else{
					echo "<br>Query Unsuccessful ".mysqli_error($db);
				}
			 
			}else{
				$fileTypeError_photo = "Invalid File Type. File must be in (JPEG, JPG, PNG) format";
			}
			
		  
	  }
	}else{
		if(!empty($_FILES['sign']['name'])){
			if($signFilesize > 1024){
			  $fileSizeError_sign ="Maximum file size Exceeded";
			}else{
				if(in_array($signFileType, $extensions_arr)){
				  // Insert into db
					$query = "UPDATE user SET sign='$sign' WHERE id='$id'";
					if (mysqli_query($db, $query)){
						// move images to their respective folders in server
						move_uploaded_file($_FILES['sign']['tmp_name'], $sign_dir.$sign);
						
						header('location: index.php');
						
					}else{
						echo "<br>Query Unsuccessful ".mysqli_error($db);
					}
				 
				}else{
					$fileTypeError_sign = "Invalid File Type. File must be in (JPEG, JPG, PNG) format";
				}
				
			}
		}
	}
		
	
	
}


// REGISTER ADMINISTRATOR
if (isset($_POST['reg_admin'])) {
	if(!empty($_POST['fname']) &&  (!empty($_POST['lname'])) && (!empty($_POST['email'])) &&  (!empty($_POST['username']))&&  (!empty($_POST['pwd'])) &&  (!empty($_POST['cpwd']))){
		
		// receive all input values from the form
	  $fname = mysqli_real_escape_string($db, $_POST['fname']);
	  $lname = mysqli_real_escape_string($db, $_POST['lname']);
	  $email = mysqli_real_escape_string($db, $_POST['email']);
	  $username = mysqli_real_escape_string($db, $_POST['username']);
	  $pwd1 = mysqli_real_escape_string($db, $_POST['pwd']);
	  $cpwd = mysqli_real_escape_string($db, $_POST['cpwd']);
	  $pwd = md5($pwd1);
	  
	  
	  // Validate password correspondence 
	  if ($pwd1 != $cpwd){
		  $error_pwd ="Passwords Don't Match";
	  }else{
		  
			// Validate Multiple registration  
			$query_email = mysqli_query($db, "SELECT email FROM admin WHERE email='$email'");
			$query_user = mysqli_query($db, "SELECT username FROM admin WHERE username='$username'");
			
			
			if (mysqli_num_rows($query_email) > 0) {
				$error_email = "Email Address already exist";
			}elseif (mysqli_num_rows($query_user) > 0){
				$error_user = "Username already used!";
			}else{
			  
			  // Insert into db
				$query = "INSERT INTO admin (fname, lname, email, username, pwd) VALUES('$fname', '$lname', '$email', '$username', '$pwd')";
				if (mysqli_query($db, $query)){
					
					$success = "Admin Account Creation Was Successful";
					
				}else{
					echo "<br>Query Unsuccessful ".mysqli_error($db);
				}
					 
					
		
			}
			
		}
		
	}
  
}

// Sign in to Admin Dashboard
if (isset($_POST['sign_in_admin']) && (!empty($_POST['email'])) && (!empty($_POST['pwd']))){
	$email = $_POST['email'];
	$pwd = $_POST['pwd'];
	$pwd = md5($pwd);
	$query_user = "SELECT * FROM admin WHERE email='$email' AND pwd='$pwd'";
	$result = mysqli_query($db, $query_user);
	
	if (mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_array($result)){
			session_start();
			$_SESSION['id'] = $row['id'];
					
		}
		
		header('location: ../dashboard/admin/');
		  
	}else{
		$login_error .= "Account Not Found, Try again";
	}
		  
	
}


?>
