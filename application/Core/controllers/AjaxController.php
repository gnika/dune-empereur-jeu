<?php

class AjaxController extends Application_Controller_Action
{
	public function init() {
       
    }
	
	public function ajaxporteAction() {
		$membre=new Zend_Session_Namespace('user');
		if($membre->userInfo!=null){
			$idPorte	=	$this->getRequest()->getParam('porte');
			$etat	=	$this->getRequest()->getParam('etatPorte');
			$idObject	=	$this->getRequest()->getParam('objectId');
			
			$squotes=new Core_Model_Mapper_Personnage();
			$squotes->majPorte($idPorte, $etat);
			$squotes->supprObjet($membre->userInfo->getId(), $idObject);
		}
    }
	
	public function ajaximpotAction(){
		$this->_helper->layout->disableLayout();
		$membre=new Zend_Session_Namespace('user');
		if($membre->userInfo!=null){
			$epice	=	$this->getRequest()->getParam('epice');
			$renommee	=	$this->getRequest()->getParam('renommee');
			$corruption	=	$this->getRequest()->getParam('corruption');
			$suggGuesserit	=	$this->getRequest()->getParam('suggGuesserit');
			$suggIx	=	$this->getRequest()->getParam('suggIx');
			$suggGuilde	=	$this->getRequest()->getParam('suggGuilde');
			$suggTleilax	=	$this->getRequest()->getParam('suggTleilax');
			$corruptionTotale	=	$this->getRequest()->getParam('corruptionTotale');
			
			$menace=Application_Common::getMajQueste(5, 7, 1);
			if($menace && $suggIx==20)
				Application_Common::majQueste(7, 7, 1);
			
			$squotes=new Customer_Model_Mapper_User();
			$squotes->majEpice($epice);
			$squotes->majRenommee(round($renommee-($corruptionTotale/10)));
			$squotes->majCorruption($corruption);
			$squotes->majImpot();			
		}
	}
	
	public function ajaxcarteAction()
	{	
		$this->_helper->layout->disableLayout();
		$membre=new Zend_Session_Namespace('user');
		if($membre->userInfo!=null){
			$idPlanete	=	$this->getRequest()->getParam('id');
			$quid	=	$this->getRequest()->getParam('quid');
			$troupe	=	$this->getRequest()->getParam('troupe');
			$diplomate	=	$this->getRequest()->getParam('diplomate');
			$carte=new Core_Model_Mapper_Carte();
			$planete=$carte->getMyStar($idPlanete);
			$this->view->planete=$planete;
			$this->view->quid=$quid;
			$this->view->diplomate=$diplomate;
			$this->view->troupe=$troupe;
			
			$user=new Customer_Model_Mapper_User();
			$us=new Customer_Model_User();
			$user->find($membre->userInfo->getId(), $us);
			$this->view->myUser=$us;
		}
	}
	
	public function ajaxcarteenvoitroupeAction()
	{
		$this->_helper->layout->disableLayout();
		$membre=new Zend_Session_Namespace('user');
		if($membre->userInfo!=null){
			$idPlanete	=	$this->getRequest()->getParam('id');
			$nb	=	$this->getRequest()->getParam('nb');
			$carte=new Core_Model_Mapper_Carte();
			$planete=$carte->getMyStar($idPlanete);
			if($planete->cau_envoi>0)
				echo 1;
			elseif($planete->cau_etat==1 ){
				if($carte->envoiTroupe($planete->ca_id, $nb))
					echo 2;else return 4;
			}else
				echo 3;
			
		}
		die();
	}
	
	public function envoidiplomateAction()
	{
		$this->_helper->layout->disableLayout();
		$membre=new Zend_Session_Namespace('user');
		if($membre->userInfo!=null){
			$idPlanete	=	$this->getRequest()->getParam('idPlanete');
			$carte=new Core_Model_Mapper_Carte();
			$waiting=$carte->diplomateWait();
			if(!$waiting){
				if($carte->verifPlaneteVierge($idPlanete)){
					echo 3;
				}else{
					$planete=$carte->envoiDiplomate($idPlanete);
					echo 1;
				}
			}else
			 echo 2;
		}
		die();
	}
	
	public function envoiflotteAction()
	{
		$this->_helper->layout->disableLayout();
		$membre=new Zend_Session_Namespace('user');
		if($membre->userInfo!=null){
			$idPlanete	=	$this->getRequest()->getParam('idPlanete');
			$action	=	$this->getRequest()->getParam('actionId');
			$carte=new Core_Model_Mapper_Carte();
			$planete=$carte->envoiVaisseau($idPlanete, $action);
			if($planete==3)
				echo 3;
			if($planete==4)
				echo 4;
			if($planete==5)
				echo 5;
		}
		die();
	}
	
