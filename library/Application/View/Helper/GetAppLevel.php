<?php

class Application_View_Helper_GetAppLevel extends Zend_View_Helper_Abstract
{

    function getAppLevel()
    {
        $level = Zend_Registry::get('debugLevel');
        switch( $level ){
            case 'dev' :
                return 'development';
                break;
            case 'testing' :
                return 'testing';
                break;
            case 'staging' :
                return 'staging';
                break;
            case 'prod' :
                return 'production';
                break;
            default:
                return 'production';
                break;
        }
    }
}