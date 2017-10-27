<?php

class Customer_Form_Login extends Zend_Form
{
    public function init()
    {
       
        $username = new Zend_Form_Element_Text('username');
        $username->class = 'formtext';
        $username->setLabel('Votre identifiant :')
                 ->setDecorators(array(
                     array('ViewHelper',
                           array('helper' => 'formText')),
                     array('Label',
                           array('class' => 'label'))
                 ));
        $username->setRequired(true);
        $username->addValidator(new Zend_Validate_Alnum());
        
        
        $password = new Zend_Form_Element_Password('password');
        $password->class = 'formtext';
        $password->setLabel('Votre mot de passe :')
                 ->setDecorators(array(
                     array('ViewHelper',
                           array('helper' => 'formPassword')),
                     array('Label',
                           array('class' => 'label')),
                 ));
        $password->setRequired(true);
        $password->addValidator(new Zend_Validate_Alnum());
        
        
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
        $submit->setLabel(' Connexion ')
               ->setDecorators(array(
                   array('ViewHelper',
                   array('helper' => 'formSubmit'))
               ));
 
        $this->addElements(array(
            $username,
            $password,
            $source,
            $submit
        ));
 
        $this->setDecorators(array(
            'FormElements',
            'Form'
        ));
    }
}