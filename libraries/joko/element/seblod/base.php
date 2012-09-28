<?php
defined( '_JEXEC' ) or die;

/**
 * An 
 *
 * @package default
 * @author Jiliko.net
 */

jimport('joko.element.base');
jimport('cms.cck.table');

class JokoElementSeblod extends JokoElement {

	protected static $table_instance = 'JCckTable';
	
	# ------------------------------------------------------------------------
	# getK2categoriesHtml function
	#
	# Return : This function returns a list of K2 categories as select options
	# ------------------------------------------------------------------------
	
	/**
	* ------------------------------------------------------------------------
	* getCategories function
	*
	* This function returns an array of K2 category Ids assigned to the given template
	 * 
	* @param	string $templateName / Name of the K2 Template
	*
	* @return	array / List of category ids assigned to hte given template
	*
	* ------------------------------------------------------------------------
	*/
	
	protected static function getInstance() {
		
		$table_instance = static::$table_instance;
		return $table_instance::getInstance( '#__'.static::$table_name);
	}
	
}