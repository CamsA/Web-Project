<?php
require_once("model.php");


if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_SESSION["connecte"]))
{
	$narticle = new Article();
	
	$name = htmlspecialchars($_POST["name"]);
	$description = htmlspecialchars($_POST["description"]);
	$price = htmlspecialchars($_POST["price"]);
	$id_category = htmlspecialchars($_POST["cat"]);
	
	$picture = upload()[0];
	$narticle->setName($name);
	$narticle->setDescription($description);
	$narticle->setPrice($price);
	$narticle->setId_Category($id_category);
	$narticle->setPicture(array($picture));
	
	$narticle->setId(BDD::newArticle($narticle));
	
	$article = $narticle;
	header("Location: http://".$_SERVER['HTTP_HOST']."/WebProject/article.php/".$narticle->getId());
	exit;
}



if(isset($_SERVER["PATH_INFO"]))
	$id = trim($_SERVER["PATH_INFO"],"/");
else
	$id = null;


if(is_array($id))
	$id = (int)explode("/",$id)[0];

if(is_int($id) && isset($_SESSION["connecte"]))
{

	switch($_SERVER['REQUEST_METHOD']){
		case "UPDATE": 
			parse_str(file_get_contents("php://input"),$UPDATE);
			$toupdate = BDD::getArticle($UPDATE["id"]);
			$toupdate->setName(htmlspecialchars($UPDATE["name"]));
			$toupdate->setDescription(htmlspecialchars($UPDATE["description"]));
			$toupdate->setPrice(htmlspecialchars($UPDATE["price"]));
			$toupdate->setId_Category(htmlspecialchars($UPDATE["id_category"]));
			//$toupdate->setPicture(htmlspecialchars($UPDATE["picture"]));
			BDD::updateArticle($toupdate);
			echo json_encode($toupdate);
			exit;
		break;
		case "DELETE": 
			parse_str(file_get_contents("php://input"),$DELETE);
			$todelete = $DELETE["id"];
			BDD::deleteArticle($todelete);
			exit;
		break;
		case "PUT": 
			parse_str(file_get_contents("php://input"),$PUT);
			$toput = $PUT["name"];
			$cat = new Category();
			$cat->setName($toput);
			BDD::newCategory($cat);
			$lc = BDD::listCategory();
			$ret = array();
			foreach($lc as $val)
				array_push($ret,$val->getName());
			echo json_encode($ret);
			exit;
		break;
	}
	
	$article = BDD::getArticle($id);

}
if(!empty($id)){
	$article = BDD::getArticle($id);
	var_dump($article);
	$p = BDD::getPicture($article->getPicture()[0]);
	$articlePicture = $p->getLink();
}
else
	$article = null;
	
$categories = BDD::listCategory();

?>