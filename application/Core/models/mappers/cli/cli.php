#!/usr/bin/php -q
<?php


/*************************************************************************
*	AMITEL - Squelette CLI Zend Framework
*	cli.php ( Dispatcher pour exécution en ligne de commande / Crontab )
*	Jean-Baptiste MONIN  / AMITEL
**************************************************************************/

if ( $_SERVER['HTTP_USER_AGENT'] != '' ) {
	print 'Action non autorisée';
	exit;
}

$startTime = microtime(true);


//		CONSTANTES OS-DEPENDANTES	
// =====================================================================
		define ('DS', DIRECTORY_SEPARATOR);
		define ('PS', PATH_SEPARATOR);
		define ('BP', dirname(dirname(__FILE__)));
		define ('CRLF',"\r\n");
		define ('TAB',"\t");


//		INTRO POUR SORTIE ECRAN
// =====================================================================
//print( CRLF );
//print( '_______________________________________________________________'.CRLF );
//print( 'Execution d\'une tache en ligne de commande');
//print( CRLF );



//		STRUCTURE - CHEMINS  DE L'APPLI POUR LES INCLUDES
// =====================================================================

		define ('PATH_ROOT',			dirname(dirname(__FILE__)).DS);
		define ('PATH_BATCHES',			dirname(__FILE__).DS);
		define ('PATH_CLIAPPS',			PATH_BATCHES . 'processes'.DS);
		define ('PATH_LIB',				PATH_ROOT . 'library'.DS);
		define ('PATH_VAR',				PATH_ROOT . 'var'.DS);
        define ('PATH_CACHE',			PATH_VAR  . 'cache'.DS);
		define ('PATH_LOG',				PATH_ROOT . 'var'.DS.'log'.DS);
		define ('PATH_CACHE',			PATH_ROOT . 'cache'.DS);
		define ('PATH_CONF',			PATH_ROOT . 'etc'.DS);
		define ('PATH_MODELS',			PATH_ROOT . 'models'.DS);
		define ('PATH_TEMP',			PATH_VAR  . 'tmp'.DS);
		define ('PATH_LUCENE',			PATH_VAR  . 'lucene'.DS);


//		CONFIGURATION ET INSTANCIATION GENERALES
// =====================================================================

		// Modification du include path
		set_include_path (
			ini_get('include_path'). PS .
			BP . '/library' . PS .
			BP . '/application/models' . PS .
			BP . '/application/'
		);

		// Activation de l'autoload
		include 'Zend/Loader.php';
		spl_autoload_register(array('Zend_Loader', 'autoload'));
		
		// Lecture du fichier de config
		$config	= new Zend_Config_Xml(PATH_CONF.'conf_main.xml', 'staging', $allowModifications = true);

		// Construction du connecteur MySQL et mise en registre
		$_dbConfig 	= array( 'host'		=> $config->database->host,
							 'username'	=> $config->database->username,
							 'password'	=> $config->database->password,
							 'dbname'	=> $config->database->dbname
							);
		$_dbAdapter = (string) $config->database->adapter;

		$_db = Zend_Db::factory(''.$_dbAdapter.'', $_dbConfig );
		Zend_Db_Table_Abstract::setDefaultAdapter($_db);
		Zend_Registry::set('db', $_db);
		
		// Construction du système de journélisation et mise en registre 
		$logger = new Zend_Log();
		$cronLogWriter 		= new Zend_Log_Writer_Stream( PATH_LOG . $config->logfiles->cron );
		$cronLogFormatter	= new Zend_Log_Formatter_Simple('%timestamp% %priorityName% : %message%' . PHP_EOL);
		$cronLogWriter->setFormatter( $cronLogFormatter );
		$logger->addWriter($cronLogWriter);
		

// ==========================================================================================
//		CONFIGURATION DU CACHE
// ==========================================================================================
		
		// Création d'un cache de type Core reposant sur un backend File d'une durée de vie d'une heure ( 3600s ) puis enregistrement de l'objet dans le registre
		$frontend		= 'Core';
		$backend		= 'File';
		$frontendOptions = array('lifetime' => 3600,
								 'automatic_serialization' => true);
		$backendOptions = array('cache_dir' => PATH_CACHE); 
			
		Zend_Registry::set('cacheCore', Zend_Cache::factory($frontend, $backend, $frontendOptions, $backendOptions));
		Zend_Registry::get('cacheCore')->clean(Zend_Cache::CLEANING_MODE_OLD);
        
//		TRAITEMENT 
// =====================================================================

		// Créée un flag pour la sécurité des includes
		Define('IN_CLI', true); 
		
		// Créée un tableau des processus autorisés
		$processes = array ( 'default.php', 'buildSearchIndex.php', 'searchIndex.php', 'rssGrabber.php' );
		
		// Récupère les options passées en ligne de commande
	
		try {
			$opts = new Zend_Console_Getopt( 'p:s');
			$process = $opts->p;
            //print( 'EXECUTION EN COURS'.CRLF );
		} catch (Zend_Console_Getopt_Exception $e) {
			$logger->log("cli.php a retourné l'erreur suivante :\n $e", Zend_Log::EMERG);
			print( 'FIN DE L\'EXECUTION : 1 erreur est survenue '.CRLF );
			print( '_______________________________________________________________'.CRLF );
			print( CRLF );
			exit;
		}
		
		// Test si process  est autorisé
		if ( in_array( $process, $processes )) {
			require_once( PATH_CLIAPPS . $process );
		}
		else {
			$logger->log("cli.php a retourné l'erreur suivante : Le processus $process n'est pas un processus autorisé.", Zend_Log::EMERG);
			print( 'FIN DE L\'EXECUTION : 1 erreur est survenue '.CRLF );
			print( '_______________________________________________________________'.CRLF );
			print( CRLF );
			exit;
		} 

		
//		FIN DU TRAITEMENT -CONCLUSION POUR SORTIE ECRAN
// =====================================================================

		$endTime = microtime(true);

		//print( 'FIN DE L\'EXECUTION'.CRLF );
		//print( 'Exécution en ' . round($endTime - $startTime, 4) .' sec' .CRLF );
		//print( '_______________________________________________________________'.CRLF );
		//print( CRLF );
		exit;

