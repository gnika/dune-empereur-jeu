<?php

class IndexController extends Application_Controller_Action
{


    public function init() {
		if(!$this->getRequest()->getParam('heure') && !$this->getRequest()->getParam('idDiv')){
			$this->_auth = Zend_Auth::getInstance();
			
			$member = $this->_auth->getIdentity();
			$user=new Customer_Model_Mapper_User();
			$us=new Customer_Model_User();
			$user->find($member->cuu_id, $us);
			$this->view->user=$us;
			// $salleNop=array(1, 27, 28, 29, 33);
			// if($us->getImpot()>=5 && !in_array($us->getSalle(), $salleNop))
			// {
				// $us->setSalle(1);
				
				// $user->save($us);
				?>
				<script>
				// location.reload();
				// var request = jQuery.ajax({
				// url: url_site+'Core/index/trone',
				// type: "POST"							
				// }); 
				// request.done(function(msg) {			
					 // jQuery("#inThePlace").html(msg); 			
				// });
				</script>
				 <?php
			// }
		}
    }
    
	public function indexAction()
	{
		$lang=$this->getRequest()->getParam('lang');
		if($lang=='')$lang='fr';
		$language=new Zend_Session_Namespace('lang');
		$language->lang=$lang;
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
		$user=new Customer_Model_Mapper_User();
		$us=new Customer_Model_User();
		$user->find($member->cuu_id, $us);
		$persos=new Core_Model_Mapper_Personnage();
		$nomMusique_old=$persos->getMusiqueSalle();
		$this->view->nomMusique_old=$nomMusique_old;
		
		$this->view->form ='';
		if( !$this->_auth->hasIdentity()){
				$form = new Customer_Form_Login();
				$form   ->setAction( URL_MAIN_ABS . 'Customer/auth/dologin' )
						->setMethod( 'post' )
						->setAttrib('id', 'loginForm');
				$this->view->form = $form;
				// $this->_helper->viewRenderer->setScriptAction('loginform');
		}
		
		$nomSalle=$persos->getSalle($us->getSalle());
		$this->view->nomSalle=$nomSalle;
		$this->view->myUser=$us;
		$this->_helper->layout()->user=$us;
		// $carte=new Core_Model_Mapper_Carte();
		// $myStar=$carte->getMyStar(1);
		
		// $user->majServiteur(-5, 4);
		/*?><script>afficheGraphe()</script><?php*/
		$request    = $this->getRequest();
        $inscrit      = $request->getParam( 'inscrit' );
		if($inscrit && $inscrit==1)
			$this->view->inscrit=1;else $this->view->inscrit=0;
		if($lang=='en')
			$this->render('index-en');
	}
	
    public function troneAction()
	{
		$language=new Zend_Session_Namespace('lang');
		
		$this->_helper->layout->disableLayout();
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
		
		/*$user=new Customer_Model_Mapper_User();
		$user->majServiteur(-1, 4);?><script>afficheGraphe()</script><?php*/
		
		$persos=new Core_Model_Mapper_Personnage();
		$idSalle=1;
		$nomMusique_old=$persos->getMusiqueSalle();
		$nomMusique=$persos->getMusiqueSalle($idSalle);
		 // echo $nomMusique_old.' ::: '.$nomMusique;
		if($nomMusique_old!=$nomMusique){
			?><script>musicBox('<?php echo $nomMusique;?>')</script><?php
		}
		$user=new Customer_Model_Mapper_User();
		$user->majSalle($idSalle);
		$us=new Customer_Model_User();
		$user->find($member->cuu_id, $us);
		
		$this->verifimpotAction();
		
		$nomSalle=$persos->getSalle($idSalle);
		$persoDansSalle=$persos->getPersonnages($idSalle);
		$porteDansSalle=$persos->getPortes($idSalle);
		$persoTotal=$persos->getPersonnages();

		// foreach($persoTotal as $clef=>$value)
			// $this->view->InlineScript()->appendFile(URL_MAIN_ABS . 'js/perso/'.$clef.'.js', $type = 'text/javascript');		
		
		$this->view->myUser=$us;
		$this->view->salle=$nomSalle;
		$this->view->lang=$language->lang;
		$this->view->persoDansSalle=$persoDansSalle;
		$this->view->porteDansSalle=$porteDansSalle;
    }
	
	public function couloirAction()
    {
		$this->_helper->layout->disableLayout();
		
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
		
		$persoCuisine=new Core_Model_Mapper_Personnage();
		$idSalle=2;
		$nomMusique_old=$persoCuisine->getMusiqueSalle();
		$nomMusique=$persoCuisine->getMusiqueSalle($idSalle);
		if($nomMusique_old!=$nomMusique){
			?><script>musicBox('<?php echo $nomMusique;?>')</script><?php
		}
		$nomSalle=$persoCuisine->getSalle($idSalle);
		$persoDansSalle=$persoCuisine->getPersonnages($idSalle);
		$porteDansSalle=$persoCuisine->getPortes($idSalle);
			
		$user=new Customer_Model_Mapper_User();
		$user->majSalle($idSalle);
		$us=new Customer_Model_User();
		$user->find($member->cuu_id, $us);
		$this->view->myUser=$us;
		
		$this->view->salle=$nomSalle;
		$this->view->persoDansSalle=$persoDansSalle;
		$this->view->porteDansSalle=$porteDansSalle;
    }
	
	public function couloir2Action()
    {
		$this->_helper->layout->disableLayout();
		
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
		
		$persoCuisine=new Core_Model_Mapper_Personnage();
		$idSalle=8;
		$nomMusique_old=$persoCuisine->getMusiqueSalle();
		$nomMusique=$persoCuisine->getMusiqueSalle($idSalle);
		if($nomMusique_old!=$nomMusique){
			?><script>musicBox('<?php echo $nomMusique;?>')</script><?php
		}
		$nomSalle=$persoCuisine->getSalle($idSalle);
		$persoDansSalle=$persoCuisine->getPersonnages($idSalle);
		$porteDansSalle=$persoCuisine->getPortes($idSalle);
			
		$user=new Customer_Model_Mapper_User();
		$user->majSalle($idSalle);
		$us=new Customer_Model_User();
		$user->find($member->cuu_id, $us);
		$this->view->myUser=$us;
		
		$this->view->salle=$nomSalle;
		$this->view->persoDansSalle=$persoDansSalle;
		$this->view->porteDansSalle=$porteDansSalle;
    }
	
