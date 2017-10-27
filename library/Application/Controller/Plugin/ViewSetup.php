<?php

class Application_Controller_Plugin_ViewSetup extends Zend_Controller_Plugin_Abstract
{    
   /**
     * @var Zend_View
     */ 
    protected $_view;
    
    public function dispatchLoopStartup(Zend_Controller_Request_Abstract $request)
    {
       // Initialise le helper de vue viewRenderer
        $this->_view = $this->_setupViewRenderer();
        
        // Implémentation de Zend_Layout
        $this->_setupLayout();
        $this->_view->Doctype( Zend_Registry::get('config')->xhtml_version );
        //Définition des balises Metas -> seront récupérées dans le layout grâce à l'appel de $this->headMeta()
        $this->_view->headMeta()->setName('Content-Type', 'text/html;charset=iso-8859-15');
        $this->_view->headMeta()->setName('google-signin-client_id', '227247000170-0joekb3tnkmcgu8ejnpou4lvngnn4lc7.apps.googleusercontent.com');
        // $this->_view->headMeta()->setName('description', "Dune Le jeu d'aventure: Moneo au service de l'Empereur-dieu. Dune emperor est un jeu point-and-click volontairement vintage. Sauvez Arrakis ! ");
        $this->_view->headMeta()->setName('description', "dune jeu point and click sur Arrakis. Résolvez des quêtes et explorez l'univers de DUNE. Sauvez Arrakis");
        
        //Si l'appli est en développement, ajoute un suffixe "-dev"  pour charger les fichiers non minifiés
        Zend_Registry::get('debugLevel') == 'dev' ? $level = '-dev' : $level = '';
        
        //Définition des balises link pour le chargement des CSS -> seront récupérées dans le layout grâce à l'appel de $this->headLink()
        $this->_view->headLink()->appendStylesheet( URL_MAIN_ABS  . 'css/style' . $level . '.css');
        $this->_view->headLink()->appendStylesheet( URL_MAIN_ABS  . 'css/print' . $level . '.css', 'print');
        $this->_view->headLink()->appendStylesheet( URL_MAIN_ABS  . 'css/jquery.progbar.css');
        $this->_view->headLink()->appendStylesheet( URL_MAIN_ABS  . 'css/stage1.css');
        $this->_view->headLink()->appendStylesheet( URL_MAIN_ABS  . 'css/zoommap.css');
		// $this->_view->headLink(array('rel' => 'shortcut icon', 'type' => 'image/vnd.microsoft.icon', 'href' => URL_MAIN_ABS . 'images/dune.ico'));
	   
        //Définition des balises scripts pour le chargement des JS -> seront récupérées dans le layout grâce à l'appel de $this->headScript()
        $this->_view->headScript()->appendScript("var URL_MAIN_ABS = '".URL_MAIN_ABS."' ;");
		
        // $this->_view->headScript()->appendFile(URL_MAIN_ABS . 'js/main' . $level . '.js', $type = 'text/javascript');
		
		$this->_view->headScript()->appendFile(URL_MAIN_ABS . 'js/jquery-1.9.1.js', $type = 'text/javascript');
		$this->_view->headScript()->appendFile(URL_MAIN_ABS . 'js/jquery-ui.min.js', $type = 'text/javascript');
		$this->_view->headScript()->appendFile(URL_MAIN_ABS . 'js/jquery-timers.js', $type = 'text/javascript');
		$this->_view->headScript()->appendFile(URL_MAIN_ABS . 'js/jquery.progbar.js', $type = 'text/javascript');
		$this->_view->headScript()->appendFile(URL_MAIN_ABS . 'js/jqBarGraph.1.1.min.js', $type = 'text/javascript');
		$this->_view->headScript()->appendFile(URL_MAIN_ABS . 'js/initJour.js', $type = 'text/javascript');
		$this->_view->headScript()->appendFile(URL_MAIN_ABS . 'js/zoommap.js', $type = 'text/javascript');
		$this->_view->headScript()->appendFile(URL_MAIN_ABS . 'js/main.js', $type = 'text/javascript');
		$this->_view->headScript()->appendFile(URL_MAIN_ABS . 'js/underscore-lib-min.js', $type = 'text/javascript');
		$this->_view->headScript()->appendFile('https://apis.google.com/js/platform.js', $type = 'async defer');
    }


