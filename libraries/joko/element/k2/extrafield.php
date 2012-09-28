<?php
defined( '_JEXEC' ) or die;

jimport('joko.element.k2.base');

class JokoElementK2Extrafield extends JokoElementK2 {

	protected static $table_type = 'K2Extrafield';
	protected static $table_name = 'k2_extra_fields';
	
	public static function load( $elementId ) {
		
		$element = parent::load($elementId);
		
		$element->value = JokoK2Tools::getParam($element->value);
		
		return $element;
	}
}