	public function couloir3Action()
    {
		$this->_helper->layout->disableLayout();
		
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
		
		$persoCuisine=new Core_Model_Mapper_Personnage();
		$idSalle=11;
		$nomMusique_old=$persoCuisine->getMusiqueSalle();
		$nomMusique=$persoCuisine->getMusiqueSalle($idSalle);
		if($nomMusique_old!=$nomMusique){
			?><script>musicBox('<?php echo $nomMusique;?>')</script><?php
		}
		$nomSalle=$persoCuisine->getSalle($idSalle);
		$persoDansSalle=$persoCuisine->getPersonnages($idSalle);
		$porteDansSalle=$persoCuisine->getPortes($idSalle);
			
		$user=new Customer_Model_Mapper_User();
		$user->majSalle($idSalle);
		$us=new Customer_Model_User();
		$user->find($member->cuu_id, $us);
		$this->view->myUser=$us;
		
		$this->view->salle=$nomSalle;
		$this->view->persoDansSalle=$persoDansSalle;
		$this->view->porteDansSalle=$porteDansSalle;
    }
	
	public function couloir4Action()
    {
		$this->_helper->layout->disableLayout();
		
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
		
		$persoCuisine=new Core_Model_Mapper_Personnage();
		$idSalle=16;
		$nomMusique_old=$persoCuisine->getMusiqueSalle();
		$nomMusique=$persoCuisine->getMusiqueSalle($idSalle);
		if($nomMusique_old!=$nomMusique){
			?><script>musicBox('<?php echo $nomMusique;?>')</script><?php
		}
		$nomSalle=$persoCuisine->getSalle($idSalle);
		$persoDansSalle=$persoCuisine->getPersonnages($idSalle);
		$porteDansSalle=$persoCuisine->getPortes($idSalle);
		
		// $this->view->InlineScript()->appendFile(URL_MAIN_ABS . 'js/paper-full.min.js', $type = 'text/javascript');
		
		$user=new Customer_Model_Mapper_User();
		$user->majSalle($idSalle);
		$us=new Customer_Model_User();
		$user->find($member->cuu_id, $us);
		$this->view->myUser=$us;
		
		$this->view->salle=$nomSalle;
		$this->view->persoDansSalle=$persoDansSalle;
		$this->view->porteDansSalle=$porteDansSalle;
    }
	
	public function siaynoqAction()
    {
		$this->_helper->layout->disableLayout();
		
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
		
		$persoCuisine=new Core_Model_Mapper_Personnage();
		$idSalle=35;
		$nomMusique_old=$persoCuisine->getMusiqueSalle();
		$nomMusique=$persoCuisine->getMusiqueSalle($idSalle);
		if($nomMusique_old!=$nomMusique){
			?><script>musicBox('<?php echo $nomMusique;?>')</script><?php
		}
		$nomSalle=$persoCuisine->getSalle($idSalle);
			
		$user=new Customer_Model_Mapper_User();
		$user->majSalle($idSalle);
		$us=new Customer_Model_User();
		$user->find($member->cuu_id, $us);
		$this->view->myUser=$us;
		
		$this->view->salle=$nomSalle;
    }
	
	public function communeAction()
    {
		$this->_helper->layout->disableLayout();
		
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
		
		$persoCuisine=new Core_Model_Mapper_Personnage();
		$idSalle=9;
		$nomMusique_old=$persoCuisine->getMusiqueSalle();
		$nomMusique=$persoCuisine->getMusiqueSalle($idSalle);
		if($nomMusique_old!=$nomMusique){
			?><script>musicBox('<?php echo $nomMusique;?>')</script><?php
		}
		$nomSalle=$persoCuisine->getSalle($idSalle);
		$persoDansSalle=$persoCuisine->getPersonnages($idSalle);
		$porteDansSalle=$persoCuisine->getPortes($idSalle);
		
		$mapQuote=new Core_Model_Mapper_Quote();
		$planeteGuilde=$mapQuote->getMajQuete(4,7,1);//si commandant a dit planète appartient à la guilde
		if($planeteGuilde)
			$persoCuisine->mouveSalle(23, $idSalle);
		
		$nop=0;
		$firstAc=$mapQuote->getMajQuete(1,2,0);
		$firstAc2=$mapQuote->getMajQuete(1,4,0);
		if(!$firstAc || !$firstAc2)
			$nop=1;
		$user=new Customer_Model_Mapper_User();
		$user->majSalle($idSalle);
		$us=new Customer_Model_User();
		$user->find($member->cuu_id, $us);
		$this->view->myUser=$us;
		
		$this->view->salle=$nomSalle;
		$this->view->nop=$nop;
		$this->view->persoDansSalle=$persoDansSalle;
		$this->view->porteDansSalle=$porteDansSalle;
    }
	
	public function bibliothequeAction()
    {
		$this->_helper->layout->disableLayout();
		
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
		
		$persoB=new Core_Model_Mapper_Personnage();
		
		$idSalle=12;
		$nomMusique_old=$persoB->getMusiqueSalle();
		$nomMusique=$persoB->getMusiqueSalle($idSalle); 
		if($nomMusique_old!=$nomMusique){
			?><script>musicBox('<?php echo $nomMusique;?>')</script><?php
		}
		$mapQuote=new Core_Model_Mapper_Quote();
		$mapgetbene=$mapQuote->getMajQuete(1,15,1);//si soeur_1 a donné rdv biblio
		$danseurVisageTrouve=$mapQuote->getMajQuete(1,17,0);
		if($mapgetbene)
			$persoB->mouveSalle(15, $idSalle);
		
		$nomSalle=$persoB->getSalle($idSalle);
		$persoDansSalle=$persoB->getPersonnages($idSalle);
		$porteDansSalle=$persoB->getPortes($idSalle);
			
		$user=new Customer_Model_Mapper_User();
		$user->majSalle($idSalle);
		$us=new Customer_Model_User();
		$user->find($member->cuu_id, $us);
		$this->view->myUser=$us;
		
		$renom=$us->getRenommee();
		if($danseurVisageTrouve && $renom >=500)
		$this->view->vol=1;
		$this->view->salle=$nomSalle;
		$this->view->persoDansSalle=$persoDansSalle;
		$this->view->porteDansSalle=$porteDansSalle;
    }
	
