<? defined('C5_EXECUTE') or die('Access Denied'); ?>
<?
$dh = Loader::helper('concrete/dashboard/sitemap');
if ($dh->canRead()) { ?>
	
	<div class="ccm-dashboard-content-full" data-search="pages">
	<? Loader::element('pages/search', array('controller' => $searchController))?>
	</div>
		
<? } else { ?>
	<div class="ccm-pane-body">
		<p><?=t("You must have access to the dashboard sitemap to search pages.")?></p>
	</div>
<? } ?>

