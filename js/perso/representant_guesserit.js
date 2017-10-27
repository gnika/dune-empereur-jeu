jQuery.fn.arretParleGue = function() {
		$(this).oneTime(200,function() {
			$(this).css({backgroundPosition:' 3px -159px'});
		}).oneTime(400,function() {
			$(this).css({backgroundPosition:'-47px -159px'});
		}).oneTime(600,function() {
			$(this).css({backgroundPosition:'-98px -159px'});
		}).oneTime(800,function() {
			$(this).css({backgroundPosition:'-152px -159px'});
		});
	};
	jQuery.fn.mouvArretParleGue = function(){
		$(this).arretParleGue();
		$(this).everyTime(800,function(){
			$(this).arretParleGue();
		});
	}

	jQuery.fn.parleGue = function() {
		$(this).oneTime(200,function() {
			$(this).css({backgroundPosition:'3px 8px'});
		}).oneTime(400,function() {
			$(this).css({backgroundPosition:'-46px 8px'});
		}).oneTime(600,function() {
			$(this).css({backgroundPosition:'-93px 8px'});
		}).oneTime(800,function() {
			$(this).css({backgroundPosition:'-143px 8px'});
		});
	};
	jQuery.fn.mouvParleGue = function(){
		$(this).parleGue();
		$(this).everyTime(800,function(){
			$(this).parleGue();
		});
	}
	
	$("#representant_guesserit").click(function() {
		if($("#onTalk").val()==0 && $("#onMyTalk").val()==0){
			$("#texto").removeClass().addClass('representant_guesseritText');
			if (arret == 0 || arrestation==1) {
				$("#onTalk").val(1);
				$("#representant_guesserit").stopTime().mouvParleGue();

				var request = $.ajax({ 
				url: url_site+'Core/index/ajaxquote',
				type: "POST",
				data: { idDiv: 'representant_guesserit', idPerso: 5, talk: 'mouvArretParleGue', stopTalk: 'mouvParleGue' },			
				}); 
				request.done(function(msg) { 
				$("#texto").html(msg); 
				});
				 
			}else{
				arret = 0;
				$("#representant_guesserit").stopTime().mouvArretParleGue();
				$("#texto").invisible();
			}
		}
	});