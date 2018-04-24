<?php
require_once("model.php");


if(isset($_POST["type"])){
	if($_POST["type"] == "login"){
		$mail = htmlspecialchars($_POST["mail"]);
		$password = htmlspecialchars($_POST["mdp"]);
		
		$connect = BDD::connection($mail,$password);

		if(!empty($connect)){
			$_SESSION["connecte"] = $connect;
			header("Location: index.php");
			exit;
		}
		else{
			$warning = "Mot de passe ou email incorrect.";
		}

	}
	
	if($_POST["type"] == "register"){
		$fname = htmlspecialchars($_POST["fname"]);
		$lname = htmlspecialchars($_POST["lname"]);
		$mail = htmlspecialchars($_POST["mail"]);
		$cmail = htmlspecialchars($_POST["cmail"]);
		$password = htmlspecialchars($_POST["mdp"]);
		$cpassword = htmlspecialchars($_POST["cmdp"]);
		
		$valid = 1;
		
		if($mail != $cmail || $password != $cpassword){
			$valid = 0;
			$warning = "Les différents champs ne correspondent pas.";
		}
		
		$userList = BDD::listUser();
		foreach($userList as $value){
			if($value->getEmail() == $mail){
				$valid = 0;
				$warning = "Un compte utilise déjà cette adresse email.";
			}
		}
		
		
		if($valid == 1){
				
			$nuser = new User();
			$nuser->setFirstname($fname);
			$nuser->setSurname($lname);
			$nuser->setEmail($mail);
			$nuser->setPass($password);
			BDD::newUser($nuser);
			$_SESSION["connecte"] = $nuser;
			header("Location: index.php");
			exit;
		}	
	}
	
	
	
	
	
	
}


?>