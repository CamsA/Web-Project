<?php require_once("scripts/model.php")?>
<?php require_once("scripts/php_login.php")?>
<?php require_once("header.php") ?>
<!-- ACCUEIL -->
<div class="content">
	<section class="slides">
        <?php include "slider/slider.php" ?>
        <script type="text/javascript" src="http://<?php echo $_SERVER['HTTP_HOST']?>/WebProject/slider/slider.js"></script>
	</section>
	<section class="background">
		<div class="presentation">
			<div class="imgpres" style="background-image:url('http://<?php echo $_SERVER['HTTP_HOST']?>/WebProject/img/beerpong.jpg')"></div>
			<div class="textpres">
				<h2>Votre BDE</h2>
				<p>La vie étudiante est un des piliers dans une école d’ingénieur. Et on souhaite que le CESI de Saint Nazaire ne déroge pas à la règle ! Pour qu’une école soit dynamique ça commence tout d’abord par une vie associative riche et variée! La principale activité du BDE est donc l’organisation d’évènements en tout genre pour toucher le plus d’étudiants possibles : soirées au bar, boîte de nuit, challenge, weekend d’intégration, weekend de désintégration, gala, sorties en tout genre… </p>
			</div>
		</div>
		<div class="presentation">
			<div class="contactus">
				<h2>Nous Contacter</h2>
				<form>
					<div class="first">
						<input type="text" name="Nom" placeholder="Votre Nom"><br>
						<input type="text" name="Prénom" placeholder="Votre Prénom"><br>
						<input type="email" name="Email" placeholder="Votre Email"><br>
					</div>
					<div class="second">
						<textarea placeholder="Que souhaitez vous nous dire ? "></textarea><br>
						<input type="submit" name="" value="" action="">
					</div>
				</form>
			</div>		
			<div class="mapdisp">
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6440.584985281718!2d-2.259643129736452!3d47.25702488852762!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48056893813bcac7%3A0xa1e85733e72751a6!2sExia.Cesi!5e0!3m2!1sfr!2sfr!4v1523914802190" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
			</div>
		</div>
	</section>
</div>
<!-- FOOTER -->
<?php require_once("footer.php") ?>
