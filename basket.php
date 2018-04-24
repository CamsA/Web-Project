<?php require_once("scripts/model.php")?>
<?php require_once("scripts/php_login.php")?>
<?php require_once("header.php") ?>
<!-- PANIER -->
<div class="content">
	<h1>Votre Pannier</h1>
	<div class="basket">
		<form method="post" action="">
			<div class="rowtitle">
				<span class="img">Image</span>
				<span class="name">Nom du produit</span>
				<span class="quantity">Quantité</span>
				<span class="price">Prix</span>
				<span class="del">Supprimer</span>
			</div>
                    <?php 
                    foreach ($basket as $key=> $values){
                        echo "<div class=\"product\">";
                        echo "<img src=\"".$pictures[$key]->getLink()."\">";
                        echo "<span class=\"".$articles[$key]->getName()."\">";
                        echo "<span class=\"".$values->getQuantity()."\">";
                        echo"<span class=\"".$articles[$key]->getPrice()."\">";
                        echo"<span class=\"del\" name=\"".$articles[$key]->getId()."\" id=\"delete\" >";                      //" id=\"".$article[$key]->getDel()."\">";
                    }

                    ?>
                    
			<div class="product">
				<img src="">
				<span class="name"></span>
				<span class="quantity"><input type="text" name="quantity<!-- the id of the product in the json tab-->" value="<!--the current value of the product quantity-->"></span>
				<span class="price"></span>
				<span class="del"><img></span>
			</div>
			<input type="submit" value="recalculer" >
		</form>
		<div>
			<div><a href="shop.php"></a></div>
			<div>
				<div>
					<p>Total:</p>
					<p><!--return of the function recalc which had the param quatity and price of each product--></p>
				</div>
				<a href="<!--it will email the BDE staff with the whole purchase order-->">Cornfirmer vos achats</a>
			</div>
		</div>
	</div>
</div>
<!-- FOOTER -->
<?php require_once("footer.php") ?>

<!--success: function(input){

$newtab json

};-->