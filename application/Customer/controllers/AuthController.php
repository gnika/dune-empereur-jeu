<?php

class Customer_AuthController extends Application_Controller_Action
{
  
  private $_auth;
  private $_customer;
  

  /**
     * initAction
     * 
     * @return void
     */
    public function init() 
    {
        $this->_auth                = Zend_Auth::getInstance();
    }
  /**
     * preDispatch
     * 
     * @return void
     */
	function preDispatch()
	{
		
	}
    
  /**
     * preDispatch
     * 
     * @return void
     */
	function indexAction()
	{
		$this->_redirect( URL_MAIN_ABS . 'Customer/auth/customer' , array( 'exit' => true, 'code'=> 301) );
	}
    
  /**
     * customerwidgetAction
     * 
     * @return void
     */
    public function customerwidgetAction()
    {
		$formData = $this->getRequest();
		$pathI=$formData->getPathInfo();
		if($pathI!='Customer/auth/auth' && $pathI!='/Customer/auth/auth'){
			// Si l'identité n'est pas enregistrée, affiche le formulaire de connexion ( loginform.phtml )
			if( !$this->_auth->getIdentity()->cuu_id){
				// $form = new Customer_Form_Login();
				// $form   ->setAction( URL_MAIN_ABS . 'Customer/auth/dologin' )
						// ->setMethod( 'post' )
						// ->setAttrib('id', 'loginForm');
				// $this->view->form = $form;
				// $this->_helper->viewRenderer->setScriptAction('loginform');
			}
			else{
				$this->view->identity = $this->_auth->getIdentity();
			}
		}else{
		
		$this->view->jojo=1;
		die();
		}
		$this->view->auth=$this->_auth;
    }
    
    public function customerAction()
    {
        // Si l'identité n'est pas enregistrée, affiche le formulaire de connexion ( loginform.phtml )
        if( !$this->_auth->hasIdentity()){
            $form = new Customer_Form_Login();
            $form   ->setAction( URL_MAIN_ABS . 'Customer/auth/dologin' )
                    ->setMethod( 'post' )
                    ->setAttrib('id', 'loginForm');
            $this->view->form = $form;
            $this->_helper->viewRenderer->setScriptAction('loginform');
        }
        else{
            $this->view->identity = $this->_auth->getIdentity();
        }
    }
	
	public function tryagainAction()
	{
		
		$member = $this->_auth->getIdentity();
        if ($member == null) {
            return;
        }
		$idUser=$member->cuu_id;
		
		$user=new Customer_Model_User();
		$user       = new Customer_Model_User();
		$userTable  = new Customer_Model_Mapper_User();
		$userTable->find($idUser, $user);		
		$user->setHeure(1); $user->setVaisseau(15);
		$user->setJour(0); $user->setTroupe(250);
		$user->setEpice(4000); $user->setCorruption(0);
		$user->setImpot(5); $user->setSalle(1);
		$user->setSoin(0); $user->setRenommee(0);
		$user->setServiteur(2);$user->setNbVictime(1);
		$user->setInfluence(2);$user->setValeurServiteur(30);
		$user->setGardien(4);$user->setDelaiAttentat(3);
		$user->setValeurVaisseau(100);$user->setExploration(1);
		$user->setObjets('');
		$user->setRapport('');
		
		$userTable->save($user);
		$userTable->inscription($idUser);
		die();
	}
	
	public function deleteAction(){
		
	}
	