	public function barAction()
    {
		$this->_helper->layout->disableLayout();
		
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
		
		$persoCuisine=new Core_Model_Mapper_Personnage();
		$idSalle=13;
		$nomMusique_old=$persoCuisine->getMusiqueSalle();
		$nomMusique=$persoCuisine->getMusiqueSalle($idSalle); 
		if($nomMusique_old!=$nomMusique){
			?><script>musicBox('<?php echo $nomMusique;?>')</script><?php
		}
		$nomSalle=$persoCuisine->getSalle($idSalle);
		$persoDansSalle=$persoCuisine->getPersonnages($idSalle);
		$porteDansSalle=$persoCuisine->getPortes($idSalle);
			
		$user=new Customer_Model_Mapper_User();
		$user->majSalle($idSalle);
		$us=new Customer_Model_User();
		$user->find($member->cuu_id, $us);
		$this->view->myUser=$us;
		
		$quotes=new Core_Model_Mapper_Quote();
		$getMaj=$quotes->getMajQuete(1,17,0);
		if($getMaj)
		$this->view->pendu=1;
		$this->view->salle=$nomSalle;
		$this->view->persoDansSalle=$persoDansSalle;
		$this->view->porteDansSalle=$porteDansSalle;
    }
	
	public function barfondAction()
    {
		$this->_helper->layout->disableLayout();
		
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
		
		$persoCuisine=new Core_Model_Mapper_Personnage();
		$idSalle=21;
		$nomMusique_old=$persoCuisine->getMusiqueSalle();
		$nomMusique=$persoCuisine->getMusiqueSalle($idSalle); 
		if($nomMusique_old!=$nomMusique){
			?><script>musicBox('<?php echo $nomMusique;?>')</script><?php
		}
		$nomSalle=$persoCuisine->getSalle($idSalle);
			
		$user=new Customer_Model_Mapper_User();
		$user->majSalle($idSalle);
		$us=new Customer_Model_User();
		$user->find($member->cuu_id, $us);
		$this->view->myUser=$us;
		
		$this->view->salle=$nomSalle;
		$fum=Application_Common::getMajQueste(1, 17, 1);
		if(!$fum)
			$fum=Application_Common::getMajQueste(4, 17, 1);
		$this->view->fumee=$fum;
		
    }
	
	public function entreeAction()
    {
		$this->_helper->layout->disableLayout();
		
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
		
		$persoCuisine=new Core_Model_Mapper_Personnage();
		$idSalle=14;
		$nomMusique_old=$persoCuisine->getMusiqueSalle();
		$nomMusique=$persoCuisine->getMusiqueSalle($idSalle); 
		if($nomMusique_old!=$nomMusique){
			?><script>musicBox('<?php echo $nomMusique;?>')</script><?php
		}
		$nomSalle=$persoCuisine->getSalle($idSalle);
		$persoDansSalle=$persoCuisine->getPersonnages($idSalle);
		$porteDansSalle=$persoCuisine->getPortes($idSalle);
		$vol=Application_Common::getQuesteGlobal(2, 4);
		if($vol)
			$this->view->vol=1;
		else
			$this->view->vol=0;
		
		$user=new Customer_Model_Mapper_User();
		$user->majSalle($idSalle);
		$us=new Customer_Model_User();
		$user->find($member->cuu_id, $us);
		$this->view->myUser=$us;
		
		$this->view->salle=$nomSalle;
		$this->view->persoDansSalle=$persoDansSalle;
		$this->view->porteDansSalle=$porteDansSalle;
    }
	
	public function representantsAction()
    {
		$this->_helper->layout->disableLayout();
		
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
		
		$persoCuisine=new Core_Model_Mapper_Personnage();
		$idSalle=15;
		$nomMusique_old=$persoCuisine->getMusiqueSalle();
		$nomMusique=$persoCuisine->getMusiqueSalle($idSalle); 
		if($nomMusique_old!=$nomMusique){
			?><script>musicBox('<?php echo $nomMusique;?>')</script><?php
		}
		$nomSalle=$persoCuisine->getSalle($idSalle);
		$persoDansSalle=$persoCuisine->getPersonnages($idSalle);
		$porteDansSalle=$persoCuisine->getPortes($idSalle);
			
		$user=new Customer_Model_Mapper_User();
		$user->majSalle($idSalle);
		$us=new Customer_Model_User();
		$user->find($member->cuu_id, $us);
		$this->view->myUser=$us;
		
		$this->view->salle=$nomSalle;
		$this->view->persoDansSalle=$persoDansSalle;
		$this->view->porteDansSalle=$porteDansSalle;
    }
	
	public function verifimpotAction()
	{
		$this->_helper->layout->disableLayout();
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
		
		$persos=new Core_Model_Mapper_Personnage();
		$user=new Customer_Model_Mapper_User();
		$us=new Customer_Model_User();
		$user->find($member->cuu_id, $us);
		if($us->getImpot() >=5)$salle=1;else $salle=3;//si plus tard je veux changer, rendre dynamique avec appel bdd $salle
		// echo $salle;die();
		if($salle!=1){
			$persos->mouveSalle(5, 17);
			$persos->mouveSalle(6, 18);
			$persos->mouveSalle(7, 19);
			$persos->mouveSalle(8, 20);
		}else{
			$persos->mouveSalle(5, $salle);
			$persos->mouveSalle(6, $salle);
			$persos->mouveSalle(7, $salle);
			$persos->mouveSalle(8, $salle);
		}
	}
	
	public function chambre1Action()
    {
		$this->_helper->layout->disableLayout();
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
		$this->verifimpotAction();
		
		$persoCuisine=new Core_Model_Mapper_Personnage();
		$idSalle=17;
		$nomSalle=$persoCuisine->getSalle($idSalle);
		$persoDansSalle=$persoCuisine->getPersonnages($idSalle);
		$porteDansSalle=$persoCuisine->getPortes($idSalle);
			
		$user=new Customer_Model_Mapper_User();
		$user->majSalle($idSalle);
		$us=new Customer_Model_User();
		$user->find($member->cuu_id, $us);
		$this->view->myUser=$us;
		$this->view->salle=$nomSalle;
		$this->view->persoDansSalle=$persoDansSalle;
		$this->view->porteDansSalle=$porteDansSalle;
    }
	
