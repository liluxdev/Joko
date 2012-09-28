<?php
defined( '_JEXEC' ) or die;

/**
 * An 
 *
 * @package default
 * @author Jiliko.net
 */

jimport('joko.element.base');

class JokoElementJoomlaUserGroup extends JokoElement {

	protected static $table_type = 'Usergroup';
	protected static $table_name = 'usergroups';
	
	public static function assignUserGroup( $user_id, $group_id ) {
		
		$db = JFactory::getDBO();
		
		// Affect the new group to the user
		$query = "INSERT INTO #__user_usergroup_map VALUES({$user_id},{$group_id})";
		$db->setQuery($query);
		return $db->query();
	}
	
	public static function unassignUserGroup( $user_id, $group_id ) {
		
		$db = JFactory::getDBO();
		
		$query = "DELETE FROM #__user_usergroup_map WHERE user_id={$user_id} AND group_id={$group_id}";
		$db->setQuery($query);
		return $db->query();
	}
	
	public static function getAssignedUsers( $group_id ) {
		$db = JFactory::getDBO();
		
		$query = "SELECT user_id FROM #__user_usergroup_map WHERE group_id={$group_id}";
		$db->setQuery($query);
		return $db->loadResultArray();
	}
	
}