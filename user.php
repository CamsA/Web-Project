<?php require_once("scripts/model.php")?>
<?php require_once("scripts/php_profil.php")?>
<?php require_once("header.php") ?>
<!-- USER -->
<div class="content">
	<section class="background">
		<div class="greyfilter" style="background-image:url('http://<?php echo $_SERVER['HTTP_HOST']?>/WebProject/img/prof.jpg')"></div>
		<div class="setsession">
			<div>
				<div>
					<div class="enteteuser">
						<?php switch ($_SESSION["connecte"][0]["Role"]) {
								case 0: ?>
									<img class="svg" src="http://<?php echo $_SERVER['HTTP_HOST']?>/WebProject/img/icon/students.svg">
								<?php break;
								case 1: ?>
									<img class="svg" src="http://<?php echo $_SERVER['HTTP_HOST']?>/WebProject/img/icon/BDE.svg">
								<?php break; 
								case 2: ?>
									<img class="svg" src="http://<?php echo $_SERVER['HTTP_HOST']?>/WebProject/img/icon/personel.svg">
								<?php break; 
								};?>
						<h2><?php echo $_SESSION["connecte"][0]["Surname"]." ".$_SESSION["connecte"][0]["Firstname"] ?></h2>
					</div>
				</div>
				<div>
					<div class="userheader">
						<img src="http://<?php echo $_SERVER['HTTP_HOST']?>/WebProject/img/icon/edit.svg">
						<h1>Mon Profil</h1>
					</div>
					<form method="post">
						<input type="text" name="firstname" placeholder="Votre prénom" value="<?php echo $_SESSION["connecte"][0]["Surname"] ?>"><br>
						<input type="text" name="surname" placeholder="Votre nom" value="<?php echo $_SESSION["connecte"][0]["Firstname"] ?>"><br>	
						<input type="email" name="actualMail" placeholder="Votre email" value="<?php echo $_SESSION["connecte"][0]["Email"] ?>"><br>
						<input type="email" name="newMail" placeholder="Confirmer votre email"><br>
						<input type="password" name="actualPass" placeholder="Votre mot de passe" value="<?php echo $_SESSION["connecte"][0]["Pass"] ?>"><br>
						<input type="password" name="newPass" placeholder="Confirmer votre mot de passe"><br>
						<input type="submit" value="Enregistrer">
						<button>Annuler</button>
					</form>
				</div>
			</div>
		</div>
	</section>
</div>
<!-- FOOTER -->
<?php require_once("footer.php") ?>