	public function chambre2Action()
    {
		$this->_helper->layout->disableLayout();
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
		$this->verifimpotAction();
		
		$persoCuisine=new Core_Model_Mapper_Personnage();
		$idSalle=18;
		$nomSalle=$persoCuisine->getSalle($idSalle);
		$persoDansSalle=$persoCuisine->getPersonnages($idSalle);
		$porteDansSalle=$persoCuisine->getPortes($idSalle);
			
		$user=new Customer_Model_Mapper_User();
		$user->majSalle($idSalle);
		$us=new Customer_Model_User();
		$user->find($member->cuu_id, $us);
		$this->view->myUser=$us;
		
		$this->view->salle=$nomSalle;
		$this->view->persoDansSalle=$persoDansSalle;
		$this->view->porteDansSalle=$porteDansSalle;
    }
	
	public function chambre3Action()
    {
		$this->_helper->layout->disableLayout();
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
		$this->verifimpotAction();
		
		$persoCuisine=new Core_Model_Mapper_Personnage();
		$idSalle=19;
		$nomSalle=$persoCuisine->getSalle($idSalle);
		$persoDansSalle=$persoCuisine->getPersonnages($idSalle);
		$porteDansSalle=$persoCuisine->getPortes($idSalle);
			
		$user=new Customer_Model_Mapper_User();
		$user->majSalle($idSalle);
		$us=new Customer_Model_User();
		$user->find($member->cuu_id, $us);
		$this->view->myUser=$us;
		
		$this->view->salle=$nomSalle;
		$this->view->persoDansSalle=$persoDansSalle;
		$this->view->porteDansSalle=$porteDansSalle;
    }
	
	public function chambre4Action()
    {
		$this->_helper->layout->disableLayout();
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
		$this->verifimpotAction();
		
		$persoCuisine=new Core_Model_Mapper_Personnage();
		$idSalle=20;
		$nomSalle=$persoCuisine->getSalle($idSalle);
		$persoDansSalle=$persoCuisine->getPersonnages($idSalle);
		$porteDansSalle=$persoCuisine->getPortes($idSalle);
			
		$user=new Customer_Model_Mapper_User();
		$user->majSalle($idSalle);
		$us=new Customer_Model_User();
		$user->find($member->cuu_id, $us);
		$this->view->myUser=$us;
		
		$this->view->salle=$nomSalle;
		$this->view->persoDansSalle=$persoDansSalle;
		$this->view->porteDansSalle=$porteDansSalle;
    }
	
	public function magasinpalaisAction()
    {
		$this->_helper->layout->disableLayout();
		
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
		
		$persoCuisine=new Core_Model_Mapper_Personnage();
		$idSalle=10;
		$nomMusique_old=$persoCuisine->getMusiqueSalle();
		$nomMusique=$persoCuisine->getMusiqueSalle($idSalle);
		if($nomMusique_old!=$nomMusique){
			?><script>musicBox('<?php echo $nomMusique;?>')</script><?php
		}
		$nomSalle=$persoCuisine->getSalle($idSalle);
		$porteDansSalle=$persoCuisine->getPortes($idSalle);
			
		$user=new Customer_Model_Mapper_User();
		$user->majSalle($idSalle);
		$us=new Customer_Model_User();
		$user->find($member->cuu_id, $us);
		$this->view->myUser=$us;
		
		$this->view->salle=$nomSalle;
		$persoDansSalle=$persoCuisine->getPersonnages($idSalle);
		$this->view->persoDansSalle=$persoDansSalle;
		$this->view->porteDansSalle=$porteDansSalle;
		$tournevis=Application_Common::getMajQueste(9, 18, 1);
		$reacteur=Application_Common::getQuesteGlobal(21, 1);
		$boussole=Application_Common::getMajQueste(6, 16, 1);
		if(!$reacteur)$reacteur=0;else $reacteur=1;
		if(!$tournevis)$tournevis=0;else $tournevis=1;
		if(!$boussole)$boussole=1;else $boussole=0;
		$this->view->tournevis=$tournevis;
		$this->view->reacteur=$reacteur;
		$this->view->boussole=$boussole;
    }
	
	public function diplomateAction()
	{
		$this->_helper->layout->disableLayout();
		
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
		
		$persoDiplo=new Core_Model_Mapper_Personnage();
		$idSalle=7;
		$nomMusique_old=$persoDiplo->getMusiqueSalle();
		$nomMusique=$persoDiplo->getMusiqueSalle($idSalle);
		if($nomMusique_old!=$nomMusique){
			?><script>musicBox('<?php echo $nomMusique;?>')</script><?php
		}
		$nomSalle=$persoDiplo->getSalle($idSalle);
		
		$diplo=new Core_Model_Mapper_Carte();
		$debrief=$diplo->diplobriefing();
		
		$user=new Customer_Model_Mapper_User();
		$user->majSalle($idSalle);
		$us=new Customer_Model_User();
		$user->find($member->cuu_id, $us);
		$this->view->myUser=$us;
		$this->view->debrief=$debrief;
		
		$this->view->salle=$nomSalle;
	}
	
	public function hangarAction()
	{
		$this->_helper->layout->disableLayout();
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
		
		$persoDiplo=new Core_Model_Mapper_Personnage();
		$idSalle=6;
		$nomMusique_old=$persoDiplo->getMusiqueSalle();
		$nomMusique=$persoDiplo->getMusiqueSalle($idSalle);
		if($nomMusique_old!=$nomMusique){
			?><script>musicBox('<?php echo $nomMusique;?>')</script><?php
		}
		$nomSalle=$persoDiplo->getSalle($idSalle);
			
		$user=new Customer_Model_Mapper_User();
		$user->majSalle($idSalle);
		$us=new Customer_Model_User();
		$user->find($member->cuu_id, $us);
		$this->view->myUser=$us;
		
		$this->view->salle=$nomSalle;
		$indice=Application_Common::getMajQueste(4, 6, 1);
		if(!$indice)$indice=0;else $indice=1;
		$this->view->indice=$indice;
	}
	
