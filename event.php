<?php require_once("scripts/model.php")?>
<?php require_once("scripts/php_event.php")?>
<?php require_once("header.php") ?>
<!-- EVENT -->
<div class="content">
	<?php if ($_SESSION["connecte"][0]["Role"] !== "1"){ ?>
		<section class="fullscreentop notfixed" style="background-image:url('http://<?php echo $_SERVER['HTTP_HOST']?>/WebProject/img/party.jpg')">
			<h1 class=eventtitle><?php echo $event->getTitle()?></h1>
		</section>
		<section class="introevent">
			<div class="bbintro">
				<p class="date">Date de l'événement: <?php echo $event->getDate_ev() ?></p>
				<p class="price">Prix de l'événement: <?php echo $event->getPrice() ?> €</p>
			</div>
			<p class="description">Description de l'événement:<br><?php echo $event->getDescription()?></p>
			<div>
				<?php if ($_SESSION["connecte"][0]["Role"] == "0") {
							
//if(){?>
					<button title="S'incrire à l'événement" onclick="registeredtoevent()">S'incrire pour cet événement</button>
				<?php //}else{?>
					<button title="Ajouter une nouvelle photo" onclick="vote()">Voter pour cet événement</button>
				<?php }; if ($_SESSION["connecte"][0]["Role"] == "2"){?>
				<button title="Signaler quelque chose sur l'événement" onclick="report()">Signaler quelque chose sur l'événement</button>
				<?php  }?>
			</div>
		</section>
	<?php }else{ ?>
		<form style="">
			<section class="fullscreentop notfixed" style="background-image:url('http://<?php echo $_SERVER['HTTP_HOST']?>/WebProject/img/party.jpg')">
				<h1 class=eventtitle><input name="new_title" value="<?php echo $event->getTitle()?>"></h1>
			</section>
			<section class="introevent">
				<div class="bbintro">
					<input type="date" name="new_date" value="<?php echo $event->getDate_ev() ?>">
					<input type="text" name="new_price" value="<?php echo $event->getPrice() ?>">
				</div>
				<textarea name="new_desc"><?php echo $event->getDescription()?></textarea>
				<input type='checkbox' name="new_valid" value="1" <?php if($event->getValid()) echo "checked"?>>
			</section>
		</form>
	<?php }?>
	<section class="gallery">
		<div>
			<ul id="galerie_mini">
				<?php $i = 0; foreach ($event->getPictures() as $values) {$i++;?>
    			<li>
      				<div id="<?php $i++;?>" class="min_gal"><img src="http://<?php echo $_SERVER['HTTP_HOST']?>/WebProject/data/<?php  echo BDD::getPicture($values)->getLink();?>" alt="Le titre de la photo 1" /></div>
				</li>
				<?php } ?>
				<!--Le dernier de la liste des photo permet d'en ajouter un nouveau-->
				<li>
      				<img id="addnewpic" src="http://<?php echo $_SERVER['HTTP_HOST']?>/WebProject/img/icon/add.svg" alt="Le titre de la photo 1" style="height:100px"/>
				</li>
			</ul>
			<dl id="photo">
				<?php $i = 0; foreach ($event->getPictures() as $values) { $i++;?>
    			<dd ><img id="big_pict-<?php echo $i ?>" class="big_pict" src="http://<?php echo $_SERVER['HTTP_HOST']?>/WebProject/data/<?php  echo BDD::getPicture($values)->getLink();?>" alt="Photo 1 en taille normale" style="display:none" /></dd>
				<?php } ?>
  			</dl>
			<div class="newpic" style="display:none">
			<!--Hidden. Si #galerie_mini.last-child() .selected, cache #photo et montre .newpic-->
				<form enctype="multipart/form-data" action="" method="post">
					<input type="hidden" name="MAX_FILE_SIZE" value="5000000">
					<input type="file" name="avatar[]" multiple>
					<input type="submit" value="Envoyez l'image" />
				</form>
			</div>
			<!--En fonction de la photo selectionnée ou la première par défaut-->
			<div class="pictureinfos">
				<div class="buttonpic" id="<?php echo $event->getPictures()[0] ?>">
					<button>Like</button>
					<button>Show comment</button>
				</div>
				<!--Hidden par défaut-->
				<div class="commentsection" style="display:hidden">
					<ul class ="dispcomments" id="<?php echo $event->getPictures()[0] ?>">
						<?//php foreach(){ ?>
						<li>
							<p>Un commentaire</p>
						</li>
						<?//php } ?>
						<!--Le dernier de la liste des commentaires permet d'en ajouter un nouveau-->
						<li>
							<form method="post">
								<textarea name="comments" id="comment" value="Laissez votre commentaire"></textarea>
								<input type="submit" value="Submit">
							</form>
						</li>
					</ul>
				</div>
			</div>	
		</div>
	</section>
</div>
<!-- FOOTER -->
<?php require_once("footer.php") ?>