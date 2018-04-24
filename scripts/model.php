<?php
 final class BDD{
    private static $PDOInstance = null;
    private static $dsn         = null;
    private static $username    = null;
    private static $password    = null;
    private static $options     = array(
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    );

    private function __construct(){
    }

    public static function getInstance(){
      if(is_null(self::$PDOInstance)){
        if(self::configDone()){
          self::$PDOInstance = new PDO(self::$dsn, self::$username, self::$password, self::$options);
        }else{
          throw new Exception(__CLASS__." : no config !");
        }
      }
      return self::$PDOInstance;
    }

    public static function setConfig($dsn, $username, $password, array $options = array()){
      self::$dsn      = $dsn;
      self::$username = $username;
      self::$password = $password;
      self::$options += $options;
    }

    private static function configDone(){
      return self::$dsn !== null && self::$username !== null && self::$password !== null;
    }
	
	
	public static function newUser($p_user){
		$requete = BDD::getInstance()->prepare("CALL `NewUser`(?,?,?,?,?)");
		$requete->execute(array($p_user->getSurname(), $p_user->getFirstname(), $p_user->getEmail(), $p_user->getPass(), $p_user->getRole()));
		$requete->closeCursor();
		$ret = $requete->fetch()["last_insert_id()"];
		$requete->closeCursor();
		return $ret;
	}
	public static function listUser(){
		$requete = BDD::getInstance()->prepare("CALL `ListUser`()");
		$requete->execute();
		$table = $requete->fetchAll();
		$requete->closeCursor();
		$ret = array();
		foreach ($table as $id => $save){
			$ret[$id] = new User();
			foreach($save as $attribute => $value){
				switch($attribute){
					case "Id":
						$ret[$id]->setId($value);
					break;
					case "Surname":
						$ret[$id]->setSurname($value);
					break;
					case "Firstame":
						$ret[$id]->setFirstame($value);
					break;
					case "Email":
						$ret[$id]->setEmail($value);
					break;
					case "Pass":
						$ret[$id]->setPass($value);
					break;
					case "Role":
						$ret[$id]->setRole($value);
					break;
				}
			}
		}
		return $ret;
	}
	public static function getUser($p_id){
		$requete = BDD::getInstance()->prepare("CALL `GetUser`(?)");
		$requete->execute(array($p_id));
		$data = $requete->fetch();
		$requete->closeCursor();
		$ret = new User();
		if(is_array($data)){
		foreach($data as $attribute => $value){
			switch($attribute){
				case "Id":
					$ret->setId($value);
				break;
				case "Surname":
					$ret->setSurname($value);
				break;
				case "Firstame":
					$ret->setFirstame($value);
				break;
				case "Email":
					$ret->setEmail($value);
				break;
				case "Pass":
					$ret->setPass($value);
				break;
				case "Role":
					$ret->setRole($value);
				break;
				}
			}
			return $ret;
		}
		else
			return null;
	}
	public static function setUser($p_user){
		$requete = BDD::getInstance()->prepare("CALL `SetUser`(?,?,?,?,?,?)");
		$requete->execute(array($p_user->getId(), $p_user->getSurname(), $p_user->getName(), $p_user->getEmail(), $p_user->getPass(), $p_user->getRole()));
		$requete->closeCursor();
	}
	public static function deleteUser($p_id){
		$requete = BDD::getInstance()->prepare("CALL `DeleteUser`(?)");
		$requete->execute(array($p_id));
		$requete->closeCursor();
	}
	
	
	public static function newEvent($p_event){
		$requete = BDD::getInstance()->prepare("CALL `NewEvent`(?,?,?,?,?,?,?,?,?)");
		$requete->execute(array($p_event->getId_User(),$p_event->getTitle(), $p_event->getDescription(), $p_event->getDate_ev(), $p_event->getPrice(), json_encode($p_event->getVotes()),json_encode($p_event->getPictures()),   $p_event->getValid(),json_encode($p_event->getRegistered())));
		$ret = $requete->fetch()["last_insert_id()"];
		$requete->closeCursor();
		return $ret;
	}
	public static function listEvent(){
		$requete = BDD::getInstance()->prepare("CALL `ListEvent`()");
		$requete->execute();
		$table = $requete->fetchAll();
		$requete->closeCursor();
		$ret = array();
		foreach ($table as $id => $save){
			$ret[$id] = new Event();
			foreach($save as $attribute => $value){
				switch($attribute){
					case "Id":
						$ret[$id]->setId($value);
					break;
					case "Id_User":
						$ret[$id]->setId_User($value);
					break;
					case "Title":
						$ret[$id]->setTitle($value);
					break;
					case "Description":
						$ret[$id]->setDescription($value);
					break;
					case "Date_ev":
						$ret[$id]->setDate_ev($value);
					break;
					case "Price":
						$ret[$id]->setPrice($value);
					break;
					case "Votes":
						$ret[$id]->setVotes(json_decode($value));
					break;
					case "Pictures":
						$ret[$id]->setPictures(json_decode($value));
					break;
					case "Valid":
						$ret[$id]->setValid($value);
					break;
					case "Registered":
						$ret[$id]->setRegistered(json_decode($value));
					break;
					}
				}
			}
		return $ret;
	}
	public static function GetEvent($p_id){
		$requete = BDD::getInstance()->prepare("CALL `GetEvent`(?)");
		$requete->execute(array($p_id));
		$data = $requete->fetch();
		$requete->closeCursor();
		$ret = new Event();
		if(is_array($data)){
		foreach($data as $attribute => $value){
			switch($attribute){
				case "Id":
					$ret->setId($value);
				break;
				case "Id_User":
					$ret->setId_User($value);
				break;
				case "Title":
					$ret->setTitle($value);
				break;
				case "Description":
					$ret->setDescription($value);
				break;
				case "Date_ev":
					$ret->setDate_ev($value);
				break;
				case "Price":
					$ret->setPrice($value);
				break;
				case "Votes":
					$ret->setVotes(json_decode($value));
				break;
				case "Pictures":
					$ret->setPictures(json_decode($value));
				break;
				case "Valid":
					$ret->setValid($value);
				break;
				case "Registered":
					$ret->setRegistered(json_decode($value));
				break;
				}
			}
		return $ret;
		}
		else
			return null;
	}
	public static function setEvent($p_event){
		$requete = BDD::getInstance()->prepare("CALL `SetEvent`(?,?,?,?,?,?,?,?,?,?)");
		$requete->execute(array($p_event->getId(),$p_event->getId_User(),$p_event->getTitle(), $p_event->getDescription(), $p_event->getDate_ev(), $p_event->getPrice(),json_encode($p_event->getVotes()), json_encode($p_event->getPictures()),$p_event->getValid(),json_encode($p_event->getRegistered())));
		$requete->closeCursor();
	}
	public static function deleteEvent($p_id){
		$requete = BDD::getInstance()->prepare("CALL `DeleteEvent`(?)");
		$requete->execute(array($p_id));
		$requete->closeCursor();
	}
	
	
	public static function newPicture($p_picture){
		$requete = BDD::getInstance()->prepare("CALL `NewPicture`(?)");
		$requete->execute(array($p_picture->getLink()));
		$ret = $requete->fetch()["last_insert_id()"];
		$requete->closeCursor();
		return $ret;
	}
	public static function listPicture(){
		$requete = BDD::getInstance()->prepare("CALL `ListPicture`()");
		$requete->execute();
		$table = $requete->fetchAll();
		$requete->closeCursor();
		$ret = array();
		foreach ($table as $id => $save){
			$ret[$id] = new Pictures();
			foreach($save as $attribute => $value){
				switch($attribute){
					case "Id":
						$ret[$id]->setId($value);
					break;
					case "Link":
						$ret[$id]->setLink($value);
					break;
					case "Comments":
						$ret[$id]->setComments(json_decode($value));
					break;
					case "Likes":
						$ret[$id]->setLikes(json_decode($value));
					break;
				}
			}
		}
		return $ret;
	}
	public static function getPicture($p_id){
		$requete = BDD::getInstance()->prepare("CALL `GetPicture`(?)");
		$requete->execute(array($p_id));
		$data = $requete->fetch();
		$requete->closeCursor();
		$ret = new Pictures();
		if(is_array($data)){
		foreach($data as $attribute => $value){
			switch($attribute){
				case "Id":
					$ret->setId($value);
				break;
				case "Link":
					$ret->setLink($value);
				break;
				case "Comments":
					$ret->setComments(json_decode($value));
				break;
				case "Likes":
					$ret->setLikes(json_decode($value));
				break;
			}
		}
			return $ret;
		}
		else
			return null;
	}
	public static function setPicture($p_picture){
		$requete = BDD::getInstance()->prepare("CALL `SetPicture`(?,?,?,?)");
		$requete->execute(array($p_picture->getId(),$p_picture->getLink(),json_encode($p_picture->getComments()),json_encode($p_picture->getLikes())));
		$requete->closeCursor();
	}
	public static function deletePicture($p_id){
		$requete = BDD::getInstance()->prepare("CALL `DeletePicture`(?)");
		$requete->execute(array($p_id));
		$requete->closeCursor();
	}

	
	public static function newArticle($p_article){
		
		
		
		$requete = BDD::getInstance()->prepare("CALL `NewArticle`(?,?,?,?,?)");
		$requete->execute(array($p_article->getName(),$p_article->getDescription(),$p_article->getPrice(),$p_article->getId_Category(),json_encode($p_article->getPicture())));
		$ret = $requete->fetch()["last_insert_id()"];
		$requete->closeCursor();
		var_dump($ret);
		$requete->closeCursor();
		return $ret;
	}
	public static function listArticle(){
		$requete = BDD::getInstance()->prepare("CALL `ListArticle`()");
		$requete->execute();
		$table = $requete->fetchAll();
		$requete->closeCursor();
		$ret = array();
		foreach ($table as $id => $save){
			$ret[$id] = new Article();
			foreach($save as $attribute => $value){
				switch($attribute){
					case "Id":
						$ret[$id]->setId($value);
					break;
					case "Name":
						$ret[$id]->setName($value);
					break;
					case "Descritpion":
						$ret[$id]->setDescription($value);
					break;
					case "Price":
						$ret[$id]->setPrice($value);
					break;
					case "Id_Category":
						$ret[$id]->setId_Category($value);
					break;
					case "Pictures":
						$ret[$id]->setPicture(json_decode($value));
					break;
				}
			}
		}
		return $ret;
	}
	public static function getArticle($p_id){
		$requete = BDD::getInstance()->prepare("CALL `GetArticle`(?)");
		$requete->execute(array($p_id));
		$save = $requete->fetch();
		$requete->closeCursor();
		$ret = new Article();
		if(is_array($save)){
			foreach($save as $attribute => $value){
				switch($attribute){
					case "Id":
						$ret->setId($value);
					break;
					case "Name":
						$ret->setName($value);
					break;
					case "Description":
						$ret->setDescription($value);
					break;
					case "Price":
						$ret->setPrice($value);
					break;
					case "Id_Category":
						$ret->setId_Category($value);
					break;
					case "Pictures":
						$ret->setPicture(json_decode($value));
					break;
				}
			}
		return $ret;
		}
		else
			return null;
	}
	public static function setArticle($p_article){
		$requete = BDD::getInstance()->prepare("CALL `SetArticle`(?,?,?,?,?,?)");
		$requete->execute(array($p_article->getId(),$p_article->getName(),$p_article->getDescription(),$p_article->getPrice(),$p_article->getId_Category,json_encode($p_article->getPictures)));
		$requete->closeCursor();
	}
	public static function deleteArticle($p_id){
		$requete = BDD::getInstance()->prepare("CALL `DeleteArticle`(?)");
		$requete->execute(array($p_id));
		$requete->closeCursor();
	}
	public static function connection($p_email,$p_pass){
		$requete = BDD::getInstance()->prepare("CALL `Connection`(?,?)");
		$requete->execute(array($p_email,$p_pass));
		$data = $requete->fetchAll();
		$requete->closeCursor();
		return $data;
	}
	
	
	
	public static function newCategory($p_category){
		$requete = BDD::getInstance()->prepare("CALL `NewCategory`(?)");
		$requete->execute(array($p_category->getName()));
		$requete->closeCursor();
		$ret = $requete->fetch()["last_insert_id()"];
		$requete->closeCursor();
		return $ret;
	}
	public static function listCategory(){
		$requete = BDD::getInstance()->prepare("CALL `ListCategory`()");
		$requete->execute();
		$table = $requete->fetchAll();
		$requete->closeCursor();
		$ret = array();
		foreach ($table as $id => $save){
			$ret[$id] = new Category();
			foreach($save as $attribute => $value){
				switch($attribute){
					case "Id":
						$ret[$id]->setId($value);
					break;
					case "Name":
						$ret[$id]->setName($value);
					break;
				}
			}
		}
		return $ret;
	}
	public static function getCategory($p_id){
		$requete = BDD::getInstance()->prepare("CALL `GetCategory`(?)");
		$requete->execute(array($p_id));
		$save = $requete->fetchAll();
		$requete->closeCursor();
		$ret = new Category();
		if(is_array($save)){
			foreach($save as $attribute => $value){
				switch($attribute){
					case "Id":
						$ret->setId($value);
					break;
					case "Name":
						$ret->setName($value);
					break;
				}
			}
		return $ret;
		}
		else
			return null;
	}
	public static function setCategory($p_article){
		$requete = BDD::getInstance()->prepare("CALL `SetCategory`(?,?)");
		$requete->execute(array($p_category->getId(),$p_category->getName()));
		$requete->closeCursor();
	}
	public static function deleteCategory($p_id){
		$requete = BDD::getInstance()->prepare("CALL `DeleteCategory`(?)");
		$requete->execute(array($p_id));
		$requete->closeCursor();
	}

	
	public static function newLogs($p_logs){
		$requete = BDD::getInstance()->prepare("CALL `NewLog`(?,?,?)");
		$requete->execute(array($p_logs->getId_User(),$p_logs->getId_Article(),$p_logs->getQuantity()));
		$requete->closeCursor();
		$ret = $requete->fetch()["last_insert_id()"];
		$requete->closeCursor();
		return $ret;
	}
	public static function listLogs(){
		$requete = BDD::getInstance()->prepare("CALL `ListLog`()");
		$requete->execute();
		$table = $requete->fetchAll();
		$requete->closeCursor();
		$ret = array();
		foreach ($table as $id => $save){
			$ret[$id] = new Logs();
			foreach($save as $attribute => $value){
				switch($attribute){
					case "Id":
						$ret[$id]->setId($value);
					break;
					case "Quantity":
						$ret[$id]->setQuantity($value);
					break;
					case "Id_User":
						$ret[$id]->setId_User($value);
					break;
					case "Id_Article":
						$ret[$id]->setId_Article($value);
					break;
				}
			}
		}
		return $ret;
	}
	public static function getLogs($p_id){
		$requete = BDD::getInstance()->prepare("CALL `GetLog`(?)");
		$requete->execute(array($p_id));
		$data = $requete->fetchAll();
		$requete->closeCursor();
		$ret = new Logs();
		if(is_array($data)){
			foreach($save as $attribute => $value){
				switch($attribute){
					case "Id":
						$ret->setId($value);
					break;
					case "Quantity":
						$ret->setQuantity($value);
					break;
					case "Id_User":
						$ret->setId_User($value);
					break;
					case "Id_Article":
						$ret->setId_Article($value);
					break;
				}
			}
		return $ret;
		}
		else
			return null;
	}
	public static function setLogs($p_logs){
		$requete = BDD::getInstance()->prepare("CALL `SetLog`(?,?,?,?)");
		$requete->execute(array($p_logs->getId(),$p_logs->getId_User(),$p_logs->getId_Article(),$p_logs->getQuantity()));
		$requete->closeCursor();
	}
	public static function deleteLogs($p_id){
		$requete = BDD::getInstance()->prepare("CALL `DeleteLog`(?)");
		$requete->execute(array($p_id));
		$requete->closeCursor();
	}
	 
  }
  
  BDD::setConfig('mysql:host=localhost;dbname=webproject;charset=latin1', 'root', '');
  
