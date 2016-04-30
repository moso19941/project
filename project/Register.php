<!DOCTYPE html>
<html>
<head>
<title>Teacher control</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet"
	href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script
	src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="stylesheet.css">
<script type="text/javascript" src="script.js"></script>
</head>
<body>
	<div class="row">
		<div class="container">
			<div class="jumbotron">
				<h1>Online Exam System</h1>
			</div>
		</div>

	</div>
	<div class="row">
		<div class="col-md-4">
		<h3><a href="login.php">Home Page ?</a></h3>
		
		</div>

		<div class="col-md-4">
			<form action="" method="post" onsubmit="return checkform()">
			<p id="Error in the form"></p>
				First Name : <input type='text' name='fn' id='fn' class='form-control'> 
				LastName : <input type='text' name='ln' id="ln" class='form-control'> 
				ID : <input type='text' name='id' id='id' class='form-control'> 
				Course : <input type='text' name='co' id="co" name='ln' class='form-control'>
				Section : <input type='text' name='se' id="se" class='form-control'>
				 Password : <input type='text' name='password' id="password" class='form-control'>
					 Email : <input type='text' name='email' id="email" class='form-control'>
					<br>
					<input type="submit" name="reg" value="Register"  class="btn btn-primary">
			</form>
		</div>


		<div class="col-md-4">
		<?php 
		include 'dbconfig.php';
		
		if(isset($_POST['reg'])){
			//echo "hi"; 
			$fn = $_POST['fn'];
			$ln = $_POST['ln'];
			$id = $_POST['id'];
			$co = $_POST['co'];
			$se = $_POST['se'];
			$pass = $_POST['password'];
			$email = $_POST['email'];
			// check if the id is exist
			$result = mysql_query("SELECT id FROM  student WHERE id = 'id'");
			if(mysql_num_rows($result) == 0) {
				$sql = "INSERT INTO `student`(`no`, `id`, `firstname`, `lastname`, `course`, `section`, `password`, `email`) 
			VALUES('','$id','$fn','$ln','$co','$se','$pass','$email')";
				$reg = mysql_query ( $sql );
				echo '<div class="alert alert-info">';
				echo "<h3>Welecom you successfully register in the system</h3>";
				echo "</div>";
			} else {
				// do other stuff...
			}
		}
		
		
		?>
		
		
		</div>


	</div>



</body>
</html>
<?php
