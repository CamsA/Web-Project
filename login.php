<?php require_once("scripts/model.php")?>
<?php require_once("scripts/php_login.php")?>
<?php require_once("header.php") ?>
        
<!-- LOGIN -->
<div class="content">
	<section class="background">
		<div class="greyfilter" style="background-image:url('http://<?php echo $_SERVER['HTTP_HOST']?>/WebProject/img/beerpong.jpg')"></div>
		<div class="setsession">
			<img src='http://<?php echo $_SERVER['HTTP_HOST']?>/WebProject/img/LogoBDEblanc.png'>
			<h1>Bienvenue!</h1>
			<form id="login" action="" method="post">	 
				<input type="email" name="mail" placeholder="Votre email" required><br>
				<input type="password" name="mdp" placeholder="Votre mot de passe" required><br>
				<input type='hidden' value="login" name="type">
				<input type="submit" value="Submit">
				<p>Vous n'êtes pas inscrit ? <a id="cestjolicamarche1" href="#" >M'inscire</a></p>
			</form>
			<form id="inscription" style="display:none" action="" method="post">
  				<input type="text" name="fname" placeholder="Votre prénom" required><br>
  				<input type="text" name="lname" placeholder="Votre nom" required><br>
				<input type="email" name="mail" placeholder="Votre email" required><br>
				<input type="email" name="cmail" placeholder="Confirmer votre email" required><br>
				<input type="password" name="mdp" placeholder="Votre mot de passe" required><br>
				<input type="password" name="cmdp" placeholder="Confirmer votre mot de passe" required><br>
				<input type='hidden' value="register" name="type">
				<input type="submit" value="Submit">
				<p>Vous êtes déjà inscrit ? <a id="cestjolicamarche2" href="#">Me connecter</a></p>
			</form>
		</div>
	</section>
</div>
<!-- FOOTER -->
<?php require_once("footer.php") ?>

