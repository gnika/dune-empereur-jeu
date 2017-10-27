<?php

// Vérification de la version de PHP
$required = array(  'pdo_mysql',
					'simplexml'
			     );
				 
foreach( $required as $ext ) {
	if(!extension_loaded($ext)){
		die( 'L\'extension ' . $ext . ' n\'est pas installée.');
	}
}


require_once 'application/application.php';
// $application = new Application( 'dev' );
$application = new Application( 'prod' );
$application->run();
