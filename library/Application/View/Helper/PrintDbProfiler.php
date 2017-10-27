<?php
/**
 * Cleo Consulting
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
 * @copyright  Copyright (c) 2005-2009 Jean-Baptiste MONIN - Cleo Consulting
 * @version    $Id: PrintDbProfiler.php 7078 2009-11-06 14:29:33Z jb $
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
class Application_View_Helper_PrintDbProfiler extends Zend_View_Helper_Abstract
{
    /**
     * Db Adapter Object
     * @var Object
     */
    protected $_db;
    
    public function __construct()
    {
        $this->_db = Zend_Registry::get('db');
    }
    /**
     * PrintDbProfiler
     *
     * Get & display Db Profiler as HTML block
     *
     * @return string
     */
    public function PrintDbProfiler(){
        $output =  CRLF .'<!-- Profiler SQL -->' . CRLF;
        $output .=  '<div id="sqlProfiler"><h2>Profiler SQL</h2>' . CRLF;
        $profiler     = $this->_db->getProfiler();
        if ( $profiler->getQueryProfiles() ) {
            $maxTime      = 0;        
            $longQuery    = null;        
            $output .=  '<p><strong>' .$profiler->getTotalNumQueries() .' requ&ecirc;tes en ' . $profiler->getTotalElapsedSecs() . ' secondes.</strong></p>'  . CRLF;
            $output .=  '<ul>' . CRLF;
            foreach ($profiler->getQueryProfiles() as $query) {
                if ($query->getElapsedSecs() > $maxTime) {
                    $maxTime  = $query->getElapsedSecs();
                    $longQuery = $query->getQuery();                
                }                
                $output .= '<li>' . $query->getQuery() .' ex&eacute;cut&eacute;e en ' . $query->getElapsedSecs() . ' secondes.</li>' . CRLF;
            }        
            $output .= '</ul>' . CRLF;
            $output .= '<p><strong>Requ&ecirc;te la plus lente : ' . $longQuery . ' ex&eacute;cut&eacute;e en ' . $maxTime . ' secondes.</strong></p>'  . CRLF;
        }    
        else {        
            $output .= '<p><strong>Aucune requ&ecirc;te.</strong></p>' . CRLF;
        }
        $output .= '</div><br /><br />' . CRLF;
        $output .= '<!-- FIN Profiler SQL -->' . CRLF;
        return $output;
    }
}
