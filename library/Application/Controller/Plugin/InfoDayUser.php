<?php

class Application_Controller_Plugin_InfoDayUser extends Zend_Controller_Plugin_Abstract
{    
    
    public function dispatchLoopStartup(Zend_Controller_Request_Abstract $request)
    {
        $time_actuel=time();
		
        $this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
        if ($member == null) {
            return;
        };   
		
        $us=new Customer_Model_User();
        $user=new Customer_Model_Mapper_User();
        $user->find($member->cuu_id, $us);
        
    
        $membre=new Zend_Session_Namespace('user');
        $membre->userInfo=$us;
		$this->_view->member=$membre;
		
		$perso=new Core_Model_Mapper_Personnage();
		$objects=$perso->getAllObjet();
		$objets=new Zend_Session_Namespace('objets');
		$objets->objets=$objects;
       
    }
    
}