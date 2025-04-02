<?php
include ('lib/def.inc');

$pageInfos['base'] = $db->base;

$page->header('Create table schema', $pageInfos);

switch ($action) {
	//Pour détacher une base
	case 'create_table':
		$act->create_table($_REQUEST['table_name'], $_REQUEST['field'], $_REQUEST['field_name'], $_REQUEST['field_type'], $_REQUEST['field_length'], $_REQUEST['field_null'], $_REQUEST['field_default'], $_REQUEST['field_pkey']);
		break;
}

switch ($affichage) {
	//Pour détacher une base
	case 'full_form':
		$nb_fields = intval($_REQUEST['table_size']);
		if ($nb_fields <= 0) {
			$nb_fields = 5;
		}
		
	?>
	<form action="table_create.php" method="post">
	 <input type="hidden" name="base" value="<?=$db->base?>">
	 <input type="hidden" name="action" value="create_table">
	
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
		for($i = 0; $i< $nb_fields; $i++) {
			echo '<tr>';
		//Nom
			echo '<td>
				<input type="hidden" name="field['.$i.']">
				<input type="text" name="field_name['.$i.']" value=""></td>';
		//Type
			echo '<td><select name="field_type['.$i.']">';

			ksort($config['type_name']);
  			foreach ($config['type_name'] as $type_name => $num_type) {
				echo '<option value="'.$type_name.'">'.$type_name.'</option>';	
			}
			echo '</select></td>';
			
		//Length
			echo '<td>';
			echo '<input type="text" name="field_length['.$i.']" value="" size="4">';
			echo '</td>';
		
		//Null
			echo '<td><input type="checkbox" name="field_null['.$i.']" checked></td>'; 			

		//Default
			echo '<td><input type="text" name="field_default['.$i.']" value="" size="15"></td>';

		//Primary key
			echo '<td><input type="checkbox" name="field_pkey['.$i.']"></td>'; 			

			echo "</tr>\n";
		}
		?>
	</table>
	<br><br>
	 <table cellpadding="3" cellspacing="0" class="dataTable">
	  <tr>
	   <th>Table Name</th>
	  </tr>
	  <tr>
	   <td><input type="text" name="table_name" value="<?=$_REQUEST['table_name']?>" size="20"></td>
	  </tr>
	  <tr>
	   <td colspan="2" align="right">
	    <input type="submit" value="Save">
	   </td>
	  </tr>
	 </table>	
	</form>
	<?php
		break;
		
	default:
	//Recherche des  clés primaires	
	?>
	
	<form action="table_create.php" method="post">
	 <input type="hidden" name="base" value="<?=$db->base?>">
	 <input type="hidden" name="affichage" value="full_form">
	 <table cellpadding="3" cellspacing="0" class="dataTable">
	  <tr>
	   <th>Table Name</th>
	   <th>Number of fields</th>
	  </tr>
	  <tr>
	   <td><input type="text" name="table_name" value="" size="20"></td>
	   <td><input type="text" name="table_size" value="10" size="5"></td>
	  </tr>
	  <tr>
	   <td colspan="2" align="right">
	    <input type="submit" value="Next &gt;&gt;">
	   </td>
	  </tr>
	 </table>
	</form>
	<?php
	break;

	case 'table_created':
		echo '[END]';
		break;
}
$page->footer();
?>






