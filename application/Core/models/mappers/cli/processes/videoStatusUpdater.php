<?php 
$Video 		= new Video();

// Liste les vidéos en attente de validation Youtube ( status = 2 )
$pendings	= $Video->fetchPendingVideoEntries();

// Connexion au service Youtube
$serviceName 		= Zend_Gdata_YouTube::AUTH_SERVICE_NAME;
$userName			= $config->services->youtube->username;
$password 			= $config->services->youtube->password;
$authenticationURL	= $config->services->youtube->authenticationUrl;	
$source				= $config->services->source;	
$developerKey		= $config->services->youtube->apiKey;	
$httpClient 		= Zend_Gdata_ClientLogin::getHttpClient(
	                        $userName,
	                        $password,
	                        $serviceName,
	                        $client = null,
	                        $source,
	                        $loginToken = null,
	                        $loginCaptcha = null,
	                        $authenticationURL);	  
$httpClient->setHeaders('X-GData-Key', 'key='.$developerKey.'');

try {
	$service			= new Zend_Gdata_YouTube( $httpClient );
}
catch ( Zend_Gdata_App_HttpException $e1 ) {}



if ( !$e1 ) {

	foreach ( $pendings as $pendingVideo ) {

		try {
			$videoEntry	= $service->getVideoEntry( $pendingVideo->videoSource );
		}
		catch ( Zend_Gdata_App_HttpException $e2 ) { }

		if ( !$e2 ) {
			$mediaTitle 		= $videoEntry->getVideoTitle();
			$mediaDescription 	= $videoEntry->getVideoDescription();
			$videoThumbnails 	= $videoEntry->getVideoThumbnails();
			$videoThumbnail 	= $videoThumbnails[0]['url'];
			
			
			$parentObjectId	= SiteObject::getSiteObjectParentIdBySiteObjectRef( 'VIDEO_ENTRY' ); 
			$parentId		= SiteTree::getSiteTreeParentIdBySiteObjectId( $parentObjectId );
			$siteObjectId	= SiteObject::getSiteObjectIdBySiteObjectRef( 'VIDEO_ENTRY' );
			
			$data			= array ( 	
									'videoThumbnail'	=> $videoThumbnail,
									'videoStatus'	=> 1
							);	

			$dataSiteTree 	= array ( 	
									'siteObjectId'	=> $siteObjectId,
									'controller'	=> 'video',
									'action'		=> 'view',
									'urlSegment'	=> 'video-' . $pendingVideo->videoSource . '.html',
									'parentId'		=> $parentId,
									'published'		=> 1,
									'metaTitle'		=> $mediaTitle,
									'metaDesc'		=> $mediaDescription,
									'videoId'		=> $pendingVideo->videoId,
									'htmlTitle'		=> $mediaTitle,
									'htmlContent'	=> $mediaDescription,
									'showInSearch' 	=> 1,
									'creationTime'	=> date('Y-m-d H:i:s'),
									);				

			$Video->updateVideoEntry( $pendingVideo->videoId, $data );
			$Video->insertSiteTreeVideoEntry( $dataSiteTree );

		}
		else {
			if ( $pendingVideo->videoCheckPass < 4 ) {
				$data 			= array ( 'videoCheckPass'	=> $pendingVideo->videoCheckPass + 1 ); 							
				$Video->updateVideoEntry( $pendingVideo->videoId, $data, $dataSiteTree);
			}
			else {
				$data 			= array ( 'videoStatus'	=> 3 ); 			
				$Video->updateVideoEntry( $pendingVideo->videoId, $data, $dataSiteTree );
			}
		}
	}
}

 