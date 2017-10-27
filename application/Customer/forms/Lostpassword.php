<?php

class Customer_Form_Lostpassword extends Zend_Form
{
    public function init()
    {
           
        $email  = new Zend_Form_Element_Text('email');
        $email  ->class = 'formtext';
        $email  ->setLabel('Votre adresse e-mail :')
                ->setRequired(true)
                ->addValidator(new Zend_Validate_EmailAddress())
                ->addFilter(new Zend_Filter_StringToLower());
        
        
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
        $submit->setLabel(' Demander la modification de mon mot de passe ');
 
        $this->addElements(array(
            $email,
            $submit,
            $source
        ));
 
        $this->setDecorators(array(
            'FormElements',
            'Form'
        ));
    }
}