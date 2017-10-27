<?php

class Produit_BasketController extends Application_Controller_Action
{
    private $_auth;

    public function init() {
       
    }
    
	
	public function ajoutpanierAction ()
	{
        $uniteId  = $this->getRequest()->getParam('id_unite');
        $demandeUnite  = $this->getRequest()->getParam('demandeUnite');
		$redirect   = $this->getRequest()->getParam('redirect');
        
        $form = new Produit_Form_NombreUnite();
        // Si une validation a échoué, redirige vers la page depuis laquelle le formulaire a été envoyé

                if (!$form->isValid($_POST)) {
            $errors = $form->getErrors();
            $this->addSystemError( 'L\'envoi du message a échoué pour les raisons suivantes :' );
            foreach( $errors as $key => $error ) {
                if ( 0 != count($error) ){
                    switch ($key){
                        case 'demandeUnite' :
                            $this->addSystemError('<span class="small">- Le champs est vide ou contient des caractères invalides</span>');
                            break;
                        default :
                            $this->addSystemError('<span class="small">- Le formulaire contient des données invalides</span>');
                            break;
                    }
                }
            }
                    $this->_redirect( URL_MAIN_ABS . 'Produit/index/index' , array( 'exit' => true, 'code'=> 301) );
        }

        
		$Basket     = new Produit_Model_Basket();
        $Basket->addProduct($uniteId, $demandeUnite);
		$this->_redirect( URL_MAIN_ABS . substr($redirect, 1, strlen($redirect)), array( 'exit' => true, 'code'=> 301) );
	}
    
    public function basketwidgetAction()
	{
        $Basket                 = new Produit_Model_Basket();
        $this->view->basket     = $Basket;         
	}
    
    public function basketAction()
	{
        $this->_auth                = Zend_Auth::getInstance();
        if($this->_auth->hasIdentity()){
            $form   = new Produit_Form_Main();
            $form   ->setAction( URL_MAIN_ABS . 'Produit/Basket/basketenvoi' )
                    ->setMethod( 'post' )
                    ->setAttrib( 'id', 'envoiForm' );
                    
            $this->view->form = $form;
        }
        $Basket                 = new Produit_Model_Basket();
        $this->view->basket     = $Basket;         
	}

    public function clearbasketAction()
	{
        $redirect=$this->getRequest()->getParam('redir');
        $Basket                 = new Produit_Model_Basket();
        $Basket->clear();      
        $this->_redirect( URL_MAIN_ABS . substr($redirect, 1, strlen($redirect)), array( 'exit' => true, 'code'=> 301) );        
	}
    
    public function basketenvoiAction()
	{
        $form   = new Produit_Form_Main();
        if( !$this->getRequest()->isPost() ) {
            $this->addSystemError('Méthode non autorisée.');
            $this->_redirect(URL_MAIN_ABS . 'Produit/index/index', array( 'exit' => true, 'code'=> 301) );
        }
        $Basket = new Produit_Model_Basket();
        $uniteTable     = new Produit_Model_Mapper_UserUnite();
        foreach( $Basket->getItems() as $item ){
            $unite       = new Produit_Model_UserUnite();  

        if($uniteTable->save($unite, $item) ===false)
                     $false=1;
        }
        if(isset($false))
        {
            $this->_redirect(URL_MAIN_ABS . 'Produit/index/index', array( 'exit' => true, 'code'=> 301) );
        }
        $Basket                 = new Produit_Model_Basket();
        $Basket->clear();
        $this->addSystemSuccess('achat confirmé');
        $this->_redirect(URL_MAIN_ABS . 'Produit/index/index', array( 'exit' => true, 'code'=> 301) );
    }
    
    public function ajoutbatimentAction ()
	{
        $batimentId  = $this->getRequest()->getParam('id_batiment');
		$redirect   = $this->getRequest()->getParam('redirect');
        
        $form = new Produit_Form_Batiment();
        // Si une validation a échoué, redirige vers la page depuis laquelle le formulaire a été envoyé

                if (!$form->isValid($_POST)) {
            $errors = $form->getErrors();
            $this->addSystemError( 'L\'envoi du message a échoué pour les raisons suivantes :' );
            //print_r($errors);die();
            foreach( $errors as $key => $error ) {
                if ( 0 != count($error) ){
                    switch ($key){
                        default :
                            $this->addSystemError('<span class="small">- Le formulaire contient des données invalides</span>');
                            break;
                    }
                }
            }
                    $this->_redirect( URL_MAIN_ABS . 'Produit/index/index' , array( 'exit' => true, 'code'=> 301) );
        }

        
		$Batiment     = new Produit_Model_Batiment();
        $BasketTable=new Produit_Model_Mapper_UserBatiment();
        
        if($BasketTable->save($Batiment, $batimentId) ===false)
        $this->_redirect(URL_MAIN_ABS . 'Produit/index/index', array( 'exit' => true, 'code'=> 301) );

        $this->addSystemSuccess('construction confirmée');
		$this->_redirect( URL_MAIN_ABS . substr($redirect, 1, strlen($redirect)), array( 'exit' => true, 'code'=> 301) );
	}

    public function ajoutmagieAction ()
	{
        $magieId  = $this->getRequest()->getParam('id_magie');
		$redirect   = $this->getRequest()->getParam('redirect');
        
        $form = new Produit_Form_Magie();
        // Si une validation a échoué, redirige vers la page depuis laquelle le formulaire a été envoyé

                if (!$form->isValid($_POST)) {
            $errors = $form->getErrors();
            $this->addSystemError( 'L\'envoi du message a échoué pour les raisons suivantes :' );
            //print_r($errors);die();
            foreach( $errors as $key => $error ) {
                if ( 0 != count($error) ){
                    switch ($key){
                        default :
                            $this->addSystemError('<span class="small">- Le formulaire contient des données invalides</span>');
                            break;
                    }
                }
            }
                    $this->_redirect( URL_MAIN_ABS . 'Produit/index/index' , array( 'exit' => true, 'code'=> 301) );
        }

        
		$Magie     = new Produit_Model_Magie();
        $BasketTable=new Produit_Model_Mapper_UserMagie();
        
        if($BasketTable->save($Magie, $magieId) ===false)
        $this->_redirect(URL_MAIN_ABS . 'Produit/index/index', array( 'exit' => true, 'code'=> 301) );

        $this->addSystemSuccess(' achat sort confirmée');
		$this->_redirect( URL_MAIN_ABS . substr($redirect, 1, strlen($redirect)), array( 'exit' => true, 'code'=> 301) );
	}
}  