	public function authAction()
    {
			ini_set('error_reporting', E_ALL);
        // $this->view->headLink()->appendStylesheet( URL_MAIN_ABS  . 'css/inscription.css');
        $form = new Customer_Form_Auth;
       
        $this->view->form =$form;
		if($post = $this->_request->isPost()){
			$formData = $this->getRequest()->getPost();
			// print_r($formData);die();
			if($form->isValid($formData)){
				// die('eeee');
                // $form->file->receive();
                $user=new Customer_Model_User();
                $user       = new Customer_Model_User();
                $userTable  = new Customer_Model_Mapper_User();
                $user->setLogin($form->getValue('login'));
                $user->setEmail($formData['email']);
                $user->setPassword($form->getValue('password'));
                $user->setSecuritytoken('');
                $user->setHeure(1); $user->setVaisseau(15);
                $user->setJour(0); $user->setTroupe(250);
                $user->setEpice(4000); $user->setCorruption(0);
                $user->setImpot(5); $user->setSalle(1);
                $user->setSoin(0); $user->setRenommee(0);
                $user->setServiteur(2);$user->setNbVictime(1);
                $user->setInfluence(2);$user->setValeurServiteur(30);
                $user->setGardien(4);$user->setDelaiAttentat(3);
                $user->setValeurVaisseau(100);$user->setExploration(1);
				$user->setObjets('');
				$user->setRapport('');
				$user->setConnexion(date('d-m-Y H:i'));
				// print_r($user);die();
				$userId=$userTable->save($user);
				// die('ee');
				
				$userTable->inscription($userId);//A REMETTRE UBER IMPORTANT
				
/*
                $file = $form->getElement('file');
                $name = $file->getFileName();
                if(empty($name))
                    $name='default_avatar-1989pourdebon.jpg';
                $user->setAvatar('en_cours_de_validation');
				*/
                // $userId=$userTable->save($user);
				
                $securityToken = md5( $user->getEmail() . $userId . date('d') . 'sdbyY7d'  );
                $user->setSecuritytoken( $securityToken );
                
                $user->setId($userId);
                
                /*
                $ext = $ext = substr(strrchr($name,'.'),1);
                $ext = strtolower($ext);
                
                 // mkdir(PATH_ROOT.'images\user\\'.$userId);//version zakor
                 mkdir(PATH_ROOT.'images/user/'.$userId);
                 
				 chmod(PATH_ROOT.'images/user/'.$userId, octdec(777));
				 
                if($name=='default_avatar-1989pourdebon.jpg')
                    // copy( PATH_ROOT.'images\user\default_avatar-1989pourdebon.jpg', PATH_ROOT.'images\user\\'.$userId.'\\'.$userId.'.'.$ext);//version zakor
                    copy( PATH_ROOT.'images/user/default_avatar-1989pourdebon.jpg', PATH_ROOT.'images/user/'.$userId.'/'.$userId.'.'.$ext);
                else
                    // rename($name, PATH_ROOT.'images\user\\'.$userId.'\\'.$userId.'.'.$ext);//version zakor
                    rename($name, PATH_ROOT.'images/user/'.$userId.'/'.$userId.'.'.$ext);
					
					$file = PATH_ROOT.'images/user/'.$userId.'/'.$userId.'.'.$ext ; # L'emplacement de l'image à redimensionner. L'image peut être de type jpeg, gif ou png 

					$x = 100; 

					$y = 100; 

					$size = getimagesize($file); 

					if ($size['mime']=='image/jpeg' ) { 
					$img_big = imagecreatefromjpeg($file); 
					$img_new = imagecreate($x, $y); 
					
					$img_mini = imagecreatetruecolor($x, $y) 
					or   $img_mini = imagecreate($x, $y); 

					// copie de l'image, avec le redimensionnement. 
					imagecopyresized($img_mini,$img_big,0,0,0,0,$x,$y,$size[0],$size[1]); 

					imagejpeg($img_mini,$file ); 

					} 
					elseif ($size['mime']=='image/png' ) { 
					$img_big = imagecreatefrompng($file); e 
					$img_new = imagecreate($x, $y); 
					
					$img_mini = imagecreatetruecolor($x, $y) 
					or   $img_mini = imagecreate($x, $y); 

					// copie de l'image, avec le redimensionnement. 
					imagecopyresized($img_mini,$img_big,0,0,0,0,$x,$y,$size[0],$size[1]); 

					imagepng($img_mini,$file ); 

					} 
					elseif ($size['mime']=='image/gif' ) { 
					$img_big = imagecreatefromgif($file); 
					$img_new = imagecreate($x, $y); 
					
					$img_mini = imagecreatetruecolor($x, $y) 
					or   $img_mini = imagecreate($x, $y); 

					// copie de l'image, avec le redimensionnement. 
					imagecopyresized($img_mini,$img_big,0,0,0,0,$x,$y,$size[0],$size[1]); 

					imagegif($img_mini,$file ); 

					}
					
					
					
					
                $user->setAvatar($userId.'.'.$ext);
                */
                $userTable->save($user);
				
                
                // $mailer = new Application_Mail( 'smtp/tls' , 'UTF-8' );
                // $mailer->setFrom( Zend_Registry::get('config')->mailer->fromEmail ,  Zend_Registry::get('config')->mailer->fromName );
                // $mailer->addTo( $user->getEmail() );
                // $mailer->setSubject( 'Finaliser l\'inscription sur Dune' );
                // $mailer->setBodyText( 'Pour terminer l\'inscription, vous avez entre aujourd\'hui et demain pour cliquer sur le lien suivant : ' .
                              // URL_MAIN_ABS .
                              // 'Customer/auth/verifinscrip/uid/' . $user->getId() . '/token/' . 
                              // $securityToken
                            // );
                // $mailer->setBodyHtml( '<strong>Pour terminer l\'inscription, vous avez entre aujourd\'hui et demain pour cliquer sur le lien suivant :</strong><br />' .
                                      // '<a href="' . URL_MAIN_ABS . 'Customer/auth/verifinscrip/uid/' . $user->getId() . '/token/' . $securityToken . '" >Valider mon compte Dune</a>'
                                      // );
				
                // $mailer->send();
				
				
				/*
				//ESSAI BIDON A EFFACER MAIS  QUI EST SENSE MARCHER
				$config = array('ssl' => 'tls',
                'auth' => 'login',
                'username' => 'moneo.house.atreides@gmail.com',
                'password' => 'sapedtom');

				$transport = new Zend_Mail_Transport_Smtp('smtp.gmail.com', $config);

				$mail = new Zend_Mail();
				$mail->setBodyHtml('eee');
				$mail->setFrom('moneo.house.atreides@gmail.com');
				$mail->addTo('joachim@pulsar-informatique.com', 'joachim');
				$mail->setSubject('Profile Activation');
				$mail->send($transport);
				die('eee');
				*/
				
				 $to      = $user->getEmail();
				 $subject = 'Finaliser l\'inscription sur Dune';
				 $message = 'Pour terminer l\'inscription, vous avez entre aujourd\'hui et demain pour cliquer sur le lien suivant : ' .
                              URL_MAIN_ABS .
                              'Customer/auth/verifinscrip/uid/' . $user->getId() . '/token/' . 
                              $securityToken;
				 $headers = 'From: moneo.house.atreides@gmail.com' . "\r\n" .
				 'Reply-To: moneo.house.atreides@gmail.com' . "\r\n" .
				 'X-Mailer: PHP/' . phpversion();

				 mail($to, $subject, $message, $headers);
				
				
				
				 // echo '<pre>'; print_r($mailer);die();
                
				
				
				
                // Redirection
                // $this->addSystemSuccess( 'Un e-mail vient de vous être adressé. Veuillez suivre les instructions qu\'il contient.');
                // $this->_redirect(URL_MAIN_ABS . 'Customer/auth/customerwidget' , array( 'exit' => true, 'code'=> 301) );
                $this->_redirect(URL_MAIN_ABS.'?inscrit=1' , array( 'exit' => true, 'code'=> 301) );
                
			}else{
				$errors = $form->getErrors();

				$this->addSystemError( 'L\'iinscription a échoué pour les raisons suivantes:<br/>' );
				if(in_array("isEmpty", $errors['login']))
					$this->addSystemError('<span class="small">- Le login est obligatoire</span>');
				elseif(in_array("stringLengthTooShort", $errors['login']))
					$this->addSystemError('<span class="small">- Le login doit être supérieur à 3 caractères et inférieur à 20 caractères</span>');
				if(in_array("recordFound", $errors['login']))
					$this->addSystemError('<span class="small">- Le login est déjà utilisé</span>');
				
				if(in_array("passwordMismatch", $errors['password']))
					$this->addSystemError('<span class="small">- Les mots de passe ne sont pas identiques</span>');
				if(in_array("isEmpty", $errors['password']) || in_array("isEmpty", $errors['repassword']))
					$this->addSystemError('<span class="small">- Le mot de passe est obligatoire</span>');
				
				if(in_array("isEmpty", $errors['email']))
					$this->addSystemError('<span class="small">- L\'email est obligatoire</span>');
				elseif(in_array("emailAddressInvalidFormat", $errors['email']))
					$this->addSystemError('<span class="small">- Vous devez rentrer un format Email</span>');
				elseif(in_array("recordFound", $errors['email']))
					$this->addSystemError('<span class="small">- L\'email est déjà utilisé</span>');
				$form->populate($formData);
			}
		}

    }
	
