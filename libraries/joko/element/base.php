<?php
defined( '_JEXEC' ) or die;

/**
 * An 
 *
 * @package default
 * @author Jiliko.net
 */

jimport( 'joomla.html.parameter' );
 
class JokoElement {
	
	protected static $table_instance = 'JTable';
	protected static $table_prefix = 'JTable';
	protected static $table_pk = 'id';
	protected static $table_type;
	protected static $table_name;
	protected static $param_fields = array();
	
	protected static function getInstance() {
		$table_instance = static::$table_instance;
		return $table_instance::getInstance( static::$table_type, static::$table_prefix );
	}
	
	protected static function bind(& $element, $data) {
		return $element->bind( $data );
	}
	
	protected static function check(& $element) {
		return $element->check();
	}
	
	protected static function store(& $element) {
		
		//TODO : Adding before store event
		return $element->store();
		
		//TODO : Adding after store event
	}
	
	# ------------------------------------------------------------------------
	# getArrayAsOptions function
	#
	# Return : This function returns HTML select options from Array values
	# ------------------------------------------------------------------------
	public static function save( $data, $context = null) {

		$isNew = false;
		
		if (isset($data[static::$table_pk]) && $data[static::$table_pk])
			$element = static::load($data[static::$table_pk]);
		else {
			$element = static::getInstance();
			$isNew = true;
		}
		
		// Bind data to the table object.
		static::bind($element, $data );
		
		// Check that the node data is valid.
		static::check($element);
		
		// Store the node in the database table.
		static::store($element);

		return $element;
	}
	
	public static function load( $elementId) {
		
		$element = static::getInstance();

		$element->load($elementId);
		
		foreach(static::$param_fields as $param_field) {
			if(isset($element->$param_field)) {
				$element->jparam[$param_field] = new JParameter($element->$param_field);
			}	
		}
		
		return $element;
	}
	
	public static function update( $element, $data ) {

		$data[static::$table_pk] = $element->{static::$table_pk};
		$element = static::save( $data, 'update' );
		
		return $element;
	}
		
	public static function search( $data = array(), $start = null, $limit = null, $firstAsElement = false ) {
		
		$db = JFactory::getDBO();
		
		$query = array();
		
		$query['select'] = static::$table_pk;
		$query['from'] = "#__".static::$table_name;
		
		$filters = array();
		
		foreach($data as $element => $value) {
			$filters[] = $element." = ". $db->quote($value);
		}
			
		$query['where'] = implode(" AND ", $filters);
			
		return self::_buildQuery( $query, $start, $limit, $firstAsElement );
	}
	
	public static function query($data, $start = null, $limit = null, $firstAsElement = false ) {
		
		$query = $data;

		$query['select'] = static::$table_pk;
		$query['from'] = "#__".static::$table_name;
		
		return self::_buildQuery( $query, $start, $limit, $firstAsElement );
	}
	
	public static function get( $data ) {
		return static::search($data, null, null, true);	
	}
	
	public static function count($data, $start = null, $limit = null, $firstAsElement = false ) {
		
		$query = $data;
		
		$query['select'] = "COUNT(".static::$table_pk.")";
		$query['from'] = "#__".static::$table_name;
		
		return self::_buildQuery( $query, $start, $limit, $firstAsElement, true );
	}
	
	
	public static function delete( $element ) {
		if (is_int($element)) {
			$element = static::load( $element );
		}
		
		if (!isset($element->{static::$table_pk}))
			return false;
		
		return $element->delete();
	}
	
	public static function deleteElements( $elements ) {
		foreach($elements as $element) {
			static::delete( $element );
		}
	}
	
	private static function _buildQuery( $data, $start = null, $limit = null, $firstAsElement = false, $count = false ) {
		$db = JFactory::getDBO();
		
		if (!isset($data['select']) || !isset($data['from']))
			return false;
		
		$query = "SELECT ".$data['select']." FROM ".$data['from'];

		if (isset($data['where'])) {
			$query.= " WHERE ".$data['where'];
		}
		
		if (isset($data['order_by'])) {
			$query.= " ORDER BY ".$data['order_by'];
		}
		
		if ($count) {
			$db->setQuery($query);
			return $db->loadResult();
		}
		
		if ($firstAsElement) {
			$query.= " LIMIT 0, 1";
			
			$db->setQuery($query);
			$elementId = $db->loadResult();

			return static::load($elementId);
		} else {
			if (isset($start) && isset($limit))
				$query.= " LIMIT $start, $limit";
			
			$db->setQuery($query);
			$elementIds = $db->loadResultArray();
			
			$elements = array();
			
			foreach($elementIds as $elementId) {
				$elements[] = static::load($elementId);
			}
			
			return $elements;
		}
	}
}