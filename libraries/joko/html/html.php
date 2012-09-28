<?php
defined('JPATH_PLATFORM') or die;

JHtml::addIncludePath(JPATH_PLATFORM . '/joko/html/html');

$document = JFactory::getDocument();
$document->addStyleSheet(JURI::root(true).'/media/joko/css/form.css');
$document->addScript(JURI::root(true).'/media/joko/js/joko.js');

/**
 * An 
 *
 * @package default
 * @author Jiliko.net
 */

 
class JokoHtml {
	
	# ------------------------------------------------------------------------
	# getArrayAsOptions function
	#
	# Return : This function returns HTML select options from Array values
	# ------------------------------------------------------------------------
	public static function getArrayAsOptions($arrayOfValues, $valueAsKey = false) {

		$options = array ();
		
		foreach ($arrayOfValues as $key => $value) {
			$options[] = JHTML::_('select.option', $valueAsKey ? $value : $key, $value);
		}

		return $options;
	}
}