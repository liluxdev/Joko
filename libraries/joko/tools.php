<?php
/**
* @version 			Joko Library 2.5.x
* @package			Joko
* @url				http://www.jiliko.net
* @editor			Jiliko - www.jiliko.net
* @copyright		Copyright (C) 2012 JILIKO. All Rights Reserved.
* @license 			GNU General Public License version 2 or later; see _LICENSE.php
**/

// no direct access
defined('_JEXEC') or die('Restricted access');

abstract class JokoTools {

	public static function callFuncArray( $class, $method, $args ) {
		return call_user_func_array( $class.'::'.$method, $args );
	}
	
	public static function callFunc( $class, $method, &$args = NULL, $ref = false ) {
		return $class::$method( $args );
	}
	
	function toCamelCase($word) {
		return lcfirst(str_replace(' ', '', ucwords(strtr($word, '_-', ' '))));
	}
}

?>
