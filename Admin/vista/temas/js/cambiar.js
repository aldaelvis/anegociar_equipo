	$(document).ready(function(){ /* PREPARE THE SCRIPT */
		$("#show").hide();
		$("#categoriacrearanuncio").each(function(){ /* WHEN YOU CHANGE AND SELECT FROM THE SELECT FIELD */
			$("#categoriacrearanuncio").show();
		  	var allbooks = $(this).val(); /* GET THE VALUE OF THE SELECTED DATA */
		  	var dataString = "categoriacrearanuncio="+allbooks; /* STORE THAT TO A DATA STRING */
		  	//$("#show").remove();

		  	$.ajax({ /* THEN THE AJAX CALL */
		    	type: "POST", /* TYPE OF METHOD TO USE TO PASS THE DATA */
		    	url: "vista/modulos/ajax/ajax.php", /* PAGE WHERE WE WILL PASS THE DATA */
		    	data: dataString, /* THE DATA WE WILL BE PASSING */
		    	cache: false,
		    	success: function(html){ /* GET THE TO BE RETURNED DATA */
		    		$("#show").show();
		      		$("#show").html(html); /* THE RETURNED DATA WILL BE SHOWN IN THIS DIV */
		    	}
		  	});
		});
	});