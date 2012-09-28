<?php
defined( '_JEXEC' ) or die;

/**
 * An 
 *
 * @package default
 * @author Jiliko.net
 */

jimport('joko.element.base');
 
class JokoElementJoomlaUser extends JokoElement {
	
	protected static $table_type = 'User';
	protected static $table_name = 'users';

}