<?php
require_once('model.php');

$url = $_SERVER['PATH_INFO'];
$parsed_url	= trim($url,'/'); 
$parsed_url = explode("/",$parsed_url);
$id_event = $parsed_url[0];
$event = BDD::GetEvent($id_event);
//var_dump($event);

switch($_SERVER['REQUEST_METHOD']){
	case "UPDATE":
	parse_str(file_get_contents("php://input"),$UPDATE);
	switch ($UPDATE['type']) {

		case 'like':
		if (isset($_SESSION['connecte'])){
			$id_picture = htmlspecialchars($UPDATE['id']);
			$picture = BDD::getPicture($id_picture);
			$temp_likes = $picture->getLikes();
			

			if ($temp_likes[$_SESSION['connecte']->getId()] == 0){
				$temp_likes[$id_user] = 1;
				$picture->setLikes($temp_likes);
				BDD::setPictures($picture);
				exit();
			}
		}
		break;
		

		case 'registered':
		if (isset($_SESSION['connecte'])){
			$temp_registered = $event->getRegistered();
			$temp_registered[$_SESSION['connecte']->getId()] = 1;
			$event->setRegistered($temp_registered);
			BDD::setEvent($event);
			exit();
		}
		break;


		case 'vote':
		if (isset($_SESSION['connecte'])){
			$temp_vote = $event->getVotes();
			$temp_vote[$_SESSION['connecte']->getId()] = 1;
			$event->setVotes($temp_vote);
			BDD::setEvent($event);
			exit();
		}
		break;
	}


	case "DELETE":
		parse_str(file_get_contents("php://input"),$DELETE);
		switch ($DELETE['type']) {

			case 'comment':
			if (isset($_SESSION['connecte']))
				if ($_SESSION['connecte']->getRole() == "1"){
					$tab_comments = json_decode($DELETE["comments"]);
					$event-> setComments($tab_comments);
					BDD::setEvent($event);
					exit();
				}
				break;

				case 'picture':
				if (isset($_SESSION['connecte']))
					if ($_SESSION['connecte']->getRole() == "1"){
						$todel = $DELETE['id_picture'];
						$list = $event->getPictures();
						foreach ($list as $key => $value) {
							if ($value == $todel) {
								$value = null;
							}
						}
						$list = array_values($list);
						$event -> setPictures($list);
						BDD::setEvent($event);
						exit();
					}
					break;
				break;
				}

	case "POST":
		var_dump($_POST);
			switch ($_POST['type']) {
					
				case 'event':
				if (isset($_SESSION['connecte']))
					if ($_SESSION['connecte']->getRole() == "1"){
						$new_title = htmlspecialchars($_POST['new_title']);
						$new_desc = htmlspecialchars($_POST['new_desc']);
						$new_date = htmlspecialchars($_POST['new_date']);
						$new_price = htmlspecialchars($_POST['new_price']);
						$new_valid = htmlspecialchars($_POST['new_valid']);

						$event->setTittle($new_title);
						$event->setDescription($new_desc);
						$event->setDate($new_date);
						$event->setPrice($new_price);
						$event->setValid($new_valid);

						BDD::setEvent($event);
						exit();
					}
				break;


				case 'picture':
					if (isset($_SESSION['connecte'])){
						$new_picture = upload()[0];
						$temp_picture = $event->getPictures();
						array_push($temp_picture,$new_picture);

						$event->setPictures($temp_picture);
						BDD::setEvent($event);
					}
					exit();
				break;


				case 'add_comment':
					if (isset($_SESSION['connecte'])){
						$tab_comments = json_decode($_POST["comments"]);
						$event-> setComments($tab_comments);
						BDD::setEvent($event);	
						exit();
					}
				break;

				case 'report':

					exit();
					break;
				}

			break;
			}


/*			function report($event){

				$mail = 
				if (!preg_match("#^[a-z0-9._-]+@viacesi\.fr$#", $mail))
				{
					$passage_ligne = "\r\n";
				}
				else
				{
					$passage_ligne = "\n";
				}

				$header = "From: \"WeaponsB\"<weaponsb@mail.fr>".$passage_ligne;
				$header .= "Reply-to: \"WeaponsB\" <weaponsb@mail.fr>".$passage_ligne;
				$header .= "MIME-Version: 1.0".$passage_ligne;
				$header .= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;


				$to = "BDE@viacesi.fr";
				$subject  = "Alerte concernant un article.";
				$message = "Membre du BDE je vous informe que le contenue de cette événement" . " \r\n événement : " . $event[title] . "\r\n Peuvent nuire à l'image de l'école veuillez supprimez une partie de son contenue.";


				mail($to,$subject,$message,$header);
	//a revoir
			}*/
?>