	public function marchesAction()
	{
		$this->_helper->layout->disableLayout();
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
		
		$persoDiplo=new Core_Model_Mapper_Personnage();
		$idSalle=23;
		$nomMusique_old=$persoDiplo->getMusiqueSalle();
		$nomMusique=$persoDiplo->getMusiqueSalle($idSalle);
		if($nomMusique_old!=$nomMusique){
			?><script>musicBox('<?php echo $nomMusique;?>')</script><?php
		}
		$nomSalle=$persoDiplo->getSalle($idSalle);
		$persoDansSalle=$persoDiplo->getPersonnages($idSalle);
		$this->view->persoDansSalle=$persoDansSalle;
		
		$user=new Customer_Model_Mapper_User();
		$user->majSalle($idSalle);
		$us=new Customer_Model_User();
		$user->find($member->cuu_id, $us);
		$this->view->myUser=$us;
		
		$this->view->salle=$nomSalle;
		// $indice=Application_Common::getMajQueste(4, 6, 1);
		// if(!$indice)$indice=0;else $indice=1;
		// $this->view->indice=$indice;
	}
	
	public function village1Action()
	{
		$this->_helper->layout->disableLayout();
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
		
		$persoDiplo=new Core_Model_Mapper_Personnage();
		$idSalle=24;
		$nomMusique_old=$persoDiplo->getMusiqueSalle();
		$nomMusique=$persoDiplo->getMusiqueSalle($idSalle);
		if($nomMusique_old!=$nomMusique){
			?><script>musicBox('<?php echo $nomMusique;?>')</script><?php
		}
		$nomSalle=$persoDiplo->getSalle($idSalle);
			
		$user=new Customer_Model_Mapper_User();
		$user->majSalle($idSalle);
		$us=new Customer_Model_User();
		$user->find($member->cuu_id, $us);
		$this->view->myUser=$us;
		
		$this->view->salle=$nomSalle;
		// $indice=Application_Common::getMajQueste(4, 6, 1);
		// if(!$indice)$indice=0;else $indice=1;
		// $this->view->indice=$indice;
	}
	
	public function village2Action()
	{
		$this->_helper->layout->disableLayout();
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
		
		$persoDiplo=new Core_Model_Mapper_Personnage();
		$idSalle=25;
		$nomMusique_old=$persoDiplo->getMusiqueSalle();
		$nomMusique=$persoDiplo->getMusiqueSalle($idSalle);
		if($nomMusique_old!=$nomMusique){
			?><script>musicBox('<?php echo $nomMusique;?>')</script><?php
		}
		$nomSalle=$persoDiplo->getSalle($idSalle);
			
		$user=new Customer_Model_Mapper_User();
		$user->majSalle($idSalle);
		$us=new Customer_Model_User();
		$user->find($member->cuu_id, $us);
		$this->view->myUser=$us;
		
		$this->view->salle=$nomSalle;
		// $indice=Application_Common::getMajQueste(4, 6, 1);
		// if(!$indice)$indice=0;else $indice=1;
		// $this->view->indice=$indice;
	}
	
	public function village3Action()
	{
		$this->_helper->layout->disableLayout();
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
		
		$persoDiplo=new Core_Model_Mapper_Personnage();
		$idSalle=26;
		$nomMusique_old=$persoDiplo->getMusiqueSalle();
		$nomMusique=$persoDiplo->getMusiqueSalle($idSalle);
		if($nomMusique_old!=$nomMusique){
			?><script>musicBox('<?php echo $nomMusique;?>')</script><?php
		}
		$nomSalle=$persoDiplo->getSalle($idSalle);
		$mapQuote=new Core_Model_Mapper_Quote();
		// $planeteGuilde=$mapQuote->getMajQuete(1,24,1);//si contact recu par guilde
		// if($planeteGuilde)
			// $persoCuisine->mouveSalle(24, $idSalle);
		
		$persoDansSalle=$persoDiplo->getPersonnages($idSalle);
		$this->view->persoDansSalle=$persoDansSalle;
		$user=new Customer_Model_Mapper_User();
		$user->majSalle($idSalle);
		$us=new Customer_Model_User();
		$user->find($member->cuu_id, $us);
		$this->view->myUser=$us;
		
		$this->view->salle=$nomSalle;
		// $indice=Application_Common::getMajQueste(4, 6, 1);
		// if(!$indice)$indice=0;else $indice=1;
		// $this->view->indice=$indice;
	}
	
	public function village4Action()
	{
		$this->_helper->layout->disableLayout();
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
		$returnBoussole = $this->getRequest()->getParam('returnBoussole');
		
		
		$persoDiplo=new Core_Model_Mapper_Personnage();
		$idSalle=33;
		$nomMusique_old=$persoDiplo->getMusiqueSalle();
		$nomMusique=$persoDiplo->getMusiqueSalle($idSalle);
		if($nomMusique_old!=$nomMusique){
			?><script>musicBox('<?php echo $nomMusique;?>')</script><?php
		}
		$nomSalle=$persoDiplo->getSalle($idSalle);
		$traitr=Application_Common::getPerso(19);
		if($traitr['tarhani']['pers_salle']==27)
			$persoDiplo->mouveSalle(19, 99);
		$user=new Customer_Model_Mapper_User();
		$user->majSalle($idSalle);
		$us=new Customer_Model_User();
		$user->find($member->cuu_id, $us);
		if($returnBoussole)
			$user->majEntretien();
		
		if($us->getEntretien() != '0' && !$returnBoussole){
			$us->setSalle(28);
			$user->save($us);
			
			 ?>
			 <script>
			location.reload();
			var request = jQuery.ajax({
			url: url_site+'Core/index/desert2',
			type: "POST"							
			}); 
			request.done(function(msg) {			
				 jQuery("#inThePlace").html(msg);	
			});
			</script>
			 <?php
		}
		$persoDansSalle=$persoDiplo->getPersonnages($idSalle);
		$this->view->persoDansSalle=$persoDansSalle;
		$this->view->myUser=$us;
		$this->view->salle=$nomSalle;
		$distille=Application_Common::getObject(8);
		if($distille)$distille=1;else $distille=0;
		$this->view->distille=$distille;
		// if(!$indice)$indice=0;else $indice=1;
		// $this->view->indice=$indice;
	}
	
