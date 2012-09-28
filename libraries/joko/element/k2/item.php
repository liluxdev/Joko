<?php
defined( '_JEXEC' ) or die;

jimport('joko.element.k2.base');

class JokoElementK2Item extends JokoElementK2 {

	protected static $table_type = 'K2Item';
	protected static $table_name = 'k2_items';
	
	public static function getExtraFields($extraFields) {
		$itemExtraFields = array();
		
		$jsonObjects = JokoK2Tools::getParam($extraFields);
	
		foreach ($jsonObjects as $object){
			$itemExtraFields[$object->id] = $object->value;
		}
		
		return $itemExtraFields;
	}
}