<?php

class Application_Controller_Plugin_CheckAuth extends Zend_Controller_Plugin_Abstract
{    

    public function dispatchLoopStartup(Zend_Controller_Request_Abstract $request)
    {
    
        $Auth           = Zend_Auth::getInstance();
        // tableau contenant les actions non soumises à une authentification
        $exceptions     = array( 'Produit/user/login', 
                                 'Produit/user/process'
                                );  
        // Si l'action  demandée n'est pas dans le tableau des exceptions, vérifie que l'utilisateur est bien authentifié
        $requestPath = $request->getModuleName() . '/' . $request->getControllerName() . '/' . $request->getActionName();
        if ( !in_array(  $requestPath , $exceptions ) )
        { 
            if (!$Auth->hasIdentity()) {
                $request -> setControllerName('user')
                         -> setActionName('login')
                         -> setModuleName('Produit')
                         -> setDispatched(true);
            }
        }
        
    }
    
}