// ---------------------------------------------------------------------------------------

class Pictures{
	private $Id;
	private $Link;
	private $Comments;
	private $Likes;
	
	public function __construct(){
		$this->Id = 0;
		$this->Link = "";
		$this->Comments = array();
		$this->Likes = array();
    }
	
	public function setId($p_Id){
		$this->Id = $p_Id;
	}
	public function getId(){
		return $this->Id;
	}
	public function setLink($p_Link){
		$this->Link = $p_Link;
	}
	public function getLink(){
		return $this->Link;
	}
	public function setComments($p_Comments){
		$this->Comments = $p_Comments;
	}
	public function getComments(){
		return $this->Comments;
	}
	public function setLikes($p_Likes){
		$this->Likes = $p_Likes;
	}
	public function getLikes(){
		return $this->Likes;
	}


}


// ---------------------------------------------------------------------------------------

class User{
	private $Id;
	private $Surname;
	private $Firstname;
	private $Email;
	private $Pass;
	private $Role;
	
	public function __construct(){
		$this->Id = 0;
		$this->Surname = "";
		$this->Firstname = "";
		$this->Email = "";
		$this->Pass = "";
		$this->Role = 0;
    }
	
	public function setId($p_Id){
		$this->Id = $p_Id;
	}
	public function getId(){
		return $this->Id;
	}
	public function setSurname($p_Surname){
		$this->Surname = $p_Surname;
	}
	public function getSurname(){
		return $this->Surname;
	}
	public function setFirstname($p_Firstname){
		$this->Firstname = $p_Firstname;
	}
	public function getFirstname(){
		return $this->Firstname;
	}
	public function setEmail($p_Email){
		$this->Email = $p_Email;
	}
	public function getEmail(){
		return $this->Email;
	}
	public function setPass($p_Pass){
		$this->Pass = $p_Pass;
	}
	public function getPass(){
		return $this->Pass;
	}
	public function setRole($p_Role){
		$this->Role = $p_Role;
	}
	public function getRole(){
		return $this->Role;
	}

}

