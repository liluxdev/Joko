<?php
defined( '_JEXEC' ) or die;

jimport('joko.element.seblod.base');

class JokoElementSeblodCore extends JokoElementSeblod {

	protected static $table_name = 'cck_core';
	
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
	public static function save( $data, $context = null ) {
		
		if (!isset($data['pkb'])) $data['pkb'] = 0;
		if (!isset($data['date_time'])) $data['date_time'] = JFactory::getDate()->toFormat();
		if (!isset($data['app'])) $data['app'] = '';
		
		$element = parent::save( $data, $context );

		if ($data['pk']) {
			switch ($context) {
				case 'content':
					jimport('joko.element.joomla.content');
					JokoElementJoomlaContent::update(JokoElementJoomlaContent::load($data['pk']), array( 'introtext' => '::cck::'.$element->{static::$table_pk}.'::/cck::'));
				break;
				case 'category':
					jimport('joko.element.joomla.category');
					JokoElementJoomlaCategory::update(JokoElementJoomlaCategory::load($data['pk']), array( 'description' => '::cck::'.$element->{static::$table_pk}.'::/cck::'));
				break;
			}
		}
		
		return $element;
	}
	
}