<?php
require_once("model.php");


switch($_SERVER['REQUEST_METHOD']){
	
	case "UPDATE":
		parse_str(file_get_contents("php://input"),$UPDATE);
		$quantity = $UPDATE["quantity"];
		$toupdate = $UPDATE["id"];
		
		if(isset($_COOKIE["basket"])){
			$basket = json_decode($_COOKIE["basket"]);
			$basket[$toupdate]->setQuantity($quantity);
			echo json_encode($basket);
			setcookie('basket', json_encode($basket), time() + 365*24*3600, null, null, false, true);
		}
		exit();
	break;
	
	case "DELETE":		
		parse_str(file_get_contents("php://input"),$DELETE);
		$todelete = $DELETE["id"];
		
		if(isset($_COOKIE["basket"])){
			$basket = json_decode($_COOKIE["basket"]);
			$basket[$todelete] = null;
			$toreturn = array_values($basket);
			echo json_encode($toreturn);
			setcookie('basket', json_encode($toreturn), time() + 365*24*3600, null, null, false, true);
		}
		exit();
	break;
	
	
	case "POST": 
		if(isset($_SESSION["connect"]))
		{
			if(isset($_COOKIE["basket"])){
			$basket = json_decode($_COOKIE["basket"]);
			
			$canAdd = 1;
			foreach($basket as $value){
				if($value->getId_Article == $id){
					$canAdd = 0;
					$value->setQuantity($value->getQuantity()+1);
				}
			}
			if($canAdd){
				$topush = new Logs();
				$topush->setId_User($_SESSION["connect"]);
				$topush->setId_Article($id);
				$topush->setQuantity(1);
				array_push($basket,$topush);
			}
			echo json_encode($basket);
			setcookie('basket', json_encode($basket), time() + 365*24*3600, null, null, false, true);
			exit();
		}
	break;
	
}
}

$basket = array();
$pictures = array();
$articles = array();

if(isset($_COOKIE["basket"]))
	$basket = json_decode($_COOKIE["basket"]);

foreach($basket as $key => $value){
	$articles[$key] = BDD::getArticle($value->getId_Article());
	$pictures[$key] = BDD::getPictures($articles[$key]->getPictures()[0]);
}

var_dump($basket);

?>