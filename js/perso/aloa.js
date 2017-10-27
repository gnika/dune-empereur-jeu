jQuery.fn.mouvRigole = function(){
		$(this).rigole();
		$(this).everyTime(200,function(){
			$(this).rigole();
		});
	}
	jQuery.fn.mouvArretRigole = function(){
		$(this).arretRigole();
	}
	jQuery.fn.rigole = function() {
		var mousePos = new Array(419, 511);
		$(this).oneTime(50,function() {
			interact(mousePos, ["-356px", "-475px", "-593px"]);
		}).oneTime(200,function() {
			interact(mousePos, ["-1px", "-120px", "-238px"])
		});
	};
	
	jQuery.fn.arretRigole = function() {
		var mousePos = new Array(419, 511);
		$(this).oneTime(800,function() {
			interact(mousePos, ["-1px", "-120px", "-238px"]);
		});
	};
	
$("#aloa").click(function() {
		if($("#onTalk").val()==0 && $("#onMyTalk").val()==0){
			$("#texto").removeClass().addClass('aloaText');
			if (arret == 0 || arrestation==1) {
				$("#onTalk").val(1);
				$('#yeuxMouve').val(1);
				$("#aloa").stopTime().mouvRigole();

				var request = $.ajax({ 
				url: url_site+'Core/index/ajaxquote',
				type: "POST",	
				data: { idDiv: 'aloa', idPerso: 4, talk: 'mouvArretRigole', stopTalk: 'mouvRigole', XY: 1 },							
				}); 
				request.done(function(msg) { 
				$("#texto").html(msg); 
				});
				 
			}else{
				arret = 0;
				$("#aloa").stopTime().mouvArretRigole();
				$("#texto").invisible();
			}
		}
	});
	
aniX = $("#aloa").offset().left;
aniY = $("#aloa").offset().top;
	
$(document).mousemove(function(event) {
	if($('#yeuxMouve').val()==0){
		var mousePos = new Array(event.pageX, event.pageY);
		interact(mousePos, ["-1px", "-120px", "-238px"]);
	}
});

function interact(mouseCord, aniCord){
    if (mouseCord[0] < aniX && mouseCord[1] < aniY){ // Box-1 
        $("#aloa").css("background-position", aniCord[0]+" 0px");
    } else if (mouseCord[0] > aniX && mouseCord[0] < aniX+117 && mouseCord[1] < aniY){ // Box-2
        $("#aloa").css("background-position", aniCord[1]+" 0px");
    } else if (mouseCord[0] > aniX+117 && mouseCord[1] < aniY){ // Box-3
        $("#aloa").css("background-position", aniCord[2]+" 0px");
    } else if (mouseCord[0] < aniX && mouseCord[1] > aniY && mouseCord[1] < aniY+117){ // Box-4
        $("#aloa").css("background-position", aniCord[0]+" -119px");
    } else if (mouseCord[0] > aniX && mouseCord[0] < aniX+117 && mouseCord[1] > aniY && mouseCord[1] < aniY+117){ // Box-5
        $("#aloa").css("background-position", aniCord[1]+" -119px");
    }else if (mouseCord[0] > aniX+117 && mouseCord[1] > aniY && mouseCord[1] < aniY+117){ // Box-6
        $("#aloa").css("background-position", aniCord[2]+" -119px");
    } else if (mouseCord[0] < aniX && mouseCord[1] > aniY+117){ // Box-7
        $("#aloa").css("background-position", aniCord[0]+" -237px");
    } else if (mouseCord[0] > aniX && mouseCord[0] < aniX+117 && mouseCord[1] > aniY+117){ // Box-8
        $("#aloa").css("background-position", aniCord[1]+" -237px");
    } else if (mouseCord[0] > aniX+117 && mouseCord[1] > aniY+117){ // Box-9
        $("#aloa").css("background-position", aniCord[2]+" -237px");
    }
}