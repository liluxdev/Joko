<?php
defined( '_JEXEC' ) or die;

/**
 * An 
 *
 * @package default
 * @author Jiliko.net
 */

jimport('joko.element.base');

JTable::addIncludePath(JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_advancedmodules'.DS.'tables');

class JokoElementAdvancedModulesAdvancedModules extends JokoElement {
	
	protected static $table_prefix = 'AdvancedModulesTable';
	protected static $table_type = 'AdvancedModules';
	protected static $table_name = 'advancedmodules';
	protected static $table_pk = 'moduleid';

}