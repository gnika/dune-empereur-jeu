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
 * @version    $Id: PrintAppProfiler.php 7078 2009-11-06 14:29:33Z jb $
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

/** Application_Profiler */
require_once 'Application/Profiler.php';

/** Zend_View_Helper_Abstract.php */
require_once 'Zend/View/Helper/Abstract.php';

class Application_View_Helper_PrintAppProfiler extends Zend_View_Helper_Abstract
{
    /**
     * PrintAppProfiler
     *
     * Get & display Application Profiler as HTML block
     *
     * @return string
     */
    public function PrintAppProfiler() 
    {
        $timers  = Application_Profiler::getTimers();
        $output  = CRLF . CRLF .'<!-- Profiler Appli -->' . CRLF;
        $output  .= '<table id="appProfiler">' . CRLF;
        $output  .= '  <tr class="head">' . CRLF;
        $output  .= '    <td>Trace</td>' . CRLF;
        $output  .= '    <td>Temps</td>' . CRLF;
        $output  .= '    <td>Etapes</td>' . CRLF;
        $output  .= '    <td>Realmem</td>' . CRLF;
        $output  .= '    <td>Emalloc</td>' . CRLF;
        $output  .= '  </tr>' . CRLF;
        $globalTime     = 0;
        $globalPasses   = 0;
        $globalRealmem  = 0;
        $globalEmalloc  = 0;
        foreach( $timers as $timer => $array ) {
            $output .= '  <tr>' .CRLF;
            $output .= '    <td>' . $timer . '</td>'. CRLF;
            $output .= '    <td>' . round($array['sum'],5). ' s</td>' . CRLF;
            $output .= '    <td>' . $array['count']. '</td>' . CRLF;
            $output .= '    <td>' . round($array['realmem']/1024,2). ' Ko</td>' . CRLF;
            $output .= '    <td>' . round($array['emalloc']/1024,2) . ' Ko</td>' . CRLF;
            $output .= '  </tr>' . CRLF;
            $globalTime     += round($array['sum'],5);
            $globalPasses   += $array['count'];
            $globalRealmem  += round($array['realmem']/1024,2);
            $globalEmalloc  += round($array['emalloc']/1024,2);
        }
        $output .= '  <tr>' .CRLF;
        $output .= '    <td>Temps global</td>'. CRLF;
        $output .= '    <td>' . $globalTime . ' s</td>' . CRLF;
        $output .= '    <td>' . $globalPasses . '</td>' . CRLF;
        $output .= '    <td>' . $globalRealmem . ' Ko</td>' . CRLF;
        $output .= '    <td>' . $globalEmalloc . ' Ko</td>' . CRLF;
        $output .= '  </tr>' . CRLF;
        $output .= '</table>' . CRLF;
        $output .= '<!-- FIN Profiler Appli -->' . CRLF;
        
        return $output;
    }
}