class Event{
	private $Id;
	private $Id_User;
	private $Title;
	private $Description;
	private $Date_ev;
	private $Price;
	private $Votes;
	private $Pictures;
	private $Valid;
	private $Registered;
	
	public function __construct(){
		$this->Id = 0;
		$this->Id_User = 0;
		$this->Title = "";
		$this->Description = "";
		$this->Date_ev = "";
		$this->Price = 0;
		$this->Votes = array();
		$this->Pictures = array();
		$this->Valid = 0;
		$this->Registered = array();
    }
	
		public function setId($p_Id){
		$this->Id = $p_Id;
	}
	public function getId(){
		return $this->Id;
	}
	public function setId_User($p_Id_User){
		$this->Id_User = $p_Id_User;
	}
	public function getId_User(){
		return $this->Id_User;
	}
	public function setTitle($p_Title){
		$this->Title = $p_Title;
	}
	public function getTitle(){
		return $this->Title;
	}
	public function setDescription($p_Description){
		$this->Description = $p_Description;
	}
	public function getDescription(){
		return $this->Description;
	}
	public function setDate_ev($p_Date_ev){
		$this->Date_ev = $p_Date_ev;
	}
	public function getDate_ev(){
		return $this->Date_ev;
	}
	public function setPrice($p_Price){
		$this->Price = $p_Price;
	}
	public function getPrice(){
		return $this->Price;
	}
	public function setVotes($p_Votes){
		$this->Votes = $p_Votes;
	}
	public function getVotes(){
		return $this->Votes;
	}
	public function setPictures($p_Pictures){
		$this->Pictures = $p_Pictures;
	}
	public function getPictures(){
		return $this->Pictures;
	}
	public function setValid($p_Valid){
		$this->Valid = $p_Valid;
	}
	public function getValid(){
		return $this->Valid;
	}
	public function setRegistered($p_Registered){
		$this->Registered = $p_Registered;
	}
	public function getRegistered(){
		return $this->Registered;
	}

}


