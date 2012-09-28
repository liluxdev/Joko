<?php
defined( '_JEXEC' ) or die;

/**
 * An 
 *
 * @package default
 * @author Jiliko.net
 */

jimport('joko.element.base');
 
class JokoElementJoomlaExtension extends JokoElement {
	
	protected static $table_type = 'Extension';
	protected static $table_name = 'extensions';
	protected static $table_pk = 'extension_id';
}