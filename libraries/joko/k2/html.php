<?php
defined( '_JEXEC' ) or die;

/**
 * An 
 *
 * @package default
 * @author Jiliko.net
 */

class JokoK2Html {
	
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
	public static function getCategoriesSelectList($name ='categories', $showTemplate = false, $showInheritance = false, $disableInherit = false, $values = array()) {

		$db = &JFactory::getDBO();
		$query = 'SELECT m.* FROM #__k2_categories m WHERE published=1 AND trash=0 ORDER BY parent, ordering';
		$db->setQuery( $query );
		$mitems = $db->loadObjectList();

		$children = array();

		if ( $mitems )
		{
			foreach ( $mitems as $v )
			{
				$pt 	= $v->parent;
				$list 	= @$children[$pt] ? $children[$pt] : array();
				array_push( $list, $v );
				$children[$pt] = $list;
			}
		}

		$list = JHTML::_('menu.treerecurse', 0, '', array(), $children, 9999, 0, 0 );
		
		$mitems = array();
		
		$values = array();
		
		foreach ( $list as $item ) {
			$categoryParams = new JParameter($item->params);
			
			$inheritFrom = $categoryParams->get('inheritFrom');
			
			if ( $inheritFrom ) {
				$query = "SELECT id,name,params FROM #__k2_categories WHERE id=".$inheritFrom;
				$db->setQuery($query);
				$parentCategory = $db->loadObject();
				$parentCategoryParams = new JParameter($parentCategory->params);
				$catTheme = $parentCategoryParams->get('theme','default');
			} else
				$catTheme = $categoryParams->get('theme','default');
			
			$categoryLabel = '&nbsp;&nbsp;&nbsp;'. $item->treename.$item->title;
			
			if ($showTemplate)
				$categoryLabel.= " (".$catTheme.")";
			
			if ($showInheritance)
				$categoryLabel.= " (inherit from '".$parentCategory->name."')";
			
			@$mitems[] = JHTML::_('select.option', $item->id, $categoryLabel, 'value','text', $disableInherit ? $inheritFrom : false);
		}

		return JHTML::_('select.genericlist',  $mitems, $name.'[]', 'class="inputbox" multiple="multiple" size="15"', 'value', 'text', $values );
	}
	
}