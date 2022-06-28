<?php 
include('../process.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin: PCRC -Identification System</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <script src="../js/jquery.js"></script>
  <script src="../js/bootstrap.min.js"></script>

  <style>
	body{
		background-color:#313b78;
		background-image: url("../img/bg.png");
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
      padding: 20px;
      max-height: 85%;
	  box-shadow: 0 5px 10px rgba(154,160,185,.05), 0 15px 40px rgba(166,173,201,.2);
    }
	.form-control{
		border: solid 1px rgb(195, 195, 195);
	}
	.login_page{
		background-color: ;
		margin: 0 auto;
		margin-top: 50px;
		margin-bottom: 50px;
	}
	.img{
		width:150px;
		height: auto;
	}
  </style>
</head>
<body>

  
<div class="container-fluid" >
	<div class="row" >

    <div class="col-md-6 login_page">
		<div>
			<img class="img mx-auto d-block img-fluid" src="../img/pcrc_logo.png" alt="logo">
		</div>
        <h3 class"heading" style="color:#ffff00">PCRC IDENTIFICATION SYSTEM</h3>
        <p class="text-center text-info">Fill the form below to create Administrator Account</p>
		
		<p class="text-success text-center text-bold"><?php echo $success?></p>
		<p class="text-danger text-center text-bold"><?php echo $login_error?></p>
		<p class="text-center"><?php echo $download ?></p>
        

      <div class="container rbox">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#register">Create Admin Account</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#signin">Sign In</a>
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
				<span class="input-group-text">Email:</span>
				</div>
                <input type="text" class="form-control" id="email" placeholder="Enter Email" name="email" required>
                <div class="invalid-feedback">Please fill out this field.</div>
              </div>
			  <p class="text-danger"><?php echo $error_email; ?></p>
			  
			  <div class="form-group input-group">
                <div class="input-group-prepend">
					<span class="input-group-text">Username</span>
				</div>
                <input type="text" class="form-control" id="username" placeholder="Enter Username" name="username" required>
                <div class="invalid-feedback">Please fill out this field.</div>
              </div>
			  <p class="text-danger"><?php echo $error_user;?></p>
			  
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
			  <p class="text-danger"><?php echo $error_pwd; ?></p>
             
			  
              <input type="submit" class="btn btn-primary btn-success" name="reg_admin" value="REGISTER">
            </form>
          </div>

		<div id="signin" class="container tab-pane fade"><br>
            <form action="#signin" method="POST" class="needs-validation" novalidate>
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
                
                <input type="submit" class="btn btn-primary btn-success" name="sign_in_admin" value= "Sign In">
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
