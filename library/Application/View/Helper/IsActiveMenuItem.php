<?php

class Application_View_Helper_IsActiveMenuItem extends Zend_View_Helper_Abstract

{
  /**
     * IsActiveMenuItem
     *
     * @return string
     */
    function IsActiveMenuItem($module, $controller = null, $action = null )
    {

        if( null === $action && null === $controller ){
            if ( $module == $this->view->module )
                return 'class="current_page_item"';
        }
        else if ( null === $action ){
            if ( $module == $this->view->module && $controller == $this->view->controller )
                return 'class="current_page_item"';
        }
        else {
            if ( $module == $this->view->module && $controller == $this->view->controller && $action == $this->view->action )
                return 'class="current_page_item"';
        }
    }
}