    public function postDispatch(Zend_Controller_Request_Abstract $request)
    {
        // Ajoute la partie commune de la balise TITLE
        $this->_view->headTitle()->setSeparator(' - ');
        // $this->_view->headTitle( 'Dune-Moneo.net' );
        // $this->_view->headTitle( "Dune - Moneo au service de l'empereur-dieu" );
        $this->_view->headTitle( "dune jeu point and click sur la planète Arrakis" );

        // Si l'appli est en developpement, l'indique dans la balise TITLE
        if ( Zend_Registry::get('debugLevel') == 'dev' ) {
            $this->_view->headTitle()->setSeparator(' | ');
            $this->_view->headTitle('DEVELOPPEMENT');
        }
        
        $moduleName = $request->getModuleName();
        $this->_loadCss( $moduleName );
        $this->_loadJs( $moduleName );
        $this->_view->module         = $request->getModuleName();
        $this->_view->controller     = $request->getControllerName();
        $this->_view->action         = $request->getActionName();
    }
    
    // methode qui charge les CSS en fonction du module
    private function _loadCss( $moduleName )
    {
        // Recupère le nom du module et le met en miniscule
        $module = strtolower( $moduleName );

        //Si l'appli est en développement, ajoute un suffixe pour charger les fichiers non minifiés
        Zend_Registry::get('debugLevel') == 'dev' ? $level = '-dev' : $level = '';
        
        // Charge un tableau avec les css déjà mis dans la pile
        $currentLinks = array();
        foreach( $this->_view->headLink() as $link )
        {
            if ( $link->rel = 'stylesheet' ) {
                @$currentLinks[] = $link->href;
            }
        }

        // Ajoute le CSS spécifique au module dans la pile ( si le fichier existe )
        $file = PATH_ROOT . DS . 'css' . DS . $module . $level . '.css';

        if (file_exists($file)) {
            $url = URL_MAIN_ABS . 'css/' . $module . $level . '.css';
            if(!in_array($url, $currentLinks)) {
                $this->_view->headLink()->appendStylesheet( $url );
            }
        }
    }
    
    // methode qui charge les JSen fonction du module
    private function _loadJs( $moduleName )
    {
        // Recupère le nom du module et le met en miniscule
        $module = strtolower( $moduleName );

        //Si l'appli est en développement, ajoute un suffixe pour charger les fichiers non minifiés
        Zend_Registry::get('debugLevel') == 'dev' ? $level = '-dev' : $level = '';
        
        // Charge un tableau avec les css déjà mis dans la pile
        $currentScripts = array();
        foreach( $this->_view->headScript() as $script )
        {
            if ( $script->type = 'text/javascript' ) {
                @$currentScripts[] = $script->attributes['src'];
            }
        }

        // Ajoute le CSS spécifique au module dans la pile ( si le fichier existe )
        $file = PATH_ROOT . DS . 'js' . DS . $module . $level . '.js';

        if (file_exists($file)) {
            $url = URL_MAIN_ABS . 'js/' . $module . $level . '.js';
            if(!in_array($url, $currentScripts)) {
                $this->_view->headScript()->appendFile( $url );
            }
        }
    }
    
    // Initialise et configuration du Layout
    private function _setupLayout()
    {
        // Instacie l'inflecteur pour la configuration du layout
        $inflector = new Zend_Filter_Inflector(':script.:suffix');
        $inflector->addRules(array(     ':script' => array('Word_CamelCaseToDash', 'StringToLower'),
                                        'suffix'  => 'phtml'));
 
        // Initialise Zend_Layout's MVC helpers
        Zend_Layout::startMvc(array('layoutPath' => PATH_ROOT . DS . 'layouts',
                            'view' => $this->_view,
                            'layout' => 'default_template',
                            'inflector' => $inflector));
    }
    
    
    // Initialisation et configuration du viewRenderer
    private function _setupViewRenderer()
    {
        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('viewRenderer');
        $viewRenderer->init();
        $viewRenderer->setViewSuffix('phtml');
        $viewRenderer->view->setScriptPath( PATH_ROOT . 'Core' . DS . 'views' . DS . 'scripts');
        $viewRenderer->view->addHelperPath( PATH_ROOT . 'library' . DS . 'Application' . DS . 'View' . DS . 'Helper' . DS , 'Application_View_Helper');
        return $viewRenderer->view;
    }
}