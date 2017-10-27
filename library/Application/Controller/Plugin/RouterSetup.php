<?php

class Application_Controller_Plugin_RouterSetup extends Zend_Controller_Plugin_Abstract
{    

    public function dispatchLoopStartup(Zend_Controller_Request_Abstract $request)
    {
        $url           = substr( $request->getRequestUri(), strlen( Zend_Registry::get('config')->rewriteBase ) );
        $redirector    = new Zend_Controller_Action_Helper_Redirector();
        
        // Si l'URL est vide, réécrit vers index.html
        if ( $url == ''  ){
            $url = 'index.html' ;
            $redirector->setCode( 301 )
                       ->setExit( true )
                       ->gotoUrl( $url );
        }
        
        // Sépare l'adresse de la page et les éventuelles variables GET
        $target = preg_split( "/[\s?]+/", $url );

        // Vérifie si la partie fixe de l'URL ( $target[0] ) est une adresse réécrite et si oui, récupère l'adresse non réécrite
        $Url           = new Core_Model_Urlrewrite();
        $UrlMapper     = new Core_Model_Mapper_Urlrewrite();
        
        $UrlMapper->getInternalUri( $target[0], $Url );

        // Si il y a bien une adresse non réécrite correspondante
        if (  is_object( $Url ) && $targetUri = $Url->getResponsepath() ) { 
            $request->setPathInfo( $targetUri  );
            // Si il y a des variables GET, les ajoute au pathinfo
            if ( @$target[1] ) {
                parse_str( $target[1], $query);
                foreach( $query as $key => $value ) {
                   $targetUri .= '/'.$key.'/'.$value;
                }
                $request->setPathInfo( $targetUri );
            }
            // Applique l'objet request modifié au routeur
            $router = new Zend_Controller_Router_Rewrite();
            $router->route( $request );
        }
        // sinon, l'adresse demandée est déjà une adresse non réécrite
        else {
            // Vérifie si il existe une réécriture correspondant à cette adresse non réécrite
            $UrlMapper->getExternalUri( $url, $Url );

            // Si oui, effectue une redirection de type 301 ou 302 en fonction de $sourceUri->response_code
            if ( is_object( $Url ) && $sourceUri = $Url->getRequestpath() ) {
                $redirector->setCode( intval($Url->getResponsecode() ) )
                           ->setExit( true )
                           ->gotoUrl( $sourceUri );
            }
        }

    }
}