class Article{
	private $Id;
	private $Name;
	private $Description;
	private $Price;
	private $Id_Category;
	private $Picture;
	
	public function __construct(){
		$this->Id = 0;
		$this->Name = "";
		$this->Description = "";
		$this->Price = 0;
		$this->Id_Category = 0;
		$this->Picture = array();
    }
	
	public function setId($p_Id){
		$this->Id = $p_Id;
	}
	public function getId(){
		return $this->Id;
	}
	public function setName($p_Name){
		$this->Name = $p_Name;
	}
	public function getName(){
		return $this->Name;
	}
	public function setDescription($p_Description){
		$this->Description = $p_Description;
	}
	public function getDescription(){
		return $this->Description;
	}
	public function setPrice($p_Price){
		$this->Price = $p_Price;
	}
	public function getPrice(){
		return $this->Price;
	}
	public function setId_Category($p_Id_Category){
		$this->Id_Category = $p_Id_Category;
	}
	public function getId_Category(){
		return $this->Id_Category;
	}
	public function setPicture($p_Picture){
		$this->Picture = $p_Picture;
	}
	public function getPicture(){
		return $this->Picture;
	}

}

class Category{
	private $Id;
	private $Name;
	
	public function __construct(){
		$this->Id = 0;
		$this->Name = "";
    }
	
