<?php 
$Serp = new Serp();
		
if ( $Serp->checkDate() ) {

	$pos = $Serp->isInGoogle( $config->serp->kw1, $config->serp->url, '20' );
	$Serp->save( $config->serp->kw1, $pos, 'google'); 

	$pos = $Serp->isInGoogle( $config->serp->kw2, $config->serp->url, '20' );
	$Serp->save( $config->serp->kw2, $pos, 'google'); 

	$pos = $Serp->isInGoogle( $config->serp->kw3, $config->serp->url, '20' );
	$Serp->save( $config->serp->kw3, $pos, 'google');
				
	$pos = $Serp->isInGoogle( $config->serp->kw4, $config->serp->url, '20' );
	$Serp->save( $config->serp->kw4, $pos, 'google'); 

	$pos = $Serp->isInGoogle( $config->serp->kw5, $config->serp->url, '20' );
	$Serp->save( $config->serp->kw5, $pos, 'google');

	$Serp->clearDb();
	$logger->log("ANALYSE DES SERPS (batch/serpanalyser.php) a été exécuté avec succès", Zend_Log::INFO);
 }
else {
	$logger->log("ANALYSE DES SERPS (batch/serpanalyser.php) a été exécuté avec succès mais aucun enregistrement n'a été modifié", Zend_Log::INFO);
}