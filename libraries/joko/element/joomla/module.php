<?php
defined( '_JEXEC' ) or die;

/**
 * An 
 *
 * @package default
 * @author Jiliko.net
 */

jimport('joko.element.base');
 
class JokoElementJoomlaModule extends JokoElement {
	
	protected static $table_type = 'Module';
	protected static $table_name = 'modules';

	public static function assignMenu( $module_id, $menu_id ) {
		
		$db = JFactory::getDBO();
		
		// Affect the new group to the user
		$query = "INSERT INTO #__modules_menu VALUES({$module_id},{$menu_id})";
		$db->setQuery($query);
		return $db->query();
	}
	
	public static function unassignMenu( $module_id, $menu_id ) {
		
		$db = JFactory::getDBO();
		
		$query = "DELETE FROM #__modules_menu WHERE module_id={$module_id} AND menu_id={$menu_id}";
		$db->setQuery($query);
		return $db->query();
	}
	
	public static function getAssignedMenus( $module_id ) {
		
		$db = JFactory::getDBO();
		
		$query = "SELECT menu_id FROM #__modules_menu WHERE module_id={$module_id}";
		$db->setQuery($query);
		return $db->loadResultArray();
	}
}