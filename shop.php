<?php require_once("scripts/model.php")?>
<?php require_once("scripts/php_shop.php")?>
<?php require_once("header.php") ?>
<!-- SHOP -->
<div class="content">
	<section class="fullsreentop" style="background-image:url('http://<?php echo $_SERVER['HTTP_HOST']?>/WebProject/img/shop.jpg')">
		<h1 class="titlemiddle">Boutique</h1>
	</section>
	<section class="shop">
		<div class="headershop">
			<h2>Nos produits</h2>
			<nav>
				<ul>
					<?php foreach ($categories as $values) { ?>
						<li><?php echo $values->getName();?></li>
					<?php } ?>
				</ul>
			</nav>
			<div class="searchbar">
				<form action="">
					<input class="blank" type="text" placeholder="Search..."/>
					<input class="valid" type="button" value=""/>
				</form>
			</div>
			<div class = "orderby">
				<select name="carlist" form="carform">
					<option value="" disabled selected>Trier par :</option>
					<option value="ppop">Plus populaire</option>
					<option value="mcher">Moins Cher</option>
					<option value="pcher">Plus Cher</option>
					<option value="aalpha">De A à Z</option>
					<option value="dalpha">De Z à A</option>
				</select>
			</div>
		</div>
		<div class="prodart-list">
			<?php foreach($articles as $key => $values){ ?>
			<div class="prodart">
				
					 <div class="prodartview" style="background-image: url('http://<?php echo $_SERVER['HTTP_HOST']."/WebProject/data/".BDD::getPicture($values->getPicture()[0])->getLink(); ?>')"></div><br>
					<div>
					<h3><?php echo $values->getName() ?></h3>
					<h4><?php echo $values->getPrice() ?></h4>
					</div>
					<button><img src="http://<?php echo $_SERVER['HTTP_HOST']?>/WebProject/img/icon/shoppingcart.svg">Hého<img src="http://<?php echo $_SERVER['HTTP_HOST']?>/WebProject/img/icon/next.svg"></button>
					<div class="controlpannel">
						<button style="background-image:url('http://<?php echo $_SERVER['HTTP_HOST']?>/WebProject/img/icon/edit.svg')"></button>
						<button style="background-image:url('http://<?php echo $_SERVER['HTTP_HOST']?>/WebProject/img/icon/trash.svg')"></button>
				</div>
			
			</div>
			<?php } ?>
			<?php if ($_SESSION["connecte"][0]["Role"] == "1"){ ?>
				<div class="prodart">
					<img src="http://<?php echo $_SERVER['HTTP_HOST']?>/WebProject/img/icon/add.svg">
				</div>
				<?php }?>
		</div>
	</section>
</div>
<!-- FOOTER -->
<?php require_once("footer.php") ?>