	public function setId($p_Id){
		$this->Id = $p_Id;
	}
	public function getId(){
		return $this->Id;
	}
	public function setName($p_Name){
		$this->Name = $p_Name;
	}
	public function getName(){
		return $this->Name;
	}

}

class Logs{
	private $Id;
	private $Id_User;
	private $Id_Article;
	private $Quantity;
	
	public function __construct(){
		$this->Id = 0;
		$this->Id_User = 0;
		$this->Id_Article = 0;
		$this->Quantity = 0;
    }
	
	public function setId($p_Id){
		$this->Id = $p_Id;
	}
	public function getId(){
		return $this->Id;
	}
	public function setId_User($p_Id_User){
		$this->Id_User = $p_Id_User;
	}
	public function getId_User(){
		return $this->Id_User;
	}
	public function setId_Article($p_Id_Article){
		$this->Id_Article = $p_Id_Article;
	}
	public function getId_Article(){
		return $this->Id_Article;
	}
	public function setQuantity($p_Quantity){
		$this->Quantity = $p_Quantity;
	}
	public function getQuantity(){
		return $this->Quantity;
	}

}

//--------------------------------------------------------------------------------


function upload(){
	if(!empty($_FILES['avatar'])){
		$picId = array();
		
		foreach ($_FILES['avatar']['name'] as $key => $value){
            $path = str_replace("/","\\",$_SERVER["DOCUMENT_ROOT"]."/WebProject/data/".time().$key.".".explode(".",$value)[1]);
    		$upload = move_uploaded_file($_FILES['avatar']['tmp_name'][$key], $path);
			$picture = new Pictures();
			$link = explode("\\",$path);
			$picture->setLink($link[count($link)-1]);

			array_push($picId,BDD::newPicture($picture)); 
        }
		return $picId;
	}
	return array(); 
}


session_start();
?>