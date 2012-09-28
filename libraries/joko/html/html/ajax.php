<?php

defined('JPATH_PLATFORM') or die;

$document = JFactory::getDocument();
$document->addScript('http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js');
$document->addStyleSheet('http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css');

abstract class JHtmlAjax {
	
	public static function users($name, $userIds, $id = false, $classSuffix = '', $attribs = '') {
		
		$document = JFactory::getDocument();
		$document->addScript(JURI::root(true).'/media/joko/js/html.ajax.users.js');
		
		if (!($id))
			$id = 'joko-html-ajax-users';
		
		ob_start();
		include (JPATH_ROOT.DS.'libraries'.DS.'joko'.DS.'html'.DS.'html'.DS.'tmpl'.DS.'ajax.user.php');
		$html= ob_get_contents();
		ob_end_clean();
		
		return $html;
	}
}