	public function verifinscripAction()
    {
        $user       = new Customer_Model_User();
        $userTable  = new Customer_Model_Mapper_User();
                    // Récupère, filtre, et vérifie les données GET
        $f              = new Zend_Filter_StripTags();
        $userId         = $f->filter($this->getRequest()->getParam('uid'));
        $securityToken  = $f->filter($this->getRequest()->getParam('token'));

        $userTable->find( $userId, $user );

                    // Teste les valeurs possibles du token pour le jour J et J-1
        
        $uidValidator       = new Zend_Validate_Int();
        $tokenValidator     = new Zend_Validate_Alnum();
        if ( !$uidValidator->isValid( $userId ) || !$tokenValidator->isValid( $securityToken )){
            $this->addSystemError('Méthode non autorisée (1).');
            $this->_redirect( URL_MAIN_ABS , array( 'exit' => true, 'code'=> 301) );
        }
       
        $acceptedTokens = array( md5($user->getEmail() . $user->getId() . date('d')    . 'sdbyY7d'),
                                     md5($user->getEmail() . $user->getId() . date('d')-1  . 'sdbyY7d')
                                    );
									
        // Si le token n'est pas valide, redirige avec une erreur                        
            if ( !in_array(  $securityToken, $acceptedTokens )) {
                $this->addSystemError('Méthode non autorisée (2).');
                $this->_redirect( URL_MAIN_ABS , array( 'exit' => true, 'code'=> 301) );
            }
            // si le token n'est pas dans la base, la modification a déjà eu lieu, redirige avec une erreur
            if ( $user->getSecuritytoken() !== $securityToken ) {
                $this->addSystemError('Méthode non autorisée (3).');
                $this->_redirect( URL_MAIN_ABS , array( 'exit' => true, 'code'=> 301) );
            }
            
        // Si le client est trouvé, vide le jeton de sécurité
        $user->setSecuritytoken( '' );
        $userTable->save( $user );
       
        
        // Redirection
        $this->addSystemSuccess( 'Votre compte a été mis à jour, vous pouvez vous identifier.');
		$this->_redirect(URL_MAIN_ABS , array( 'exit' => true, 'code'=> 301) );                
    }
    
