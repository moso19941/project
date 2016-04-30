function previewAns() {
	var numberOFquestions = document.getElementById("numberOfQuestions").value;

	for (i = 0; i < numberOFquestions; i++) { 
		document.getElementById("printNumberOfQuestions").innerHTML = "print the number of the question : " + numberOfQuestions ;
	}
}

function sendID(){
	var id = document.getElementById("stidAns").value;
	
	document.getElementById("printID").innerHTML = id;
}


function checkform(){
	var fn =document.getElementById("fn").value;
	var ln =document.getElementById("ln").value;
	var pass = document.getElementById("password").value;
	var id = document.getElementById("id").value;
	var email = document.getElementById("eamil").value;
	var co =document.getElementById("co").value;
	var se = document.getElementById("se").value;
	
	if(fn == "" || ln == ""|| pass == ""|| id== ""|| email == ""|| co == ""|| se == ""){
		alert("please check the form again");
		return false;
	}
	return true;
}