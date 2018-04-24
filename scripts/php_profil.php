<?php

require_once('model.php');



if(!isset($_SESSION['connecte'])){
    header("Location: index.php");
    exit;
}
else{
   

    if(!empty($_POST)) 
    {
		var_dump($_POST);
        $actualMail = htmlspecialchars($_POST['actualMail']);
        $newMail = htmlspecialchars($_POST['newMail']);
        $actualPass = htmlspecialchars($_POST['actualPass']);
        $newPass = htmlspecialchars($_POST['newPass']);
        $newSurname = htmlspecialchars($_POST['surname']);
        $newFirstname = htmlspecialchars($_POST['firstname']);

   
        if($actualMail == $newMail && $actualPass == $newPass)
            {
           
            $user = $_SESSION['connecte'][0];
			
			$use = new User();
			$use -> setSurname($user["Surname"]);
            $use -> setFirstname($user["Firstname"]);
            $use -> setEmail($user["Email"]);
            $use -> setPass($user["Pass"]);
            $use -> setRole($user["Role"]);
            $use -> setId($user["Id"]);
            
            $use -> setSurname($newSurname);
            $use -> setFirstname($newFirstname);
            $use -> setEmail($newMail);
            $use -> setPass($newPass);
			
			
			
                    
			
            BDD::setUser($use);
			$user = $use;
			
            }
        else
            {
            $warning ="Votre mot de passe ou email est invalide";
            }
    }

}
    
?>