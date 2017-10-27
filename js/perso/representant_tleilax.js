jQuery.fn.arretParleTle = function() {
		$(this).oneTime(200,function() {
			$(this).css({backgroundPosition:' -180px -216px'});
		}).oneTime(400,function() {
			$(this).css({backgroundPosition:'-222px -216px'});
		}).oneTime(600,function() {
			$(this).css({backgroundPosition:'-258px -216px'});
		});
	};
	jQuery.fn.mouvArretParleTle = function(){
		$(this).arretParleTle();
		$(this).everyTime(600,function(){
			$(this).arretParleTle();
		});
	}

	jQuery.fn.parleTle = function() {
		$(this).oneTime(200,function() {
			$(this).css({backgroundPosition:' -187px -308px'});
		}).oneTime(400,function() {
			$(this).css({backgroundPosition:'-223px -308px'});
		}).oneTime(600,function() {
			$(this).css({backgroundPosition:'-258px -308px'});
		});
	};
	jQuery.fn.mouvParleTle = function(){
		$(this).parleTle();
		$(this).everyTime(800,function(){
			$(this).parleTle();
		});
	}
	
	$("#representant_tleilax").click(function() {
		if($("#onTalk").val()==0 && $("#onMyTalk").val()==0){
			$("#texto").removeClass().addClass('representant_tleilaxText');
			if (arret == 0 || arrestation==1) {
				$("#onTalk").val(1);
				$("#representant_tleilax").stopTime().mouvParleTle();

				var request = $.ajax({ 
				url: url_site+'Core/index/ajaxquote',
				type: "POST",
				data: { idDiv: 'representant_tleilax', idPerso: 5, talk: 'mouvArretParleTle', stopTalk: 'mouvParleTle' },			
				}); 
				request.done(function(msg) { 
				$("#texto").html(msg); 
				});
				 
			}else{
				arret = 0;
				$("#representant_tleilax").stopTime().mouvArretParleTle();
				$("#texto").invisible();
			}
		}
	});