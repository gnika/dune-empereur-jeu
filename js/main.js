$(document).ready(function() {
	// alert('a');
})

function openDoorLoin(idPorte, idType){
	$("#porte_"+idPorte).stopTime().mouvDoorLoin(idPorte, idType);
}
function openIndice(){
	var request = $.ajax({
		url: url_site+'Core/index/indice',
		type: "POST"							
		}); 
		request.done(function(msg) {
						$("#inThePlace").fadeOut(1000);
						setTimeout(function(){
						  $("#inThePlace").hide();
						  $("#inThePlace").html(msg); 
						$("#inThePlace").fadeIn(1000);
						}, 1000);
						
					});
}
function openJournal(){
	var request = $.ajax({
		url: url_site+'Core/index/journal',
		type: "POST"							
		}); 
		request.done(function(msg) {
						$("#inThePlace").fadeOut(1000);
						setTimeout(function(){
						  $("#inThePlace").hide();
						  $("#inThePlace").html(msg); 
						$("#inThePlace").fadeIn(1000);
						}, 1000);
						
					});
}
function returnVillage(){
	var request = $.ajax({
		url: url_site+'Core/index/village4',
		type: "POST",
		data: { returnBoussole:1 }
		}); 
		request.done(function(msg) {
						$("#inThePlace").fadeOut(1000);
						setTimeout(function(){
						  $("#inThePlace").hide();
						  $("#inThePlace").html(msg); 
						$("#inThePlace").fadeIn(1000);
						}, 1000);
						
					});
}

function openDoorCote(idPorte, idType){
	$("#porte_"+idPorte).stopTime().mouvDoorCote(idPorte, idType);
}

jQuery.fn.mouvDoorLoin = function(idPorte, idType){
	$(this).everyTime(1000,function(){
		$(this).openDoorLoin(idPorte, idType);
	});
}
jQuery.fn.mouvDoorCote = function(idPorte, idType){
	$(this).everyTime(1000,function(){
		$(this).openDoorCote(idPorte, idType);
	});
}

jQuery.fn.openDoorCote = function(idPorte, idType) {
	$(this).oneTime(200,function() {
		$(this).css({backgroundPosition:'3px 2px'});
	}).oneTime(400,function() {
		$(this).css({backgroundPosition:'3px -318px'});
	}).oneTime(600,function() {
		$(this).css({backgroundPosition:'3px -638px'});
	}).oneTime(800,function() {
		$(this).css({backgroundPosition:'3px -958px'});
	}).oneTime(1000,function() {
		$("#porte_"+idPorte).removeClass('porte_'+idType+'_0').addClass('porte_'+idType+'_1');
		$(this).css({backgroundPosition:'3px -1279px'});
		$(this).stopTime();
	});		
};


jQuery.fn.openDoorLoin = function(idPorte, idType) {
	$(this).oneTime(200,function() {
		$(this).css({backgroundPosition:'2px 0px'});
	}).oneTime(400,function() {
		$(this).css({backgroundPosition:'2px -200px'});
	}).oneTime(600,function() {
		$(this).css({backgroundPosition:'2px -400px'});
	}).oneTime(800,function() {
		$(this).css({backgroundPosition:'2px -600px'});
	}).oneTime(1000,function() {
		$("#porte_"+idPorte).removeClass('porte_'+idType+'_0').addClass('porte_'+idType+'_1');
		$(this).css({backgroundPosition:'2px -800px'});
		$(this).stopTime();
	});		
};


function ajaxClef(idPorte, etat, idObject){
	var request = $.ajax({ 
				url: url_site+'Core/ajax/ajaxporte', 
				type: "POST",
				data: { porte: idPorte, etatPorte: etat, objectId: idObject},			
				});
}
function hormones(){
	var request = $.ajax({
				url: url_site+'Core/ajax/hormones', 
				type: "POST",
				data: { objectId: 3},			
				});
}
function mv_nuage(){
	$(".sprite_nuage").removeClass('hide');
	$(".sprite_nuage").stopTime().mouvfondCom();
	var request = $.ajax({
				url: url_site+'Core/ajax/tournevis', 
				type: "POST",
				data: { objectId: 5},			
				});
}
function learnLang(){
	var request = $.ajax({
				url: url_site+'Core/ajax/chakobsa', 
				type: "POST",
				data: { objectId: 5},			
				});
}
/*
function donneSucre(){
	var request = $.ajax({
				url: url_site+'Core/ajax/donnesugar', 
				type: "POST",
				data: { objectId: 17},			
				});
}
*/
function afficheGraphe(){
	var request = $.ajax({
				url: url_site+'Customer/index/infohumeur', 
				type: "POST",
				data: { ajax: 1},			
				});
	request.done(function(msg) {
				$("#resultAjax").empty(); 
				$("#resultAjax").html(msg);
				$('#sortie_graph').css({'display': 'block'});
				$('#buttonObjet, #infojoueur, #information, #buttonRessources, #mesTexto, .foot').css({'display': 'none'});
				if($("#mesObjets").css('display')!='none')
					$( "#mesObjets" ).toggle( "drop" );
			});
}

function afficheSpice(){
	var request = $.ajax({ 
				url: url_site+'Customer/index/inforessourcesuser', 
				type: "POST",
				data: { ajax: 1},
				});
	request.done(function(msg) {
				$("#ressources").empty(); 
				$("#ressources").html(msg);
			});
}

