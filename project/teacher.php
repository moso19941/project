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
<?php 	session_start(); ?>
	
<div class="container">
		<h1>Teacher control</h1>
		<div class="row">
			<nav class="navbar navbar-default">
				<div class="container-fluid">
					<div class="navbar-header">
						<a class="navbar-brand" href="#">Teacher control</a>
					</div>
					<ul class="nav navbar-nav">
						<li class="active"><a href="teacher.php">Home</a></li>
						<li><a href="teacher.php?onoffExam">Start/Stop Exam</a></li>
						<li><a href="teacher.php?creatExam">Create Exam</a></li>
						<li><a href="teacher.php?AllExam">See All Exam</a></li>
						<li><a href="teacher.php?studentans">Student Answers</a></li>
						<li><a href="teacher.php?logout">Log out</a></li>
						<li><a href="#"><?php echo "<p class='bg-success' >Welcome : ".$_SESSION['teacher']['fn']."</p>"; ?></a></li>
					</ul>
				</div>
			</nav>
		</div>
		<!--End of navbar  -->

		<div class="row" id="contentPage">
	<?php
	/*
	 * we have from the session id and firstname
	 *
	 */
	include 'dbconfig.php';
	
	if (isset ( $_GET ['onoffExam'] )) {
		/*
		 * here we'll do :
		 * - he can select an exam to trun it on/off
		 * - he's choice will be saved in db to make the student know if he start/stop the exam
		 */
		// echo "on off exam page";
		
		$sql = "SELECT `examTitle` FROM `examq`";
		$sqlT = mysql_query ( $sql );
		
		if (isset ( $sqlT )) {
			echo "<form action='./teacher.php?onoffExam' method='POST'>";
			echo "<select name='examSelected'>";
			while ( $row = mysql_fetch_array ( $sqlT ) ) {
				echo "<option>" . $row ['examTitle'] . "</option>";
			}
			echo "</select>";
			
			echo "<table class='table'>";
			echo "<tr><th>Enter the password for the exam : <input type='text' name='exampass' placeholder='type exam password here' id='exampass' class='form-control'></th></tr>>";
			echo "<tr><td><input type='submit' name='showExam' id='showExam' value ='Show Exam Questions'></td>";
			echo "<td><input type='submit' name='startExam' id='startExam' value ='Start the exam'></td>";
			echo "<td><input type='submit' name='EndExam' id='EndExam' value ='End the exam' the exam'></td></tr>";
			echo "</table>";
			echo "</form>";
			
			if (isset ( $_POST ['showExam'] )) {
				
				$examTitle = $_POST ['examSelected'];
				echo "The exam you selected is : " . $examTitle;
				
				// go to database and print the reslut
				$ShowQ = "SELECT `q1`, `q2`, `q3`, `q4`, `q5`, `q6`, `q7`, `q8`, `q9`, `q10`, `q11`, `q12` FROM `examq` WHERE `examTitle` = '$examTitle'";
				$sqlShowQ = mysql_query ( $ShowQ );
				
				if (isset ( $sqlShowQ )) {
					echo "<br>inside the the exam : " . $examTitle;
					echo "<div class='row'>";
					echo "<form action ='./teacher.php?onoffExam' method='POST'";
					echo "<div class='col-md-4'>";
					echo "<table class='table' >";
					
					while ( $row = mysql_fetch_row ( $sqlShowQ ) ) { // to print all the sqlShowQ ..
					                                                 // echo "inside the while loop";
						$q = 1;
						foreach ( $row as $cell ) {
							echo "<tr>";
							echo "<td>Qeustion $q<input value='$cell' id='q$q' name='q$q' class='form-control'></td>";
							$_SESSION ['qeustionUpdate'] ['q$q'] = $cell;
							// echo $_SESSION['qeustionUpdate']['q$q']."<br>";
							echo "</tr>";
							$q ++;
						}
					}
					echo "</table>";
					echo ("</div>");
					
					echo "<div class='col-md-4'>";
					echo "</div>";
					echo ("</form>");
					// echo $q;
					
					echo ("</div>");
				}
			}
			if (isset ( $_POST ['startExam'] )) {
				echo "start the exam<br>";
				$examTitle = $_POST ['examSelected'];
				// echo "$examTitle";
				$password = $_POST ['exampass'];
				$sqlaccess = "INSERT INTO `examaccess`(`number_exam`, `exam_title`, `password`, `status`) VALUES ('','$examTitle','$password',1)";
				$sqlA = mysql_query ( $sqlaccess );
				if (isset ( $sqlA )) {
					?>
								<script>
								alert('The exam is starting now');
						        </script>
					<?php
				}
				echo "</div>";
			}
			
			if (isset ( $_POST ['EndExam'] )) {
				echo "start the exam<br>";
				$examTitle = $_POST ['examSelected'];
				// echo "$examTitle";
				
				$password = $_POST ['exampass'];
				$sqlaccess = "INSERT INTO `examaccess`(`number_exam`, `exam_title`, `password`, `status`) VALUES ('','$examTitle','$password',0)";
				$sqlA = mysql_query ( $sqlaccess );
				if (isset ( $sqlA )) {
					?>

								<script>
								alert('The exam is End now');
						        </script>
							<?php
				}
				echo "</div>";
			}
		}
	}
	if (isset ( $_GET ['logout'] )) {
		// here we will destory the sesstion and go to the login page
		session_destroy ();
		// echo "logged out";
		header ( 'Location: login.php' );
	}
	if (isset ( $_GET ['creatExam'] )) {
		/*
		 * here we'll do :
		 * - take his questions in form
		 * - send it to the database
		 * - if it save on not we will display alert to notify him about the status
		 */
		?>

		<div class="row" id="contentPage">

				<div class="col-md-12" id="exam-q">
					<h2 class="text-center">Creat new Exam :</h2>
					<br>
					<p>please enter the number of the quetions :[max = 12 qeution]</p>

					<form action="./teacher.php?creatExam" method="POST">
						<div class="col-md-8">
							<label for="title-exam">Title of the exam :</label> <input
								type="text" class="form-control" id="title_exam"
								name="title_exam" placeholder="Title of the exam"> <br>
						</div>

						<table class="table table-striped">
							<tr>
								<th><label for="q1">Question 1 :</label> <input type="text"
									class="form-control" name="q1" id="q1" placeholder="Question 1"></th>

								<th><label for="q2">Question 2 :</label> <input type="text"
									class="form-control" name="q2" id="q2" placeholder="Question 2"></th>

								<th><label for="q3">Question 3 :</label> <input type="text"
									class="form-control" name="q3" id="q3" placeholder="Question 3"></th>
							</tr>

							<tr>
								<td><label for="q4">Question 4 :</label> <input type="text"
									class="form-control" name="q4" id="q4" placeholder="Question 4"></td>

								<td><label for="q5">Question 5 :</label> <input type="text"
									class="form-control" name="q5" id="q5" placeholder="Question 5"></td>

								<td><label for="q6">Question 6 :</label> <input type="text"
									class="form-control" name="q6" id="q6" placeholder="Question 6"></td>
							</tr>

							<tr>
								<td><label for="q7">Question 7 :</label> <input type="text"
									class="form-control" name="q7" id="q7" placeholder="Question 7"></td>

								<td><label for="q8">Question 8 :</label> <input type="text"
									class="form-control" name="q8" id="q8" placeholder="Question 8"></td>

								<td><label for="q9">Question 9 :</label> <input type="text"
									class="form-control" name="q9" id="q9" placeholder="Question 9"></td>
							</tr>

							<tr>
								<td><label for="q10">Question 10 :</label> <input type="text"
									class="form-control" name="q10" id="q10"
									placeholder="Question 10"></td>

								<td><label for="q11">Question 11 :</label> <input type="text"
									class="form-control" name="q11" id="q11"
									placeholder="Question 11"></td>

								<td><label for="q12">Question 12 :</label> <input type="text"
									class="form-control" name="q12" id="q12"
									placeholder="Question 12"></td>
							</tr>
						</table>
						<input type="submit" value="save" name="addQuetions">
					</form>
				</div>

			</div>
		
		

<?php
		
		if (isset ( $_POST ['addQuetions'] )) {
			/*
			 *
			 *
			 * we need to check the title is empty or not
			 * and not the same name as another exams
			 *
			 */
			echo "save qeution";
			$title_exam = $_POST ['title_exam'];
			$q1 = $_POST ['q1'];
			$q2 = $_POST ['q2'];
			$q3 = $_POST ['q3'];
			$q4 = $_POST ['q4'];
			$q5 = $_POST ['q5'];
			$q6 = $_POST ['q6'];
			$q7 = $_POST ['q7'];
			$q8 = $_POST ['q8'];
			$q9 = $_POST ['q9'];
			$q10 = $_POST ['q10'];
			$q11 = $_POST ['q11'];
			$q12 = $_POST ['q12'];
			
			$sql = "INSERT INTO `examq` (`no_exam`,`examTitle`, `q1`, `q2`, `q3`, `q4`, `q5`, `q6`, `q7`, `q8`, `q9`, `q10`, `q11`, `q12`) 
						VALUES ('','" . $title_exam . "','" . $q1 . "','" . $q2 . "','" . $q3 . "','" . $q4 . "','" . $q5 . "','" . $q5 . "','" . $q7 . "','" . $q8 . "','" . $q9 . "','" . $q10 . "','" . $q11 . "','" . $q12 . "');";
			
			// echo "$sql";
			
			$result = mysql_query ( $sql );
			if ($result) {
				?>

							<script>
							alert('The quetions successfully been added');
					        </script>
						<?php
			} else {
				// echo"mysqli_error($result)";
				?>
							<script>
							alert('Something went wrong in add-questions');
					        </script>
						<?php
			}
		} else {
			// echo "error adding the qutions";
		}
	}
	if (isset ( $_GET ['AllExam'] )) {
		
		/*
		 * here we'll do :
		 * - show him all the exams that are saved in the db
		 * - he can select exam and update/remove it
		 */
		
		echo "<h3>All exame page</h3>";
		echo "<br>";
		
		$sql = "SELECT `examTitle` FROM `examq`";
		$sqlT = mysql_query ( $sql );
		
		if (isset ( $sqlT )) {
			echo "<form action='./teacher.php?AllExam' method='POST'>";
			echo "<select name=examSelected>";
			while ( $row = mysql_fetch_array ( $sqlT ) ) {
				echo "<option>" . $row ['examTitle'] . "</option>";
			}
			echo "</select>";
			echo "<input type='submit' name='showExam' id='showExam' value ='showExam'>";
			echo "</form>";
			
			// display the exam that had been choicen
			if (isset ( $_POST ['showExam'] )) {
				
				/*
				 * Missing the update questions for the exams
				 */
				
				// echo "show exam";
				$examTitle = $_POST ['examSelected'];
				echo "The exam you selected is : " . $examTitle;
				
				// go to database and print the reslut
				$ShowQ = "SELECT `q1`, `q2`, `q3`, `q4`, `q5`, `q6`, `q7`, `q8`, `q9`, `q10`, `q11`, `q12` FROM `examq` WHERE `examTitle` = '$examTitle'";
				$sqlShowQ = mysql_query ( $ShowQ );
				
				if (isset ( $sqlShowQ )) {
					echo "<br>inside the the exam : " . $examTitle;
					echo "<div class='row'>";
					echo "<form action ='./teacher.php?AllExam' method='POST'";
					
					echo "<div class='col-md-4'>";
					echo "<table class='table' >";
					while ( $row = mysql_fetch_row ( $sqlShowQ ) ) { // to print all the sqlShowQ ..
					                                                 // echo "inside the while loop";
						$q = 1;
						foreach ( $row as $cell ) {
							echo "<tr>";
							echo "<td>Qeustion $q<input value='$cell' id='q$q' name='q$q' class='form-control'></td>";
							echo "</tr>";
							$q ++;
						}
					}
					echo "</table>";
					echo ("</div>");
					
					echo "<div class='col-md-4'>";
					echo "<input type= 'submit' name='updateQ' id='updateQ' value='Update'>";
					echo "</div>";
					echo ("</form>");
					
					echo ("</div>");
				} else {
					// echo "error in selecting the exam";
				}
			} else {
				// echo "error in show exam";
			}
		}
	}
	if (isset ( $_GET ['studentans'] )) {
		/*
		 * here we'll do :
		 * - he will select a section
		 * - then show him sutdent number/ name / link to the answers
		 * - then he can grade it after that save it in db
		 */
		
		echo "<h3>Show Student Answers</h3>";
		echo "<br>";
		
		$sql = "SELECT distinct `exam_title` FROM `student_anw`";
		$sqlT = mysql_query ( $sql );
		
		if (isset ( $sqlT )) {
			echo "<form method='POST'>";
			echo "<select name='examSelected'>";
			while ( $row = mysql_fetch_array ( $sqlT ) ) {
				echo "<option>" . $row ['exam_title'] . "</option>";
				$_SESSION ['titleExam'] = $row ['exam_title'];
			}
			echo "</select>";
			echo "<input type='submit' name='showStudent' id='showStudent' value ='show Student'>";
			echo "</form>";
		}
		if (isset ( $_POST ['showStudent'] )) {
			// echo "showStudent";
			$examTit = $_POST ['examSelected']; // take exam selected
			$sql = "SELECT `id` FROM `student_anw` WHERE `exam_title`= '$examTit'";
			$sqlID = mysql_query ( $sql );
			// loop and get the name of the student and section
			// create array to store all id of the student that took the exam and get their iformation
			$stInfo = array ();
			$index = 0;
			if (isset ( $sqlID )) {
				while ( $row = mysql_fetch_array ( $sqlID ) ) {
					// echo $row ['id']."<br>";
					$stInfo [$index] = $row ['id'];
					$index ++;
				}
				
				// make for loop and retrive there name
				$arrlength = count ( $stInfo );
				
				echo "<div class='row'>";
				echo "<div class='col-md-6'>";
				echo "<table class='table'>";
				
				echo "<form method = 'post' action='./teacher.php?displayStudentAns' target='_blank'>";
				echo '<div class="form-group">
  				<label for="sel1">Select list:</label>
 				<select class="form-control" name="idStu">';
				for($x = 0; $x < $arrlength; $x ++) {
					$sqlINFO = "SELECT * FROM `student` WHERE `id`= $stInfo[$x]";
					$sqlINFO1 = mysql_query ( $sqlINFO );
					while ( $row = mysql_fetch_array ( $sqlINFO1 ) ) {
						
						$stname = $row ['firstname'] . " " . $row ['lastname'] . " " . $row ['id'];
						$id = $row ['id'];
						
						echo ' <option>' . $row ['id'] . '</option> ';
						$_SESSION ['fn'] [$id] = $row ['firstname'];
						$_SESSION ['ln'] [$id] = $row ['lastname'];
						$_SESSION ['id'] [$id] = $row ['id'];
					}
				}
				echo '</select>
						</div>';
				// echo "<input type='hidden' name='seeAns' value='see the answer'>";
				
				echo "<input type='hidden' name='idstu' value=''>";
				echo "<input type='hidden' name='tit' value='$examTit'>";
				echo "<input type='submit' name='seeAns' value='see the answer'>";
				echo "</form>";
			}
			// echo "atudent ans page";
		}
	} else if (isset ( $_GET ['displayStudentAns'] )) {
		if (isset ( $_POST ['seeAns'] )) {
			$t = $_POST ['tit'];
			$id = $_POST ['idStu'];
			
			echo "<h3>Exam title : " . $t . "</h3>";
			$sqlINFO = "SELECT * FROM `student` WHERE `id`= $id";
			$sqlINFO1 = mysql_query ( $sqlINFO );
			
			while ( $row = mysql_fetch_array ( $sqlINFO1 ) ) {
				//echo $row ['firstname'] . " " . $row ['lastname'] . " " . $row ['id'];
				$id = $row ['id'];
			}
			
			echo "<div class='row'>";
			echo "<div class='col-md-6'>";
			$sqlQ = "SELECT * FROM `student_anw` WHERE `id`= $id AND `exam_title` =	'$t'";
			$sqlQQ1 = mysql_query ( $sqlQ );
			$numberQ = 1;
			echo "<table class='table table-striped'>";
			while ( $row = mysql_fetch_row ( $sqlQQ1 ) ) { // to print all the sqlShowQ ..

				foreach ( $row as $cell ) {
					echo "<tr><td>".$cell."</td></tr>";
					
				}
			}
// 			echo "<form action='' method='post'>";
// 			echo "<input type='hidden' name='tit' value='$t'>";
// 			echo "<input type='hidden' name='ids' value='$id'>";
// 			echo "<input type='submit' name='comment' value='sumbit grade'>";
// 			echo "</form>";
			
			echo "</table>";
			
			echo "</div>";
			echo "<div class='col-md-6'>";
			echo "<form method = 'post' action='teacher.php?gradeStudent'>";
			echo "<table class='table table-striped'>";
			echo "<tr><td>Grade <input type='text' name='grade' class='form-control'> </td></tr>";
			echo "<tr><td> Comment for Question 1 <input type='text' name='q1' class='form-control'> </td></tr>";
			echo "<tr><td> Comment for Question 2 <input type='text' name='q2' class='form-control'> </td></tr>";
			echo "<tr><td> Comment for Question 3 <input type='text' name='q3' class='form-control'> </td></tr>";
			echo "<tr><td> Comment for Question 4 <input type='text' name='q4' class='form-control'> </td></tr>";
			echo "<tr><td> Comment for Question 5 <input type='text' name='q5' class='form-control'> </td></tr>";
			echo "<tr><td> Comment for Question 6 <input type='text' name='q6' class='form-control'> </td></tr>";
			echo "<tr><td> Comment for Question 7 <input type='text' name='q7' class='form-control'> </td></tr>";
			echo "<tr><td> Comment for Question 8 <input type='text' name='q8' class='form-control'> </td></tr>";
			echo "<tr><td> Comment for Question 9 <input type='text' name='q9' class='form-control'> </td></tr>";
			echo "<tr><td> Comment for Question 10 <input type='text' name='q10' class='form-control'> </td></tr>";
			echo "<tr><td> Comment for Question 11 <input type='text' name='q11' class='form-control'> </td></tr>";
			echo "<tr><td> Comment for Question 12 <input type='text' name='q12' class='form-control'> </td></tr>";
			echo "</table>";
			
			echo "<input type='hidden' name='tit' value='$t'>";
			echo "<input type='hidden' name='ids' value='$id'>";
			echo "<input type='submit' name='comment' value='sumbit grade'>";
			echo "</form>";
			
			echo "</div>";
			echo "</div>";
			
			

		}
	} if(isset ( $_GET ['gradeStudent'] )){
		if (isset ( $_POST ['comment'] )) {
			$t = $_POST ['tit'];
			$id = $_POST ['ids'];
			$grade = $_POST ['grade'];
			$q1 = $_POST ['q1'];
			$q2 = $_POST ['q2'];
			$q3 = $_POST ['q3'];
			$q4 = $_POST ['q4'];
			$q5 = $_POST ['q5'];
			$q6 = $_POST ['q6'];
			$q7 = $_POST ['q7'];
			$q8 = $_POST ['q8'];
			$q9 = $_POST ['q9'];
			$q10 = $_POST ['q10'];
			$q11 = $_POST ['q11'];
			$q12 = $_POST ['q12'];
			
			$sqlCom ="INSERT INTO `student_grade`(`id`, `exam_title`,`grade`, `q1`, `q2`, `q3`, `q4`, `q5`, `q6`, `q7`, `q8`, `q9`, `q10`, `q11`, `q12`)
			VALUES($id,'$t','$grade','" . $q1 . "','" . $q2 . "','" . $q3 . "','" . $q4 . "','" . $q5 . "','" . $q5 . "','" . $q7 . "','" . $q8 . "','" . $q9 . "','" . $q10 . "','" . $q11 . "','" . $q12 . "')";
			$sqlComm = mysql_query ( $sqlCom );
			if (isset ( $sqlComm )) {
				?>
									<script>
									alert('You grade the student');
							        </script>
						<?php
						}
					}
	}else {
		echo "<h3 class='bg-success'> Welcome : " . $_SESSION ['teacher'] ['fn'] . "</h3>";
	}
	
	?>
</div>
	</div>



</body>
</html>
