<?php

class Application_View_Helper_Rewrite extends Zend_View_Helper_Abstract
{
    function rewrite( $internalUri )
    {
        $cache          = Zend_Registry::get('cache');
        $cache_id       = 'link_'.md5( $internalUri );
        
        if ( !($externalUrl = $cache->load( $cache_id )) ) {
            $Url        = new Core_Model_Urlrewrite();
            $UrlMapper  = new Core_Model_Mapper_Urlrewrite();
            
            $UrlMapper->getExternalUri( $internalUri, $Url );
            if( $Url->getRequestpath() ){
                $externalUrl    = $Url->getRequestpath();
                $externalUrl    = $externalUrl != '' ? $externalUrl : $internalUri;
                $cache->save( $externalUrl );
            }
            else{
                return $internalUri;
            }
        }
        return $externalUrl;
        
    }
}