<?php
/**
* @version		1.0
* @package		Categories Module
* @copyright	Copyright (C) 2008 - Hussfelt Consulting AB
* @license		GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

/// no direct access
defined('_JEXEC') or die('Restricted access');

require_once (JPATH_SITE.DS.'components'.DS.'com_content'.DS.'helpers'.DS.'route.php');

class modCategoryiesHelper
{
	function getList(&$params)
	{
		global $mainframe;

		$db		=& JFactory::getDBO();
		$user	=& JFactory::getUser();

		$count		= intval($params->get('count', 20));

		$contentConfig 	= &JComponentHelper::getParams( 'com_content' );
		$access		= !$contentConfig->get('shownoauth');
		$id 		= $params->get( 'id', 1 );

		$gid 		= $user->get('aid', 0);
		$now		= date('Y-m-d H:i:s', time() + $mainframe->getCfg('offset') * 60 * 60);
		$nullDate	= $db->getNullDate();

		// show/hide empty categories in section
		$empty_sec 	= '';
		if ( !$params->get( 'empty_cat_section' ) ) {
			$empty_sec = "\n HAVING cnt > 0";
		}

		$query = 'SELECT a.id AS id,a.section as section_id,a.title AS title, COUNT(b.id) as cnt' .
			' FROM #__categories as a' .
			' LEFT JOIN #__content as b ON a.id = b.catid' .
			($access ? ' WHERE b.access <= '.(int) $gid . ' AND' : 'WHERE ') .
			' ( b.publish_up = '.$db->Quote($nullDate).' OR b.publish_up <= '.$db->Quote($now).' )' .
			' AND ( b.publish_down = '.$db->Quote($nullDate).' OR b.publish_down >= '.$db->Quote($now).' )' .
			' AND a.published = 1' .
			' AND a.section = "'.$id.'"' .
			($access ? ' AND a.access <= '.(int) $gid : '') .
			' GROUP BY a.id '.
			$empty_sec.
			' ORDER BY a.ordering';
		$db->setQuery($query, 0, $count);
		$rows = $db->loadObjectList();
		return $rows;
	}
}
