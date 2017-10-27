<?php

class Application_Controller_Plugin_InforessourcesUser extends Zend_Controller_Plugin_Abstract
{    
    
    public function dispatchLoopStartup(Zend_Controller_Request_Abstract $request)
    {
        $time_actuel=time();
		$multi_or_magie=1;
		$multi_bois_magie=1;
		$multi_population_magie=1;
		$multi_mana_magie=1;
        $this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
        if ($member == null) {
            return;
        };               
        $user=new Customer_Model_Mapper_User();
        $us=new Customer_Model_User();
        $user->find($member->cuu_id, $us);
        
        $magieUser=new Produit_Model_Mapper_UserMagie();
        $maUs=new Produit_Model_UserMagie();
        $magieEnCours=$magieUser->findEnCours($member->cuu_id);
        if(count($magieEnCours)!=0)
		{
			foreach($magieEnCours as $mg)
			{
				$multi_or_magie*=$mg['pm_multi_or'];
				$multi_bois_magie*=$mg['pm_multi_bois'];
				$multi_population_magie*=$mg['pm_multi_population'];
				$multi_mana_magie*=$mg['pm_multi_mana'];
			}

		}
       
        $nbrsecnncompte=$us->getnbrhrnoncompte();

        $lastConnectTime = $us->getLastconnect();
        if($lastConnectTime <= 0 )
        $lastConnectTime = $time_actuel;
        $tempspasse= $time_actuel - $lastConnectTime;
        $nbMin=floor(($tempspasse + $nbrsecnncompte)/60);
        
        $resultor=$nbMin* $us->getTauxOr()*$multi_or_magie;  

        $resultbois=$nbMin* $us->getTauxBois()*$multi_bois_magie;          
 
        $resultpopulation=$nbMin* $us->getTauxPopulation()*$multi_population_magie;         
 
        $resultmana=$nbMin* $us->getTauxMana()*$multi_mana_magie;        

        
        $nbrsecnoused = (($tempspasse + $nbrsecnncompte)/60)-$nbMin;
        $nbrsecnoused *= 60;
        $us->setnbrhrnoncompte($nbrsecnoused);

        $us->setOr($us->getOr()+$resultor);
        $us->setBois($us->getBois()+$resultbois);
        $us->setPopulation($us->getPopulation()+$resultpopulation);
        $us->setMana($us->getMana()+$resultmana);
        
        $data=array(
            'cuu_or'=>$us->getOr(),
            'cuu_bois'=>$us->getBois(),
            'cuu_population'=>$us->getPopulation(),
            'cuu_mana'=>$us->getMana(),
            'cuu_lastconnect'=>$time_actuel,
            'cuu_nbrhrnoncompte'=>$us->getnbrhrnoncompte()
        );
        
        $user->getDbTable()->update($data, 
                array('cuu_id  = ?' => $member->cuu_id));
                
        $membre=new Zend_Session_Namespace('user');
        $membre->userInfo=$us;
        $magieEnCoursSession=new Zend_Session_Namespace('magieEnCours');
        $magieEnCoursSession->magieEnCours=$magieEnCours;
    }
    
}