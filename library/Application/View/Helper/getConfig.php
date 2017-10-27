<?php
/**
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
 * @category   Core
 * @package    Core_View_Helpers
 * @subpackage GetConfig
 * @copyright  2009 Jean-Baptiste MONIN - G2M DIFFUSION
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: GetConfig.php 01 2009-03-29 12:00:00Z jb $
 */
class Zend_View_Helper_GetConfig
{
  /**
     * getConfig
     *
     * @return string
     */
    function getConfig()
    {
        return Zend_Registry::get('config');
    }
}