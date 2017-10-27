<?php

class ErrorController extends Zend_Controller_Action
{

    private $_exception;
    
    public function errorAction()
    {
        $this->_exception              = $this->_getParam('error_handler');
        $this->view->exception         = $this->_exception;
        
        switch ($this->_exception->type) {
                case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER:
                case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION:
                    $httpCode = 404;
                    $errorMessage = 'Page inexistante';
                break;
                case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_OTHER:
                    switch (get_class($this->_exception->exception)) {
                        case 'Zend_View_Exception' :
                            $httpCode = 500;
                            $errorMessage = 'Erreur de vue';
                        break;
                        case 'Zend_Controller_Action_Exception' :
                            $httpCode = 401;
                            $errorMessage = 'Erreur de droits';
                        break;
                        default:
                            $httpCode = 500;
                            $errorMessage = 'Erreur inconnue';
                        break;
                    }
                break;
            }
       // $this->_helper->layout->setLayout('error');
        $this->getResponse()->setHttpResponseCode($httpCode);
        $this->view->errorCode = $httpCode;
        $this->view->errorMessage = $errorMessage;
        
        // Utilisation du log fichier journal
        $log = Zend_Registry::get('errorLog');
        $log->warn( $this->_exception->exception->getMessage() . "\n" .  $this->_exception->exception->getTraceAsString() . "\n-----------------------------" );
        
        // Utilisation du log firebug (nécessite le plugin firephp) 
        $log2 = Zend_Registry::get('firebugLog');
        $log2->warn( $this->_exception->exception->getMessage() . "\n" .  $this->_exception->exception->getTraceAsString() . "\n-----------------------------");
    }

}