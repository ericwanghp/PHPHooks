<?php
/**
 * The plugin control panel, you can manage the plugins activity in this page.
 */
include_once 'phphooks.class.php';
include_once 'includes/database.class.php';

require_once ('config.php');
$db = new Database ( $mysql_db_host, $mysql_db_user, $mysql_db_passwd, $mysql_db_name, $table_prefix );
$db->connect ();
switch ($_GET ['action']) {
	case "deactivate" :
		$data ['action'] = 0;
		$db->query_update ( "plugins", $data, "filename='" . $_GET ['filename'] . "'" );
		break;
	case "activate" :
		$sql = "SELECT * FROM " . $table_prefix . "plugins WHERE filename = '" . $db->escape ( $_GET ['filename'] ) . "'";
		$count = count ( $db->fetch_all_array ( $sql ) );
		if ($count < 1) {
			$data ['filename'] = $_GET ['filename'];
			$data ['action'] = 1;
			$db->query_insert ( "plugins", $data );
		} else {
			$data ['action'] = 1;
			$db->query_update ( "plugins", $data, "filename='" . $_GET ['filename'] . "'" );
		}
		break;
}
$sql = "SELECT filename, action FROM " . $table_prefix . "plugins WHERE action = '" . $db->escape ( 1 ) . "'";
$result_rows = $db->fetch_all_array ( $sql );

$plugin_list = new phphooks ( );
$plugin_headers = $plugin_list->get_plugins_header ();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome - PHP Plugin system - Control Panel</title>
<meta name="keywords" content="php,hooks,hook,plugin" />
<link rel='stylesheet' href='css/admin.css' type='text/css' />
</head>


<table class="widefat" cellspacing="0" id="active-plugins-table">
	<thead>
		<tr>
			<th scope="col">Plugin</th>
			<th scope="col" class="num">Version</th>
			<th scope="col">Description</th>
			<th scope="col" class="action-links">Action</th>
		</tr>
	</thead>

	<tfoot>
		<tr>
			<th scope="col">Plugin</th>
			<th scope="col" class="num">Version</th>
			<th scope="col">Description</th>
			<th scope="col" class="action-links">Action</th>
		</tr>
	</tfoot>

	<tbody class="plugins">
<?php
foreach ( $plugin_headers as $plugin_header ) {
	$action = false;
	foreach ( $result_rows as $result_row )
		if ($plugin_header ['filename'] == $result_row ['filename'] && $result_row ['action'] == 1)
			$action = true;
	?>
		<tr <?php
	if ($action)
		echo "class='active'";
	?>>
			<td class='name'><a
				href="<?php
	echo $plugin_header ['PluginURI'];
	?>"
				title="<?php
	echo $plugin_header ['Title'];
	?>"><?php
	echo $plugin_header ['Name'];
	?></a></td>
			<td class='vers'><?php
	echo $plugin_header ['Version'];
	?></td>
			<td class='desc'>
			<p class="nopadbot"><?php
	echo $plugin_header ['Description'];
	?>By <a href="<?php
	echo $plugin_header ['AuthorURI'];
	?>"
				title="Visit author homepage"><?php
	echo $plugin_header ['Author'];
	?></a>.</p>
			</td>
			<td>
				<?php
	if (! $action)
		echo '<a href="control.php?action=activate&filename=' . $plugin_header ['filename'] . '" title="activate this plugin">Activate</a>';
	else
		echo '<a href="control.php?action=deactivate&filename=' . $plugin_header ['filename'] . '" title="deactivate this plugin">Deactivate</a>';
	?>
			</td>
		</tr>
<?php
}
?>
	</tbody>
</table>
<div align="center"><a href="example.php" target="_blank">Example</a></div>

<?php
$db->close ();
?>