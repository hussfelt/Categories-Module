<?php
/**
* @version		1.5.2
* @package		Categories Module
* @copyright	Copyright (C) 2008 - Hussfelt Consulting AB
* @license		GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*
* Contributors to the projects;
* Gerhard Alexander Hokamp, HPI-ING Global Partners
*
* Thank you for helping out!
* - Henrik
*/

/// no direct access
defined('_JEXEC') or die('Restricted access');

// Include the syndicate functions only once
require_once (dirname(__FILE__).DS.'helper.php');

$list = modCategoryiesHelper::getList($params);

if (!count($list)) {
	return;
}

$show_count	= intval($params->get('show_count', 1));
$show_count_text = intval($params->get('show_count_text', 1));

require(JModuleHelper::getLayoutPath('mod_categories'));
?>