<?php 
session_start();
include('../../controllers/config.php');

// Get User's Id to be used to generate individual user profile
$id ='';
if(isset($_GET['u'])){
	$user_id = $_GET['u'];
}

// Query User db for user records
$query_user = mysqli_query($db, "SELECT * FROM user WHERE user_id='$user_id'");

if(!isset($_SESSION['id'])){
	header('location: ../../admin');
}

while ($fetch = mysqli_fetch_assoc($query_user)){
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>E-Identity Verification</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../../css/bootstrap.min.css">
  <script src="../../js/jquery.js"></script>
  <script src="../../js/bootstrap.min.js"></script>

  <style>
   body{
	   //background-color: black;
   }
 
   
   .id_front{
	   width: 300px !important;
	   height: 450px !important;
	   background-color:white;
	   border-radius: 5%;
	   //border: solid  1px;
	   background-image: url('../../img/id_bg.png');
	   background-repeat: no-repeat;
   }
   .id_back{
	   width: 300px !important;
	   height: 450px !important;
	   background-color:white;
	   background-image: url('../../img/id_bg_back.png');
	   border-radius: 5%;
	   padding-top: 10px;
   }
   .row{
	   margin: 100px auto !important;
	   width: 700px !important;
	   height: 450px !important;
   }
   .heading{
	   width:85%;
	   height: auto;
	   margin-top: 15px;
	   margin-left: 35px !important;
	   margin-bottom: 10px;
   }
   .passport{
	   width: 50%;
	   height: auto;
	   border-radius: 25px;
	   border: solid 2px #313b78;
	   margin-left: 70px !important;
	   
   }
   
   .name{
	   text-transform: uppercase;
	   font-weight: bold;
	   color: #313b78;
	   margin-bottom: 0px;
	   font-size: 17px;
	   font-family: "Franklin Gothic Heavy";
	   margin-left: 25px !important;
   }
   .text-white{
	   font-size: 15px;
   }
   .signature{
	   margin-top: 10px;
	   margin-bottom: 0px !important;
	   padding-bottom: 0px !important;
	   width: 50px;
	   height: 30px;
   }
   .qr{
	   width: 30%;
	   height: auto;
	   margin-top: 3px;
   }
   .text{
	   font-size: 13px;
	   font-weight: bold;
	   margin-bottom: 3px;
	   padding-bottom: 0px;
	   padding-top: 0px;
   }
   .txt{
	   border-bottom: dotted 2px #313b78;
	   text-transform: uppercase;
	   font-family: "Franklin Gothic Heavy";
	   font-size: 12px;
	   font-weight: bold;
   }
   .txt-heading{
	   padding-left: 30px !important;
	   font-size: 10px;
	   font-weight: bold;
	   margin-bottom: 0px !important;
   }
   .txt-heading-sign{
	   padding-left: 30px !important;
	   font-size: 10px;
	   font-weight: bold;
	   margin-bottom: 0px !important;
	   padding-bottom: 0px !important
   }
   .stamp{
	   width: 21%;
	   height: auto;
	   float: right;
   }
   .txt2{
	   font-family: "Franklin Gothic Heavy";
	   font-size: 25px;
	   font-weight: bold;
	   padding-bottom: 0px;
	   margin-bottom: 0px;
   }
   .aut_sign{
	   width: 100%;
	   height: auto;
   }
  </style>
</head>
<body>

  
<div class="container content" >
	<div class=" row">
		<div class="col-sm-5 id_front">
			<img class="img img-fluid heading  mx-auto d-block" src="../../img/id_heading.png" />
			<img class="img img-fluid mx-auto d-block passport" src="<?php echo "../../photos/".$fetch['passport']?>" />
			<p class="text-center name"><?php echo $fetch['fname']." ".$fetch['lname'];?></p>
			<p class="txt-heading">POSITION: <span class="text-center txt"><?php echo $fetch['position']?></span></p>
			<p class="txt-heading">COMMAND: <span class="text-center txt"><?php echo $fetch['command']?></span></p>
			<p class="txt-heading">DIVISION/LGA: <span class="text-center txt"><?php echo $fetch['division']?></span></p>
			<p class="txt-heading-sign">HOLDER'S SIGN: <span class="text-center "><img class="txt signature" src="<?php echo "../../signatures/".$fetch['sign']?>" /></span></p>
			<img class="stamp d-block mx-auto" src="../../img/pcrc_stamp.png" />
			
			
			
			
		</div>
		
		<div class="col-sm-2 ">
		</div>
		
		<div class=" col-sm-5 id_back">
			
			<p class="text-center text">This Card is an Official Document and relation to the identification  of the
			person only and confirms that the holder is a Member with the <br>
			<h1 class="text-center txt2"> POLICE COMMUNITY</h1>
			<p class="text-center" style="padding-bottom: 0px; margin-bottom: 0px; font-weight:bold;">RELATIONS COMMITTEE </p>
			<h5 class="text-center"> (PCRC)</h5>
			<p class="text-center text">Impersonation by unauthorized holder is an offence
			<br>
			If found, please return it to the nearest Police Station or PCRC Office. <br>VALID TILL:<br>
			DECEMBER 2022 <br>
			<img class="img img-fluid mx-auto d-block qr" src="<?php echo "../../".$fetch['qr_code']?>"/>
			Authorised Signatures
			<img class="img img-fluid mx-auto d-block aut_sign" src="../../img/aut_sign.png" />
			</p>
			</p>
			
			
		</div>
		
	</div>
</div>


</body>
</html>
<?php } ?>

	
	

