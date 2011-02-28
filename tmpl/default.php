<?php // no direct access
defined('_JEXEC') or die('Restricted access'); ?>
<ul class="categories<?php echo $params->get('moduleclass_sfx'); ?>"><?php
foreach ($list as $item) :
// Added next line to check so text for item or items will be shown after the amount of items
?>
<li>
	<a href="<?php echo JRoute::_(ContentHelperRoute::getCategoryRoute($item->id, $item->section_id)); ?>">
		<?php echo $item->title . ($show_count ? " (".$item->cnt.($show_count_text ? ( $item->cnt > 1 ? " " . JText::_( 'items' ) : " " . JText::_( 'item' )) : "").")" : "");?></a>
</li>
<?php endforeach; ?>
</ul>