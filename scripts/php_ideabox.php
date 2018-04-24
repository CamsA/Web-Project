<?php
require_once("model.php");

function paging($database, $per_page, $page) {
	if (!isset($page)) {
		$page =1;
	}
	if (!intval($page)) {
		$page =1;
	}
	$number_items = count($database);
	$max_page = ceil($number_items/$per_page);
	if ($page > $max_page) {
		$page =1;
	}
	$new_items_list = array();
	$new_items_list = array_slice($database, ($page-1)*$per_page, $per_page);

	return $new_items_list;
}


	switch($_SERVER['REQUEST_METHOD']){
		case "UPDATE": 
			parse_str(file_get_contents("php://input"),$UPDATE);
			
			switch($UPDATE["type"]){
				case "valided":
				echo json_encode(paging(BDD::listEvent(),3,$UPDATE["page"]));
				exit;
				break;
				case "proposed":
				echo json_encode(paging(BDD::listEvent(),3,$UPDATE["page"]));
				break;				
			}
		break;
		case "POST":
			if(isset($_SESSION["connecte"]))
				if($_SESSION["connecte"][0]['Role'] == 1)
				{
					$titre = htmlspecialchars($_POST["title"]);
					$description = htmlspecialchars($_POST["textarea"]);
					$date = htmlspecialchars($_POST["date"]);
					
					$event = new Event();
					$event->setId_User($_SESSION["connecte"][0]['Id']);
					$event->setTitle($titre);
					$event->setDescription($description);
					$event->setDate_ev($date);
					$event->setPictures(upload());
					BDD::newEvent($event);
				}
		break;
	}

$valided = array();
$validedPicture = array();
$proposed = array();
$proposedPicture = array();
$list = BDD::listEvent();
$maxvalided = ceil(count($valided));
$maxproposed = ceil(count($proposed));


foreach($list as $value){
	if($value->getValid())
		array_push($valided,$value);
	else
		array_push($proposed,$value);
}
	
if(isset($_SERVER['PATH_INFO'])){
	$valided = paging($valided,3,explode("/",trim($_SERVER['PATH_INFO'],'/'))[0]);
	$proposed = paging($proposed,3,explode("/",trim($_SERVER['PATH_INFO'],'/'))[1]);
}
else{
	$valided = paging($valided,3,1);
	$proposed = paging($proposed,3,1);
}


foreach($valided as $value){
	$pic = BDD::getPicture($value->getPictures()[0]);
	array_push($validedPicture,$pic->getLink());
}
	
foreach($proposed as $value){
	$pic = BDD::getPicture($value->getPictures()[0]);
	array_push($proposedPicture,$pic->getLink());
}
?>