	public function desert1Action()
	{
		$this->_helper->layout->disableLayout();
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
		
		$persoDiplo=new Core_Model_Mapper_Personnage();
		$idSalle=27;

		$nomSalle=$persoDiplo->getSalle($idSalle);
			
		$user=new Customer_Model_Mapper_User();
		$user->majEntretien(1);
		$us=new Customer_Model_User();
		$user->find($member->cuu_id, $us);

		$nomMusique=$persoDiplo->getMusiqueSalle($idSalle);
		if($us->getEntretien()=='0,1'){
			?><script>musicBox('<?php echo $nomMusique;?>')</script><?php
		}
		
		
		$expl=$us->getEntretien();
		$traitr=Application_Common::getMajQueste(5, 6, 1);
		
		if($traitr && $expl=='0,2,2,3,2,2,1,1'){
		// if($traitr && $expl=='0,1'){
			$persoDiplo->mouveSalle(19, $idSalle);
			$traitr2=Application_Common::getMajQueste(1, 19, 1);
			if(!$traitr2)
				$traitr=Application_Common::majQueste(1, 19, 1);
		}
		
		$persoDansSalle=$persoDiplo->getPersonnages($idSalle);
		$this->view->persoDansSalle=$persoDansSalle;
		$this->view->myUser=$us;
		$this->view->salle=$nomSalle;
		// $indice=Application_Common::getMajQueste(4, 6, 1);
		// if(!$indice)$indice=0;else $indice=1;
		// $this->view->indice=$indice;
	}
	
	public function habitat1Action()
	{
		$this->_helper->layout->disableLayout();
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
		
		$persoDiplo=new Core_Model_Mapper_Personnage();
		$idSalle=34;
		$nomMusique_old=$persoDiplo->getMusiqueSalle();
		$nomMusique=$persoDiplo->getMusiqueSalle($idSalle);
		if($nomMusique_old!=$nomMusique){
			?><script>musicBox('<?php echo $nomMusique;?>')</script><?php
		}
		$nomSalle=$persoDiplo->getSalle($idSalle);
			
		$user=new Customer_Model_Mapper_User();
		$user->majSalle($idSalle);
		$us=new Customer_Model_User();
		$user->find($member->cuu_id, $us);
		
		$traitr=Application_Common::getMajQueste(5, 6, 1);
		// if($traitr && $expl=='0,2,2,3,2,2,1,1'){
			// $persoDiplo->mouveSalle(19, $idSalle);
			// $traitr2=Application_Common::getMajQueste(1, 19, 1);
			// if(!$traitr2)
				// $traitr=Application_Common::majQueste(1, 19, 1);
		// }
		$persoDansSalle=$persoDiplo->getPersonnages($idSalle);
		$this->view->persoDansSalle=$persoDansSalle;
		$this->view->myUser=$us;
		$this->view->salle=$nomSalle;
		// $indice=Application_Common::getMajQueste(4, 6, 1);
		// if(!$indice)$indice=0;else $indice=1;
		// $this->view->indice=$indice;
	}
	
	public function desert2Action()
	{
		$this->_helper->layout->disableLayout();
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
		
		$persoDiplo=new Core_Model_Mapper_Personnage();
		$idSalle=28;
		$user=new Customer_Model_Mapper_User();
		$user->majEntretien(2);
		$us=new Customer_Model_User();
		$user->find($member->cuu_id, $us);
		$nomMusique=$persoDiplo->getMusiqueSalle($idSalle);
		if($us->getEntretien()=='0,2'){
			?><script>musicBox('<?php echo $nomMusique;?>')</script><?php
		}
		$nomSalle=$persoDiplo->getSalle($idSalle);
			
		
		$siona=Application_Common::getMajQueste(2, 24, 1);
		$siona=1;
		
		$expl=$us->getEntretien();

		// if($siona && $expl=='0,2'){
		if($siona && $expl=='0,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2'){
			$persoDiplo->mouveSalle(25, $idSalle);
		}
		
		$persoDansSalle=$persoDiplo->getPersonnages($idSalle);
		$this->view->persoDansSalle=$persoDansSalle;
		$this->view->myUser=$us;
		$this->view->salle=$nomSalle;
		// $indice=Application_Common::getMajQueste(4, 6, 1);
		// if(!$indice)$indice=0;else $indice=1;
		// $this->view->indice=$indice;
	}
	
	public function desert3Action()
	{
		$this->_helper->layout->disableLayout();
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
		
		$persoDiplo=new Core_Model_Mapper_Personnage();
		$idSalle=29;
		$user=new Customer_Model_Mapper_User();
		$user->majEntretien(3);
		$us=new Customer_Model_User();
		$user->find($member->cuu_id, $us);
		$nomMusique=$persoDiplo->getMusiqueSalle($idSalle);
		if($us->getEntretien()=='0,3'){
			?><script>musicBox('<?php echo $nomMusique;?>')</script><?php
		}
		$nomSalle=$persoDiplo->getSalle($idSalle);
			
		
		
		$persoDansSalle=$persoDiplo->getPersonnages($idSalle);
		$this->view->persoDansSalle=$persoDansSalle;
		$this->view->myUser=$us;
		$this->view->salle=$nomSalle;
		// $indice=Application_Common::getMajQueste(4, 6, 1);
		// if(!$indice)$indice=0;else $indice=1;
		// $this->view->indice=$indice;
	}
	
	public function vaisseauxAction()
    {
		$this->_helper->layout->disableLayout();
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
		
		$persoVaisseau=new Core_Model_Mapper_Personnage();
		
		$idSalle=3;
		$nomMusique_old=$persoVaisseau->getMusiqueSalle();
		$nomMusique=$persoVaisseau->getMusiqueSalle($idSalle);
		if($nomMusique_old!=$nomMusique){
			?><script>musicBox('<?php echo $nomMusique;?>')</script><?php
		}
		$nomSalle=$persoVaisseau->getSalle($idSalle);
		$persoDansSalle=$persoVaisseau->getPersonnages($idSalle);
		$porteDansSalle=$persoVaisseau->getPortes($idSalle);
			
		$user=new Customer_Model_Mapper_User();
		$user->majSalle($idSalle);
		$us=new Customer_Model_User();
		$user->find($member->cuu_id, $us);
		$this->view->myUser=$us;
		
		$this->view->salle=$nomSalle;
		$this->view->persoDansSalle=$persoDansSalle;
		$this->view->porteDansSalle=$porteDansSalle;
    }
	