  /**
     * dologinAction
     * 
     * @return void
     */
    public function dologinAction()
    {
   
        // Si le formulaire n'est pas appelé avec la méthode POST, lève une exception
        if (!$this->getRequest()->isPost()) {
            throw new Zend_Controller_Request_Exception( 'Méthode incorrecte' );
        }
        
       
        $form = new Customer_Form_Login();
        // Si une validation a échoué, redirige vers la page depuis laquelle le formulaire a été envoyé
        if (!$form->isValid($_POST)) {
            $errors = $form->getErrors();
            $this->addSystemError( 'L\'identification a échoué pour les raisons suivantes :' );
            foreach( $errors as $key => $error ) {
                if ( 0 != count($error) ){
                    switch ($key){
                        case 'username' :
                            $this->addSystemError('<span class="small">- Votre identifiant est vide ou contient des caractères invalides</span>');
                            break;
                        case 'password' :
                            $this->addSystemError('<span class="small">- Votre mot de passe est vide ou contient des caractères invalides</span>');
                            break;
                        default :
                            $this->addSystemError('<span class="small">- Le formulaire contient des données invalides</span>');
                            break;
                    }
                }
            }
            $this->_redirect( $form->getValue('source') , array( 'exit' => true, 'code'=> 301) );
        }
 
        // Si aucune validation n'a échoué, tente d'identifié le client
        // $authAdapter = new Zend_Auth_Adapter_DbTable( Zend_Registry::get('db') );
		// $authAdapter->setTableName('customer_user')
					// ->setIdentityColumn('cuu_login')
					// ->setCredentialColumn('cuu_password')
					// ->setIdentity( $form->getValue('username') )
					// ->setCredential( md5( $form->getValue('password') ) );       
		// $result = $this->_auth->authenticate($authAdapter);
		
		
		$authAdapter = new Zend_Auth_Adapter_DbTable(
			Zend_Registry::get('db'),
			'customer_user',
			'cuu_login',
			'cuu_password',
			'MD5(?) AND cuu_securitytoken = ""'
		);

		$authAdapter
			->setIdentity($form->getValue('username'))
			->setCredential($form->getValue('password')); 

		// Peform authentication against database
		$result = $authAdapter->authenticate();
		
		
        
        // On teste le résultat de Zend_Auth
        switch ($result->getCode()) 
		{    
            // En cas d'échec, ajoute un message d'erreur dans la pile et redirige vers la page depuis laquelle le formulaire a été envoyé
			case Zend_Auth_Result::FAILURE_IDENTITY_NOT_FOUND:        
			case Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID:        
				$this->addSystemError( 'L\'identification a échoué' );
                $this->_redirect( $form->getValue('source') , array( 'exit' => true, 'code'=> 301) );
                break;    
            // En cas de succès, enregistre l'identité et redirige vers la page depuis laquelle le formulaire a été envoyé
			case Zend_Auth_Result::SUCCESS:    
                // Récupère l'enregistrement utilisateur en base sauf le champ cuu_password pour des raisons de sécurité
				$data = $authAdapter->getResultRowObject(null, 'cuu_password');
                // Place l'enregistrement dans la session auth
				$this->_auth->getStorage()->write($data);
                $this->_redirect( $form->getValue('source') , array( 'exit' => true, 'code'=> 301) );
                break;    
			default:       
      
			break;
		}


    }   

