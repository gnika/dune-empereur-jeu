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
	
	$("#nayla").click(function() {
		if($("#onTalk").val()==0 && $("#onMyTalk").val()==0){
			$("#texto").removeClass().addClass('naylaText');
			if (arret == 0 || arrestation==1) {
				$("#onTalk").val(1);
				$("#nayla").stopTime().mouvMarcheDrt();

				var request = $.ajax({ 
				url: url_site+'Core/index/ajaxquote',
				type: "POST",
				data: { idDiv: 'nayla', idPerso: 2, talk: 'mouvArretDrt', stopTalk: 'mouvMarcheDrt' },			
				}); 
				request.done(function(msg) { 
				$("#texto").html(msg); 
				});
				 
			}else{
				arret = 0;
				$("#nayla").stopTime().mouvArretDrt();
				$("#texto").invisible();
			}
		}
	});