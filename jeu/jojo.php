<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Stage 1</title>
<link rel="stylesheet" type="text/css" href="css/stage1.css" />
<link rel="stylesheet" href="css/jquery.progbar.css">
<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="js/jquery-timers.js"></script>
<script src="js/jquery.progbar.js"></script>
<script src="js/initJour.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$("#onTalk").val(0);
	$("#onMyTalk").val(0);
	jQuery.fn.arretDrt = function() {
		$(this).oneTime(200,function() {
			$(this).css({backgroundPosition:'-21px -128px'});
		}).oneTime(400,function() {
			$(this).css({backgroundPosition:'-121px -128px'});
		}).oneTime(600,function() {
			$(this).css({backgroundPosition:'-221px -128px'});
		}).oneTime(800,function() {
			$(this).css({backgroundPosition:'-121px -128px'});
		});
	};
	jQuery.fn.mouvArretDrt = function(){
		$(this).arretDrt();
		$(this).everyTime(800,function(){
			$(this).arretDrt();
		});
	}

	jQuery.fn.marcheDrt = function() {
		$(this).oneTime(200,function() {
			$(this).css({backgroundPosition:'-18px -328px'});
		}).oneTime(400,function() {
			$(this).css({backgroundPosition:'-118px -328px'});
		}).oneTime(600,function() {
			$(this).css({backgroundPosition:'-218px -328px'});
		}).oneTime(800,function() {
			$(this).css({backgroundPosition:'-318px -328px'});
		});
	};
	jQuery.fn.mouvMarcheDrt = function(){
		$(this).marcheDrt();
		$(this).everyTime(800,function(){
			$(this).marcheDrt();
		});
	}
	///////////
	jQuery.fn.arretGch = function() {
		$(this).oneTime(200,function() {
			$(this).css({backgroundPosition:'-23px -28px'});
		}).oneTime(400,function() {
			$(this).css({backgroundPosition:'-123px -28px'});
		}).oneTime(600,function() {
			$(this).css({backgroundPosition:'-223px -28px'});
		}).oneTime(800,function() {
			$(this).css({backgroundPosition:'-123px -28px'});
		});
	};
	jQuery.fn.mouvArretGch = function(){
		$(this).arretGch();
		$(this).everyTime(800,function(){
			$(this).arretGch();
		});
	}
	jQuery.fn.marcheGch = function() {
		$(this).oneTime(200,function() {
			$(this).css({backgroundPosition:'-23px -228px'});
		}).oneTime(400,function() {
			$(this).css({backgroundPosition:'-123px -228px'});
		}).oneTime(600,function() {
			$(this).css({backgroundPosition:'-223px -228px'});
		}).oneTime(800,function() {
			$(this).css({backgroundPosition:'-323px -228px'});
		});
	};
	jQuery.fn.mouvMarcheGch = function(){
		$(this).marcheGch();
		$(this).everyTime(800,function(){
			$(this).marcheGch();
		});
	}

	$("#perso").mouvArretDrt();
	$("#perso2").mouvArretGch();
	
	var arret = 0;

	$("#perso").click(function(event) {
		if($("#onTalk").val()==0 && $("#onMyTalk").val()==0){
			if (arret == 0 || arrestation==1) {
				$("#onTalk").val(1);
				$("#perso").stopTime().mouvMarcheDrt();

				var request = $.ajax({ 
				url: "page_ajax.php", 
				type: "POST",
				data: { text: 1, idPerso: 'perso', talk: 'mouvArretDrt', stopTalk: 'mouvMarcheDrt' },			
				}); 
				request.done(function(msg) { 
				$("#texto").html(msg); 
				});
				 
			}else{
				arret = 0;
				$("#perso").stopTime().mouvArretDrt();
				$("#texto").hide();
			}
		}
	});
	
	$("#perso2").click(function(event) {
		if($("#onTalk").val()==0 && $("#onMyTalk").val()==0){
			if (arret == 0 || arrestation==1) {
				$("#onTalk").val(1);
				$("#perso2").stopTime().mouvMarcheGch();

				var request = $.ajax({ 
				url: "page_ajax.php", 
				type: "POST",
				data: { text: 4, idPerso: 'perso2', talk: 'mouvArretGch', stopTalk: 'mouvMarcheGch' },			
				}); 
				request.done(function(msg) { 
				$("#texto").html(msg); 
				});
				 
			}else{
				arret = 0;
				$("#perso2").stopTime().mouvArretGch();
				$("#texto").hide();
			}
		}
	});
	
	
	
});
</script>
</head>
<body>
	<div id="progBar1"></div>
	<div id="masque">
		<div id="container">
			<div id="sol"></div>
			<div id="animation"></div>
			<div id="perso"></div>
			<div id="perso2"></div>
			<div id="texto"></div>
			<div id="mesTexto"></div>
			<input type='hidden' id='onTalk' value='0' /><!-- variable à ranger dans le template : qu'une conversation à la fois !-->
			<input type='hidden' id='onMyTalk' value='0' /><!-- variable à ranger dans le template : qu'une conversation à la fois !-->
		</div>
	</div>
</body>
</html>