	public function carteAction()
    {
		$this->_helper->layout->disableLayout();
		$this->_auth = Zend_Auth::getInstance();
		$member = $this->_auth->getIdentity();
		$idUser=$member->cuu_id;
		$persoCarte=new Core_Model_Mapper_Personnage();
		$vaisseau=new Core_Model_Mapper_Carte();
		$idSalle=5;
		$nomMusique_old=$persoCarte->getMusiqueSalle();
		$nomMusique=$persoCarte->getMusiqueSalle($idSalle);
		if($nomMusique_old!=$nomMusique){
			?><script>musicBox('<?php echo $nomMusique;?>')</script><?php
		}
		$nomSalle=$persoCarte->getSalle($idSalle);
		$persoDansSalle=$persoCarte->getPersonnages($idSalle);
		
		$this->view->encoursExploration=$vaisseau->getActionVaisseau(4);//4==exploration
		$this->view->encoursAttaque=$vaisseau->getActionVaisseau(3);//3==attaque

		$myPlanetes=$vaisseau->getMyStars();
		$user=new Customer_Model_Mapper_User();
		$user->majSalle($idSalle);
		$us=new Customer_Model_User();
		$user->find($idUser, $us);
		$this->view->myUser=$us;
		
		$this->view->salle=$nomSalle;
		$this->view->persoDansSalle=$persoDansSalle;
		$this->view->myPlanetes=$myPlanetes;
    }
	
	public function cartezoom1dataAction()
    {
		$this->_helper->layout->disableLayout();
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
		$idUser=$member->cuu_id;
		
		$carte=new Core_Model_Mapper_Carte();
		$stars=$carte->getAllStar(1);
		
		$this->view->allStar=$stars;
	}
	
	public function cartezoom2dataAction()
    {
		$this->_helper->layout->disableLayout();
	}
	
	public function indiceAction()
    {
		$this->_helper->layout->disableLayout();
		$idSalle=22;		
		$Ind=new Core_Model_Mapper_Personnage();
		$nomSalle=$Ind->getSalle($idSalle);
		$this->_helper->layout->disableLayout();

		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
		$user=new Customer_Model_Mapper_User();
		$us=new Customer_Model_User();
		$user->find($member->cuu_id, $us);
		
		$salleU=$us->getSalle();
		$nomSalleU=$Ind->getSalle($salleU);
		
		$this->view->salle=$nomSalle;
		$this->view->nomSalleU=$nomSalleU;
	}
	public function journalAction()
    {
		$this->_helper->layout->disableLayout();
		$idSalle=36;		
		$Ind=new Core_Model_Mapper_Personnage();
		$nomSalle=$Ind->getSalle($idSalle);
		$this->_helper->layout->disableLayout();

		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
		$vaisseau=new Core_Model_Mapper_Carte();
		$user=new Customer_Model_Mapper_User();
		$us=new Customer_Model_User();
		$user->find($member->cuu_id, $us);
		
		
		$salleU=$us->getSalle();
		$nomSalleU=$Ind->getSalle($salleU);
		$getJournal=$us->getRapport();
		$this->view->myUser=$us;
		
		$this->view->salle=$nomSalle;
		$this->view->nomSalleU=$nomSalleU;
		$this->view->getJournal=$getJournal;
		
		$this->view->encoursExploration=$vaisseau->getActionVaisseau(4);//4==exploration
		$this->view->encoursAttaque=$vaisseau->getActionVaisseau(3);//3==attaque
		
		$myPlanetes=$vaisseau->getMyStars();
		$this->view->myPlanetes=$myPlanetes;
	}
	
	public function journaldeleteAction()
    {
		$user=new Customer_Model_Mapper_User();
		$us=new Customer_Model_User();
		$user->find($member->cuu_id, $us);
		$us->setRapport('');
		$user->save($us);
		die();
	}
	public function cartedataAction()
    {
		$this->_helper->layout->disableLayout();
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
		$idUser=$member->cuu_id;
		
		$carte=new Core_Model_Mapper_Carte();
		$allStar=$carte->getAllStar(0);
		$this->view->allStar=$allStar;
	}
	
	public function cartedataoneAction()
    {
		$this->_helper->layout->disableLayout();
		
		$idPlanete=$this->getRequest()->getParam('idPlanete');
		
		$carte=new Core_Model_Mapper_Carte();
		$myStar=$carte->getMyStar($idPlanete);
		$this->view->myStar=$myStar;
	}
	
	public function ajaxquoteAction()
    {
		$this->_helper->layout->disableLayout();
    }
	
	public function ajaxpayeAction()
    {
		$this->_helper->layout->disableLayout();
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
		
		$user=new Customer_Model_Mapper_User();
		$us=new Customer_Model_User();
		$user->find($member->cuu_id, $us);

		$arrSuggestion=$user->getSuggestionFaction();
		$arrInfluence=$user->getAllInfluence();
		$epiceVoulu1=array(20=>0, 40=>rand(100, 500), 60=>rand(500, 1000), 80=>rand(1000, 1500), 100=>rand(1500, 2000));
		$epiceVoulu2=array(20=>0, 40=>rand(100, 500), 60=>rand(500, 1000), 80=>rand(1000, 1500), 100=>rand(1500, 2000));
		$epiceVoulu3=array(20=>0, 40=>rand(100, 500), 60=>rand(500, 1000), 80=>rand(1000, 1500), 100=>rand(1500, 2000));
		$epiceVoulu4=array(20=>0, 40=>rand(100, 500), 60=>rand(500, 1000), 80=>rand(1000, 1500), 100=>rand(1500, 2000));
		$renommeeVoulu=array(20=>0, 40=>10, 60=>20, 80=>30, 100=>50);
		$corruptionVoulu=array(20=>50, 40=>0, 60=>0, 80=>0, 100=>0);
		$this->view->myEpice=$us->getEpice();
		$this->view->usCorr=$us->getCorruption();
		$this->view->epiceIx=$epiceVoulu1[$arrSuggestion[5]]-($$arrInfluence[5]*10);
		$this->view->epiceGuilde=$epiceVoulu2[$arrSuggestion[6]]-($$arrInfluence[6]*10);
		$this->view->epiceTleilax=$epiceVoulu3[$arrSuggestion[4]]-($$arrInfluence[4]*10);
		$this->view->epiceGuesserit=$epiceVoulu4[$arrSuggestion[3]]-($$arrInfluence[3]*10);
		$corrupTotal=$corruptionVoulu[$arrSuggestion[3]]+$corruptionVoulu[$arrSuggestion[4]]+$corruptionVoulu[$arrSuggestion[5]]+$corruptionVoulu[$arrSuggestion[6]];
		$this->view->corruptionVoulu=$corrupTotal;
		$this->view->renommeeGagnee=$renommeeVoulu[$arrSuggestion[3]]+$renommeeVoulu[$arrSuggestion[4]]+$renommeeVoulu[$arrSuggestion[5]]+$renommeeVoulu[$arrSuggestion[6]];
		$this->view->suggIx=$arrSuggestion[5];
		$this->view->suggGuilde=$arrSuggestion[6];
		$this->view->suggTleilax=$arrSuggestion[4];
		$this->view->suggGuesserit=$arrSuggestion[3];
		
		$language=new Zend_Session_Namespace('lang');
		if($language->lang=='en')
			$this->render('ajaxpaye-en');

		
	}
	
