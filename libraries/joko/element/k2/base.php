<?php
defined( '_JEXEC' ) or die;

/**
 * An 
 *
 * @package default
 * @author Jiliko.net
 */

jimport('joko.element.base');
jimport('joko.k2.tools');

JTable::addIncludePath(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_k2'.DS.'tables');

class JokoElementK2 extends JokoElement {
	
	protected static $table_prefix = 'Table';

}