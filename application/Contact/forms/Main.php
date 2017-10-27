<?php

class Contact_Form_Main extends Zend_Form
{

    public $elementDecorators = array(
        'ViewHelper',
        array(array('row' => 'HtmlTag'), array('tag' => 'p')),
    );

    public $buttonDecorators = array(
        'ViewHelper',
        array(array('row' => 'HtmlTag'), array('tag' => 'p')),
    );

    
    public function init()
    {
        $this->setName('contactForm');

        $fromTitle = new Zend_Form_Element_Select('fromTitle');
        $fromTitle  ->setLabel('Civilité :')
                    ->setMultiOptions(array('M'=>'M', 'Mme'=>'Mme', 'Melle'=>'Melle'))
                    ->setRequired(true)
                    ->addValidator(new Zend_Validate_NotEmpty());

              
        $fromName = new Zend_Form_Element_Text('fromName');
        $fromName   ->setLabel('Votre nom :')
                    ->setRequired(true)
                    ->addValidator(new Zend_Validate_Alnum( true ))
                    ->addValidator(new Zend_Validate_StringLength( array( 'min' => 3, 'max' => 40 )))
                    ->addValidator(new Zend_Validate_NotEmpty())
                    ->addFilter(new Zend_Filter_StripTags);
        
        
        $fromEmail = new Zend_Form_Element_Text('fromEmail');
        $fromEmail  ->setLabel('Votre e-mail:')
                    ->setRequired(true)
                    ->addValidator(new Zend_Validate_EmailAddress())
                    ->addFilter(new Zend_Filter_StringToLower());
        
        $message = new Zend_Form_Element_Textarea('message');
        $message    ->setLabel('Votre message :')
                    ->setValue('')
                    ->addValidator(new Zend_Validate_NotEmpty())
                    ->addFilter(new Zend_Filter_StripTags);
                        
        $pubKey     = '6Lfg5N4SAAAAAFGJ6gT6irG0mrjYMWRUy7tkEECl';
		$privKey    = '6Lfg5N4SAAAAAE0g3gyiz8_btO52O91WVrfMaP88';
        $params     = array(
                        'ssl' => false,
                        'error' => null, 
                        'xhtml' => false 
                        );
        $options = array( 'theme' => 'white', 'lang' => 'fr' );
		$recaptcha = new Zend_Service_ReCaptcha($pubKey, $privKey, $params, $options);
 
		$adapter = new Zend_Captcha_ReCaptcha();
		$adapter->setService($recaptcha);
 
		$captcha = new Zend_Form_Element_Captcha('recaptcha', array( 'label' => "Anti-spam :", 'captcha' => $adapter));

        $submit = new Zend_Form_Element_Submit('send');
        $submit     ->setIgnore( true )
                    ->setLabel( 'Envoyer');
 
        $this->addElements(array(
            $fromTitle,
            $fromName,
            $fromEmail,
            $message,
            $captcha,
            $submit
        ));
 
        
        $this->setDecorators(array(
            'FormElements',
            //'Fieldset',
            'Form'
        ));
        


    }
}