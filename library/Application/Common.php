<?php

 class Application_Common
 {
		public static function addSystemError($message)
        {
            $messages = new Zend_Session_Namespace('messages');
            if ( !is_array( $messages->error ) ) {
                $messages->error = array();
            }
            $messages->error[] = $message;
        }
        
        
        public static function addSystemSucces($message)
        {
            $messages = new Zend_Session_Namespace('messages');
            if ( !is_array( $messages->success ) ) {
                $messages->success = array();
            }
            $messages->success[] = $message;
        }
		
		public static function getHour($debutHeure)
		{
			if($debutHeure >=0 &&  $debutHeure<12)
				return '06h00';
			if($debutHeure >=12 &&  $debutHeure<23)
				return '10h00';
			if($debutHeure >=23 &&  $debutHeure<45)
				return '12h00';
			if($debutHeure >=45 &&  $debutHeure<56)
				return '12h30';
			if($debutHeure >=56 &&  $debutHeure<67)
				return '16h00';
			if($debutHeure >=67 &&  $debutHeure<78)
				return '18h00';
			if($debutHeure >=78 &&  $debutHeure<89)
				return '20h00';
			if($debutHeure >=89 &&  $debutHeure<99)
				return '00h00';
		}
		
		public static function deleteobject($idObjet, $display=null)
		{
			$map=new Core_Model_Mapper_Personnage();
			$map->supprObjet(0, $idObjet);
		}
		
		public static function addDay()
		{	
			$membre=new Zend_Session_Namespace('user');
			$idUser=$membre->userInfo->getId();
			$user=new Customer_Model_Mapper_User();
			$user->addDay();
		}

		public static function setobject($idObjet, $display=null)
		{
			$map=new Core_Model_Mapper_Personnage();
			$map->addObjet($idObjet);
			if(!$display){
				echo "<script>recompenseDisplay('<tr><td>Vous avez reçu un objet</td></tr>');</script>";
				echo "<script>afficheObject();</script>";
			}
		}
		
		public static function majQueste($idQuest, $idPerso, $idExt)
		{
			$quote=new Core_Model_Mapper_Quote();
			$quote->majQuete($idQuest, $idPerso, $idExt);
		}
		
		public static function moveSalle($idPerso, $idSalle)
		{
			$map=new Core_Model_Mapper_Personnage();
			$map->mouveSalle($idPerso, $idSalle);
		}
		
		public static function getObject($idObj)
		{
			$perso=new Core_Model_Mapper_Personnage();
			return $myObj=$perso->getObjet($idObj);
		}
		
		public static function getMajQueste($idQ, $idP, $idE)
		{
			$quotes=new Core_Model_Mapper_Quote();
			return $getMaj=$quotes->getMajQuete($idQ,$idP,$idE);
		}
		public static function getQuesteGlobal($idP, $idE)
		{
			$quotes=new Core_Model_Mapper_Quote();
			return $getMaj=$quotes->getQuesteGlobal($idP,$idE);
		}
		
		public static function majPortes($idP, $etat)
		{
			$squotes=new Core_Model_Mapper_Personnage();
			$squotes->majPorte($idP, $etat);
		}
		
		public static function getSugFaction($idF)
		{
			$us=new Customer_Model_Mapper_User();
			return $us->getSuggestionFaction($idF);
		}
		
		public static function getHeure()
		{
			$membre=new Zend_Session_Namespace('user');
			$idUser=$membre->userInfo->getId();
			$user=new Customer_Model_Mapper_User();
			$us=new Customer_Model_User();
			$user->find($idUser, $us);
			return $us->getHeure();
		}
		
		public static function getRenommee()
		{
			$membre=new Zend_Session_Namespace('user');
			$idUser=$membre->userInfo->getId();
			$user=new Customer_Model_Mapper_User();
			$us=new Customer_Model_User();
			$user->find($idUser, $us);
			return $us->getRenommee();
		}
		
		public static function getMyStarOne()
		{
			$carte=new Core_Model_Mapper_Carte();
			return $carte->getMyStarsStatutOne();
		}
		
		public static function getSalle()
		{
			$membre=new Zend_Session_Namespace('user');
			$idUser=$membre->userInfo->getId();
			$user=new Customer_Model_Mapper_User();
			$us=new Customer_Model_User();
			$user->find($idUser, $us);
			return $us->getSalle();
		}
		
		public static function setArret($idExt, $idMoneo=0)//pour mettre une quote de moneo, par exemple en arret comme dans le fremen de musée
		{
			$quote=new Core_Model_Mapper_Quote();
			$quote->setArret($idExt, $idMoneo);
		}
		
		public function diplomates()
		{
			$diplo=new Core_Model_Mapper_Carte();
			return $debrief=$diplo->diplobriefing();
		}
		
		public function setdiplomateNull($idPlanete, $cau_etat)
		{
			$diplo=new Core_Model_Mapper_Carte();
			$diplo->setdiplomateNull($idPlanete, $cau_etat);
		}
		public function setEpices($spice, $display=null)
		{
			$membre=new Zend_Session_Namespace('user');
			$idUser=$membre->userInfo->getId();
			$user=new Customer_Model_Mapper_User();
			$us=new Customer_Model_User();
			$user->find($idUser, $us);
			if($spice=='-half')$spice=-(round($us->getEpice()/2));
			if($spice=='half')$spice=(round($us->getEpice()/2));
			$us->setEpice($us->getEpice()+$spice);
			$user->save($us);
			if($spice>=0)$word='reçu';else $word='dépensé';
			if(!$display)
				echo "<script>recompenseDisplay('<tr><td>Total épice $word : $spice</td></tr>');</script>";
			echo "<script>afficheSpice();</script>";
		}
		public function setValeurVaisseau($spice)
		{
			$membre=new Zend_Session_Namespace('user');
			$idUser=$membre->userInfo->getId();
			$user=new Customer_Model_Mapper_User();
			$us=new Customer_Model_User();
			$user->find($idUser, $us);
			$us->setValeurVaisseau($spice);
			$user->save($us);
		}
		public function setTroupes($troupe)
		{
			$membre=new Zend_Session_Namespace('user');
			$idUser=$membre->userInfo->getId();
			$user=new Customer_Model_Mapper_User();
			$us=new Customer_Model_User();
			$user->find($idUser, $us);
			$us->setTroupe($us->getTroupe()+$troupe);
			$user->save($us);
		}
		
		public function setZeroCorruption()
		{
			$membre=new Zend_Session_Namespace('user');
			$idUser=$membre->userInfo->getId();
			$user=new Customer_Model_Mapper_User();
			$us=new Customer_Model_User();
			$user->find($idUser, $us);
			$us->setCorruption(0);
			$user->save($us);
		}
		
		public function setInfluence($nb=1, $display=null, $house=null)
		{
			$membre=new Zend_Session_Namespace('user');
			$idUser=$membre->userInfo->getId();
			$user=new Customer_Model_Mapper_User();
			$us=new Customer_Model_User();
			$user->find($idUser, $us);
			if($us->getInfluence()+$nb<0)$set=0;else $set=$us->getInfluence()+$nb;
			$us->setInfluence($set);
			$user->save($us);
			if(!$display)
				echo "<script>recompenseDisplay('<tr><td>Total influence reçu : $nb</td></tr>');</script>";
		}
		
		public function getPerso($idP)
		{
			$membre=new Zend_Session_Namespace('user');
			$idUser=$membre->userInfo->getId();
			$perso=new Core_Model_Mapper_Personnage();
			return $perso->getPersonnage($idP);
		}
		
		public function allDiplo($id=0)
		{
			$diplo=new Core_Model_Mapper_Carte();
			$diplo->allDiplo($id);
		}
		
		public function setCorruption($nb=1, $display=null)
		{
			$membre=new Zend_Session_Namespace('user');
			$idUser=$membre->userInfo->getId();
			$user=new Customer_Model_Mapper_User();
			$us=new Customer_Model_User();
			$user->find($idUser, $us);
			$set=$us->getCorruption()+$nb;
			$us->setInfluence($set);
			$user->save($us);
			if(!$display)
				echo "<script>recompenseDisplay('<tr><td>Votre corruption augmente</td></tr>');</script>";
		}
		
		public function getHumeurByFaction($idF)
		{
			$persos=new Customer_Model_Mapper_User();
			return $nbInfluence=$persos->getHumeurFaction($idF);
		}
		
		public function setServiteur($nb=1, $display=null, $house=null)
		{
			$membre=new Zend_Session_Namespace('user');
			$idUser=$membre->userInfo->getId();
			$user=new Customer_Model_Mapper_User();
			$us=new Customer_Model_User();
			$user->find($idUser, $us);
			if($us->getServiteur()+$nb<0)$set=0;else $set=$us->getServiteur()+$nb;
			$us->setServiteur($set);
			$user->save($us);
			if(!$display)
				echo "<script>recompenseDisplay('<tr><td>Total Serviteurs reçu : $nb</td></tr>');</script>";
		}
		
		public function setServiteurHouse($nb, $house)
		{
			$membre=new Zend_Session_Namespace('user');
			$idUser=$membre->userInfo->getId();
			$user=new Customer_Model_Mapper_User();
			$us=new Customer_Model_User();
			$user->majServiteur($nb, $house);
		}
		
		public function explore($nb=1)
		{
			$diplo=new Core_Model_Mapper_Carte();
			$diplo->explore($nb);
		}
		
		public function getMyStar($nb)
		{
			$diplo=new Core_Model_Mapper_Carte();
			$myStar=$diplo->getMyStar($nb);
			if(!isset($myStar->cau_id)  || $myStar->cau_etat != 1)return false;else return true;
		}
		
		public function displayRecompense($msg){
			echo "<script>recompenseDisplay('$msg');</script>";
		}
		
  }