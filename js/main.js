$(document).ready(function(){
	
	var $height = $('header').outerHeight();
    $('.eventstitle').css('padding-top', $height+80);
	$('.eventtitle').css('padding-top', $height+80);
	
	function Nicetry (){
		Date.prototype.toDateInputValue = (function() {
			var local = new Date(this);
			local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
			return local.toJSON().slice(0,10);
		});
		var today = new Date();
		var dd = today.getDate();
		var mm = today.getMonth()+1;
		var yyyy = today.getFullYear();
		if (dd < 10) {
			dd='0'+dd;
		}
		if (mm < 10) {
			mm='0'+mm;
		}
		today = yyyy+'-'+mm+'-'+dd;
		$("#dateeventadded").attr("min", today);
	};
	
	Nicetry();
	
	$("#addnewpic").on("click", function(){
		$(".newpic").css("display", "block");
		$(".pictureinfos").css("display", "none");
		$("#photo").css("display", "none");
	});
	
	$('#big_pict-1').addClass('selected');
    $('.min_gal').on("click",function(){
    	var $thisid = $(this).attr('id');
        $('.big_pict').removeClass('selected');
        $('#big_pict-' + $thisid).addClass('selected');
    });

	
	$("#cestjolicamarche1").on("click", function(){
		$("#inscription").css("display", "block");
		$("#login").css("display", "none");});
		
	$("#cestjolicamarche2").on("click", function(){
		$("#login").css("display", "block");
		$("#inscription").css("display", "none");});
	
	$(".prodart").last().on("click", function(){
		$(location).attr('href','article.php');
		$('#visit').css("display", "none");
		$('#edit').css("display", "none");	
	});
	
	
    jQuery('img.svg').each(function(){
                    var $img = jQuery(this);
                    var imgID = $img.attr('id');
                    var imgClass = $img.attr('class');
                    var imgURL = $img.attr('src');

                    jQuery.get(imgURL, function(data) {
                        // Get the SVG tag, ignore the rest
                        var $svg = jQuery(data).find('svg');

                        // Add replaced image's ID to the new SVG
                        if(typeof imgID !== 'undefined') {
                            $svg = $svg.attr('id', imgID);
                        }
                        // Add replaced image's classes to the new SVG
                        if(typeof imgClass !== 'undefined') {
                            $svg = $svg.attr('class', imgClass+' replaced-svg');
                        }

                        // Remove any invalid XML tags as per http://validator.w3.org
                        $svg = $svg.removeAttr('xmlns:a');

                        // Replace image with new SVG
                        $img.replaceWith($svg);

                    }, 'xml');

                });
	
	
	//====================================================================================================================================================================================
 
         $("#like").click(function(){ // ==========================================  OK=========================
               $myId = $(this).attr("id");
        $.ajax({
                url:'event.php',
                type: 'UPDATE',
                data: 'id'+$myId,
                success : function(retour, statut){ 
                 $('#myimg').attr('src','img/pocebleu.png');
                
                       
                }
            });
        });
        
        
     $("#picture").click(function(){ //====================================== A REVOIR
         $myId_picture = $(this).attr("id_picture");
        $.ajax({
                url:'event.php',
                type: 'DELETE',
                dataType:'json',
                data:'id_picture' + $myId_picture,
               
                success : function(retour, statut){ 
           $picture = retour;
                }
            });
        });
     
     
     $("#valid").click(function(){
         $.ajax({
             url:'event.php',
             type:'UPDATE',
             dataType:'json',
             
             success: function(retour, statut){
              $('#mycheckbox').attr('param','valeurparam');     
             }
   
             });
         
         }); 
         
     $("#registered").click(function(){ // A VOIR   
         $.ajax({
             url:'event.php',
             type:'UPDATE',
             dataType:'json',
             
             success: function(retour, statut){
             //genredesactiver + changer le texte en deja inscrit 
              
             }
   
             });
         
         }); 
 
 /*$("#like").ajaxStart(function(){ 
        $(this).show();
    });*/
    
    
         $("#vote").click(function(){ // A VOIR  
             
             $.ajax({
             url:'event.php',
             type:'UPDATE',
             dataType:'json',
             
             success: function(retour, statut){
             //genredesactiver + changer le texte en deja vote
              
             }
   
             });
         
         }); 
         
         $("#comment").click(function(){ // A VOIR  ======================================= COMMENT==============================
             $mycomments = $(this).attr("comments");
             $.ajax({
             url:'event.php',
             type:'DELETE',
             dataType:'json',
             
             success: function(retour, statut){
             var comments = retour;
             $('#idcomment').html('src','img/pocebleu.png');
             
             }
   
             });
         
         }); 
    
 
 //===========================================================================
 
 
  $("#id_categorie").click(function(){
     $.ajax({
         url:'article.php',
         type:'UPDATE',
         datatype:'json',
         
     success: function(retour, statut){
         $('#mycategorie').attr('param','valeurparam');
     } 
         
     });
     
 });
 
   $("#delete").click(function(){
      $myId_article = $(this).attr("id");
     $.ajax({
         url:'article.php',
         type:'DELETE',
         datatype:'json',
         data:'id'+$myId_article,
         
     success: function(retour, statut){
         $(location).attr('href','index.php');
     } 
         
     });
     
 });
 
 $("#formedit").change(function(){ // =======UPDATE ARTICLE================  OK
        $.ajax({
                url:'article.php',
                type: 'UPDATE',
                data: "id"+$('#idprod').val()+
              "&name"+$('#idnameprod').val()+
              "&description"+$('#iddecriptionprod').val()+
              "&price"+$('#idpriceprod').val()+
              "&id_category"+$('#idnewcat').val(),
        datatype: 'json',
                success : function(retour, statut){ 
                 $('#idprod').val(retour.Id);
         $('#idnameprod').val(retour.Name);
         $('#iddecriptionprod').val(retour.Description);
         $('#idpriceprod').val(retour.Price);
         $('#idnewcat').val(retour.Id_Category);
              
                }
            });
        });
        
        $("#buttoncat").click(function(){ // =======PUT CATEGORY================  OK
        $.ajax({
                url:'article.php',
                type: 'PUT',
                data: "name"+$('#newcatname').val(),
        datatype: 'json',
                success : function(retour, statut){ 
            tstr = "<option disabled selected>Choisir la catégorie</option>\n";
            retour.each( function(index) {
                tstr+= "<option value=\"";
                tstr+= index;
                tstr+= "\">";
                tstr+= $(this);
                tstr+= "</option>\n";
            });
            $('#idselect').html(tstr);
                }
            });
        });
 
 
 //=============================================================================
 
   $("#buttonDel").click(function(){
      $myId = $(this).attr("id");
     $.ajax({
         url:'shop.php',
         type:'DELETE',
         datatype:'json',
         data:'id'+$myId,
         
     success: function(retour, statut){
         $(location).attr('href','index.php');
     } 
         
     });
     
 });
 
 
    
	
});