	public function loginfacebookAction()
    {
   
        // Si le formulaire n'est pas appelé avec la méthode POST, lève une exception
        if (!$this->getRequest()->isPost()) {
            throw new Zend_Controller_Request_Exception( 'Méthode incorrecte' );
        }
        
       $email = $_POST['email'];
       $login = $_POST['login'];
	   
	   $user       = new Customer_Model_User();
       $userTable  = new Customer_Model_Mapper_User();
       $userTable->findByEmail( $email, $user );
		if($user->id!=-1){
			$authAdapter = new Zend_Auth_Adapter_DbTable(
				Zend_Registry::get('db'),
			'customer_user',
			'cuu_login',
			'cuu_password',
			'(?) AND cuu_securitytoken = ""'
			);

			$authAdapter
			->setIdentity($user->getLogin())
			->setCredential($user->getPassword());

			// Peform authentication against database
			$result = $authAdapter->authenticate();
			// echo '<pre>';print_r($result);die();
			
			
			// On teste le résultat de Zend_Auth
			switch ($result->getCode()) 
			{    
				// En cas d'échec, ajoute un message d'erreur dans la pile et redirige vers la page depuis laquelle le formulaire a été envoyé
				case Zend_Auth_Result::FAILURE_IDENTITY_NOT_FOUND:        
				case Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID:        
					$this->addSystemError( 'L\'identification a échoué. Certains comptes Facebook ne permettent pas la connexion via l\'API facebook. Essayez avec google+ ou à la main ' );
					$this->_redirect( $form->getValue('source') , array( 'exit' => true, 'code'=> 301) );
					break;    
				// En cas de succès, enregistre l'identité et redirige vers la page depuis laquelle le formulaire a été envoyé
				case Zend_Auth_Result::SUCCESS:    
					// Récupère l'enregistrement utilisateur en base sauf le champ cuu_password pour des raisons de sécurité
					$data = $authAdapter->getResultRowObject(null, 'cuu_password');
					// Place l'enregistrement dans la session auth
					$this->_auth->getStorage()->write($data);
					echo 'good';die();
					break;    
				default:       
		  
				break;
			}
		}else{
		
		    $this->authRS($email, $login);
			echo 'new';die();
		}
		


    }   
	
	function authRS($email, $login)
    {
       
			$user       = new Customer_Model_User();
			$user2      = new Customer_Model_User();
			$userTable  = new Customer_Model_Mapper_User();
			
			$userTable->findByLogin($login, $user2);
			if($user2->getId()!=-1){
				$login.=rand(10000, 100000);;
			}
			$pass= $login.':'.rand(1250, 10000);
			$user->setLogin($login);
			$user->setEmail($email);
			$user->setPassword($pass);
			$user->setSecuritytoken('');
			$user->setHeure(1); $user->setVaisseau(15);
			$user->setJour(0); $user->setTroupe(250);
			$user->setEpice(4000); $user->setCorruption(0);
			$user->setImpot(5); $user->setSalle(1);
			$user->setSoin(0); $user->setRenommee(0);
			$user->setServiteur(2);$user->setNbVictime(1);
			$user->setInfluence(2);$user->setValeurServiteur(30);
			$user->setGardien(4);$user->setDelaiAttentat(3);
			$user->setValeurVaisseau(100);$user->setExploration(1);
			$user->setObjets('');
			$user->setRapport('');
			$user->setConnexion(date('d-m-Y H:i'));

			$userId=$userTable->save($user);
			
			$userTable->inscription($userId);
			
			$securityToken = md5( $user->getEmail() . $userId . date('d') . 'sdbyY7d'  );
			$user->setSecuritytoken( $securityToken );
			
			$user->setId($userId);
			
			$userTable->save($user);
			
			 $to      = $user->getEmail();
			 $subject = 'Finaliser l\'inscription sur Dune';
			 $message = 'Pour terminer l\'inscription, vous avez entre aujourd\'hui et demain pour cliquer sur le lien suivant : ' .
						  URL_MAIN_ABS .
						  'Customer/auth/verifinscrip/uid/' . $user->getId() . '/token/' . 
						  $securityToken;
			 $headers = 'From: moneo.house.atreides@gmail.com' . "\r\n" .
			 'Reply-To: moneo.house.atreides@gmail.com' . "\r\n" .
			 'X-Mailer: PHP/' . phpversion();

			 mail($to, $subject, $message, $headers);                
			

    }

