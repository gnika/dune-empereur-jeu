<?php

class Produit_IndexController extends Application_Controller_Action
{   
    protected $_auth;


    public function init() {
       
    }
    
    public function indexAction()
    {
        
		
		$cache_id    = 'produit_index_categorie';
        if (!($pageData = $this->getCache()->load($cache_id)) ) {
            $Categorie_Unite          = new Produit_Model_CategorieUnite();
            $Categorie_UniteTable     = new Produit_Model_Mapper_CategorieUnite();
            $pageData = $Categorie_UniteTable->fetchAll();
            $this->getCache()->save( $pageData );
        } 
        
		if(!$pageData)
			throw new Zend_Controller_Action_Exception('La categorie n\'a pas été trouvée.', 404);
			$this->view->pageData = $pageData;
		
    
    }
    
    public function uniteAction()
    {
        
		$membre=new Zend_Session_Namespace('user');
        if($membre->userInfo==null)
		$this->_redirect( URL_MAIN_ABS .'Customer/auth/customer', array( 'exit' => true, 'code'=> 301) );
		$cache_id    = 'produit_index_Unite';
        if (!($pageData = $this->getCache()->load($cache_id)) ) {
            $Categorie_Unite          = new Produit_Model_CategorieUnite();
            $Categorie_UniteTable     = new Produit_Model_Mapper_CategorieUnite();
            $pageData = $Categorie_UniteTable->fetchAll();
            $this->getCache()->save( $pageData );
        } 
       
		if(!$pageData)
			throw new Zend_Controller_Action_Exception('La categorie n\'a pas été trouvée.', 404);
			$this->view->pageData = $pageData;
            $this->view->pageus = $membre->userInfo;
		
    
    }
	
	public function listeuniteAction ()
	{
        $membre=new Zend_Session_Namespace('user');
        if($membre->userInfo==null)
		$this->_redirect( URL_MAIN_ABS .'Customer/auth/customer', array( 'exit' => true, 'code'=> 301) );
		$categorieId = $this->getRequest()->getParam('pc_id');
		$validator  = new Zend_Validate();
        // Chainage du validator
        $validator  ->addValidator( new Zend_Validate_Int() );
        
		if(!$validator->isValid($categorieId))
			throw new Zend_Controller_Action_Exception('La page n\'existe pas.', 404);
        
         $cache_id    = 'produit_index_listeUnite' . $categorieId    ;
        if (!($pageData = $this->getCache()->load($cache_id)) ) {
            $unite       = new Produit_Model_Unite();  
            $uniteTable  = new Produit_Model_Mapper_Unite();
            $pageData      = $uniteTable->fetchByCategory( $categorieId );
            Zend_Registry::get('cache')->save( $pageData );
        } 
        // Exemples avec jointures
        /*$categorieTable = new Produit_Model_Mapper_CategorieUnite();
        $categorieTable->fetchWithProducts( $categorieId );
        $uniteTable->fetchByCategoryWithCategory( $categorieId );*/
        
        
		if(!$pageData)
			throw new Zend_Controller_Action_Exception('La page n\'a pas été trouvée.', 404);
		
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('pagination.phtml');
		$paginator     = Zend_Paginator::factory($pageData);
        $paginator -> setPageRange(5);
        $paginator -> setCurrentPageNumber($this->_getParam('page', 1));
        $paginator -> setItemCountPerPage($this->_getParam('par', 1));
        $this->view-> paginatedUnites = $paginator;
	}
	
	public function unitedetailsAction ()
	{
		$uniteId = $this->getRequest()->getParam('pa_id');
		$validator  = new Zend_Validate();
        $validator  ->addValidator( new Zend_Validate_Int() );
        $membre=new Zend_Session_Namespace('user');
        if($membre->userInfo==null)
		$this->_redirect( URL_MAIN_ABS .'Customer/auth/customer', array( 'exit' => true, 'code'=> 301) );
		if(!$validator->isValid($uniteId))
			throw new Zend_Controller_Action_Exception('L\'unite demandé n\'existe pas.', 404);
        
         $cache_id    = 'produit_index_listeUnite' . $uniteId    ;
        if ( !$pageData = $this->getCache()->load($cache_id) )  {
            $unite       = new Produit_Model_Unite();  
            $categorie     = new Produit_Model_CategorieUnite();
            $uniteTable  = new Produit_Model_Mapper_Unite();
            $uniteTable->find( $uniteId, $unite, $categorie );
            $pageData ['categorie'] = $categorie;
            $pageData ['unite']   = $unite;
            $this->getCache()->save( $pageData );
        } 
        
		if(!$pageData)
			throw new Zend_Controller_Action_Exception('L\'unite demandé n\'existe pas.', 404);
            $this->view->pageData = $pageData;
            $form=new Produit_Form_NombreUnite($pageData);
            $form   ->setAction( URL_MAIN_ABS . 'Produit/basket/ajoutpanier' )
                    ->setMethod( 'post' )
                    ->setAttrib( 'id', 'envoiForm' );
            $this->view->form=$form;
		//echo $this->view->prix = $this->_helper->getTVA( '10' );
		
	}
	
	public function ajoutpanierAction ()
	{
        $uniteId  = $this->getRequest()->getParam('id_unite');
		$redirect   = $this->getRequest()->getParam('redirect');
		$Basket     = new Produit_Model_Basket();
        $Basket->addProduct($uniteId);
		$this->_redirect( URL_MAIN_ABS . $redirect, array( 'exit' => true, 'code'=> 301) );

	}
	
