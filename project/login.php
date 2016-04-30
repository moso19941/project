<!DOCTYPE html>
<html>
<head>
<title>Online Exam</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet"
	href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script
	src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<body>
	<div class="row">
		<div class="col-md-4"></div>
		<div class="col-md-4">
			<form action="login.php" method="post" id="msgLogin">
				<h3>Login</h3>
				<p>
					If you don't have an account please
					<mark>
						<a href="Register.php"> Sing up here </a>
					</mark>
				</p>

				<label>ID : <input type="text" id="signId" name="signId"
					placeholder="Enter you ID here" class="form-control"></label> <label>Password
					: <input type="password" id="password" name="password"
					placeholder="Enter you ID here" class="form-control">
				</label> <input type="submit" name="login" id="login" value="Log in"
					class="btn btn-success">
			</form>
		</div>
		<div class="col-md-4"></div>
	</div>
	<div class="row">
		<div class="col-md-4"></div>
		<div class="col-md-4">
<?php
if (isset ( $_POST ['login'] )) {
	include 'dbconfig.php';
	session_start ();
	// we'll check the id and password are correct and based on that it will send him to either teacher.php or student.php
	$id = $_POST ['signId'];
	$password = $_POST ['password'];
	
	// check if he's the teacher
	$sqlTeacher = "SELECT `id`, `password`,`firstname`  FROM `teacher`";
	$sqlT = mysql_query ( $sqlTeacher );
	
	if (isset ( $sqlT )) {
		
		if (! empty ( $id ) && ! empty ( $password )) {
			
			while ( $row = mysql_fetch_array ( $sqlT ) ) {
				
				if ($id == $row ['id'] && $password == $row ['password']) {
					echo "<br>";
					echo $id . " -- > " . $row ['firstname'] . " you loged in succfully";
					
					$_SESSION ['teacher'] ['id'] = $id;
					$_SESSION ['teacher'] ['fn'] = $row ['firstname'];
					
					// ************************************************************************************************************
					// echo $_SESSION['teacher']['id']; // by this we store the id number of the teacher then send it to teacher.php
					// ************************************************************************************************************
					
					header ( 'Location: teacher.php' );
					exit ();
				} else {
					
					// check if he student
					$sqlStudent = "SELECT * FROM `student`";
					$sqlS = mysql_query ( $sqlStudent );
					if (isset ( $sqlS )) {
						while ( $row = mysql_fetch_array ( $sqlS ) ) {
							
							if ($id == $row ['id'] && $password == $row ['password']) {
								echo "<br>";
								echo $id . " -- > " . $row ['firstname'] . " you loged in succfully";
								$_SESSION ['student'] ['id'] = $id;
								$_SESSION ['student'] ['fn'] = $row ['firstname'];
								$_SESSION ['student'] ['lastname'] = $row ['lastname'];
								$_SESSION ['student'] ['course'] = $row ['course'];
								$_SESSION ['student'] ['section'] = $row ['section'];
								$_SESSION ['student'] ['email'] = $row ['email'];
								header ( 'Location: student.php' );
								exit ();
							} else {
								echo "<h4 id='loginMsgError'>wrong id or password please try again!</h4>";
							}
						}
					}
				}
			}
		}
	}
	
	// echo "<br>loged in";
} else {
	// echo "not loged in";
}
?>
</div>
		<div class="col-md-4"></div>
	</div>
</body>
</html>