  /**
     * logoutAction
     * 
     * @return void
     */
    public function logoutAction()
    {	
		$this->_auth = Zend_Auth::getInstance();
        $member = $this->_auth->getIdentity();
		
        $request    = $this->getRequest();
        $redir      = $request->getParam( 'redir' );
        $redir = null === $redir ? URL_MAIN_ABS : urldecode($redir);
        // $this->addSystemSuccess('Vous êtes maintenant déconnecté');
        $this->_auth->clearIdentity();
        $membre=new Zend_Session_Namespace('user');
        $membre->userInfo=null;
        $this->_redirect(  $redir , array( 'exit' => true, 'code'=> 301) );
    }    

    /**
     * lostpasswordAction
     * 
     * @return void
     */
    public function lostpasswordAction()
    {
        // Si l'identité n'est pas enregistrée, affiche le formulaire de récupération de mot de passe ( lostpassword.phtml )
        if( !$this->_auth->hasIdentity()){
            $form = new Customer_Form_Lostpassword();
            $form   ->setAction( URL_MAIN_ABS . 'Customer/auth/dolostpassword' )
                    ->setMethod( 'post' )
                    ->setAttrib('id', 'lostpasswordForm');
            $this->view->form = $form;
        }
        // Sinon, invite le client à modifier son mot de passe sur le formulaire dédié ( editaccount.phtml )
        else{
            $this->addSystemWarning('Vous êtes déjà identifié, vous pouvez modifier votre mot de passe à l\'aide du formulaire ci-dessous.');
            $this->_redirect(  URL_MAIN_ABS . 'Customer/index/editaccount' , array( 'exit' => true, 'code'=> 301) );
        }
    }
    
