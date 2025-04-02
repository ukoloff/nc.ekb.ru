<?php
include ('lib/def.inc');

$pageInfos['base'] = $db->base;


$page->header('Database details', $pageInfos);



$menu[] = Array('url'   => 'index.php?baseToDelete='.$db->base.'&action=delete_db',
				'image' => 'images/icons/delete.gif',
				'title' => 'Delete database');
$menu[] = Array('url'   => 'index.php?baseToDetach='.$db->base.'&action=detach_db',
				'image' => 'images/icons/detach.gif',
				'title' => 'Detach database');
?>

<b>Page</b><br>
<a href="db_detail.php?base=<?=$db->base?>">Structure</a> | 
<a href="db_options.php?base=<?=$db->base?>">Options</a> |
<a href="db_export.php?base=<?=$db->base?>">Export</a>
	

<?php

$page->footer();
?>