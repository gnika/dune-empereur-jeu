<?php

include_once( 'library/Application/Profiler.php' );

final class Application
{

    private $_debugLevel;
    private $_config;
    private $_frontController ;
    private $_db ;
    private $_cacheManager ;
    
    const   DS          = '';
    const   PS          = '';
    const   CRLF        = '';
    const   TAB         = '';
    const   PATH_ROOT   = '';
    const   URL_MAIN_REL   = '';
    const   URL_MAIN_ABS   = '';

    
	function __construct( $debugLevel = 'dev' )
	{
    
        // Récupération du niveau d'exécution de l'appli ( dev | test | prod )
        $this->_debugLevel  = $debugLevel;
       
        // Lance le profiling de l'application ( temps global -> jusqu'après le dispatch dans la méthode run()  )
        $this->_debugLevel == 'dev' ? Application_Profiler::enable() : false;
        
        // Définition des constantes pour les caractères dépendants de l'OS serveur
		define ( 'DS' , DIRECTORY_SEPARATOR );
		define ( 'PS' , PATH_SEPARATOR );
		define ( 'CRLF' , "\r\n" );
		define ( 'TAB' , "\t" );
        
        // Définition des constantes faisant référence aux chemins de l'application
        define ( 'PATH_ROOT',           dirname(dirname(__FILE__)) . DS );
        define ('URL_MAIN_REL',         rtrim(dirname($_SERVER['PHP_SELF']), '/\\').'/');
        define ('URL_MAIN_ABS',         'http://'.$_SERVER['HTTP_HOST'].URL_MAIN_REL);
       
        // Configuration de l'environnement PHP ( errors_display et error_reporting )
        Application_Profiler::start('Modif php.ini');
        $this->_setupPhpIni();
        Application_Profiler::stop('Modif php.ini');
        
        // Configuration et instanciation du Zend_Loader
        Application_Profiler::start('Config autoLoad');
        // Namespaces coorespondant au librairies
        $namespaces = array(  'Application',
                              'Vendor',
                            );
        // Namespaces correspondant aux modules de l'application                  
        $modules    = array(  
                              'Cms',
                              'Contact', 
                              'Core',
                              'Customer',
                              'Produit',
                              'Attaque'
                            );
        $this->_setupLoader( $namespaces, $modules);
        Application_Profiler::stop('Config autoLoad');
        
        // Chargement du fichier de configuration application.xml
        Application_Profiler::start('Chargement config');
        $this->_loadConfig();
        Application_Profiler::stop('Chargement config');
        
        // Configuration de la locale et de la timezone
        $this->_setupLocale();
        
        // Création de l'adaptateur de BDD
        Application_Profiler::start('Init DB');
        $this->_setupDbAdapter();
        Application_Profiler::stop('Init DB');
        
        // Création du système de cache applicatif
        Application_Profiler::start('Init Cache');
        $this->_setupCacheCore();
        Application_Profiler::stop('Init Cache');

        // Création du système de journalisation des erreurs ( fichier text )
        Application_Profiler::start('Init ErrorLog');
        $this->_setupErrorLog();
        Application_Profiler::stop('Init ErrorLog');
        
        // Création du système de journalisation des erreurs ( firePHP )
        Application_Profiler::start('Init FirebugLog');
        $this->_setupFirebugLog();
        Application_Profiler::stop('Init FirebugLog');
		
		// Création du système de journalisation des erreurs ( fichier text )
        Application_Profiler::start('Init UserLog');
        $this->_setupUserLog();
        Application_Profiler::stop('Init UserLog');
        
        // Création et configuration de la session
        Application_Profiler::start('Init Session');
        $this->_setupSession();
        Application_Profiler::stop('Init Session');
        
        // Création du registre et enregistrement des objets
        Application_Profiler::start('Init Registry');
        $this->_setupRegistry();
        Application_Profiler::stop('Init Registry');
        
        $this->_setupController();
	}
  
  
	public function run()
	{
        // Instancie le contrôleur frontal ( singleton )
        $this->_frontController = Zend_Controller_Front::getInstance();
        // Défini le répertoire qui contient les modules de l'application
        $this->_frontController->addModuleDirectory( PATH_ROOT . 'application' );
        //  Défini le module utilisé par défaut
        $this->_frontController->setDefaultModule( 'Core' );

        // Chargement des plugins du frontController
        $this->_frontController->registerPlugin( new Application_Controller_Plugin_ViewSetup() );  // Configuration de la vue et du Layout
        $this->_frontController->registerPlugin( new Application_Controller_Plugin_RouterSetup() );  // Configuration du routeur et prise en charge de l'URL Rewriting 
        $this->_frontController->registerPlugin( new Application_Controller_Plugin_InfoDayUser() );
        // Lance la boucle de dispatching

        try {
            $this->_frontController->dispatch();
        } 
        catch (Exception $e1) {
            $log = Zend_Registry::get('errorLog');
            $log->debug( $e1->getMessage() . "\n" .  $e1->getTraceAsString() . "\n-----------------------------" );
            print( 'Erreur générale, consultez le journal des erreurs' );
            exit();
        }

	}
  
    
    // Configuration de l'environnement PHP ( errors_display et error_reporting )
    private function _setupPhpIni()
    {
        switch( $this->_debugLevel ) {
            case 'dev' : 
                $displayErrors  = true;
                $errorReporting = E_ALL;
                break;
            case 'test' :
                $displayErrors = true;
                $errorReporting = E_ALL ^ E_NOTICE ;
                break;
            case 'prod' : 
                $displayErrors = false;
                $errorReporting = E_ERROR | E_WARNING | E_PARSE;
                break;
            default :
                $displayErrors = false;
                $errorReporting = E_ERROR | E_WARNING | E_PARSE;
                break;
        }
        ini_set( 'display_errors', $displayErrors );
        ini_set( 'error_reporting', $errorReporting );
    }

