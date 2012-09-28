<?php
defined( '_JEXEC' ) or die;

/**
 * An 
 *
 * @package default
 * @author Jiliko.net
 */

jimport('joko.element.base');
jimport('joko.environment.url');

class JokoElementJoomlaContent extends JokoElement {
	
	protected static $table_type = 'Content';
	protected static $table_name = 'content';

	public static function getRoute($content_id) {
		return JokoEnvironmentUrl::getRoute(static::_getLink($content_id));
	}
	
	public static function _getLink($content_id) {
		
		$content = static::load($content_id);
		
		require_once(JPATH_ROOT.DS.'components'.DS.'com_content'.DS.'helpers'.DS.'route.php');
		
		$link = ContentHelperRoute::getArticleRoute($content->id, $content->catid);

		return $link;
	}
}