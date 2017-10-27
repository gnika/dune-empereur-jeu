<?php

 class App_Validate_PasswordMatch extends Zend_Validate_Abstract  

 {  

     const PASSWORD_MISMATCH = 'passwordMismatch';  

     protected $_compare;  

     protected $_messageTemplates = array(  

         self::PASSWORD_MISMATCH => "PASSWORD_MISMATCH" 

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
        
        $name = new Zend_Form_Element_Text("name");
		$name ->setLabel('Prenom')
		  ->addFilter('StripTags')
		  ->addFilter('StringTrim')
		  ->addValidator('NotEmpty')
		  ->addValidator('StringLength', false, 3, 20)
		  ->setDescription("Prenom entre 3 et 20 caracteres.");
		  
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
		  ->addValidator('NotEmpty')
		  ->addValidator($loginDoesntExist)
		  ->addValidator('StringLength', false, 3, 20)
		  ->setDescription("Login entre 3 et 20 caracteres.");
		  
		

        $file = new Zend_Form_Element_File('file');
       /*$file->setLabel('Upload une image:')
                 ->setDestination(PATH_ROOT.'images/user');

        // Fait en sorte qu'il y ait un seul fichier
        $file->addValidator('Count', false, 1);
        // limite à 100K
        $file->addValidator('Size', false, 102400);
        $file->setMaxFileSize(102400);
        // seulement des JPEG, PNG, et GIFs
        $file->addValidator('Extension', false, 'jpg,png,gif');  
        */
		$emailDoesntExist = new Zend_Validate_Db_NoRecordExists('customer_user', 'cuu_email');
		$email = new Zend_Form_Element_Text("email");
		$email ->setLabel('Email address')
		  ->setRequired(true)
		  ->addFilter('StripTags')
		  ->addFilter('StringTrim')
		  ->addValidator('NotEmpty')
		 	->addValidator($emailDoesntExist)
		  ->addValidator('EmailAddress')
		  ->setDescription("inserez une adresse mail valide.");

		$password = new Zend_Form_Element_Password("password");
		$password ->setLabel('Password')
		  ->setRequired(true)
		  ->addFilter('StringTrim')
		  ->addValidator('NotEmpty');

		$repassword = new Zend_Form_Element_Password("repassword");
		$repassword ->setLabel('Retype password')
		  ->setRequired(true)
		  ->addFilter('StringTrim')
		  ->addValidator('NotEmpty');
		$repassword->setDescription("retapez votre mot de passe pour eviter les erreurs.");
        
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
		$this->addElements(array($hidden1, $name, $login, $hidden2, $email, $password, $repassword, $file, $hidden3, $captcha, $submit));
		// $this->addElements(array($name, $login,$email, $password, $repassword, $file));
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

         if ($this->getElement('email')->getValue() == $data['email']){  

                 $this->getElement('email')->removeValidator ( "Zend_Validate_Db_NoRecordExists" );  

         }

		return parent::isValid($data);
  }

}