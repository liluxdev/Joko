<?php
require(dirname(__FILE__).'/../base.php' );

$db = JFactory::getDBO();
$query = $db->getQuery(true);

$value = JRequest::getVar('q');

$query->select("name AS label, id as value")->from("#__users")->where("name LIKE '%{$value}%'");
$db->setQuery($query);
$users = $db->loadObjectList();

echo json_encode($users);
?>