	public function affichetabvaisseauAction()
	{
		$this->_helper->layout->disableLayout();
		$membre=new Zend_Session_Namespace('user');
		if($membre->userInfo!=null){
			$user=new Customer_Model_Mapper_User();
			$us=new Customer_Model_User();
			$user->find($membre->userInfo->getId(), $us);
			$this->view->myUser=$us;
			
			$vaisseau=new Core_Model_Mapper_Carte();
			$myPlanetes=$vaisseau->getMyStars();
			$this->view->myPlanetes=$myPlanetes;
			$this->view->encoursExploration=$vaisseau->getActionVaisseau(4);//4==exploration
			$this->view->encoursAttaque=$vaisseau->getActionVaisseau(3);//3==attaque
		}
	}
	
	public function achatvaisseauAction()
	{
		$this->_helper->layout->disableLayout();
		$membre=new Zend_Session_Namespace('user');
		if($membre->userInfo!=null){
			$nbAchete	=	$this->getRequest()->getParam('nbAchete');
			if($nbAchete == 1 || $nbAchete == 2 || $nbAchete == 5 || $nbAchete == 10){
				
				$carte=new Core_Model_Mapper_Carte();
				$getActionVaisseau=$carte->getActionVaisseau(3);
				$user=new Customer_Model_Mapper_User();
				$us=new Customer_Model_User();
				$user->find($membre->userInfo->getId(), $us);
				$prix=$nbAchete*$us->getValeurVaisseau();
				if($prix>$us->getEpice()){
					Application_Common::addSystemError('Vous ne possédez pas assez d\'épice pour faire cet achat !');
				}
				elseif($getActionVaisseau>0){
					Application_Common::addSystemError('Vous ne pouvez pas acheter de vaisseaux lorsque votre flotte est en	expédition !');
				}
				else{
					$user->majEpice(-$prix);
					$user->majVaisseau($nbAchete);
					echo $us->getVaisseau()+$nbAchete;
					Application_Common::addSystemSucces('Vous avez acheté '.$nbAchete.' vaisseaux !');
				}
			}
			die();
		}
	}
	public function achatobjetAction()
	{
		$this->_helper->layout->disableLayout();
		$membre=new Zend_Session_Namespace('user');
		if($membre->userInfo!=null){
			$nbAchete	=	$this->getRequest()->getParam('nbAchete');
			$idOb	=	$this->getRequest()->getParam('idObParam');
			
			$user=new Customer_Model_Mapper_User();
			$us=new Customer_Model_User();
			$user->find($membre->userInfo->getId(), $us);
			
			$deja		= 0;
			$dejaAchete = $us->getObjets();
			if($dejaAchete!=''){
				$dejaAchete = json_decode($dejaAchete);
				$key = array_search($idOb, $dejaAchete); 
				if($key!==false)$deja = 1;
			}
			
			$prix=$nbAchete;
			if($prix>$us->getEpice()){
				Application_Common::addSystemError('Vous ne possédez pas assez d\'épice pour faire cet achat !');
			}
			elseif($deja==1){
				Application_Common::addSystemError('Vous avez déjà acheté ce type d\'objet !');
			}
			else{
				$user->majEpice(-$prix);
				$user->majObjet($idOb);//au customer pour qu'il ne puisse pas acheter deux fois le même objet
				$squotes=new Core_Model_Mapper_Personnage();
				
				$squotes->addObjet($idOb);
				$ob=$squotes->getNameObjet($idOb);
				Application_Common::addSystemSucces('Vous avez acheté un '.$ob);
				if($idOb==7)
					Application_Common::majQueste(1, 10, 1);
				echo 'done';
			}

			die();
		}
	}
	
	public function messagesAction()
	{
		$this->_helper->layout->disableLayout();
	}



	public function journaladdAction()
    {
		$this->_helper->layout->disableLayout();
		
		$this->_auth = Zend_Auth::getInstance();
		$member = $this->_auth->getIdentity();
		$user=new Customer_Model_Mapper_User();
		$us=new Customer_Model_User();
		$user->find($member->cuu_id, $us);
		$message	=	$this->getRequest()->getParam('htmlCell');
		$message	=	str_replace("<tr>", '<br>', $message);
		$message	=	str_replace("</tr>", '', $message);
		$message	=	str_replace("<td>", '<br>', $message);
		$message	=	str_replace("</td>", '', $message);
		
		
		$rap = json_decode($us->getRapport(),true);
		$rap['recompense'][] = $message;
		$rap = json_encode($rap);
		$us->setRapport($rap);
		$user->save($us);

		die();
	}
	
