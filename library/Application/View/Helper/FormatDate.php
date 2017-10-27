<?php

class Application_View_Helper_FormatDate extends Zend_View_Helper_Abstract

{
  /**
     * formatDate
     *
     * @return string
     */
    function formatDate($timestamp, $format='%d/%m/%Y')
    {
        return strftime($format, strtotime($timestamp));
    }
}