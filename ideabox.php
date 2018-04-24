<?php require_once("scripts/model.php")?>
<?php require_once("scripts/php_ideabox.php")?>
<?php require_once("header.php") ?>
<!-- BOITE A IDEES -->
<div class="content">
	<section class="fullscreentop" style="background-image:url('http://<?php echo $_SERVER['HTTP_HOST']?>/WebProject/img/party.jpg')">
		<h1 class=eventstitle>Amusez - vous !</h1>
		<div class="intro">
			<h2>Votre BDE</h2>
			<p>
				La vie étudiante est un des piliers dans une école d’ingénieur. Et on souhaite que le CESI de Saint Nazaire ne déroge pas à la règle ! Pour qu’une école soit dynamique ça commence tout d’abord par une vie associative riche et variée! La principale activité du BDE est donc l’organisation d’évènements en tout genre pour toucher le plus d’étudiants possibles : soirées au bar, boîte de nuit, challenge, weekend d’intégration, weekend de désintégration, gala, sorties en tout genre… 
			</p>
			<div>
				<button class="buttonevents"><a href="#validevents"> S'inscrire ! </a></button>
				<button class="buttonevents"><a href="#proposevents"> Voter ! </a></button>
				<button class="buttonevents"><a href="#subevents"> Proposer ! </a></button>
			</div>
		</div>
		<div id="validevents" class="validevents">
			<div class="dispevents">
				<h2>Participez aux événements </h2>
				<div class="event">
					<?php  foreach($valided as $key => $value) { ?>
					<div class="singleevent"><a href="http://<?php echo $_SERVER['HTTP_HOST']?>/WebProject/event.php/<?php echo $value->getId();?>/">
						<div class="topevent"><img src="http://<?php echo $_SERVER['HTTP_HOST']."/WebProject/data/".$validedPicture[$key] ?>"></div>
						<h3 class="title"><?php echo $value->getTitle() ?></h3>
						<h4 class="date"><?php echo $value->getDate_ev() ?></h4>
						<p class="description"><?php echo $value->getDescription() ?></p>
						</a></div>
					<?php } ?>
				</div>
				<!--la pagination-->
			</div>
		</div>		
		<div id="proposevents" class="proposevents">
			<div class="dispevents">
				<h2>Apportez votre soutien à une idée</h2>
				<div class="event">
					<?php foreach($proposed as $key => $value) { ?>
					<div class="singleevent"><a href="http://<?php echo $_SERVER['HTTP_HOST']?>/WebProject/event.php/<?php echo $value->getId();?>/">
						<div class="wrapper"><img src="http://<?php echo $_SERVER['HTTP_HOST']."/WebProject/data/".$proposedPicture[$key] ?>"></div>
						<div class="wrapper"><h3 class="title"><?php echo $value->getTitle() ?></h3>
						<h4 class="date"><?php echo $value->getDate_ev() ?></h4>
						<p class="description"><?php echo $value->getDescription() ?></p></div>
						</a></div>
					<?php } ?>
				</div>
				<!--la pagination-->
			</div>
		</div>
	</section>
	<section id="subevents" class="subevents">
		<form name="avatar" method="POST" action="" enctype="multipart/form-data">
			<input type="text" name="title" placeholder="Titre de votre événement"> 
			<input type="date" id="dateeventadded" name="date"> 
			<input type="hidden" name="MAX_FILE_SIZE" value="5000000">
			<input type="file" name="avatar[]" multiple>
			<textarea name="textarea" placeholder="Décrivez nous comment vous imaginez votre événement !"></textarea>
			<input type="submit" name="envoyer" value="Proposer votre événement!">
		</form>
	</section>
</div>
<!-- FOOTER -->
<?php require_once("footer.php") ?>