	public function ajaxusermajAction() {
		$this->_helper->layout->disableLayout();
		$membre=new Zend_Session_Namespace('user');
		if($membre->userInfo!=null){
			$idCell	=	$this->getRequest()->getParam('idCell');
			
			$user=new Customer_Model_Mapper_User();
			
			
			switch ($idCell) {
				case 'IXinfluence':
					$user->majuserinfluence(5);
					$image='influence';
					$result=$user->getInfluenceFaction(5);
					break;
				case 'IXserviteur':
					$user->majuserServiteur(5);
					$image='serviteur';
					$result=$user->getServiteurFaction(5);
					break;
				case 'IXescorte':
					$user->majuserEscorte(5);
					$image='escorte';
					$result=$user->getEscorteFaction(5);
					break;
				case 'GUILDEinfluence':
					$user->majuserinfluence(6);
					$image='influence';
					$result=$user->getInfluenceFaction(6);
					break;
				case 'GUILDEserviteur':
					$user->majuserServiteur(6);
					$image='serviteur';
					$result=$user->getServiteurFaction(6);
					break;
				case 'GUILDEescorte':
					$user->majuserEscorte(6);
					$image='escorte';
					$result=$user->getEscorteFaction(6);
					break;
				case 'TLEILAXinfluence':
					$user->majuserinfluence(4);
					$image='influence';
					$result=$user->getInfluenceFaction(4);
					break;
				case 'TLEILAXserviteur':
					$user->majuserServiteur(4);
					$image='serviteur';
					$result=$user->getServiteurFaction(4);
					break;
				case 'TLEILAXescorte':
					$user->majuserEscorte(4);
					$image='escorte';
					$result=$user->getEscorteFaction(4);
					break;
				case 'GUESSERITinfluence':
					$user->majuserinfluence(3);
					$image='influence';
					$result=$user->getInfluenceFaction(3);
					break;
				case 'GUESSERITserviteur':
					$user->majuserServiteur(3);
					$image='serviteur';
					$result=$user->getServiteurFaction(3);
					break;
				case 'GUESSERITescorte':
					$user->majuserEscorte(3);
					$image='escorte';
					$result=$user->getEscorteFaction(3);
					break;
			}
			if($image=='serviteur')echo '<script>afficheGraphe()</script>';
			$this->view->img=$image;
			$this->view->result=$result;
		}
    }
	
	public function ajaxusersuggAction()
	{
		$this->_helper->layout->disableLayout();
		$membre=new Zend_Session_Namespace('user');
		if($membre->userInfo!=null){
			$idSlider	=	$this->getRequest()->getParam('idSlider');
			$valueSlid	=	$this->getRequest()->getParam('valueSlid');
			if($idSlider=='sliIx')$idFaction=5;elseif($idSlider=='sliTl')$idFaction=4;elseif($idSlider=='sliBEN')$idFaction=3;else $idFaction=6;
			$user=new Customer_Model_Mapper_User();
			$user->majSuggestionFaction($idFaction, $valueSlid);
		}
			die();
	}	
	
	public function hormonesAction()
	{
		$this->_helper->layout->disableLayout();
		$membre=new Zend_Session_Namespace('user');
		if($membre->userInfo!=null){
			Application_Common::deleteobject(3);
			Application_Common::majQueste(3, 12, 1);
		}
			die();
	}
	
	public function indiceAction()
	{
		$this->_helper->layout->disableLayout();
		$membre=new Zend_Session_Namespace('user');
		if($membre->userInfo!=null){
			Application_Common::majQueste(5, 6, 1);
			$squotes=new Core_Model_Mapper_Personnage();
				$squotes->addObjet(6);
			Application_Common::addSystemSucces('Vous avez trouvé une lettre');
		}
			die();
	}
	
	public function inscritAction()
	{
		$this->_helper->layout->disableLayout();
		$membre=new Zend_Session_Namespace('user');
		if($membre->userInfo!=null){
			$sucre=Application_Common::getMajQueste(3, 16, 1);
			if($sucre){
				Application_Common::majQueste(3, 3, 4);
				Application_Common::majQueste(4, 16, 1);

				$squotes=new Core_Model_Mapper_Personnage();
					$squotes->addObjet(6);
				Application_Common::addSystemSucces('Vous avez trouvé l\'inscription entière');
			}
		}
			die();
	}

	public function sugarAction()
	{
		$this->_helper->layout->disableLayout();
		$membre=new Zend_Session_Namespace('user');
		if($membre->userInfo!=null){
			$squotes=new Core_Model_Mapper_Personnage();
				$squotes->addObjet(17);
			Application_Common::addSystemSucces('Vous avez trouvé des sucreries');
		}
			die();
	}
	
	public function tournevisAction()
	{
		$this->_helper->layout->disableLayout();
		$membre=new Zend_Session_Namespace('user');
		if($membre->userInfo!=null){
			Application_Common::deleteobject(5);
			Application_Common::majQueste(1, 17, 1);
		}
			die();
	}
	public function chakobsaAction()
	{
		$this->_helper->layout->disableLayout();
		$membre=new Zend_Session_Namespace('user');
		if($membre->userInfo!=null){
			Application_Common::deleteobject(9);
			Application_Common::majQueste(2, 21, 2);
		}
			die();
	}

	public function donnesugarAction()
	{
		$this->_helper->layout->disableLayout();
		$membre=new Zend_Session_Namespace('user');
		if($membre->userInfo!=null){
			Application_Common::deleteobject(17);
			Application_Common::majQueste(2, 3, 4);
		}
			die();
	}
}