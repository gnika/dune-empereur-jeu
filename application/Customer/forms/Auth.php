<?php

 class App_Validate_PasswordMatch extends Zend_Validate_Abstract  

 {  

     const PASSWORD_MISMATCH = 'passwordMismatch';  

     protected $_compare;  

     protected $_messageTemplates = array(  

         self::PASSWORD_MISMATCH => "Les mots de passe ne sont pas identique" 

     );  
     public function __construct($compare){  

         $this->_compare = $compare;  
     }  

     public function isValid($value){  

         $this->_setValue((string) $value);  

         if ($value !== $this->_compare)  {  

             $this->_error(self::PASSWORD_MISMATCH);  

             return false;  

         }  

         return true;  

     }  

 } 

class Customer_Form_Auth extends Zend_Form
{
    public $elementDecorators = array(
        'ViewHelper',
        array(array('row' => 'HtmlTag'), array('tag' => 'p')),
    );

    public $buttonDecorators = array(
        'ViewHelper',
        array(array('row' => 'HtmlTag'), array('tag' => 'p')),
    );
    
    public function __construct($options = null)
	{
		parent::__construct($options);

		$this->setName('contactForm');
        
       
		  
		$hidden1 = new Zend_Form_Element_Hidden("hidden1");
		$hidden1 ->setLabel('');
		
		$hidden2 = new Zend_Form_Element_Hidden("hidden2");
		$hidden2 ->setLabel('');
		
		$hidden3 = new Zend_Form_Element_Hidden("hidden3");
		$hidden3 ->setLabel('');
		  
		$login = new Zend_Form_Element_Text("login");
		$loginDoesntExist = new Zend_Validate_Db_NoRecordExists('customer_user', 'cuu_login');
		$login ->setLabel('Login')
		  ->addFilter('StripTags')
		  ->addFilter('StringTrim')
		  ->setRequired(true)
		  ->addValidator('NotEmpty')
		  ->addValidator($loginDoesntExist)
		  ->addValidator('StringLength', false, 3, 20)
		  ->setDescription("Login entre 3 et 20 caracteres");
		  
		

        $email = new Zend_Form_Element_Text("email");
		$emailDoesntExist = new Zend_Validate_Db_NoRecordExists('customer_user', 'cuu_email');
		$email ->setLabel('Email')
		  ->setRequired(true)
		  ->addFilter('StripTags')
		  ->addFilter('StringTrim')
		  ->setRequired(true)
		  ->addValidator('NotEmpty')
		  ->addValidator($emailDoesntExist)
		  ->addValidator('EmailAddress')
		  ->setDescription("inserez une adresse mail valide.");

		$password = new Zend_Form_Element_Password("password");
		$password ->setLabel('Mot de passe')
		  ->setRequired(true)
		  ->addFilter('StringTrim')
		  ->addValidator('NotEmpty');

		$repassword = new Zend_Form_Element_Password("repassword");
		$repassword ->setLabel('Vérification Mot de passe')
		  ->setLabel("retapez votre mot de passe pour eviter les erreurs")
		  ->setRequired(true)
		  ->addFilter('StringTrim')
		  ->addValidator('NotEmpty');
        
		$submit = new Zend_Form_Element_Submit('send');
        $submit     ->setIgnore( true )
                    ->setLabel( 'VALIDER MON INSCRIPTION');


		$pubKey     = '6LeR27kSAAAAALIzCqIEt5RXdHTfTPKqc7OmuAfA';
		$privKey    = '6LeR27kSAAAAAF9nXvsdP57eTZSVQYKRebOhZjo4';
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
		// $this->addElements(array($hidden1, $login, $hidden2, $password, $repassword, $hidden3, $captcha, $submit));
		$this->addElements(array($hidden1, $login, $hidden2, $email, $password, $repassword, $hidden3, $submit));
        $this->setDecorators( array( array('ViewScript', array('viewScript' => 'auth/registerform.phtml'))));
		$this->setDecorators(array(
            'FormElements',
            //'Fieldset',
            'Form'
        ));
		
	}

	public function isValid($data)
  {
        $this->getElement('password')->addValidator(new App_Validate_PasswordMatch($data['repassword']));  

         if ($this->getElement('login')->getValue() == $data['login']){  

                 $this->getElement('login')->removeValidator ( "Zend_Validate_Db_NoRecordExists" );  

         }
		 
		 if ($this->getElement('email')->getValue() == $data['email']){  

                 $this->getElement('email')->removeValidator ( "Zend_Validate_Db_NoRecordExists" );  

         }

		return parent::isValid($data);
  }

}