    // Configuration et instanciation du Zend_Loader
    private function _setupLoader( $namespaces, $modules ) 
    {
        set_include_path (
            ini_get( 'include_path' ) .PS .
            PATH_ROOT . 'library' . PS .
            PATH_ROOT . 'application' 
        );
        require_once('Zend/Loader/Autoloader.php');
        $autoloader = Zend_Loader_Autoloader::getInstance();
        
        foreach( $namespaces as $namespace ){ 
            $autoloader->registerNamespace($namespace);
        }
        
        foreach( $modules as $module ){
            $resourceLoader = new Zend_Loader_Autoloader_Resource(array(
              'basePath'      => PATH_ROOT . 'application' . DS . ucFirst( $module ),
              'namespace'     => $module ,
              'resourceTypes' => array(
                'dbtable' => array(
                    'namespace' => 'Model_DbTable',
                    'path'      => 'models/DbTable',
                ),
                'mappers' => array(
                    'namespace' => 'Model_Mapper',
                    'path'      => 'models/mappers',
                ),
                'form'    => array(
                    'namespace' => 'Form',
                    'path'      => 'forms',
                ),
                'model'   => array(
                    'namespace' => 'Model',
                    'path'      => 'models',
                ),
                'plugin'  => array(
                    'namespace' => 'Plugin',
                    'path'      => 'plugins',
                ),
                'service' => array(
                    'namespace' => 'Service',
                    'path'      => 'services',
                ),
                'viewhelper' => array(
                    'namespace' => 'View_Helper',
                    'path'      => 'views/helpers',
                ),
                'viewfilter' => array(
                    'namespace' => 'View_Filter',
                    'path'      => 'views/filters',
                )
          )));
        }
    }
    
    // Chargement du fichier de configuration application.xml
    private function _loadConfig()
    {
        $this->_config = new Zend_Config_Xml( PATH_ROOT . 'etc' . DS . 'application.xml' , $this->_debugLevel, false);
    }
    
	// Création du système de journalisation des connexions utilisateurs ( fichier text )
    private function _setupUserLog()
    {
        $userLogWriter     = new Zend_Log_Writer_Stream( PATH_ROOT  . 'var' . DS . 'log' . DS . 'user.log' );
        $this->_userLog    = new Zend_Log( $userLogWriter );
    }
    
    
    // Configuration de la locale et de la timezone
    private function _setupLocale()
    {
        date_default_timezone_set( $this->_config->locale->timezone );
        Zend_Locale::setDefault( $this->_config->locale->default );
    }
    
    // Création de l'adaptateur de BDD
    private function _setupDbAdapter()
    {
        // print_r( $this->_config->database->toArray() ); exit;
       $this->_db = Zend_Db::factory( $this->_config->database->adapter, $this->_config->database->params->toArray() );
	   $this->_db->query("SET NAMES 'utf8'");
       $this->_debugLevel == 'dev' ? $this->_db->getProfiler()->setEnabled(true) : $this->_db->getProfiler()->setEnabled(false);
       // Défini l'adaptateur comme défaut pour le design patern Data_Table
       Zend_Db_Table_Abstract::setDefaultAdapter( $this->_db );
       // Appelle le système de cache pour les métadonnées des tables 
       $this->_setupCacheMetaData();
	   // print_r( $this->_config->database->toArray() ); exit;
    }
    
