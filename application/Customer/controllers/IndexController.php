<?php

class Customer_IndexController extends Application_Controller_Action
{
  
	function indexAction()
	{
		$this->_redirect( URL_MAIN_ABS . 'Customer/auth/customer' , array( 'exit' => true, 'code'=> 301) );
	}
   
    function infouserAction()
    {
       /*$membre=new Zend_Session_Namespace('user');
        if($membre->userInfo==null)
		$this->_redirect( URL_MAIN_ABS .'Customer/auth/customer', array( 'exit' => true, 'code'=> 301) );*/
    }
    
    public function infohumeurAction()
    {
       $membre=new Zend_Session_Namespace('user');
       if($membre->userInfo!=null){
		$ajax	=	$this->getRequest()->getParam('ajax');
		if($ajax)
			$this->_helper->layout->disableLayout();
		$this->view->infouser=$membre->userInfo;
		$user=new Customer_Model_Mapper_User();
		$this->view->humeurs=$user->getHumeurFaction();
       }
       else
       $this->_helper->viewRenderer->setScriptAction('infousernonconnect');
    }
	
	public function inforessourcesuserAction()
	{
		$membre=new Zend_Session_Namespace('user');
		$ajax	=	$this->getRequest()->getParam('ajax');
		if($ajax)
			$this->_helper->layout->disableLayout();
		if($membre->userInfo!=null){
			$us=new Customer_Model_User();
			$user=new Customer_Model_Mapper_User();
			$user->find($membre->userInfo->getId(), $us);
			$this->view->user=$us;
       }
       else
       $this->_helper->viewRenderer->setScriptAction('infousernonconnect');
	}
	
	public function joursAction()
    {
		// echo Application_Common::GetHour(57).'eeee';
		$membre=new Zend_Session_Namespace('user');
		if($membre->userInfo!=null){
			$this->view->infouser=$membre->userInfo;
		}
		else
			$this->_helper->viewRenderer->setScriptAction('infousernonconnect');
    }

