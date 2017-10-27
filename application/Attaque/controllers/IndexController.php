<?php

class Attaque_IndexController extends Application_Controller_Action
{
  
	function indexAction()
	{
		
	}

	public function assautAction()
	{
		$foisAttaque=5;
		$somme=0;
		$victoireAttaque=5;
		
		$membre=new Zend_Session_Namespace('user');
        if($membre->userInfo==null)
		$this->_redirect( URL_MAIN_ABS .'Customer/auth/customer', array( 'exit' => true, 'code'=> 301) );
		$arrayUnit=array();
		$hidunit = $this->getRequest()->getParam('hidunit');
		$userId = $this->getRequest()->getParam('pa_id');
		$validator  = new Zend_Validate();
        $validator  ->addValidator( new Zend_Validate_Int() );
		if(!$validator->isValid($hidunit) || $hidunit <0 || !$validator->isValid($userId) || $userId < 0 ){
                Application_Common::addSystemError('L\'unite n\'existe pas.');
				$this->_redirect( URL_MAIN_ABS . 'Attaque/index/alluser' , array( 'exit' => true, 'code'=> 301) );
        }
		for($i=0;$i<$hidunit;$i++){
			if(!$validator->isValid($this->getRequest()->getParam('assaut'.$i)) ||
				$this->getRequest()->getParam('assaut'.$i) < 0 ||
				$this->getRequest()->getParam('id'.$i) < 0 ||
			   !$validator->isValid($this->getRequest()->getParam('id'.$i)) || $this->getRequest()->getParam('id'.$i) < 0){
				Application_Common::addSystemError('L\'unite n\'existe pas.');
				$this->_redirect( URL_MAIN_ABS . 'Attaque/index/alluser' , array( 'exit' => true, 'code'=> 301) );
			}
			$arrayUnit[$this->getRequest()->getParam('id'.$i)]= $this->getRequest()->getParam('assaut'.$i) ;
			$somme+=$this->getRequest()->getParam('assaut'.$i);
		}
		$false=0;
		if($somme==0)
		{	
			$message='vous devez envoyer des troupes a la guerre pour monter a l\'assaut';
			$false=1;
		}
		
		$infoEnn=new Customer_Model_Mapper_User();
		$modelUser=new Customer_Model_User();
		$infoEnn->find($userId, $modelUser);
		//print_r($modelUserEnnemi);die();
		$journals=new Attaque_Model_Mapper_Journal();
		$journal=new Attaque_Model_Journal();
		$attaque=$journals->fetchAllbyUser($modelUser->getId(), 'verif');
		
		if(array_key_exists($modelUser->getId(),$attaque) && $attaque[$modelUser->getId()]>$foisAttaque)
		{
			$message='vous ne pouvez pas attaquer le meme joueur plus de '.$foisAttaque.' fois par jour';
			$false=1;	
		}
		
	    if($membre->userInfo->getId()==$userId)
		{	
			$message='faire le con nuit gravement a la santé de son entourage.';
			$false=1;
		}
   //     echo $membre->userInfo->getVictoire();
		if($membre->userInfo->getVictoire()-$modelUser->getVictoire() > 500)
		{	
			$message='vous ne pouvez pas vous en prendre a un joueur ayant moins de 500 points de victoire que vous';
			$false=1;	
		}
		
		if($false==1)
		{
			Application_Common::addSystemError($message);
			$this->_redirect( URL_MAIN_ABS . 'Attaque/index/alluser' , array( 'exit' => true, 'code'=> 301) );
		}
		$usersunits=new Produit_Model_Mapper_UserUnite();
		$batiments= new Produit_Model_Mapper_UserBatiment();
		$userMagies=new Produit_Model_Mapper_UserMagie();
		$usermagieEnnemi=$userMagies->findEnCours($userId);
		$myBatiment=$batiments->fetchAllbyUser($membre->userInfo->getId());

		$ennemyBatiment=$batiments->fetchAllbyUser($userId);
		$unitEnnemi=$usersunits->fetchAllbyUser($userId);
		if(($uniteGuerre=$usersunits->fetchAllbyUser($membre->userInfo->getId(), $arrayUnit))==false)
		$this->_redirect( URL_MAIN_ABS . 'Produit/index/index' , array( 'exit' => true, 'code'=> 301) );
		$magieEnCoursSession=new Zend_Session_Namespace('magieEnCours');
		
		//constatations de la bataille
		
		
		$myAttaque=0;
		$myDefense=0;
		$myMagie=0;
		$myPillage=0;
        $myUnit=0;
		foreach($uniteGuerre as $result){
                    $myUnit+=$result['uu_quantite'];
					$defenseUnite=$result['uu_quantite']*$result['pu_defense'];
					$attaqueUnite=$result['uu_quantite']*$result['pu_attaque'];
					$magieUnite=$result['uu_quantite']*$result['pu_magie'];
					$pillageUnite=$result['uu_quantite']*$result['pu_pillage'];
					$myAttaque+=$attaqueUnite;
					$myDefense+=$defenseUnite;
					$myMagie+=$magieUnite;
					$myPillage+=$pillageUnite;
				   
				}
				
		foreach($myBatiment as $result){
				
					$defenseBatiment=$result['ub_quantite']*$result['pb_defense'];
					$attaqueBatiment=$result['ub_quantite']*$result['pb_attaque'];
					$magieBatiment=$result['ub_quantite']*$result['pb_magie'];
					$pillageBatiment=$result['ub_quantite']*$result['pb_pillage'];
					$myAttaque+=$attaqueBatiment;
					$myDefense+=$defenseBatiment;
					$myMagie+=$magieBatiment;
					$myPillage+=$pillageBatiment;
				}		
				
		foreach($magieEnCoursSession->magieEnCours as $result){
			$myPillage*=$result['pm_multi_pillage'];
		}
				
				
		$hisAttaque=0;
		$hisDefense=0;
		$hisMagie=0;
		$hisPillage=0;
        $quantiteEnnemy=0;
		foreach($unitEnnemi as $result){
                    $quantiteEnnemy+=$result['uu_quantite'];
					$defenseUnite=$result['uu_quantite']*$result['pu_defense'];
					$attaqueUnite=$result['uu_quantite']*$result['pu_attaque'];
					$magieUnite=$result['uu_quantite']*$result['pu_magie'];
					$pillageUnite=$result['uu_quantite']*$result['pu_pillage'];
					$hisAttaque+=$attaqueUnite;
					$hisDefense+=$defenseUnite;
					$hisMagie+=$magieUnite;
					$hisPillage+=$pillageUnite;
				   
				}
				
		foreach($ennemyBatiment as $result){
				
					$defenseBatiment=$result['ub_quantite']*$result['pb_defense'];
					$attaqueBatiment=$result['ub_quantite']*$result['pb_attaque'];
					$magieBatiment=$result['ub_quantite']*$result['pb_magie'];
					$pillageBatiment=$result['ub_quantite']*$result['pb_pillage'];
					$hisAttaque+=$attaqueBatiment;
					$hisDefense+=$defenseBatiment;
					$hisMagie+=$magieBatiment;
					$hisPillage+=$pillageBatiment;
				}		
				
		foreach($usermagieEnnemi as $result){
			$hisPillage*=$result['pm_multi_pillage'];
		}

	if($hisDefense==$myAttaque)
	$hisDefense+=1;
    
    $this->view->uniteDefensePerdu=$usersunits->destruct($unitEnnemi,$myAttaque-$hisDefense, $myMagie-$hisMagie);
	$this->view->uniteAttaquePerdu=$usersunits->destruct($uniteGuerre, $hisDefense-$myAttaque, $hisMagie-$myMagie);
	$this->view->myMagie=$myMagie;
	$this->view->hisMagie=$hisMagie;
	
	$datefin=date('d/m/Y');
	$dfin = explode("/", $datefin); 
	$finab = $dfin[2].$dfin[1].$dfin[0];
	$this->view->attaque=$myAttaque;
	$this->view->defense=$hisDefense;
		//victoire de l'agresseur
		if($hisDefense < $myAttaque)
		{
			$pillage=$infoEnn->pill($modelUser, $myPillage, $membre->userInfo);
			$batiments->destruct($userId);
			$infoEnn->victory($membre->userInfo, $victoireAttaque);
			
			$journal->setIdAttaque($membre->userInfo->getId());
			$journal->setIdVictoire($modelUser->getId());
			$journal->setPseudoAttaque($membre->userInfo->getLogin());
			$journal->setPseudoDefense($modelUser->getLogin());
			$journal->setIdDefense($membre->userInfo->getId());
			$journal->setOrPille($pillage['or']);
			$journal->setBoisPille($pillage['bois']);
			$journal->setManaPille($pillage['mana']);
			$journal->setPopulationPille($pillage['population']);
			$journal->setDate($finab);
			$journals->save($journal);
			
			// $this->_helper->viewRenderer->setScriptAction('victoire.phtml');
		}
		else
		{
			$journal->setIdAttaque($membre->userInfo->getId());
			$journal->setIdVictoire($membre->userInfo->getId());
			$journal->setIdDefense($membre->userInfo->getId());
			$journal->setPseudoAttaque($membre->userInfo->getLogin());
			$journal->setPseudoDefense($modelUser->getLogin());
			$journal->setOrPille($pillage['or']);
			$journal->setBoisPille($pillage['bois']);
			$journal->setManaPille($pillage['mana']);
			$journal->setPopulationPille($pillage['population']);
			$journal->setDate($finab);
			$journals->save($journal);
		}
		
	}
    public function userattaqueAction()
    {
    
        $membre=new Zend_Session_Namespace('user');
        if($membre->userInfo==null)
		$this->_redirect( URL_MAIN_ABS .'Customer/auth/customer', array( 'exit' => true, 'code'=> 301) );
        
        $users=new Customer_Model_Mapper_User();
        $user= new Customer_Model_User();
		$unite= new Produit_Model_Mapper_UserUnite();
        $batiments= new Produit_Model_Mapper_UserBatiment();
		$batiment=$batiments->fetchAllbyUser($membre->userInfo->getId());
		
		
        $userMagies=new Produit_Model_Mapper_UserMagie();

        $userId = $this->getRequest()->getParam('pa_id');
		$validator  = new Zend_Validate();
        // Chainage du validator
        $validator  ->addValidator( new Zend_Validate_Int() );
        
		if(!$validator->isValid($userId))
			throw new Zend_Controller_Action_Exception('Le joueur n\'existe pas.', 404);
        $users->find($userId, $user);
        $usermagieEnnemi=$userMagies->findEnCours($userId);
		$myunite=$unite->fetchAllbyUser($membre->userInfo->getId());
		
        
        $this->view->userId=$user;
        $this->view->myId=$membre->userInfo;
        $magieEnCoursSession=new Zend_Session_Namespace('magieEnCours');
        $this->view->magieEnCours=$magieEnCoursSession->magieEnCours;
		$this->view->magieEnCoursEnnemy=$usermagieEnnemi;
		$this->view->myUnite=$myunite;
        $this->view->myBatiment=$batiment;
        
    }
    public function alluserAction()
    {
     
        $cache_id    =md5('attaque_index_listeUser');
        if (!($pageData = $this->getCache()->load($cache_id)) ) {
            $users=new Customer_Model_Mapper_User();
            $pageData=$users->fetchAll();
            Zend_Registry::get('cache')->save( $pageData );
        } 
        
		if(!$pageData)
			throw new Zend_Controller_Action_Exception('La page n\'a pas été trouvée.', 404);
		
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('pagination.phtml');
		$paginator     = Zend_Paginator::factory($pageData);
        $paginator -> setPageRange(5);
        $paginator -> setCurrentPageNumber($this->_getParam('page', 1));
        $paginator -> setItemCountPerPage($this->_getParam('par', 1));
        $this->view-> paginatedUser= $paginator;
    }

}