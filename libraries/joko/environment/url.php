<?php
defined( '_JEXEC' ) or die;

/**
 * An 
 *
 * @package default
 * @author Jiliko.net
 */

class JokoEnvironmentUrl
{
	
	public function getBase($withSlash = false) {

		$uri = & JURI::getInstance();
		
		$baseUrl = $uri->toString( array('scheme', 'host', 'port'));

		return $baseUrl.($withSlash ? '/' : '');
	}

	public function getCurrentUrl($base64_encode = false, $url_encode = false) {
		$currentUrl = $_SERVER['HTTPS'] == 'on' ? 'https://' : 'http://';
		$currentUrl .= $_SERVER['SERVER_PORT'] != '80' ? $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"] : $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
		
		if ($base64_encode)
			$currentUrl = base64_encode($currentUrl);

		if ($url_encode)
			$currentUrl = urlencode($currentUrl);
		
		return $currentUrl;
	}

	public function createNewUrl($url, $extras = array()) {
		
		$u = & JURI::getInstance( $url );
	
		$params = array_merge( $u->getQuery( true ), $extras );
		$query = $u->buildQuery( $params );
		$u->setQuery( $query );
	
		return $u->toString();
	}
	
	public function getRoute($link) {
		
		$app = JFactory::getApplication();
		
		if ($app->isSite()) {
			return JRoute::_($link);
		} else {
			jimport('joomla.application.router');
			JLoader::register('JRouterSite', JPATH_ROOT.DS.'includes'.DS.'router.php');
			$router = new JRouterSite(array('mode'=>JROUTER_MODE_SEF));  
			$route = $router->build($link)->toString(array('path', 'query', 'fragment'));  
			$route = str_replace('/administrator/', '', $route);
			return $route;
		}
		
	}
}