   public function commentjouerAction()
    {
		$lang=$this->getRequest()->getParam('lang');
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
		$user=new Customer_Model_Mapper_User();
		$us=new Customer_Model_User();
		$user->find($member->cuu_id, $us);
		$persos=new Core_Model_Mapper_Personnage();
		
		$this->view->form ='';
		
		$nomSalle=$persos->getSalle($us->getSalle());
		$this->view->nomSalle=$nomSalle;
		$this->view->myUser=$us;
		$this->_helper->layout()->user=$us;
		if($lang=='en')
			$this->render('commentjouer-en');
    }
   public function apercuAction()
    {
		$lang=$this->getRequest()->getParam('lang');
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
		$user=new Customer_Model_Mapper_User();
		$us=new Customer_Model_User();
		$user->find($member->cuu_id, $us);
		$persos=new Core_Model_Mapper_Personnage();
		
		$this->view->form ='';
		
		$nomSalle=$persos->getSalle($us->getSalle());
		$this->view->nomSalle=$nomSalle;
		$this->view->myUser=$us;
		$this->_helper->layout()->user=$us;
		if($lang=='en')
			$this->render('apercu-en');
    }
   public function universAction()
    {
		$lang=$this->getRequest()->getParam('lang');
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
		$user=new Customer_Model_Mapper_User();
		$us=new Customer_Model_User();
		$user->find($member->cuu_id, $us);
		$persos=new Core_Model_Mapper_Personnage();
		
		$this->view->form ='';
		
		$nomSalle=$persos->getSalle($us->getSalle());
		$this->view->nomSalle=$nomSalle;
		$this->view->myUser=$us;
		$this->_helper->layout()->user=$us;
		if($lang=='en')
			$this->render('univers-en');
    }
   public function remerciementsAction()
    {
		$lang=$this->getRequest()->getParam('lang');
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
		$user=new Customer_Model_Mapper_User();
		$us=new Customer_Model_User();
		$user->find($member->cuu_id, $us);
		$persos=new Core_Model_Mapper_Personnage();
		
		$this->view->form ='';
		
		$nomSalle=$persos->getSalle($us->getSalle());
		$this->view->nomSalle=$nomSalle;
		$this->view->myUser=$us;
		$this->_helper->layout()->user=$us;
		if($lang=='en')
			$this->render('remerciements-en');
    }
   public function personnagesAction()
    {
		$lang=$this->getRequest()->getParam('lang');
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
		$user=new Customer_Model_Mapper_User();
		$us=new Customer_Model_User();
		$user->find($member->cuu_id, $us);
		$persos=new Core_Model_Mapper_Personnage();
		
		$this->view->form ='';
		
		$nomSalle=$persos->getSalle($us->getSalle());
		$this->view->nomSalle=$nomSalle;
		$this->view->myUser=$us;
		$this->_helper->layout()->user=$us;
		if($lang=='en')
			$this->render('remerciements-en');
    }
   public function guildeAction()
    {
		$lang=$this->getRequest()->getParam('lang');
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
		$user=new Customer_Model_Mapper_User();
		$us=new Customer_Model_User();
		$user->find($member->cuu_id, $us);
		$persos=new Core_Model_Mapper_Personnage();
		
		$this->view->form ='';
		
		$nomSalle=$persos->getSalle($us->getSalle());
		$this->view->nomSalle=$nomSalle;
		$this->view->myUser=$us;
		$this->_helper->layout()->user=$us;
		if($lang=='en')
			$this->render('remerciements-en');
    }
   public function tleilaxAction()
    {
		$lang=$this->getRequest()->getParam('lang');
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
		$user=new Customer_Model_Mapper_User();
		$us=new Customer_Model_User();
		$user->find($member->cuu_id, $us);
		$persos=new Core_Model_Mapper_Personnage();
		
		$this->view->form ='';
		
		$nomSalle=$persos->getSalle($us->getSalle());
		$this->view->nomSalle=$nomSalle;
		$this->view->myUser=$us;
		$this->_helper->layout()->user=$us;
		if($lang=='en')
			$this->render('remerciements-en');
    }
   public function ixAction()
    {
		$lang=$this->getRequest()->getParam('lang');
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
		$user=new Customer_Model_Mapper_User();
		$us=new Customer_Model_User();
		$user->find($member->cuu_id, $us);
		$persos=new Core_Model_Mapper_Personnage();
		
		$this->view->form ='';
		
		$nomSalle=$persos->getSalle($us->getSalle());
		$this->view->nomSalle=$nomSalle;
		$this->view->myUser=$us;
		$this->_helper->layout()->user=$us;
		if($lang=='en')
			$this->render('remerciements-en');
    }
   public function gholaAction()
    {
		$lang=$this->getRequest()->getParam('lang');
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
		$user=new Customer_Model_Mapper_User();
		$us=new Customer_Model_User();
		$user->find($member->cuu_id, $us);
		$persos=new Core_Model_Mapper_Personnage();
		
		$this->view->form ='';
		
		$nomSalle=$persos->getSalle($us->getSalle());
		$this->view->nomSalle=$nomSalle;
		$this->view->myUser=$us;
		$this->_helper->layout()->user=$us;
		if($lang=='en')
			$this->render('ghola-en');
    }
   public function paulAction()
    {
		$lang=$this->getRequest()->getParam('lang');
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
		$user=new Customer_Model_Mapper_User();
		$us=new Customer_Model_User();
		$user->find($member->cuu_id, $us);
		$persos=new Core_Model_Mapper_Personnage();
		
		$this->view->form ='';
		
		$nomSalle=$persos->getSalle($us->getSalle());
		$this->view->nomSalle=$nomSalle;
		$this->view->myUser=$us;
		$this->_helper->layout()->user=$us;
		if($lang=='en')
			$this->render('paul-en');
    }
   public function conqueteAction()
    {
		$lang=$this->getRequest()->getParam('lang');
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
		$user=new Customer_Model_Mapper_User();
		$us=new Customer_Model_User();
		$user->find($member->cuu_id, $us);
		$persos=new Core_Model_Mapper_Personnage();
		
		$this->view->form ='';
		
		$nomSalle=$persos->getSalle($us->getSalle());
		$this->view->nomSalle=$nomSalle;
		$this->view->myUser=$us;
		$this->_helper->layout()->user=$us;
		if($lang=='en')
			$this->render('conquete-en');
    }
   public function gesseritAction()
    {
		$lang=$this->getRequest()->getParam('lang');
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
		$user=new Customer_Model_Mapper_User();
		$us=new Customer_Model_User();
		$user->find($member->cuu_id, $us);
		$persos=new Core_Model_Mapper_Personnage();
		
		$this->view->form ='';
		
		$nomSalle=$persos->getSalle($us->getSalle());
		$this->view->nomSalle=$nomSalle;
		$this->view->myUser=$us;
		$this->_helper->layout()->user=$us;
		if($lang=='en')
			$this->render('remerciements-en');
    }
   public function epiceAction()
    {
		$lang=$this->getRequest()->getParam('lang');
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
		$user=new Customer_Model_Mapper_User();
		$us=new Customer_Model_User();
		$user->find($member->cuu_id, $us);
		$persos=new Core_Model_Mapper_Personnage();
		
		$this->view->form ='';
		
		$nomSalle=$persos->getSalle($us->getSalle());
		$this->view->nomSalle=$nomSalle;
		$this->view->myUser=$us;
		$this->_helper->layout()->user=$us;
		if($lang=='en')
			$this->render('epice-en');
    }

    
	public function objectsuserAction()
    {
		if($this->getRequest()->getParam('templateNoDisplay'))
			$this->_helper->layout->disableLayout();
       $objets=new Zend_Session_Namespace('objets');
	   $this->view->myObjects=$objets->objets;
      // $this->_helper->viewRenderer->setScriptAction('infousernonconnect');
    }


}