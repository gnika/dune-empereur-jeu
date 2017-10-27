<?php

class Customer_Form_Newpassword extends Zend_Form
{

    private $_token = '';
    private $_uid   = '';
    
    public function __construct( $uid = '', $token = '' )
    {
        $this->_uid = $uid;
        $this->_token = $token;
        $this->init();
    }
    
    public function init()
    {
           
        $pwd1   = new Zend_Form_Element_Password('pwd1');
        $pwd1  ->class = 'formpassword';
        $pwd1  ->setLabel('Entrez le nouveau mot de passe :')
                ->setRequired(true)
                ->addValidator(new Zend_Validate_Alnum())
                ->addValidator(new Zend_Validate_StringLength( array( 'min' => 6)));
        
        $pwd2   = new Zend_Form_Element_Password('pwd2');
        $pwd2  ->class = 'formpassword';
        $pwd2  ->setLabel('Confirmez le mot de passe :')
                ->setRequired(true)
                ->addValidator(new Zend_Validate_Alnum())
                ->addValidator(new Zend_Validate_StringLength( array( 'min' => 6)));
        
        $token  = new Zend_Form_Element_Hidden('token');
        $token  ->setRequired(true)
                ->setValue( $this->_token )
                ->addValidator(new Zend_Validate_Alnum())
                ->addValidator(new Zend_Validate_StringLength( array( 'min' => 32, 'max' => 32 )));
                
        $uid  = new Zend_Form_Element_Hidden('uid');
        $uid  ->setRequired(true)
              ->setValue( $this->_uid )
              ->addValidator(new Zend_Validate_Int());
        
        $source = new Zend_Form_Element_Hidden('source');
        // Défini la page de redirection après validation du formulaire (deux cas : avec ou sans sous répertoire dans l'URL)
        if (Zend_Registry::get('config')->rewriteBase != '/'){
            $source->setValue( URL_MAIN_ABS . substr($_SERVER['REQUEST_URI'], strlen(Zend_Registry::get('config')->rewriteBase), strlen($_SERVER['REQUEST_URI'])) );
        }
        else {
            $source->setValue( URL_MAIN_ABS . substr($_SERVER['REQUEST_URI'], 1, strlen($_SERVER['REQUEST_URI'])) );
        }
        
        $submit = new Zend_Form_Element_Submit('login');
        $submit->class = 'formsubmit';
        $submit->setLabel(' Enregistrer mon nouveau mot de passe ');
 
        $this->addElements(array(
            $pwd1,
            $pwd2,
            $submit,
            $token,
            $uid,
            $source
        ));
 
        $this->setDecorators(array(
            'FormElements',
            'Form'
        ));
    }
    
}