<?php

class Contact_AjaxController extends Zend_Controller_Action
{
  /**
     * Init
     *
     * @return void
     */
    function init()
    {
    }
  /**
     * preDispatch
     *
     * @return void
     */
    function preDispatch()
    {
        if( !$this->getRequest()->isXmlHttpRequest() ){
            $this->getResponse()->setRawHeader('HTTP/1.1 403 Forbidden');
            // Désactive le layout et la vue. Le disableLayout n'est pas indispensable ici :
            //  -  Si la vue est désactivée, le layout ne sera de toutes façon par rendu 
            $this->_helper->layout()->disableLayout();
            $this->_helper->viewRenderer->setNoRender(true);
            print( 'La requête n\'a pu être traitée.' );
        }
        
    }

    public function checkformAction()
    {
        echo 'ok';
        exit;
    }
    
 	public function checkemailAction() 
	{
        // récupère la valeur clientemail passée en GET dans la requête AJAX
		$email = $this->getRequest()->getParam('clientemail');
        // Instancie un validateur de type Email avec les options pour vérifier si le domaine accepte les emails( présence d'un MX record ou d'un A, A6 ou AAAA spécifique au mails - option deep )
        // Attention  à la performance, car l'interrogation de serveurs distant peut considérablement ralentir l'exécution du script
		$validator = new Zend_Validate_EmailAddress();
        //retourne une réponse valid ou invalid en texte brut selon le résultat de la validation         

		if ($validator->isValid($email)) {
			print( 'valid' );
			exit;
		} else {
            print( 'invalid' );
			exit;
		}
	}
    
	public function checknameAction() 
	{
        // récupère la valeur clientname passée en GET dans la requête AJAX
		$name = $this->getRequest()->getParam('clientname');
        // Instancie un filtre striptags pour nettoyer la chaine et protéger contre le XSS
        $filter = new Zend_Filter_StripTags();
        // Instancie un validateur de type stringlength pour vérifier que le nom a bien une longueur entre 3 et 40 caractères
		$validator = new Zend_Validate_Stringlength( array( 'min' => 3, 'max' => 40) );
        $validator2 = new Zend_Validate_Alnum( true );
        //retourne une réponse valid ou invalid en texte brut selon le résultat de la validation      
		if ($validator->isValid( $name ) && $validator2->isValid( $name ) ) {
			print( 'valid' );
			exit;
		} else {
            print( 'invalid' );
			exit;
		}
        exit;
	}
}
