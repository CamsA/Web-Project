<!DOCTYPE html>
<html>
    <head>
 		<meta charset="utf-8" />
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
		<link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']?>/WebProject/css.css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>   
		<link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']?>/WebProject/slider/lib/owlCarousel/dist/assets/owl.carousel.min.css">
      	<script src="http://<?php echo $_SERVER['HTTP_HOST']?>/WebProject/slider/lib/owlCarousel/docs/assets/vendors/jquery.min.js"></script>
      	<script src="http://<?php echo $_SERVER['HTTP_HOST']?>/WebProject/slider/lib/owlCarousel/dist/owl.carousel.min.js"></script>
		<script src="http://<?php echo $_SERVER['HTTP_HOST']?>/WebProject/js/main.js"></script>
        <title>BDE Campus CESI Saint-Nazaire</title>
		
    </head>
    <body>
<!--HEADER-->
        <header>
            <div class="logo">
            <a href="http://<?php echo $_SERVER['HTTP_HOST']?>/WebProject/index.php"><img src='http://<?php echo $_SERVER['HTTP_HOST']?>/WebProject/img/LogoBDEblanc.png'/></a>
            </div>
            <nav>
               <div class="topmenu">
				   <ul>
					   <li><a href="http://<?php echo $_SERVER['HTTP_HOST']?>/WebProject/ideabox.php">Boite à idées</a></li>
					   <li><a href="http://<?php echo $_SERVER['HTTP_HOST']?>/WebProject/shop.php">Boutique</a></li>
					   <?php 
					   if(isset($_SESSION["connecte"])){ ?>
						   <li><a href="http://<?php echo $_SERVER['HTTP_HOST']?>/WebProject/user.php">Mon profil </a></li>
					   		<li><a href="http://<?php echo $_SERVER['HTTP_HOST']?>/WebProject/logout.php">Se déconnecter</a></li>
					   		<li><a href="http://<?php echo $_SERVER['HTTP_HOST']?>/WebProject/user.php"><?php switch ($_SESSION["connecte"][0]["Role"]) {
								case 0: ?>
									<img class="svg" src="http://<?php echo $_SERVER['HTTP_HOST']?>/WebProject/img/icon/students.svg" >
								<?php break;
								case 1: ?>
									<img class="svg" src="http://<?php echo $_SERVER['HTTP_HOST']?>/WebProject/img/icon/BDE.svg">
								<?php break; 
								case 2: ?>
									<img class="svg" src="http://<?php echo $_SERVER['HTTP_HOST']?>/WebProject/img/icon/personel.svg">
								<?php break; 
								}; ?></a></li>
					   <?php }else{ ?>
					  		<li><a href="http://<?php echo $_SERVER['HTTP_HOST']?>/WebProject/login.php">Se connecter</a></li>
					   <?php } ?>
				   </ul>
				</div>
			</nav>  
        </header> 
        <main>