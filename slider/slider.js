$(document).ready(function() {
	
		/******************************************** PARAMÈTRE *********************************************/

		/**/var infinitySlider = $('.owl-carousel-1 .slides').length > 1  // Rend le slider infinie si plus de un item             

		/**/var itemScreen = 1; // Combien d'items doit etre afficher par screen      

		/**/var navigationSlider = false; // Affiche la navigation           

		/**/var autoPlay = true; // Défilement automatique               

		/**/var speed = 15000; // Nombre de seconde avant changement de slide automatique.   

		/**/var dureeTransition = 500 // Durée de la transition entre deux slides.    

		/**/var positionFleches = 50 // Règle la position des fleches du slider en pourcentage 

		/**/var dots = true
  

  
        /**/var drag = $('.owl-carousel-1 .slides').length > 1;


		/****************************************************************************************************/

    $('.owl-carousel-1').owlCarousel({
        // Combien d'élément visible sur le screen
        items:itemScreen,
       
        // Effet infinie
        loop:infinitySlider,
       
        dots:dots,
        // Navigation
        nav:navigationSlider,
        
        // Vitesse de défilement
        smartSpeed:dureeTransition,
        fluideSpeed:dureeTransition,
        autoplaySpeed:dureeTransition,
        navSpeed:dureeTransition,
        dotsSpeed:dureeTransition,
        dragEndSpeed:dureeTransition,
       
        // Autoplay
        autoplay:autoPlay,
        autoplayTimeout:speed,
        autoplayHoverPause:false, // Si true le slide ce stop bien mais redémare uniquement si un click ce fait
      
            //DRAG
        touchDrag:drag,
        mouseDrag:drag,
      
  
    });

    
             
    
   	//$('.owl-item.active .event .titre').css('color','red');
    // Calcul la hauteur
    var hauteurControl = $('i.fa img').height();
    // Divise la hauteur par 2
    var demiHauteurControl = hauteurControl / 2;
    // Ajoute le css au control du slider
    $("i.fa").css("top", "calc(" + positionFleches + "% - " + demiHauteurControl + "px)"); // Valeur dur
   
    // Au cick garde la previsu next
    $(".owl-next").click(function(){
        $(".owl-item").removeClass("visu-slide-next");
        // Active la prévisu de la slide suivante si il est hover de #previous-right     
        $(".owl-item.active").next().addClass("visu-slide-next"); 
        $(".owl-item").css("z-index", "0");
    });
   
    // Au cick garde la previsu prev
    $(".owl-prev").click(function(){
        $(".owl-item").removeClass("visu-slide-prev");
        $(".owl-item").css("z-index", "0");
        // Active la prévisu de la slide suivante si il est hover de #previous-right     
        $(".owl-item.active").prev().addClass("visu-slide-prev");
        $(".owl-item.active").prev().css("z-index", "999");
       
    });
   
    // Affiche la previsu slide suivante au hover
    $(".owl-next").hover(function(){
        $(".owl-item.active").next().addClass("visu-slide-next");
    });
    $(".owl-next").mouseout(function(){
        $(".owl-item.active").next().removeClass("visu-slide-next");
    });
   
    // Affiche la previsu slide précedente au hover
    $(".owl-prev").hover(function(){
        $(".owl-item.active").prev().css("z-index", "999");
        $(".owl-item.active").prev().addClass("visu-slide-prev");
       
    });
    $(".owl-prev").mouseout(function(){
        $(".owl-item.active").prev().removeClass("visu-slide-prev");
    });
   
    // Si click sur les puce réinitialise le z-index
    $(".owl-dot").click(function(){
        $(".owl-item").css("z-index", "0");
    });
    
    /*$('.owl-carousel-1').on('mouseover',function(e){
      $('.owl-carousel-1').trigger('stop.owl.autoplay');
     
    })
    $('.owl-carousel-1').on('mouseleave',function(e){
      $('.owl-carousel-1').trigger('play.owl.autoplay');
    })*/
 

  
});