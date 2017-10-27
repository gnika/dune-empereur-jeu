<?php
/**
 * JBM Consulting
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @package    Application_View
 * @subpackage Helper
 * @copyright  Copyright (c) 2005-2009 Jean-Baptiste MONIN
 * @version    $Id: GoogleAnalyticsCode.php 7078 2009-11-06 14:29:33Z jb $
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

/** Zend_Registry */
require_once 'Zend/Registry.php';

/** Zend_View_Helper_Abstract.php */
require_once 'Zend/View/Helper/Abstract.php';

/**
 * Helper for setting and retrieving the google analytics tracking JS code
 *
 * @package    Application_View
 * @subpackage Helper
 * @copyright  Copyright (c) 2005-2009 Jean-Baptiste MONIN
 * @version    $Id: GoogleAnalyticsCode.php 7078 2009-11-06 14:29:33Z jb $
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Application_View_Helper_GoogleAnalyticsCode extends Zend_View_Helper_Abstract
{

    
    /**
     * Configuration object containing current config settings
     * @var ArrayObject
     */
    protected $_analyticsConfig;

    /**
     * Configuration var containing current analytics system
     * @var String
     */
    protected $_analyticsSystem;

    /**
     * Configuration var containing current analytics system status
     * @var String
     */
    protected $_analyticsActive;
    
    /**
     * Configuration section telling wich run level to use
     * @var string ( devel | test | prod )
     */
    protected $_configSection;

    /**
     * JS code string
     * @var String
     */
    protected $_analyticsCode;
    
    /**
     * Constructor
     *
     * Retrieves tracking number and conf options
     *
     * @return void
     */
    public function __construct()
    {
        $this->_analyticsConfig = Zend_Registry::get('config')->analytics->ga;
        $this->_analyticsSystem = Zend_Registry::get('config')->analytics->provider;
        $this->_analyticsActive = Zend_Registry::get('config')->analytics->active;
        $this->_configSection   = Zend_Registry::get('configSection');
        $this->_analyticsCode   = '';
    }

    /**
     * Set or retrieve Google Analytics JS Code
     *
     * @return Application_View_Helper_GoogleAnalyticsCode
     */
    public function googleAnalyticsCode()
    {
        if ( $this->_analyticsSystem == 'GA'  ) {
            // $this->_analyticsCode   = CRLF . CRLF . '<!-- Google Analytics -->' . CRLF .
                                      // TAB .'<script type="text/javascript">' . CRLF .
                                      // TAB .TAB . 'var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");' . CRLF .
                                      // TAB .TAB . 'document.write(unescape("%3Cscript src=\'" + gaJsHost + "google-analytics.com/ga.js\' type=\'text/javascript\'%3E%3C/script%3E"));' . CRLF .
                                      // TAB .'</script>' . CRLF .
                                      // TAB .'<script type="text/javascript">' . CRLF .
                                      // TAB .TAB . 'try {' . CRLF .
                                      // TAB .TAB . TAB . 'var pageTracker = _gat._getTracker("' . $this->_analyticsConfig->trackingCode  . '");' . CRLF .
                                      // TAB .TAB . TAB . 'pageTracker._trackPageview();' . CRLF .
                                      // TAB .TAB . '} catch(err) {}' . CRLF .
                                      // TAB .'</script>' . CRLF .
                                      // '<!-- Google Abnalytics -->' . CRLF;
            $this->_analyticsCode   = "(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-81005264-1', 'auto');
  ga('send', 'pageview');";
            if ( $this->_analyticsActive != 1 ) {
                $this->_analyticsCode   = CRLF . CRLF . '<!-- Google Analytics not activated -->' . CRLF;
            }
            
            if ( $this->_configSection != 'prod' ) {
                $this->_analyticsCode   = CRLF . CRLF . '<!-- Google Analytics not available in developer mode -->' . CRLF . CRLF;
            }

        }
        return $this;
    }

    /**
     * Retrieve Google Analytics JS Code
     *
     * @return string
     */
    public function getGoogleAnalyticsCode()
    {
        return $this->_analyticsCode;
    }

    /**
     * String representation of googleAnalyticsCode
     *
     * @return string
     */
    public function __toString()
    {
        $googleAnalyticsCode = $this->getGoogleAnalyticsCode();
        return $googleAnalyticsCode;
    }
}
