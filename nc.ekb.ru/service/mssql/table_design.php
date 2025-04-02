<?php
include ('lib/def.inc');

$pageInfos['base'] = $db->base;
$pageInfos['table'] = $table;

$page->header('Design table schema', $pageInfos);


switch ($action) {
	case 'drop_field':
		$act->drop_field($table, $_REQUEST['field']);
		break;
		
	case 'alter_field':
		$act->alter_field($table, $_REQUEST['field_orig'], $_REQUEST['field_type'], $_REQUEST['field_length'], $_REQUEST['field_null']);
		break;
}


switch ($affichage) {
	//Pour détacher une base
	case 'edit_field':
		
		$result = $db->query("EXEC sp_tables @table_name = '$table'");
		$row = $db->fetch_array($result);
		
		$primarykeys = Array();
		
		$result2 = $db->query("EXEC sp_primarykeys '".$db->host."', '".$table."','".$row['TABLE_OWNER']."','".$db->base."'");
		while ($row2 = $db->fetch_array($result2)) {
			$primarykeys[] = $row2['COLUMN_NAME'];
		}
	?>
	<form action="table_design.php" method="post">
	 <input type="hidden" name="base" value="<?=$db->base?>">
	 <input type="hidden" name="table" value="<?=$table?>">
	 <input type="hidden" name="action" value="alter_field">
	
	 <table cellpadding="3" cellspacing="0" class="dataTable">
	  <tr>
	   <th>Field</th>
	   <th>Type</th>
	   <th>Length</th>
	   <th>Null</th>
	   <th>Default</th>
	   <th>P. Key</th>
	  </tr>
		<?php
		$result = $db->query("EXEC sp_columns @table_name='$table'");
		while ($row = $db->fetch_array($result)) {
			echo '<tr>';
		//Nom
			echo '<td>
				<input type="hidden" name="field_orig['.$row['COLUMN_NAME'].']">
				<input type="text" name="field_name['.$row['COLUMN_NAME'].']" value="'.$row['COLUMN_NAME'].'"></td>';
		//Type
			echo '<td><select name="field_type['.$row['COLUMN_NAME'].']">';

			ksort($config['type_name']);
  			foreach ($config['type_name'] as $type_name => $num_type) {
				if ($num_type == $row['DATA_TYPE']) {
					$selected = 'selected';
				} else {
					$selected = '';
				}
				echo '<option value="'.$type_name.'" '.$selected.'>'.$type_name.'</option>';	
			}
			echo '</select></td>';
			
		//Length
			echo '<td>';
			if ($config['type'][$row['DATA_TYPE']] == 'text') {
				echo '<input type="text" name="field_length['.$row['COLUMN_NAME'].']" value="'.$row['LENGTH'].'" size="4">';
			} else {
				echo '<input type="text" name="field_length['.$row['COLUMN_NAME'].']" value="" size="4">';
			}
			echo '</td>';
		
		//Null
			if ($row['IS_NULLABLE'] == 'YES') {
				$checked = 'checked';
			} else {
				$checked = '';
			}
			echo '<td><input type="checkbox" name="field_null['.$row['COLUMN_NAME'].']" '.$checked.'></td>'; 			

		//Default
			echo '<td><input type="text" name="field_default['.$row['COLUMN_NAME'].']" value="'.$row['COLUMN_DEF'].'" size="15"></td>';

		//Primary key
			
			if (in_array($row['COLUMN_NAME'], $primarykeys)) {
				$checked = 'checked';
			} else {
				$checked = '';
			}
			echo '<td><input type="checkbox" name="field_pkey['.$row['COLUMN_NAME'].']" '.$checked.'></td>'; 			

			
			
			echo "</tr>\n";
		}
		?>
		<tr>
		 <td colspan="6" align="center">
		  <input type="submit" name="" value="Update table">
		 </td>
		</tr>
	</table>
	</form>
	<?php
		break;
		
	default:
	//Recherche des  clés primaires	
	?>
	<form action="table_design.php" method="post">
	 <input type="hidden" name="base" value="<?=$db->base?>">
	 <input type="hidden" name="table" value="<?=$table?>">
	 <table cellpadding="3" cellspacing="0" class="dataTable">
	  <tr>
	   <th>Field</th>
	   <th>Type</th>
	   <th>Null</th>
	   <th>Default</th>
	   <th>Action</th>
	  </tr>
	<?php
	$result = $db->query("EXEC sp_columns $table");
	while ($row = $db->fetch_array($result)) {
	
		echo '<tr>';
		
		echo '<td>'.$row['COLUMN_NAME'].'
			<input type="hidden" name="column_name['.$row['COLUMN_NAME'].']" value="'.$row['COLUMN_NAME'].'">
			</td>';
		
	//Type
		echo '<td>'.$row['TYPE_NAME'].'('.$row['PRECISION'].')
				<input type="hidden" name="data_type['.$row['COLUMN_NAME'].']" value="'.$row['DATA_TYPE'].'">
				<input type="hidden" name="type_name['.$row['COLUMN_NAME'].']" value="'.$row['TYPE_NAME'].'">
				</td>';
	//NULL ?
		echo '<td align="center">' . $row['IS_NULLABLE'] . '</td>';
	
	//Valeur par default
		echo '<td>';
		if (empty($row['COLUMN_DEF'])) {
			echo '&nbsp;';
		} else {
			echo $row['COLUMN_DEF'];
		}
	 	echo '</td>';
	
	//Actions
		echo '<td align="center"><a href="table_design.php?base='.$db->base.'&table='.$table.'&affichage=edit_field&field='.$row['COLUMN_NAME'].'"><img src="images/icons/propriete.gif" alt="Drop"></a> <a href="javascript:confirmAction(\'DELETE the field '.$row['COLUMN_NAME'].'\',\'table_design.php?base='.$db->base.'&table='.$table.'&action=drop_field&field='.$row['COLUMN_NAME'].'\');"><img src="images/icons/delete.gif" alt="Drop"></a></td>';
		echo '</tr>';
	
	}
?>
 </table>
</form>
<?php
	break;
}
$page->footer();
?>






