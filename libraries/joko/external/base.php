<?php
// Set flag that this is a parent file
define( '_JEXEC', 1 );

define('JPATH_BASE', dirname(__FILE__).'/../../..' );

define( 'DS', DIRECTORY_SEPARATOR );

require( JPATH_BASE .DS.'includes'.DS.'defines.php' );
require( JPATH_BASE .DS.'includes'.DS.'framework.php' );

// Joomla! library imports;
jimport( 'joomla.user.user');
jimport( 'joomla.application.application' );
jimport( 'joomla.log.log' );
jimport( 'joomla.plugin.helper' );
jimport( 'joomla.environment.request' );
?>