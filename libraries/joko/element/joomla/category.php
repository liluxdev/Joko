<?php
defined( '_JEXEC' ) or die;

/**
 * An 
 *
 * @package default
 * @author Jiliko.net
 */

jimport('joko.element.base');
 
class JokoElementJoomlaCategory extends JokoElement {
	
	protected static $table_type = 'Category';
	protected static $table_name = 'categories';
	
	# ------------------------------------------------------------------------
	# getArrayAsOptions function
	#
	# Return : This function returns HTML select options from Array values
	# ------------------------------------------------------------------------
	protected static function bind(& $category, $data) {
		if (isset($data['parent_id']))
			$category->setLocation( $data['parent_id'], 'last-child' );
		
		return parent::bind( $category, $data );
	}
	
	protected static function store(& $category) {
		$result = parent::store($category);
		
		if ($result) {
			$category->rebuildPath($category->id);
			// Rebuild the paths of the category's children:
			$category->rebuild($category->id, $category->lft, $category->level, $category->path);
		}
		
		return $result;
	}
	
}