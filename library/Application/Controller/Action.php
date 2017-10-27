<?php

class Application_Controller_Action extends Zend_Controller_Action
{

	public function getConfig()
	{
		return Zend_Registry::get('config');
	}
	
	public function getAppLevel()
	{
		Zend_Registry::get('debugLevel');
	}
	
	public function getCache()
    {
		return Zend_Registry::get('cache');
	}
	
	public function getDbAdapter()
    {
		return Zend_Registry::get('db');
	}

    public function addSystemError( $message )
    {
		$messages = new Zend_Session_Namespace('messages');
        if ( !is_array( $messages->error ) ) {
            $messages->error = array();
        }
        $messages->error[] = $message;
	}

    public function addSystemSuccess( $message )
    {
		$messages = new Zend_Session_Namespace('messages');
        if ( !is_array( $messages->error ) ) {
            $messages->success = array();
        }
        $messages->success[] = $message;
	}
   
    public function addSystemWarning( $message )
    {
		$messages = new Zend_Session_Namespace('messages');
        if ( !is_array( $messages->error ) ) {
            $messages->warning = array();
        }
        $messages->warning[] = $message;
	}
}