  /**
     * dolostpasswordAction
     * 
     * @return void
     */
    public function dolostpasswordAction()
    {
   
        // Si le formulaire n'est pas appelé avec la méthode POST, lève une exception
        if (!$this->getRequest()->isPost()) {
            throw new Zend_Controller_Request_Exception( 'Méthode incorrecte' );
        }
        
       
        $form = new Customer_Form_Lostpassword();
        // Si une validation a échoué, redirige vers la page depuis laquelle le formulaire a été envoyé
        if (!$form->isValid($_POST)) {
            $errors = $form->getErrors();
            $this->addSystemError( 'Le processus de récupération de mot de passe a échoué pour les raisons suivantes :' );
            foreach( $errors as $key => $error ) {
                if ( 0 != count($error) ){
                    switch ($key){
                        case 'email' :
                            $this->addSystemError('<span class="small">- Votre adresse e-mail est invalide </span>');
                            break;
                        default :
                            $this->addSystemError('<span class="small">- Le formulaire contient des données invalides</span>');
                            break;
                    }
                }
            }
            $this->_redirect( $form->getValue('source') , array( 'exit' => true, 'code'=> 301) );
        }
 
        // Si aucune validation n'a échoué, tente de trouver l'e-mail dans la base client
       
		
        $user       = new Customer_Model_User();
        $userTable  = new Customer_Model_Mapper_User();
        $userTable->findByEmail( $form->getValue('email'), $user );
        // print_r($user);die();
        // Si aucun utilisateur n'est trouvé en base, redirige sur le formulaire avec un message d'erreur
        if ( $user->getId() == -1 ) {
			$this->addSystemError( 'Cette adresse ne correspond à aucun compte client');
			$this->_redirect(URL_MAIN_ABS . 'Customer/auth/lostpassword', array( 'exit' => true, 'code'=> 301) );
		}

        // Si le client est trouvé, génère un jeton de sécurité
        $securityToken = md5( $user->getEmail() . $user->getId() . date('d') . 'sdbyY7d'  );
        $user->setSecuritytoken( $securityToken );
        $userTable->save( $user );
        
        //puis envoie un mail de modification de mot de passe
        
		
		$to      = $user->getEmail();
				 $subject = 'Récupération de votre mot de passe';
				 $message = 'Pour modifier votre mot de passe, cliquez sur le lien suivant : ' .
                              URL_MAIN_ABS .
                              'Customer/auth/newpassword/uid/' . $user->getId() . '/token/' . 
                              $securityToken;
				 $headers = 'From: moneo.house.atreides@gmail.com' . "\r\n" .
				 'Reply-To: moneo.house.atreides@gmail.com' . "\r\n" .
				 'X-Mailer: PHP/' . phpversion();

				 mail($to, $subject, $message, $headers);
		
        // $mailer = new Application_Mail( 'smtp/tls' , 'UTF-8' );
        // $mailer->setFrom( Zend_Registry::get('config')->mailer->fromEmail ,  Zend_Registry::get('config')->mailer->fromName );
        // $mailer->addTo( $user->getEmail() );
        // $mailer->setSubject( 'Récupération de votre mot de passe ' );
        // $mailer->setBodyText( 'Pour modifier votre mot de passe, cliquez sur le lien suivant : ' .
                              // URL_MAIN_ABS .
                              // 'Customer/auth/newpassword/uid/' . $user->getId() . '/token/' . 
                              // $securityToken
                            // );
        // $mailer->setBodyHtml( '<strong>Pour modifier votre mot de passe, cliquez sur le lien suivant :</strong><br />' .
                              // '<a href="' . URL_MAIN_ABS . 'Customer/auth/newpassword/uid/' . $user->getId() . '/token/' . $securityToken . '" >Récupérer mon mot de passe</a>'
                              // );
        // $mailer->send();
		
		
		
        
        // Redirection
        $this->addSystemSuccess( 'Un e-mail vient de vous être adressé. Veuillez suivre les instructions qu\'il contient.');
        // $this->_redirect(URL_MAIN_ABS . 'Customer/auth/customerwidget' , array( 'exit' => true, 'code'=> 301) );
        $this->_redirect(URL_MAIN_ABS , array( 'exit' => true, 'code'=> 301) );
        
    }  
    
/**
     * newpasswordAction
     * 
     * @return void
     */
    public function newpasswordAction()
    {
        if (!$this->getRequest()->isGet()) {
            $this->addSystemError('Méthode non autorisée (0).');
			$this->_redirect( URL_MAIN_ABS , array( 'exit' => true, 'code'=> 301) );
		}
        
        // Si l'identité n'est pas enregistrée, affiche le formulaire de modification de mot de passe ( newpassword.phtml )
        if( !$this->_auth->hasIdentity()){
        
            // Récupère, filtre, et vérifie les données GET
            $f              = new Zend_Filter_StripTags();
            $userId         = $f->filter($this->getRequest()->getParam('uid'));
            $securityToken  = $f->filter($this->getRequest()->getParam('token'));

            $uidValidator       = new Zend_Validate_Int();
            $tokenValidator     = new Zend_Validate_Alnum();
            if ( !$uidValidator->isValid( $userId ) || !$tokenValidator->isValid( $securityToken )){
                $this->addSystemError('Méthode non autorisée (1).');
                $this->_redirect( URL_MAIN_ABS , array( 'exit' => true, 'code'=> 301) );
            }
        
            // Récupère l'utilisateur pour vérifié la validité du token
            $user       = new Customer_Model_User();
            $userTable  = new Customer_Model_Mapper_User();
            $userTable->find( $userId, $user );
            
            // Teste les valeurs possibles du token pour le jour J et J-1
            $acceptedTokens = array(  md5($user->getEmail() . $user->getId() . date('d')    . 'sdbyY7d'),
                                      md5($user->getEmail() . $user->getId() . date('d')-1  . 'sdbyY7d')
                                    );
			
            // Si le token n'est pas valide, redirige avec une erreur                        
            if ( !in_array( $securityToken, $acceptedTokens )) {
                $this->addSystemError('Méthode non autorisée (2).');
                $this->_redirect( URL_MAIN_ABS , array( 'exit' => true, 'code'=> 301) );
            }
            // si le token n'est pas dans la base, la modification a déjà eu lieu, redirige avec une erreur
            if ( $user->getSecuritytoken() !== $securityToken ) {
                $this->addSystemError('Méthode non autorisée (3).');
                $this->_redirect( URL_MAIN_ABS , array( 'exit' => true, 'code'=> 301) );
            }
            
            // Affiche le formulaire
            $form = new Customer_Form_Newpassword( $user->getId(), $securityToken);
            $form   ->setAction( URL_MAIN_ABS . 'Customer/auth/donewpassword' )
                    ->setMethod( 'post' )
                    ->setAttrib('id', 'newpasswordForm');
            $this->view->form = $form;
        }
        // Sinon, invite le client à modifier son mot de passe sur le formulaire dédié ( editaccount.phtml )
        else{
            $this->addSystemWarning('Vous êtes déjà identifié, vous pouvez modifier votre mot de passe à l\'aide du formulaire ci-dessous.');
            $this->_redirect(  URL_MAIN_ABS . 'Customer/index/editaccount' , array( 'exit' => true, 'code'=> 301) );
        }
    }
    
