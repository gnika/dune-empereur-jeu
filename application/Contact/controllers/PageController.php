<?php

class Contact_PageController extends Application_Controller_Action
{

    public function init() 
    {
       
    }
    
    public function viewAction()
    {
		Application_Profiler::start('Contact/Page/view'); 
		
        $form   = new Contact_Form_Main();
        $form   ->setAction( URL_MAIN_ABS . 'Contact/Page/send' )
                ->setMethod( 'post' )
                ->setAttrib( 'id', 'contactForm' );
                
        $this->view->form = $form;
        
		Application_Profiler::stop('Contact/Page/view');
        
        $mail                   = 'jb.monin@gmail.com';
        $pubKey                 = '011djoA0IJGCFvyfsr2k4YcA==';
		$privKey                = '9f34b61d49b081f825f115b0fa083d29';
        $mailHide               = new Zend_Service_ReCaptcha_MailHide();
        $mailHide               ->setPublicKey($pubKey);
        $mailHide               ->setPrivateKey($privKey);
        $mailHide               ->setEmail($mail);
        $this->view->mailHide   = $mailHide;
        
    }

    public function sendAction()
    {
		Application_Profiler::start('Contact/Page/send');  
		
        // Si la requête n'est pas passée en POST, il s'agit potentiellement d'une attaque : on redirige sur le formulaire avec une erreur
        if( !$this->getRequest()->isPost() ) {
            $this->addSystemError('Méthode non autorisée.');
            $this->_redirect(URL_MAIN_ABS . 'Contact/page/view', array( 'exit' => true, 'code'=> 301) );
        }

        $form = new Contact_Form_Main();
        // Si une validation a échoué, redirige vers la page depuis laquelle le formulaire a été envoyé
        if (!$form->isValid($_POST)) {
            $errors = $form->getErrors();
            $this->addSystemError( 'L\'envoi du message a échoué pour les raisons suivantes :' );
            foreach( $errors as $key => $error ) {
                if ( 0 != count($error) ){
                    switch ($key){
                        case 'fromName' :
                            $this->addSystemError('<span class="small">- Votre nom est vide, trop court ou contient des caractères invalides</span>');
                            break;
                        case 'fromEmail' :
                            $this->addSystemError('<span class="small">- Votre email est invalide</span>');
                            break;
                        case 'message' :
                            $this->addSystemError('<span class="small">- Votre message est vide ou contient des caractères invalides</span>');
                            break;
                        case 'recaptcha' :
                            $this->addSystemError('<span class="small">- Le code de vérification anti-spam est erroné.</span>');
                            break;
                        default :
                            $this->addSystemError('<span class="small">- Le formulaire contient des données invalides</span>');
                            break;
                    }
                }
            }
        $this->_redirect( URL_MAIN_ABS . 'Contact/page/view' , array( 'exit' => true, 'code'=> 301) );
        }
        
        // Envoi du mail
        $mailer = new Application_Mail( 'smtp/tls' , 'UTF-8' );
        $mailer->setFrom( $form->getValue('fromEmail') , $form->getValue('fromName') );
        $mailer->addTo( 'jb.monin@gmail.com' );
        $mailer->setSubject( 'Message depuis le site de la part de ' . $form->getValue('fromName') . ' (' . $form->getValue('fromEmail') . ')' );
        $mailer->setBodyText( 'Message reçu :' . "\n\n" . $form->getValue('message') );
        $mailer->setBodyHtml( '<strong>Message reçu : </strong><br /><br /><p>'.nl2br($form->getValue('message')).'</p>' );
        $mailer->send();
                
        // Redirection après l'envoi du message par mail
        $this->addSystemSuccess('Votre message a bien été envoyé.');
        $this->_redirect(URL_MAIN_ABS . 'Contact/page/view', array( 'exit' => true, 'code'=> 301) );
        
		Application_Profiler::stop('Contact/Page/send');
    }

}