	public function tableaubordAction()
    {
		$this->_helper->layout->disableLayout();
		$user=new Customer_Model_Mapper_User();
		
		$this->view->iIx=$user->getInfluenceFaction(5);
		$this->view->sIx=$user->getServiteurFaction(5);
		$this->view->eIx=$user->getEscorteFaction(5);
		
		$this->view->iGu=$user->getInfluenceFaction(6);
		$this->view->sGu=$user->getServiteurFaction(6);
		$this->view->eGu=$user->getEscorteFaction(6);
		
		$this->view->iTl=$user->getInfluenceFaction(4);
		$this->view->sTl=$user->getServiteurFaction(4);
		$this->view->eTl=$user->getEscorteFaction(4);
		
		$this->view->iBe=$user->getInfluenceFaction(3);
		$this->view->sBe=$user->getServiteurFaction(3);
		$this->view->eBe=$user->getEscorteFaction(3);
		
		$this->view->inf=$user->getInfluenceFaction();
		$this->view->ser=$user->getServiteurFaction();
		$this->view->esc=$user->getEscorteFaction();
		
		$this->view->suggIx=$user->getSuggestionFaction(5);
		$this->view->suggGu=$user->getSuggestionFaction(6);
		$this->view->suggTl=$user->getSuggestionFaction(4);
		$this->view->suggBe=$user->getSuggestionFaction(3);
    }
	
	public function majheureAction()
	{
		$message='';
		$attentatNb=0;
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
        if ($member == null) {
            return;
        }
		$this->_helper->layout->disableLayout();
		
		$user=new Customer_Model_Mapper_User();
		$carte=new Core_Model_Mapper_Carte();
		
        $jours=$user->majHeure($this->getRequest()->getParam('cleHeure'), $this->getRequest()->getParam('heure'));
        $us=new Customer_Model_User();
        $persoHeure=new Core_Model_Mapper_Personnage();
		$user->find($member->cuu_id, $us); 
		$clsImg=$us->getImpot();if($clsImg>5)$clsImg=5;
		if(5-$clsImg==0)
			echo '<p>'.$jours.' jours <span title="Cérémonie du Partage imminente" class="delais_'.$clsImg.'"></span></p>:::'.$us->getEpice();
		else
			echo '<p>'.$jours.' jours <span title="Prochaine Cérémonie du Partage : '.(5-$clsImg).' jours" class="delais_'.$clsImg.'"></span></p>:::'.$us->getEpice();
		// echo '<p>'.$jours.' jours</p>:::'.$us->getEpice();

		if($us->getSoin()>=$us->getDelaiAttentat()){//si soin superieur ou egal a 2 jours : risque d'attentat
			$num=rand(0, 10);
			// $num=6;//fix
			if($num>5){
				$num=rand(0, $us->getNbVictime());
				$num=rand(1, 2);//fix
				$faction=rand(3, 6);
				// $faction=5;//fix
				if($num>0){
					if($user->getServiteurFaction($faction)!=0 || $user->getEscorteFaction($faction)!=0){
						$attentatNb=1;
						$user->majEscorte(-$num, $faction, 1);
						$factionName=$persoHeure->getFaction($faction);
						if($num==1)
							$phrase=' mort est à déplorer';
						else
							$phrase=' morts sont à déplorer';
						$message='<tr><td>Un attentat a été commis sur la maison '.$factionName.'. '.$num.$phrase.'</td></tr>';
					}
				}
				$us->setSoin(0);
				$user->save($us);
			}
			
		}elseif($us->getSoin()==1 && $this->getRequest()->getParam('cleHeure')==0){
				////////////attaque carte
				$zo=rand(0,1);
				$plan=$carte->getAllStar($zo);
				$nb=rand(0, count($plan)-1);
				$myS=$carte->getMyStar($plan[$nb]->ca_id);
				if(isset($myS->cau_etat) && $myS->cau_etat==1){
					$troupes=$myS->cau_troupe;
					$pirates=rand(25, 250);
					$res=$troupes-$pirates;
					if($res<0)$res=0;
					if($res==0){
						$carte->deletePlanete($myS->ca_id);
						$message.='<tr><td>La planète '.$myS->ca_nom.' a été attaquée par '.$pirates.' pirates. Nous avons perdu la planète</td></tr>';
					}else{
						$carte->setTroupes($myS->ca_id, $res);
						$message.='<tr><td>La planète '.$myS->ca_nom.' a été attaquée par '.$pirates.' pirates. Nous avons gagné la bataille</td></tr>';
					}
				}
			////////////fin attaque carte
		}
			
			if($message!=''){
				?><script>recompenseDisplay('<?php echo $message;?>');if(<?php echo $attentatNb;?>==1)afficheGraphe();</script><?php
			}
		die();
	}
	
	public function suppressionAction()
    {
     
		$membre=new Zend_Session_Namespace('user');
        if($membre->userInfo==null)
		$this->_redirect( URL_MAIN_ABS .'Customer/auth/customer', array( 'exit' => true, 'code'=> 301) );
		
		$suppr = $this->getRequest()->getParam('suppr');
		$validator  = new Zend_Validate();
        $validator  ->addValidator( new Zend_Validate_Int() );
        
		if(!$validator->isValid($suppr))
			throw new Zend_Controller_Action_Exception('L\'evenement n\'existe pas.', 404);
		
		$attaques=new Attaque_Model_Mapper_Journal();
		$attaques->suppression($suppr);
		$this->_redirect( URL_MAIN_ABS .'Core/index/jounal', array( 'exit' => true, 'code'=> 301) );

    }

}