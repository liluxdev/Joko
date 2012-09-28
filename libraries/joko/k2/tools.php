<?php
defined( '_JEXEC' ) or die;

/**
 * An 
 *
 * @package default
 * @author Jiliko.net
 */

class JokoK2Tools {
	
	public static function getParam($param, $from = 'json', $to = 'object') {
		require_once(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_k2'.DS.'lib'.DS.'JSON.php');
		
		if ($from == 'json') {
			$json = new Services_JSON;
			return $json->decode($param);
		}
	}
}