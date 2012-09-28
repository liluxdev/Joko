<?php
defined( '_JEXEC' ) or die;

/**
 * An 
 *
 * @package default
 * @author Jiliko.net
 */

jimport('joko.element.base');
 
class JokoElementJoomlaMenu extends JokoElement {
	
	protected static $table_type = 'Menu';
	protected static $table_name = 'menu';
	protected static $param_fields = array('params');
	
	# ------------------------------------------------------------------------
	# getArrayAsOptions function
	#
	# Return : This function returns HTML select options from Array values
	# ------------------------------------------------------------------------
	protected static function bind(& $menu, $data) {
		
		if (isset($data['parent_id']))
			$menu->setLocation( $data['parent_id'], 'last-child' );
		
		return parent::bind( $menu, $data );
	}
	
	protected static function store(& $menu) {
		$result = parent::store($menu);
		
		if ($result)
			$menu->rebuildPath($menu->id);
		
		return $result;
	}
		
	public static function getAssignedModules( $menu_id ) {
		
		$db = JFactory::getDBO();
		
		$query = "SELECT module_id FROM #__modules_menu WHERE menu_id={$menu_id}";
		$db->setQuery($query);
		return $db->loadResultArray();
	}
		
}