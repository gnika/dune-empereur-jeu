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
	
	var arret = 0;

	$("#sayyaoto").click(function() {
		if($("#onTalk").val()==0 && $("#onMyTalk").val()==0){
			$("#texto").removeClass().addClass('sayyaotoText');
			if (arret == 0 || arrestation==1) {
				$("#onTalk").val(1);
				$("#sayyaoto").stopTime().mouvMarcheGch();

				var request = $.ajax({
				url: url_site+"Core/index/ajaxquote", 
				type: "POST",
				data: { idDiv: 'sayyaoto', idPerso: '3', talk: 'mouvArretGch', stopTalk: 'mouvMarcheGch' },			
				
				}); 
				request.done(function(msg) { 
				$("#texto").html(msg); 
				});
				 
			}else{
				arret = 0;
				$("#sayyaoto").stopTime().mouvArretGch();
				$("#texto").invisible();
			}
		}
	});
