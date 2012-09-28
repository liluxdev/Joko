<?php
defined( '_JEXEC' ) or die;

/**
 * An 
 *
 * @package default
 * @author Jiliko.net
 */

class JokoJoomlaTemplate {
	
	# ------------------------------------------------------------------------
	# getDefaultTemplate function
	#
	# Return : Default Joomla! template
	# ------------------------------------------------------------------------
	
	public static function getDefault() {
		$db = JFactory::getDBO();
		$query = "SELECT template FROM #__templates_menu WHERE client_id = 0 AND menuid = 0";
		$db->setQuery($query);
		return $db->loadResult();
	}
	
	# ------------------------------------------------------------------------
	# joomlaTmplK2FolderExist function
	#
	# Return : result from the Joomla template overriding folder existence test
	# ------------------------------------------------------------------------
	public static function hasOverrideFolder ($templateName, $extension, $extraPath = '') {

		global $mainframe;
		
		jimport('joomla.filesystem.folder');
		
		return JFolder::exists(JPATH_ROOT.DS.'templates'.DS.$templateName.DS.'html'.DS.$extension.DS.$extraPath);
	}

}