	public function panierAction()
	{
		$panier=new Zend_Session_Namespace('panier');
		$unites_panier=$panier->listeunite;
		$index_unite=array();
		if(count($unites_panier)!=0)
		{
			foreach($unites_panier as $cle=>$valeur)
			{
				$index_unite[]=$cle;
			}
		}
        
            $unite        = new Produit_Model_Unite();  
            $uniteTable   = new Produit_Model_Mapper_Unite();
            $uniteTable->find($index_unite, $unite);
            $pageData = $unite;
			
		if(!$pageData)
			throw new Zend_Controller_Action_Exception('L\'unite demandé n\'existe pas.', 404);
            
            
			//print_r($pageData);die();
		$this->view->pageData = $pageData;
		
	}
    
    	public function listebatimentAction ()
	{
        $membre=new Zend_Session_Namespace('user');
        if($membre->userInfo==null)
		$this->_redirect( URL_MAIN_ABS .'Customer/auth/customer', array( 'exit' => true, 'code'=> 301) );
         $cache_id    = md5('produit_index_listebatiment');
        if (!($pageData = $this->getCache()->load($cache_id)) ) {
            $unite       = new Produit_Model_Batiment();  
            $uniteTable  = new Produit_Model_Mapper_Batiment();
            $pageData      = $uniteTable->fetchAll();
            Zend_Registry::get('cache')->save( $pageData );
        } 
        $this->view->pageData = $pageData;
        $this->view->chateau = $membre->userInfo;
       
		if(!$pageData)
			throw new Zend_Controller_Action_Exception('La page n\'a pas été trouvée.', 404);
	}
    
    public function listemagieAction ()
	{
        $membre=new Zend_Session_Namespace('user');
        if($membre->userInfo==null)
		$this->_redirect( URL_MAIN_ABS .'Customer/auth/customer', array( 'exit' => true, 'code'=> 301) );
         $cache_id    = md5('produit_index_listebatiment');
        if (!($pageData = $this->getCache()->load($cache_id)) ) {
            $unite       = new Produit_Model_Magie();  
            $uniteTable  = new Produit_Model_Mapper_Magie();
            $pageData      = $uniteTable->fetchAll();
            Zend_Registry::get('cache')->save( $pageData );
        } 
        $this->view->pageData = $pageData;
        $this->view->guilde = $membre->userInfo;
       
		if(!$pageData)
			throw new Zend_Controller_Action_Exception('La page n\'a pas été trouvée.', 404);
	}
    
    public function batimentdetailsAction ()
	{
		$batimentId = $this->getRequest()->getParam('pb_id');
		$validator  = new Zend_Validate();
        $validator  ->addValidator( new Zend_Validate_Int() );
        
		if(!$validator->isValid($batimentId))
			throw new Zend_Controller_Action_Exception('Le batiment demandé n\'existe pas.', 404);
        
         $cache_id    = 'produit_index_listeUnite' . $batimentId    ;
        if ( !$pageData = $this->getCache()->load($cache_id) )  {
            $batiment       = new Produit_Model_Batiment();  
            $batimentTable  = new Produit_Model_Mapper_Batiment();
            $batimentTable->find($batimentId, $batiment);
            $pageData ['batiment']   = $batiment;
            $this->getCache()->save( $pageData );
        } 
        
		if(!$pageData)
			throw new Zend_Controller_Action_Exception('Le batiment demandé n\'existe pas.', 404);
            $this->view->pageData = $pageData;
            $this->_auth = Zend_Auth::getInstance();
            if($member = $this->_auth->getIdentity()){
            $form=new Produit_Form_Batiment($batimentId);
            $form   ->setAction( URL_MAIN_ABS . 'Produit/basket/ajoutbatiment' )
                    ->setMethod( 'post' )
                    ->setAttrib( 'id', 'envoiForm' );
            $this->view->form=$form;		
            }
	}
    

    public function magiedetailsAction ()
	{
		$magieId = $this->getRequest()->getParam('pm_id');
		$validator  = new Zend_Validate();
        $validator  ->addValidator( new Zend_Validate_Int() );
        
		if(!$validator->isValid($magieId))
			throw new Zend_Controller_Action_Exception('Le sort demandé n\'existe pas.', 404);
        
         $cache_id    = 'produit_index_listeUnite' . $magieId    ;
        if ( !$pageData = $this->getCache()->load($cache_id) )  {
            $magie       = new Produit_Model_Magie();  
            $magieTable  = new Produit_Model_Mapper_Magie();
            $magieTable->find($magieId, $magie);
            $pageData ['magie']   = $magie;
            $this->getCache()->save( $pageData );
        } 
        
		if(!$pageData)
			throw new Zend_Controller_Action_Exception('Le batiment demandé n\'existe pas.', 404);
            $this->view->pageData = $pageData;
            $this->_auth = Zend_Auth::getInstance();
            if($member = $this->_auth->getIdentity()){
            $form=new Produit_Form_Magie($magieId);
            $form   ->setAction( URL_MAIN_ABS . 'Produit/basket/ajoutmagie' )
                    ->setMethod( 'post' )
                    ->setAttrib( 'id', 'envoiForm' );
            $this->view->form=$form;		
            }
	}


}