function afficheObject(){
	var request = $.ajax({
				url: url_site+'Customer/index/objectsuser',
				type: "POST",
				data: { templateNoDisplay: 1}		
				});
	request.done(function(msg) {
				$("#mesObjets").empty();
				$("#mesObjets").html(msg);
				// $('#sortie_objet').css({'display': 'block'});
				// $('#buttonRessources, #infojoueur, #information, #buttonObjet, #mesTexto, .foot').css({'display': 'none'});
				// $( "#mesObjets" ).toggle( "drop" );
			});
}

function mouveLeft(idPerso){
			$( "#"+idPerso ).animate({
						left: -500
						}, {
						duration: 10000,
						step: function( now, fx ){
						$( ".block:gt(0)" ).css( "left", now );
						}
						})
}

function vaisseauDisplay(){
	var request = $.ajax({
				url: url_site+'Core/ajax/affichetabvaisseau',
				type: "POST"		
				});
	request.done(function(msg) {
				$("#forceTab").empty();
				$("#forceTab").html(msg);
			});
}

function planeteDisplay(id, name){
	var request = $.ajax({
				url: url_site+'Core/index/cartedataone',
				type: "POST",
				data: { idPlanete: id}		
				});
	request.done(function(msg) {
				$("#"+name+"-box").empty();
				$("#"+name+"-box").html(msg);
			});
}

function recompenseDisplay(html){
	$("#recompense #recompenseValue").html(html);
	$("#recompense").css({
	   opacity: 0,
	   visibility: 'visible'
	}).animate({ opacity: 0.9 }, 1000);
	
	setTimeout(function(){
		$("#recompense").css({
			   opacity: 0.9,
			   visibility: 'visible'
		}).animate({ opacity: 0 }, 1000);
	}, 5000);
	
	setTimeout(function(){
		$("#recompense").css('visibility', 'hidden');
	}, 6000);
  
	var request = $.ajax({
				url: url_site+'Core/ajax/journaladd',
				type: "POST",
				data: { htmlCell: html}
				});
	
}

function setIndice(){
	var request = $.ajax({
	url: url_site+'Core/ajax/indice', 
	type: "POST"			
	});
	request.done(function(msg) { 
		messagesDisplay();
		afficheObject();
	});
}

function setInscription(){
	var request = $.ajax({
	url: url_site+'Core/ajax/inscrit', 
	type: "POST"			
	});
	request.done(function(msg) { 
		messagesDisplay();
	});
}

function setSugar(){
	var request = $.ajax({
	url: url_site+'Core/ajax/sugar', 
	type: "POST"			
	});
	request.done(function(msg) { 
		messagesDisplay();
		afficheObject();
	});
}

function verifTalk(){
	if($("#onTalk").val()==0 && $("#onMyTalk").val()==0)
		return true;
	else
		return false;
}

function envoiVaisseau(idPlanete, action){
	if($("#onTalk").val()==0 && $("#onMyTalk").val()==0){
		$("#onTalk").val(1);
		var request = $.ajax({
		url: url_site+'Core/ajax/ajaxcarte',
		type: "POST",
			data: { quid: action, idPerso: 9, talk: 'mouvArretGch', stopTalk: 'mouvMarcheGch', id: idPlanete, troupe: 0, diplomate: 0 },							
		}); 
		request.done(function(msg) {
		$("#texto").html(msg); 
		});
	}
}

function envoiTroupe(idPlanete){
	if($("#onTalk").val()==0 && $("#onMyTalk").val()==0){
		$("#onTalk").val(1);
		var request = $.ajax({
		url: url_site+'Core/ajax/ajaxcarte',
		type: "POST",
			data: { quid: 0, idPerso: 9, talk: 'mouvArretGch', stopTalk: 'mouvMarcheGch', id: idPlanete, troupe: 1, diplomate: 0 },
		}); 
		request.done(function(msg) { 
		$("#texto").html(msg); 
		});
	}
}

function envoiDiplomate(idPlanete){
	if($("#onTalk").val()==0 && $("#onMyTalk").val()==0){
		$("#onTalk").val(1);
		var request = $.ajax({
		url: url_site+'Core/ajax/ajaxcarte',
		type: "POST",
			data: { quid: 0, idPerso: 9, talk: 'mouvArretGch', stopTalk: 'mouvMarcheGch', id: idPlanete, troupe: 0, diplomate: 1 },
		}); 
		request.done(function(msg) { 
		$("#texto").html(msg);
		});
	}
}

function messagesDisplay(){
	var request = $.ajax({
				url: url_site+'Core/ajax/messages',
				type: "POST",	
				});
	request.done(function(msg) {
		$("#messages").html(msg);
		$("#messages").css({
		   opacity: 0,
		   visibility: 'visible'
		}).animate({ opacity: 0.9 }, 500);
		
		setTimeout(function(){
			$("#messages").css({
				   opacity: 0.9,
				   visibility: 'visible'
			}).animate({ opacity: 0 }, 500);
		}, 3000);
		
		setTimeout(function(){
			$("#messages").css('visibility', 'hidden');
		}, 4000);
	});
	
}

(function($) {
    $.fn.invisible = function() {
        return this.each(function() {
            $(this).css("visibility", "hidden");
        });
    };
    $.fn.visible = function() {
        return this.each(function() {
            $(this).css("visibility", "visible");
        });
    };
}(jQuery));

arret=0;

function musicBox(music){
	
	// if(music==undefined)music='fond1.mp3';	
	
	if(music!=undefined){
		var audio = $("#mplayer");      
		$("#sourc").attr("src", 'music/'+music);
		/****************/
		audio[0].pause();
		audio[0].load();//suspends and restores all audio element
		audio[0].play();
		/****************/
		
	}
}
musicBox();
