<?php
include ('lib/def.inc');

$pageInfos['base'] = $db->base;
$pageInfos['table'] = $table;

$page->header('View table data', $pageInfos);


	switch ($action) {
		//To delete a record
		case 'delete_record':
			$act->delete_record($table, $_REQUEST['where']);
			break;
			
	}



	switch ($affichage) {
		case 'rows':
		default:
			$result = $db->query("EXEC sp_tables @table_name = '$table'");
			$row = $db->fetch_array($result);
			
			$primarykeys = Array();
			
			$result2 = $db->query("EXEC sp_primarykeys '".$db->host."', '".$table."','".$row['TABLE_OWNER']."','".$db->base."'");
			while ($row2 = $db->fetch_array($result2)) {
				$primarykeys[] = $row2['COLUMN_NAME'];
			}
			
			echo '<a href="table_new_record.php?base='.$db->base.'&table='.$table.'"><img src="images/icons/new.gif" align="middle"> Add new record</a><br>';
			
			if (empty($_REQUEST['order'])) {
				$orderKey = '';
				$orderSQL = '';
			} else {
				$orderKey = $_REQUEST['order'];
				$orderSQL = 'ORDER BY '.$_REQUEST['order'].' ASC';
			}
			
			$query = "SELECT * FROM $table $orderSQL";
			
			
			$result = $db->query($query);
			
			$db->displayQuery($query);
			
			if ($db->num_rows($result) == 0) {
				echo 'No records in this table<br>';
			} else {
				$fields = Array();
				while ($field = $db->fetch_field ($result)) {
					$fields[] = $field;
				}
							
				echo '<form action="" method="post">';	
				echo '<table cellspacing="0" cellpadding="3" class="dataTable">';
				echo '<tr>';
				echo '<th>&nbsp;</th>';
				
				foreach ($fields as $key => $field) {
					echo '<th><a href="table_view_data.php?base='.$db->base.'&table='.$table.'&order='.$field->name.'&previous_order='.$orderKey.'" title="Order">' . $field->name . '</a></th>';	
				}
				
				echo '</tr>';
				
				while ($row = $db->fetch_array($result)) {
					$key = Array();
					foreach($primarykeys as $key_name) {
						$key[] = $key_name . '=' . $row[$key_name];
					}
					$where = implode(" AND ", $key);
					
					
					echo '<tr>';
					//echo '<td><input type="checkbox" name="" value=""></td>';
					echo '<td><a href="javascript:confirmAction(\'DELETE this record\',\'table_view_data.php?base='.$db->base.'&table='.$table.'&action=delete_record&where='.urlencode($where).'\');"><img src="images/icons/delete.gif" alt="Delete"></a>
							  <a href="table_edit_data.php?base='.$db->base.'&table='.$table.'&where='.urlencode($where).'"><img src="images/icons/propriete.gif" alt="Edit"></a></td>';
					
					foreach ($fields as $key => $field) {
						echo '<td>';
						if (empty($row[$field->name])) {
							echo '&nbsp;';
						} else {
							echo $row[$field->name];
						}
						echo '</td>';	
					}
					
					echo '</tr>';
				}
				echo '</table></form>';
			}
			
			
			
			
			break;
	}

$page->footer();
?>