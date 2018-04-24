<?php
require_once("model.php");

switch($_SERVER['REQUEST_METHOD']){
		
		case "POST": 
			//INTEGRATION PAYPAL
		break;	
	}



$category = 0; // default
$sort = 1; //0=Most Famous / 1=A / 2=Z / 3=plus cher /4=moins cher
$out = 0; // 0=default / 1=json /
$search = "";

$categories = BDD::listCategory();

if(isset($_GET)){
	if(isset($_GET["sort"]))
		if(is_int($_GET["sort"]))
			if($_GET["sort"] >= 0 && $_GET["sort"] <= 4)
				$sort = $_GET["sort"];
	
	if(isset($_GET["category"]))
		if(is_int($_GET["category"])){
			foreach($categories as $value){
				if($value->getId() == $_GET["category"])
					$category = $_GET["category"];
			}
		}
		
	if(isset($_GET["output"]))
		if(is_int($_GET["output"]))
			$out = $_GET["output"];
		
	if(isset($_GET["search"]))
		if(is_int($_GET["search"]))
			$search = htmlspecialchars($_GET["search"]);
}

$articles = BDD::listArticle();

$categorisedArticles = array();
if($category != 0){
	foreach($articles as $value)
		if($value->getId_Category() == $category)
			array_push($categorisedArticles,$value);
}
else
	$categorisedArticles = $articles;
	var_dump($categorisedArticles);
$sortedArticles = array();
switch($sort){
	case 1:
		$order = array();
		foreach($categorisedArticles as $key => $value)
			$order[$key] = $value->getName();
		$sortedArticles = array_multisort($order,SORT_ASC,$categorisedArticles);
	break;
	case 2:
		$order = array();
		foreach($categorisedArticles as $key => $value)
			$order[$key] = $value->getName();
		$sortedArticles = array_multisort($order,SORT_DESC,$categorisedArticles);
	break;
	case 3:
		$order = array();
		foreach($categorisedArticles as $key => $value)
			$order[$key] = $value->getPrice();
		$sortedArticles = array_multisort($order,SORT_ASC,$categorisedArticles);
	break;
	case 4:
		$order = array();
		foreach($categorisedArticles as $key => $value)
			$order[$key] = $value->getPrice();
		$sortedArticles = array_multisort($order,SORT_DESC,$categorisedArticles);
	break;
	default:
		$fam = array();
		$logs = BDD::getLogs();
		foreach($categorisedArticles as $key => $value){
			$famouscount = 0;
			foreach($logs as $logsvalue){
				if($logsvalue->getId() == $value->getId())
					$famouscount += $logsvalue->getQuantity();
			}
			$fam[$key] = $famouscount;
		}
		$sortedArticles = array_multisort($order,SORT_DESC,$categorisedArticles);
}


if($search != ""){
	foreach($sortedArticles as $value){
		if(strpos($value,$search) !== false)
			$value = null;
	}
	$sortedArticles = array_values($sortedArticles);
}

$categories = BDD::listCategory();


if($out == 1){
	echo json_encode($sortedArticles);
	exit;
}

?>