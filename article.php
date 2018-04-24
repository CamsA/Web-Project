<?php require_once("scripts/model.php")?>
<?php require_once("scripts/php_article.php")?>
<?php require_once("header.php")?>
<!-- PRODUCT -->
<div class="content">
	<section class="background">
		<div class="greyfilter" style="background-image:url('http://<?php echo $_SERVER['HTTP_HOST']?>/WebProject/img/beerpong.jpg')"></div>
		<div class="setsession">
			<div><?php if(isset($_SESSION["connecte"])){?>
				<?php if($article == null && $_SESSION["connecte"][0]["Role"] == "1") {
				?>
					<div id="edit" class="dispcaractprod">			
					<form action="" method="post" enctype="multipart/form-data">
						<input type="text" name="name"><br>
						<input type="text" name="price"><br>
						<div>
							<select name="cat">
								<option disabled selected>Choisir la catégorie</option>
								<?php foreach($categories as $values){ ?>
								<option value="<?php echo $values->getId() ?>"><?php echo $values->getName()?></option>
								<?php } ?>
							</select><br>
							<input type="text" name="newcat" placeholder="Ajouter une catégorie"><br>
						</div>
						<textarea name="description"></textarea><br>
						<input type="hidden" name="MAX_FILE_SIZE" value="5000000">
						<input type="file" name="avatar[]" ><br>
						<input type="submit" value="Créer">
					</form>
				</div>
				
				<?php }elseif($_SESSION["connecte"][0]["Role"] == "1"){?>
					<div id="edit" class="dispcaractprod">			
						<form>
							<input type="text" name="nameprod" value="<?php echo $article->getName() ?>">
							<input type="text" name="priceprod" value="<?php echo $article->getPrice() ?>">

							<div>
								<select>
									<option disabled selected>Choisir la catégorie</option>
									<?php foreach($categories as $values){ ?>
									<option value="<?php $values->getId() ?>"><?php $values->getName() ?></option>
									<?php } ?>
								</select>
								<input type="text" name="newcat" placeholder="Ajouter une catégorie">
							</div>
							<textarea><?php echo $article->getDescription() ?></textarea>
							<input type="submit" value="Valider les modifications">
						</form>
						<div class="controlpannel">
							<button><img src="http://<?php echo $_SERVER['HTTP_HOST']?>/WebProject/img/icon/edit.svg"></button>
							<button><img src="http://<?php echo $_SERVER['HTTP_HOST']?>/WebProject/img/icon/trash.svg"></button>

						</div>
					</div>
				<?php }}elseif(!$article == null){?>

				<div>
				<div class="productpic"><img class="imgproduct" src="http://<?php echo $_SERVER['HTTP_HOST']."/WebProject/data/".$articlePicture ?>"></div>
				<div id="visit" class="dispcaractprod ">
					
					<h1><?php echo $article->getName() ?></h1>
					<h2><?php echo $article->getPrice() ?></h2>
					<p><?php echo $article->getDescription() ?></p>
					<button><img src="http://<?php echo $_SERVER['HTTP_HOST']?>/WebProject/img/icon/shoppingcart.svg">Ajouter au panier<img src="http://<?php echo $_SERVER['HTTP_HOST']?>/WebProject/img/icon/next.svg"></button>
				</div>
					</div>
				
				<?php }else{ 
				header("Location: http://".$_SERVER['HTTP_HOST']."/WebProject/index.php");
				} ?>
			</div>
		</div>
	</section>
</div>
<!-- FOOTER -->
<?php require_once("footer.php") ?>