  /**
     * donewpasswordAction
     * 
     * @return void
     */
    public function donewpasswordAction()
    {
   
        // Si le formulaire n'est pas appelé avec la méthode POST, lève une exception
        if (!$this->getRequest()->isPost()) {
            throw new Zend_Controller_Request_Exception( 'Méthode incorrecte (1)' );
        }
        
       
        $form = new Customer_Form_Newpassword();
        // Si une validation a échoué, redirige vers la page depuis laquelle le formulaire a été envoyé
        if (!$form->isValid($_POST)) {
            $errors = $form->getErrors();
            $this->addSystemError( 'Le processus de modification de mot de passe a échoué pour les raisons suivantes :' );
            foreach( $errors as $key => $error ) {
                if ( 0 != count($error) ){
                    switch ($key){
                        case 'pwd1' :
                        case 'pwd2' :
                            $this->addSystemError('<span class="small">- Au moins un des mots de passe est vide, trop court (6 caractères minimum) ou contient des caractères invalides </span>');
                            break;
                        default :
                            $this->addSystemError('<span class="small">- Le formulaire contient des données invalides</span>');
                            break;
                    }
                }
            }
            $this->_redirect( $form->getValue('source') , array( 'exit' => true, 'code'=> 301) );
        }
        
        // Si les deux mots de passe ne sont pas identiques
        if ( $form->getValue('pwd1') !== $form->getValue('pwd2') ) {
           
            $this->addSystemError( 'Les mots de passe ne sont pas identiques' );
            $this->_redirect( $form->getValue('source') , array( 'exit' => true, 'code'=> 301) );
        }
 
        // Si aucune validation n'a échoué, tente de trouver l'e-mail dans la base client
        $user       = new Customer_Model_User();
        $userTable  = new Customer_Model_Mapper_User();
        $userTable->find( $form->getValue('uid'), $user );
        
        // Si aucun utilisateur n'est trouvé en base, redirige sur le formulaire avec un message d'erreur
        if ( !$user ) {
			$this->addSystemError( 'Cet adresse ne correspond à aucun compte client');
			$this->_redirect(URL_MAIN_ABS . 'Customer/auth/lostpassword', array( 'exit' => true, 'code'=> 301) );
		}
        
        // Teste les valeurs possibles du token pour le jour J et J-1
            $acceptedTokens = array( md5($user->getEmail() . $user->getId() . date('d')    . 'sdbyY7d'),
                                     md5($user->getEmail() . $user->getId() . date('d')-1  . 'sdbyY7d')
                                    );
            
        // Si le token n'est pas valide, redirige avec une erreur                        
            if ( !in_array(  $form->getValue('token'), $acceptedTokens )) {
                $this->addSystemError('Méthode non autorisée (2).');
                $this->_redirect( URL_MAIN_ABS , array( 'exit' => true, 'code'=> 301) );
            }
            // si le token n'est pas dans la base, la modification a déjà eu lieu, redirige avec une erreur
            if ( $user->getSecuritytoken() !== $form->getValue('token') ) {
                $this->addSystemError('Méthode non autorisée (3).');
                $this->_redirect( URL_MAIN_ABS , array( 'exit' => true, 'code'=> 301) );
            }
            
        // Si le client est trouvé, vide le jeton de sécurité
        $user->setSecuritytoken( '' );
        $user->setPassword($form->getValue('pwd1'));
        $userTable->save( $user );
       
        
        // Redirection
        $this->addSystemSuccess( 'Votre mot de passe a été mis à jour, vous pouvez vous identifier.');
        // $this->_redirect(URL_MAIN_ABS . 'Customer/auth/customerwidget' , array( 'exit' => true, 'code'=> 301) );
        $this->_redirect(URL_MAIN_ABS , array( 'exit' => true, 'code'=> 301) );
        
    }  
}