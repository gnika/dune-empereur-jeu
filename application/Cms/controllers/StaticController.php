<?php

class Cms_StaticController extends Application_Controller_Action
{

    public function init() 
    {
       $this->_cache = Zend_Registry::get('cache');
    }
    
    public function viewAction()
    {
        Application_Profiler::start('Cms/static/view');
        
        // Récupération de l'id et validation en type int
        $pageId     = $this->getRequest()->getParam('pid');
        $validator  = new Zend_Validate();
        $validator  ->addValidator( new Zend_Validate_Int() );
		if( !$validator->isValid($pageId) ) 
			throw new Zend_Controller_Action_Exception('La page n\'existe pas.', 404);
           
    // Récupération du contenu de la page ( en base ou en cache )
        $cache_id = 'core_staticpage_' . $pageId ;
         
        if ( !( $pageData = $this->_cache->load($cache_id) ) ) {
            $Page         = new Cms_Model_Static();  
            $PageMapper   = new Cms_Model_Mapper_Static();  
            $PageMapper->find( $pageId, $Page );
            $this->_cache -> save( $Page );
        } 
    // Lève une exception si l'enregistrement n'existe pas
		if( count( $Page ) == 0 )
			throw new Zend_Controller_Action_Exception('Le document demandé n\'existe pas.', 404);
        
    // Affectation des variables de la vue
        $this->view->headTitle( $Page->getHeadtitle );
        $metadesc  = $Page->getDescription != '' ? $Page->getDescription  : ' ';
        $metakey   = $Page->getKeywords != ''    ? $Page->getKeywords     : ' ';
        
        $this->view->headMeta() -> appendName( 'Description', $metadesc );
        $this->view->headMeta() -> appendName( 'Keywords',    $metakey );
		$this->view->page   = $Page;
        
        Application_Profiler::stop('Cms/static/view');
    }


}