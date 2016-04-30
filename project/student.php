<!DOCTYPE html>
<html>
<head>
<title>student control</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet"
	href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script
	src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script type="text/javascript" src="script.js"></script>
<link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<body>


<?php
session_start ();
include 'dbconfig.php';

$stid = $_SESSION ['student'] ['id'];
$stfn = $_SESSION ['student'] ['fn'];
$stln = $_SESSION ['student'] ['lastname'];
$course = $_SESSION ['student'] ['course'];
$section = $_SESSION ['student'] ['section'];
$email = $_SESSION ['student'] ['email'];

$q1 = "no change";

// for just declear it because there're some errors occurs
// $number = 1;
// for($x = 1; $x < 13; $x ++) {
// $ans = "ans" . $number;
// $d = $_SESSION ['answers'] ['$ans'] = $number;
// echo "$d";
// $number ++;
// }

?>


<div class="container-fluid">
		<h1>Student control</h1>
		<div class="row">
			<nav class="navbar navbar-default">
				<div class="container-fluid">
					<div class="navbar-header">
						<a class="navbar-brand" href="#">Student control</a>
					</div>
					<ul class="nav navbar-nav">
						<li class="active"><a href="student.php">Home</a></li>
						<li><a href="student.php?checkExam">Exam</a></li>
						<li><a href="student.php?grade">Grade</a></li>
						<li><a href="teacher.php?logout">Log out</a></li>
						<li><a href="#"><?php echo "<p class='bg-success' >Welcome : ".$stfn."</p>"; ?></a></li>
					</ul>
				</div>
			</nav>
		</div>
		<!--End of navbar  -->


		<div class="row" id="contentPage">
	<?php
	
	if (isset ( $_GET ['checkExam'] )) {
		/*
		 * - check if there is an exam turn on now ( last exam )
		 * - make the student preview the answers that he did ( <-- go back submit --> )
		 * - insert student answers into database by his id by using SESSION after submition
		 * - send to the student an email to inform him
		 */
		$sqlch = "SELECT `exam_title`,`password`,`status` FROM `examaccess` ORDER BY `number_exam` DESC";
		$echeck = mysql_query ( $sqlch );
		
		// do one loop then exite to get the last exam_number that had been added
		// $_SESSION['examInfo']['title'];
		// $_SESSION['examInfo']['password'];
		// $_SESSION['examInfo']['status'];
		
		if (isset ( $echeck )) {
			// echo "insdie the query";
			while ( $row = mysql_fetch_array ( $echeck ) ) {
				// echo "$status";
				$_SESSION ['examInfo'] ['title'] = $row ['exam_title'];
				$_SESSION ['examInfo'] ['password'] = $row ['password'];
				$_SESSION ['examInfo'] ['status'] = $row ['status'];
				
				// echo "$status";
				break;
			}
			// echo "The last exam is : --->".$_SESSION['examInfo']['title']."<br>The password is :<br>".
			// $_SESSION['examInfo']['password'].
			// "The status is : ".$_SESSION['examInfo']['status'];
			$tit = $_SESSION ['examInfo'] ['title'];
			$status = $_SESSION ['examInfo'] ['status'];
			
			/*
			 *
			 * $stfn
			 * $stln
			 * $course
			 * $section
			 * $email
			 */
			
			if ($status == 0) {
				echo "there's NO exam yet";
			} else {
				echo "<h3> Exam title : $tit </h3>";
				echo "<table class='table'>";
				echo "<tr>";
				echo "<th> Name </th>";
				echo "<td> $stfn, $stln</td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td> section </td>";
				echo "<td> $section </td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td> Semseter </td>";
				echo "<td>  </td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td> Email </td>";
				echo "<td> $email</td>";
				echo "</tr>";
				$ShowQ = "SELECT `q1`, `q2`, `q3`, `q4`, `q5`, `q6`, `q7`, `q8`, `q9`, `q10`, `q11`, `q12` FROM `examq` WHERE `examTitle` = '$tit'";
				$sqlShowQ = mysql_query ( $ShowQ );
				if (isset ( $sqlShowQ )) {
					echo "<div class='col-md-2'></div>";
					echo "<div class='col-md-8'> <table class='table'>";
					echo "<form method='POST' action='./student.php?preivewExam' target='_blank'>";
					while ( $row = mysql_fetch_row ( $sqlShowQ ) ) {
						
						$q = 1;
						foreach ( $row as $cell ) {
							if ($cell != "") { // if any qestion that is empty we don't print it
								echo "<tr>";
								echo "<td>Qeustion $q : $cell</td>";
								$_SESSION ['questions'] ['$q'] = $cell;
								echo "</tr>";
								
								echo "<tr>";
								echo "<td><textarea class='form-control' rows='5' id='ans$q' name ='ans$q'></textarea></td>";
								// here we will save student answer by seestion using student id ( Get the name/id of the answers to use it)
								// $_SESSION['studentAnwers'][$stid]['ans$q'];
								echo "</tr>";
								$q ++;
							}
						}
						
						// echo "<p id='numberOfQuestions'>$q</p> ";
						// echo "<p id='printNumberOfQuestions'> </p>";
					}
					echo "<input type='hidden' name='numberQ' value='$q'>"; // to get the number of the questions
					
					echo "<tr><td><input type='submit' name='PreviewAns' value='Preview your Answers' ></td></tr>";
					
					echo "</form></table></div>";
					
					// echo $_POST['ans1'];
					
					// here will add the answers to the database
					// $sqlch = "INSERT INTO `student_anw`(`no`,`exam_title`, `id`, `q1`, `q2`, `q3`, `q4`, `q5`, `q6`, `q7`, `q8`, `q9`, `q10`, `q11`, `q12`) VALUES ()";
					// $echeck = mysql_query($sqlch);
					
					echo "<div class='col-md-2'></div>";
				} else {
					echo "error printing the quetions";
				}
			}
		} else {
			echo "error in exam check";
		}
		
		// echo $_SESSION['examInfo']['title'].
		// $_SESSION['examInfo']['password'].
		// $_SESSION['examInfo']['status'];
		
		// echo "exams";
	} else if (isset ( $_GET ['preivewExam'] )) {
		// echo "inside reviewEzam";
		
		if ($_POST ['PreviewAns']) {
			
			// echo "works!!";
			
			/*
			 * take as post then
			 * here we'll save it in session
			 * preview the anwers then ask him for save or go back
			 */
			
			$number = 1;
			$que = $_POST ['numberQ'];
			$title = $_SESSION ['examInfo'] ['title'];
			
			echo "<h3>Exam title : $title</h3>";
			// echo "student id is : $stid";
			echo "<table class='table'>";
			echo "<tr>";
			echo "<th> Name </th>";
			echo "<td> $stfn, $stln</td>";
			echo "</tr>";
			echo "<tr>";
			echo "<td> section </td>";
			echo "<td> $section </td>";
			echo "</tr>";
			echo "<tr>";
			echo "<td> Semseter </td>";
			echo "<td>  </td>";
			echo "</tr>";
			echo "<tr>";
			echo "<td> Email </td>";
			echo "<td> $email</td>";
			echo "</tr>";
			echo "</table>";
			
			// we declear array to save the answers then insert it to database
			
			for($x = 1; $x < $que; $x ++) {
				$ans = "ans" . $number;
				// echo "$ans";
				echo "<div id='insidePreview'>";
				echo "<h4 id='questionPreview'> <u>Question</u> : $x</h4><br>";
				$ans = $_SESSION ['answers'] ['$ans'] = $_POST [$ans];
				$ArrayANS [$x] = $ans;
				echo "<code> $ans </code>";
				echo "</div>";
				$number ++;
			}
			// echo "number of elements is the array is : ".count($ArrayANS)."<br>";
			// echo "<p>$ArrayANS[4]</p>";
			
			// full the not written question to insert it to database
			if ($number < 13) {
				$remain = 12 - $number;
				// echo "indise the if stattment";
				echo "$remain<br>";
				for($x = 0; $x <= $remain; $x ++) {
					$ans = "ans" . $number;
					echo "<br>";
					$ans = $_SESSION ['answers'] ['$ans'] = "no question";
					echo "$ans";
					$ArrayANS [$number] = $ans;
					echo $number ++;
					// echo "<br>$number";
				}
			}
			
			// echo "<br><br>number of elements is the array is : ".count($ArrayANS)."<br>";
			// echo "<p>$ArrayANS[10]</p>";
			
			// send the answers to the database
			echo "<form method='post' action='./student.php?preivewExamSuccess'>";
			echo "<input type='submit' name='saveStAns' class='btn btn-warning'>";
			echo "<input type='hidden' name='examtitle' value='$title'>";
			echo "<input type='hidden' name='q1' value='$ArrayANS[1]'>";
			echo "<input type='hidden' name='q2' value='$ArrayANS[2]'>";
			echo "<input type='hidden' name='q3' value='$ArrayANS[3]'>";
			echo "<input type='hidden' name='q4' value='$ArrayANS[4]'>";
			echo "<input type='hidden' name='q5' value='$ArrayANS[5]'>";
			echo "<input type='hidden' name='q6' value='$ArrayANS[6]'>";
			echo "<input type='hidden' name='q7' value='$ArrayANS[7]'>";
			echo "<input type='hidden' name='q8' value='$ArrayANS[8]'>";
			echo "<input type='hidden' name='q9' value='$ArrayANS[9]'>";
			echo "<input type='hidden' name='q10' value='$ArrayANS[10]'>";
			echo "<input type='hidden' name='q11' value='$ArrayANS[11]'>";
			echo "<input type='hidden' name='q12' value='$ArrayANS[12]'>";
			echo "</form>";
			
			// echo "<p>$ArrayANS[10]</p>";
		}
	} else if (isset ( $_GET ['preivewExamSuccess'] )) {
		if ($_POST ['saveStAns']) {
			$examTitle = $_POST ['examtitle'];
			echo "<h3 id='questionPreview'>You submited your exam : $examTitle</h3>";
			$stid = $_SESSION ['student'] ['id'];
			
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
			
			// echo $stid . " : ". $q7;
			$sql = "INSERT INTO `student_anw`(`id`, `exam_title`, `q1`, `q2`, `q3`, `q4`, `q5`, `q6`, `q7`, `q8`, `q9`, `q10`, `q11`, `q12`)
							VALUES($stid,'$examTitle', '$q1', '$q2', '$q3', '$q4', '$q5', '$q6', '$q7', '$q8', '$q9', '$q10', '$q11', '$q12')";
			$sqlA = mysql_query ( $sql );
			if (isset ( $sqlA )) {
				?>
					<script>
					alert('you submitted your exam successfully');
			        </script>
				<?php
			}
			
			//echo $sql;
		}
		
		// echo "<p>$q1</p>";
	} else if (isset ( $_GET ['grade'] )) {
		echo "<div class='row'>";
		
		echo "<div class='col-md-3'>";
		echo "<table class='table table-striped'>";
		
		echo "<tr><td>ID</td></tr>";
		echo "<tr><td>Title of the quiz</td></tr>";
		echo "<tr><td>Grade</td></tr>";
		echo "<tr><td>Comment For Q1 </td></tr>";
		echo "<tr><td>Comment For Q2 </td></tr>";
		echo "<tr><td>Comment For Q3</td></tr>";
		echo "<tr><td>Comment For Q4</td></tr>";
		echo "<tr><td>Comment For Q5</td></tr>";
		echo "<tr><td>Comment For Q6 </td></tr>";
		echo "<tr><td>Comment For Q7 </td></tr>";
		echo "<tr><td>Comment For Q8 </td></tr>";
		echo "<tr><td>Comment For Q9 </td></tr>";
		echo "<tr><td>Comment For Q10 </td></tr>";
		echo "<tr><td>Comment For Q11 </td></tr>";
		echo "<tr><td>Comment For Q12 </td></tr>";

		echo "</table>";
		echo "</div>";

		echo "<div class='col-md-4'>";
		echo "Your answers";
		echo "<table class='table table-striped'>";
		$sqlHis ="SELECT * FROM `student_anw` WHERE `id` = $stid";
		$sqlHiss = mysql_query ( $sqlHis );
		if (isset ($sqlHiss )) {
			
			while ( $row = mysql_fetch_row ( $sqlHiss ) ) { // to print all the sqlShowQ ..
					
				foreach ( $row as $cell ) {
					echo "<tr><td></td><td>".$cell."</td></tr>";
		
				}
			}
		}
		echo "</table>";
		echo "</div>";
		echo "comments form the Dr.";
		echo "<div class='col-md-5'>";
		$sqlCom ="SELECT * FROM `student_grade` WHERE `id` = $stid";
		$sqlComm = mysql_query ( $sqlCom );
		
		if (isset ( $sqlComm )) {
			echo "<table class='table table-striped'>";
			while ( $row = mysql_fetch_row ( $sqlComm ) ) { // to print all the sqlShowQ ..
					
				foreach ( $row as $cell ) {
					echo "<tr><td></td><td>".$cell."</td></tr>";
		
				}
			}
			echo "</table>";
		}
		
		echo "</div>";
		echo "</div>";

		
		
	}
	if (isset ( $_GET ['logout'] )) {
		// here we will destory the sesstion and go to the login page
		session_destroy ();
		// echo "logged out";
		header ( 'Location: login.php' );
	} else {
		echo "welcome<br>";
		echo $_SESSION ['student'] ['fn'] . "<br>" . $_SESSION ['student'] ['id'];
	}
	?>

	</div>

	</div>


</body>
</html>