<?php
	class Account {

		private $con;
		private $errorArray;

		public function __construct($con){
			$this->con = $con;
			$this->errorArray = array();
		}

		public function login($un, $pw){

			$pw = md5($pw);

			$query = mysqli_query($this->con, "SELECT * FROM users WHERE username='$un' AND password='$pw'");

			if(mysqli_num_rows($query) == 1){
				return true;
			}else{
				array_push($this->errorArray, constants::$loginFailed);
				return false;
			}
		}


		public function register($un, $fn, $ln, $em, $pw, $pw2){
			$this->validateUserName($un);
			$this->validateFirstName($fn);
			$this->validateLastName($ln);
			$this->validateEmail($em);
			$this->validatePassword($pw, $pw2);

			if(empty($this->errorArray) == true){
				//insert into db
				return $this->insertUserDetails($un, $fn, $ln, $em, $pw);
			}else{
				return false;
			}

		}

		public function getError($error){
			if(!in_array($error, $this->errorArray)){
				$error = "";
			}
			return "<span class='errorMessage'>$error</span>";
		}

		private function insertUserDetails($un, $fn, $ln, $em, $pw)
		{
			$encryptedPw = md5($pw); // Password would be ->gfdgfgfdg211234ffs(MD5)
			$profilePic  = "assets/images/profile-pic/profile_head.png";
			$date        = date("Y.m.d H:i:s");

			$result = mysqli_query($this->con, "INSERT INTO users VALUE ('', '$un', '$fn', '$ln', '$em', '$encryptedPw', '$date', '$profilePic')");

			return $result;
		}

		private function validateUserName($un){

			if(strlen($un) > 20 || strlen($un) < 4){
				array_push($this->errorArray, constants::$userNameCharacters);
			    return;
			}

			$checkUserNameQuery = mysqli_query($this->con, "SELECT username FROM users WHERE username = '$un'");
			if(mysqli_num_rows($checkUserNameQuery) != 0){
				array_push($this->errorArray, constants::$userNameTaken);
				return;
			}

		}

		private function validateFirstName($fn){
			if(strlen($fn) > 20 || strlen($fn) < 2){
				array_push($this->errorArray, constants::$firstNameCharacters);
				return;
			}
		}

		private function validateLastName($ln){
			if(strlen($ln) > 20 || strlen($ln) < 2){
				array_push($this->errorArray, constants::$lastNameCharacters);
				return;
			}
		}

		private function validateEmail($em){
			if(!filter_var($em, FILTER_VALIDATE_EMAIL)) {
				array_push($this->errorArray, constants::$emailInvalid);
				return;
			}
			$checkEmailQuery = mysqli_query($this->con, "SELECT email FROM users WHERE email = '$em'");
			if(mysqli_num_rows($checkEmailQuery) != 0){
				array_push($this->errorArray, constants::$emailTaken);
				return;
			}
		}

		private function validatePassword($pw, $pw2){
			if($pw != $pw2){
				array_push($this->errorArray, constants::$passwordsDoNoMatch);
				return;
			}

			if(preg_match('/[^A-Za-z0-9]/', $pw)){
				array_push($this->errorArray, constants::$passwordsNoAlphanumeric);
				return;
			}

			if(strlen($pw) > 25 || strlen($pw) < 5){
				array_push($this->errorArray, constants::$passwordsCharacters);
				return;
			}

		}

	}


?>