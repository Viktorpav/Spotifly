<?php

function sanitizeFormUserName($inputText){ // this function for reduce line of code $userName

	$inputText = strip_tags($inputText);
	$inputText = str_replace(" ", "", $inputText);
	return $inputText;
}

function sanitizeFormString($inputText){ // this function for reduce line of code for $firstName, $lastName

	$inputText = strip_tags($inputText);
	$inputText = str_replace(" ", "", $inputText);
	$inputText = ucfirst(strtolower($inputText));
	return $inputText;
}

function sanitizeFormPassword($inputText){ // this function for reduce line of code $password

	$inputText = strip_tags($inputText);
	return $inputText;
}


if (isset($_POST['registerButton'])){
	//Register button was pressed
	$userName = sanitizeFormUserName($_POST['userName']); //call back function
	$firstName = sanitizeFormString($_POST['firstName']); // the same call back $firstName
	$lastName = sanitizeFormString($_POST['lastName']); // the same call back $lastName
	$email = sanitizeFormString($_POST['email']); // the same call back $email
	$password = sanitizeFormPassword($_POST['password']); // the same call back $password
	$password2 = sanitizeFormPassword($_POST['password2']);

	$wasSuccessful = $account->register($userName, $firstName, $lastName, $email, $password, $password2);

	if($wasSuccessful == true){
		$_SESSION['userLoggedIn'] = $userName;
		header("Location: index.php");
	}

}

?>