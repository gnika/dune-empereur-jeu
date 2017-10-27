<div id='textoIn'>
<?php
$talk=$_POST['talk'];
$stopTalk=$_POST['stopTalk'];
$idPerso=$_POST['idPerso'];
if($_POST['text']==1){
	$text='Bonjour///je suis la fille de Moneo///Je travaille au palais';//sortie sql
}
elseif($_POST['text']==2){
	$text='En effet, je ne supporte pas le Ver///celui qui se fait appeler l\'empereur-dieu de dune///nous sommes la rébellion !';//sortie sql

}
elseif($_POST['text']==3){
	$text='Moneo est le l\'homme de confiance du Ver///mon coiffeur s\'appelle Dominique';//sortie sql
}
elseif($_POST['text']==4){
	$text='Je suis la servante de Siona';//sortie sql
}
elseif($_POST['text']==8){
	$text='elles sont la garde et l\'armée du Ver...///je les trouve menaçante...';//sortie sql
}
elseif($_POST['text']==9){
	$text='Je le trouve répugnant...';//sortie sql
}


if($_POST['text']==1){//sortie sql
	$valReturn='';
	$choix=array(2=>'A votre comportement, je vous devine hostile au pouvoir en place', 3=>'Qui donc est Moneo ?', 999=>'Désolé de vous avoir dérangé');//sortie sql
	$val=1;
	foreach($choix as $clef=>$value){
		$valReturn.='<p><a onclick="ajaxReturn('.$clef.', \\\''.$idPerso.'\\\', \\\''.$talk.'\\\', \\\''.$stopTalk.'\\\');return false">'.$val.' : '.$value.'</a></p>';
		$val++;
	}
}else{
	$choix=0;
}

if($_POST['text']==3){//sortie sql
	$valReturn='';
	$choix=array(8=>'Les truitesses sont-elles vos alliées ?', 9=>'Aimez vous Duncan Hidaho ?', 999=>'Désolé de vous avoir dérangé');//sortie sql
	$val=1;
	foreach($choix as $clef=>$value){
		$valReturn.='<p><a onclick="ajaxReturn('.$clef.', \\\''.$idPerso.'\\\', \\\''.$talk.'\\\', \\\''.$stopTalk.'\\\');return false">'.$val.' : '.$value.'</a></p>';
		$val++;
	}
}

$pieces = explode("///", $text);


echo $pieces[0];
?>
</div>
<?if(count($pieces)>1) { ?>
	<a href='' onclick='return false;' id='textoLink'>suite ... </a> 
<?php 
} ?>
<input type='hidden' id='stepDial' value='0'/>
<?php if(count($pieces)>1){
?>
	<input type='hidden' id='closeWindow' value='0'/>
<?php }else{ ?>
	<input type='hidden' id='closeWindow' value='1'/>
<?php } ?>
<input type='hidden' id='maxDial' value='<?php echo count($pieces);?>'/>


<SCRIPT language="Javascript">
	$("#texto").show();
	var idPerso='<?php echo $idPerso;?>';
	var talk='<?php echo $talk;?>';
	$("#texto").css('background-color', '#FFFFFF');
	$("#textoLink").click(function(event) {

	
		var tab = <?php echo json_encode($pieces); ?>;
		$("#textoIn").empty();
		var newVal=$("#stepDial").val();
		if(newVal < $("#maxDial").val()){
			newVal=parseInt(newVal)+1;
			$("#stepDial").val(newVal);
			
			$("#textoIn").html(tab[newVal]);
		}
		
		if(newVal+1==$("#maxDial").val()){
			$("#textoLink").hide();
			$("#closeWindow").val(1);
			
		}
		
	})	
	
	$("#textoIn").click(function(event) {
			if($("#closeWindow").val()==1){
			arrestation = 1;
			
			$("#"+idPerso).stopTime().<?php echo $talk.'()';?>;
			if(<?php echo $choix;?>!=0){
				$("#onMyTalk").val(1);
				$("#mesTexto").html('<?php echo $valReturn;?>');
			}else{
				$("#onTalk").val(0);
			}
			$("#texto").hide();
		}
	})
	
	function ajaxReturn(clefId, idPersoReturn, stopTalkReturn, stopstopTalkReturn){
		if(clefId==999){
			$("#mesTexto").empty();
			$("#onTalk").val(0);
			$("#onMyTalk").val(0);
			return false;
		}
		arrestation = 1;
		
		$("#"+idPerso).stopTime()[stopstopTalkReturn]();
		
		var request2 = $.ajax({
		url: "page_ajax.php", 
		type: "POST",
		data: { text: clefId, idPerso: idPersoReturn, talk: stopTalkReturn, stopTalk: stopstopTalkReturn},			
		});
		request2.done(function(msg) { 
			$("#texto").html(msg); 
			});
		
	}
	
</SCRIPT>
