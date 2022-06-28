<?php 
include('process.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>PCRC -Identification System</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>

  <style>
	body{
		background-color:;
		background-image: url("img/bg.png");
		background-size: cover;
		background-repeat: no-repeat;
	}
    .banner{
      }
    .cbanner{
      padding: 0px;
    }
    h3{
      text-align: center;
      color: #cb5f93;
	  font-family: Inter,-apple-system,BlinkMacSystemFont,Segoe UI,Helvetica,Arial,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol;
	  font-weight: bold;
    }
    .rbox{
      background-color:white;
      border-radius: 10px;
	  border: solid 1px rgba(166,173,201, .7);
      padding: 20px;
      max-height: 85%;
	  box-shadow: 10px 0px 10px  10px rgba(154,160,185,.05), 10px 0px 20px  10px rgba(166,173,201,.2);
    }
	.form-control{
		border: solid 1px rgb(195, 195, 195);
	}
	.login_page{
		background-color: ;
		margin: 0 auto;
		margin-top: 30px;
		margin-bottom: 50px;
	}
	.img{
		width:150px;
		height: auto;
	}
	.error{
		font-size: 13px;
		margin-top:0px !important;
		padding: 0px;
	}
  </style>
</head>
<body>

  
<div class="container-fluid" >
	<div class="row" >

    <div class="col-md-6 login_page">
		<div>
			<img class="img mx-auto d-block img-fluid" src="img/pcrc_logo.png" alt="logo">
		</div>
        <h3 class"heading" style="color:#313b78">PCRC IDENTIFICATION SYSTEM</h3>
        <p class="text-center text-info">Fill the form below to create Account</p>
		
		<p class="text-success text-center text-bold"><?php echo $success?></p>
		<p class="text-danger text-center text-bold"><?php echo $login_error?></p>
		<p class="text-center"><?php echo $download ?></p>
        

      <div class="container rbox">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#register">Create Account</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#sign_in">Sign In</a>
          </li>
        
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
			<form method="GET" action="verify.php">
				<input type="hidden" name="n" />
			</form>
			  <div id="register" class="container tab-pane active"><br>
				<form action="" class="needs-validation" method="post" enctype="multipart/form-data" novalidate>
				  <div class="form-group input-group">
					<div class="input-group-prepend">
						<span class="input-group-text">First Name:</span>
					</div>
					<input type="text" class="form-control" id="fname" placeholder="Enter Firstname" name="fname" required>
					<div class="invalid-feedback">Please fill out this field.</div>
				  </div>
				  <div class="form-group input-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Last Name:</span>
					</div>
					<input type="text" class="form-control" id="lname" placeholder="Enter Lastname" name="lname" required>
					<div class="invalid-feedback">Please fill out this field.</div>
				  </div>
				   <div class="form-group input-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Gender:</span>
					</div>
					<select class="form-control" id="gender" name="gender">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>

					</select>
				  </div>
				  
				  <div class="form-group input-group">
					<div class="input-group-prepend">
					<span class="input-group-text">Email:</span>
					</div>
					<input type="text" class="form-control" id="email" placeholder="Enter Email" name="email" required>
					<div class="invalid-feedback">Please fill out this field.</div>
				   </div>
					<p class="text-danger error"><?php echo $error_email; ?></p>
				  <div class="form-group input-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Username</span>
					</div>
					<input type="text" class="form-control" id="username" placeholder="Enter Username" name="username" required>
					<div class="invalid-feedback">Please fill out this field.</div>
				  </div>
				  <p class="text-danger error"><?php echo $error_user; ?></p>
				  
				  <div class="form-group input-group">
					<div class="input-group-prepend">
						<span class="input-group-text">National ID/Int'l Passport No:</span>
					</div>
					<input type="text" class="form-control" id="n_id" placeholder="ID Number (Optional)" name="n_id" >
					<div class="invalid-feedback">Please fill out this field.</div>
				  </div>
				  <p class="text-danger error"><?php echo $error_id; ?></p>
				  
				  <div class="form-group input-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Mobile Number:</span>
					</div>
					<input type="number" class="form-control" id="phone" placeholder="Enter Mobile Number" name="phone" required>
					<div class="invalid-feedback">Please fill out this field.</div>
				  </div>
				  <p class="text-danger error"><?php echo $error_phone; ?></p>
				  
				  <div class="form-group input-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Password:</span>
					</div>
					<input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd" required>
					<div class="invalid-feedback">Please fill out this field.</div>
				  </div>
				  <div class="form-group input-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Comfirm Password:</span>
					</div>
					<input type="password" class="form-control" id="cpwd" placeholder="Comfirm password" name="cpwd" required>
					<div class="invalid-feedback">Please fill out this field.</div>
				  </div>
				  <p class="text-danger error"><?php echo $error_pwd; ?></p>
				  <div class="form-group input-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Passport (max-size: 1MB):</span>
					</div>
					<input type="file" class="form-control" id="passport" name="passport" required>
					<div class="invalid-feedback">Upload a valid Photograph</div>
				  </div>
				  <p class="text-danger error"><?php if($fileSizeError_photo || $fileTypeError_photo){echo $fileSizeError_photo.", ".$fileTypeError_photo;} ?></p>
				  
				  <div class="form-group input-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Signature (max-size: 1MB):</span>
					</div>
					<input type="file" class="form-control" id="sign" name="sign" required>
					<div class="invalid-feedback">Upload a valid Image</div>
				  </div>
				  <p class="text-danger error"><?php if($fileSizeError_sign|| $fileTypeError_sign){echo $fileSizeError_sign.", ".$fileTypeError_sign;} ?></p>
				  
				  <div class="form-group input-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Division/LGA:</span>
					</div>
					<input type="text" class="form-control" id="command" placeholder="eg. Obio/Akpor" name="division" >
					<div class="invalid-feedback">Please fill out this field.</div>
				  </div> 
				  <div class="form-group input-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Position:</span>
					</div>
					<input type="text" class="form-control" id="position" placeholder="Enter Position" name="position" >
					<div class="invalid-feedback">Please fill out this field.</div>
				  </div>
				  <div class="form-group input-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Command:</span>
					</div>
					<select class="form-control" id="command" name="command">
						<option disabled="" selected="">--Select Command--</option>
                        <option value="Abia">Abia</option>
                        <option value="Adamawa">Adamawa</option>
                        <option value="Akwa Ibom">Akwa Ibom</option>
                        <option value="Anambra">Anambra</option>
                        <option value="Bauchi">Bauchi</option>
                        <option value="Bayelsa">Bayelsa</option>
                        <option value="Benue">Benue</option>
                        <option value="Borno">Borno</option>
                        <option value="Cross Rive">Cross River</option>
                        <option value="Delta">Delta</option>
                        <option value="Ebonyi">Ebonyi</option>
                        <option value="Edo">Edo</option>
                        <option value="Ekiti">Ekiti</option>
                        <option value="Enugu">Enugu</option>
                        <option value="FCT">Federal Capital Territory</option>
                        <option value="Gombe">Gombe</option>
                        <option value="Imo">Imo</option>
                        <option value="Jigawa">Jigawa</option>
                        <option value="Kaduna">Kaduna</option>
                        <option value="Kano">Kano</option>
                        <option value="Katsina">Katsina</option>
                        <option value="Kebbi">Kebbi</option>
                        <option value="Kogi">Kogi</option>
                        <option value="Kwara">Kwara</option>
                        <option value="Lagos">Lagos</option>
                        <option value="Nasarawa">Nasarawa</option>
                        <option value="Niger">Niger</option>
                        <option value="Ogun">Ogun</option>
                        <option value="Ondo">Ondo</option>
                        <option value="Osun">Osun</option>
                        <option value="Oyo">Oyo</option>
                        <option value="Plateau">Plateau</option>
                        <option value="Rivers">Rivers</option>
                        <option value="Sokoto">Sokoto</option>
                        <option value="Taraba">Taraba</option>
                        <option value="Yobe">Yobe</option>
                        <option value="Zamfara">Zamfara</option>
					</select>
				  </div>
				  
				  <input type="submit" class="btn btn-primary btn-success" name="reg" value="REGISTER">
				</form>
			  </div>

			<div id="sign_in" class="container tab-pane fade"><br>
				<form action="#download" method="POST" class="needs-validation" novalidate>
					<div class="form-group">
					  <label for="email">Email:</label>
					  <input type="text" class="form-control" id="email" placeholder="Enter Email" name="email" required>
					  <div class="invalid-feedback">Please fill out this field.</div>
					</div>
					<div class="form-group">
					  <label for="pwd">Password:</label>
					  <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd" required>
					  <div class="invalid-feedback">Please fill out this field.</div>
					</div>
					
					<input type="submit" class="btn btn-primary btn-success" name="sign_in" value= "Sign In">
				</form>
			  
			</div>
			  
		  
		  
		  
		</div>
		  
                  
		</div>
		
	<footer class="main-footer">
    <p class="text-center" style="color: cyan;"><strong>Copyright &copy; 2020 PCRC.</strong> All rights
    reserved.</p>
  </footer>
      
      </div>
      
    </div>
  </div>

</div>

<script>
// Disable form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Get the forms we want to add validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>	
</body>
</html>