    // Création du système de cache applicatif
    private function _setupCacheCore()
    {
        $backend    =  $this->_config->cache->backend;
        $frontend   = 'Core';
        
        // Configuration du backend : File | Apc
        if ( strtolower( $backend ) == 'file' ) {
            $backendOptions     = array(   'cache_dir' => PATH_ROOT . 'var' . DS . 'cache', 
                                           'file_locking' => true, 
                                           'read_control' => true, 
                                           'read_control_type' => 'adler32', // custom
                                           'hashed_directory_level' => 1,
                                           'hashed_directory_umask' => 0700,
                                           'file_name_prefix' => $this->_config->cache->filePrefix, // custiom
                                           'cache_file_umask' => 0600, 
                                           'metadatas_array_max_size' => 100
                                        );
        }
        else {
            $backendOptions     = array();
        }
        
        // Configuration du frontend
        $frontendOptions    = array(    'write_control' => false,  // custom - improving cache writing regardless of cache integrity - maybe could be changed
                                        'caching' => $this->_config->cache->enabled == 1 ? true : false, // custom
                                        'cache_id_prefix' => null,
                                        'automatic_serialization' => true,  // custom
                                        'automatic_cleaning_factor' => $this->_config->cache->automaticCleaningFactor,  // custom
                                        'lifetime' => $this->_config->cache->lifetime,  // custom
                                        'logging' => false,
                                        'logger' => null,
                                        'ignore_user_abort' => true  // custom
                                    );
        
        // Initialisation du cache
        try{                            
            $this->_cacheManager    = Zend_Cache::factory( $frontend, $backend, $frontendOptions, $backendOptions );
            $this->_cacheManager->clean( Zend_Cache::CLEANING_MODE_OLD );
        } catch ( Zend_Cache_Exception $e ){
            $this->_errorLog->debug( $e->getMessage() . "\n" .  $e1->getTraceAsString() . "\n-----------------------------" );
            print( 'Erreur du gestionnaire de cache, consultez le journal des erreurs');
            exit();
        }
    }
    
     // Création du système de cache de métadonnées BDD
    private function _setupCacheMetaData()
    {
        $backend    = 'File';
        $frontend   = 'Core';
        
        $backendOptions     = array(   'cache_dir' => PATH_ROOT . 'var' . DS . 'cache' );
        $frontendOptions    = array(   'lifetime' => 3600,
                                       'automatic_serialization' => true 
                                    );
        if( $this->_config->cache->enabled ) {
            $this->_cacheManagerMetaData    = Zend_Cache::factory( $frontend, $backend, $frontendOptions, $backendOptions );
            $this->_cacheManagerMetaData->clean( Zend_Cache::CLEANING_MODE_OLD );
            Zend_Db_Table_Abstract::setDefaultMetaDataCache( $this->_cacheManagerMetaData );
        }
    }
    
    // Création du système de journalisation des erreurs ( fichier text )
    private function _setupErrorLog()
    {
        $errorLogWriter     = new Zend_Log_Writer_Stream( PATH_ROOT  . 'var' . DS . 'log' . DS . 'error.log' );
        $this->_errorLog    = new Zend_Log( $errorLogWriter );
    }
        
    // Création du système de journalisation des erreurs ( firePHP )
    private function _setupFirebugLog()
    {
        $errorLogWriter     = new Zend_Log_Writer_Firebug();
        $this->_firebugLog  = new Zend_Log( $errorLogWriter );
    }
    
    // Création du registre et enregistrement des objets
    private function _setupRegistry()
    {
        Zend_Registry::set( 'config',       $this->_config );
        Zend_Registry::set( 'debugLevel',   $this->_debugLevel );
        Zend_Registry::set( 'db',           $this->_db);
        Zend_Registry::set( 'cache',        $this->_cacheManager );
        Zend_Registry::set( 'errorLog',     $this->_errorLog );
        Zend_Registry::set( 'firebugLog',   $this->_firebugLog );
		Zend_Registry::set( 'userLog',      $this->_userLog );
    }
    
    // Gestion des sessions ( configuration et création des espaces de nom)
    private function _setupSession()
    {
        $configSession = new Zend_Config_Xml(PATH_ROOT . DS . 'etc' . DS . 'session.xml', $this->_debugLevel);
        Zend_Session::setOptions($configSession->toArray());
        new Zend_Session_Namespace('main');           // Espace de noms principal
        new Zend_Session_Namespace('messages');       // Espace de noms pour les messages systèmes
		new Zend_Session_Namespace('customer');       // Espace de noms pour la gestion des clients  
		new Zend_Session_Namespace('lang');         
        new Zend_Session_Namespace('user');
        new Zend_Session_Namespace('objets');
    }
    
    // Configuration supplémentaire du Zend Controller
    private function _setupController()
    {
        Zend_Controller_Action_HelperBroker::addPrefix( 'Application_Controller_Action_Helper' );
        Zend_Controller_Action_HelperBroker::addPath( PATH_ROOT . 'library' . DS . 'Application' . DS . 'Controller' . DS . 'Action' . DS . 'Helper' );
    }
    
}