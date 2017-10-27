<?php

class Application_View_Helper_DisplayMessages extends Zend_View_Helper_Abstract

{
  /**
     * displayMessages
     *
     * @return string
     */
    function displayMessages()
    {
        // Accède à l'espace de nom des messages dans la session
        $messages = new Zend_Session_Namespace('messages');
        
        // Pour chaque type de message, affiche si non vide
        if ( is_array($messages->success) && 0 != count($messages->success) ) {
            print '<p class="success">';
            foreach( $messages->success as $message ){
                print $message . '<br />';
            }
            print '</p>';
            $messages->success = array();
        }
        if (  is_array($messages->warning) && 0 != count($messages->warning) ) {
            print '<p class="warning">';
            foreach( $messages->warning as $message ){
                print $message . '<br />';
            }
            print '</p>';
            $messages->warning = array();
        }
        if ( is_array($messages->error) && 0 != count($messages->error) ) {
            print '<p class="error">';
            foreach( $messages->error as $message ){
                print $message . '<br />';
            }
            print '</p>';
            $messages->error = array();
        }

    }
}