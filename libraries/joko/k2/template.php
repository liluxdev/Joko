<?php
defined( '_JEXEC' ) or die;

/**
 * An 
 *
 * @package default
 * @author Jiliko.net
 */

class JokoK2Template
{
	public static function getExt($file)
	{
		$dot = strrpos($file, '.') + 1;

		return substr($file, $dot);
	}
	
	# ------------------------------------------------------------------------
	# getFolderList function
	#
	# Return : This function returns a list of K2 templates directories
	# ------------------------------------------------------------------------
	function getFolderList() {
		
		global $mainframe;
		
		jimport('joomla.filesystem.folder');
		
		$folderList = array();
		
		$defaulTemplate = K2HelperTemplates::getDefaultTemplate();
		
		if(JFolder::exists(JPATH_ROOT.DS.'templates'.DS.$defaulTemplate.DS.'html'.DS.'com_k2'.DS.'templates'))
			$folderList[] = 'templates'.DS.$defaulTemplate.DS.'html'.DS.'com_k2'.DS.'templates';
			
		$folderList[] = 'components'.DS.'com_k2'.DS.'templates';
		
		return $folderList;
	}

	
	# ------------------------------------------------------------------------
	# getFolders function
	#
	# Return : This function returns a list of available K2 templates folders
	# ------------------------------------------------------------------------
	function getFolders() {
		
		global $mainframe;
		
		jimport('joomla.filesystem.folder');
		
		$folderList = K2HelperTemplates::getFolderList();
		
		$folders = array();
		
		foreach ($folderList as $templateFolder) {

			$badFolders = array('templates');
			if ($templateFolder == 'components'.DS.'com_k2'.DS.'templates')
				array_unshift($badFolders,'default');
			
			$folders[$templateFolder] = JFolder::folders(JPATH_ROOT.DS.$templateFolder, '.', false, false, $badFolders);
		}
		
		return $folders;
	}
	
	# ------------------------------------------------------------------------
	# getTemplates function
	#
	# Return : This function returns a list of K2 available templates
	# ------------------------------------------------------------------------
	function getTemplates($addPath = true) {
		
		global $mainframe;
		
		jimport('joomla.filesystem.folder');
		
		$folderList = K2HelperTemplates::getFolderList();
		
		$templates = array();
		
		foreach ($folderList as $templateFolder) {

			$badFolders = array('templates');
			if ($templateFolder == 'components'.DS.'com_k2'.DS.'templates')
				array_unshift($badFolders,'default');
				
			$templateNames = JFolder::folders(JPATH_ROOT.DS.$templateFolder, '.', false, false, $badFolders);
			
			if (count($templateNames)) {
			
				foreach($templateNames as $templateName) {
					$templates[] = ($addPath ? $templateFolder.DS : '').$templateName;
				}
			}
		}
		
		return $templates;
	}
	
	/**
	* ------------------------------------------------------------------------
	* getCategories function
	*
	* This function returns an array of K2 category Ids assigned to the given template
	 * 
	* @param	string $templateName / Name of the K2 Template
	*
	* @return	array / List of category ids assigned to hte given template
	*
	* ------------------------------------------------------------------------
	*/
	function getCategories($templateName) {

		global $mainframe;
		
		$db = & JFactory::getDBO();
		
		$query = "SELECT * FROM #__k2_categories WHERE published=1 AND trash=0";
		$db->setQuery($query);
		$categories = $db->loadObjectList();
		
		$tmplCategories = array();
		
		if(count($categories)) {
			foreach($categories as $category) {
				$categoryParams = new JParameter($category->params);
				
				$inheritFrom = $categoryParams->get('inheritFrom');
				$theme = $categoryParams->get('theme','default');
				
				if (!($inheritFrom) && ($theme == $templateName)) {
					$tmplCategories[] = $category->id;
				}
			}
		}
		
		return $tmplCategories;
	}
	
	# ------------------------------------------------------------------------
	# getTemplateFiles function
	#
	# Return : Array of a folder list of files
	# ------------------------------------------------------------------------
	function getTemplateFiles($path) {
		global $mainframe;
		
		jimport('joomla.filesystem.folder');
		
		$files = JFolder::files(JPATH_ROOT.DS.$path);
		
		if (count($files)) {
			$tmplFiles = array();
			
			foreach($files as $file) {
				$objFile = new JObject;
				$objFile->name = JFile::getName($file);
				$objFile->extension = JFile::getExt($file);
				$objFile->writable =  is_writable(JPATH_ROOT.DS.$path.DS.$file );
				$tmplFiles[] = $objFile;
			}
		}
		
		return $tmplFiles;
	}
	
}