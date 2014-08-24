<?php
require_once ('includes/database.class.php');
require_once ('includes/config.class.php');

if (file_exists ( 'config.php' )) {
	require_once ('config.php');
} else {
	$mysql_db_name = '';
	$mysql_db_user = '';
	$mysql_db_passwd = '';
	$mysql_db_host = 'localhost';
	$table_prefix = 'plugins_';
}

if (isset ( $_GET ['step'] ))
	$step = $_GET ['step'];
else
	$step = 0;

switch ($step) {
	case 0 :
		display_header ();
		?>
<p>Welcome to PHP HOOKS. Before getting started, we need some
information for configuration. You will need to know the following items
before proceeding.</p>
<ol>
	<li>MYSQL Database name</li>
	<li>MYSQL Database username</li>
	<li>MYSQL Database password</li>
	<li>MYSQL Database host</li>
	<li>Table prefix (if you want to run more than one application in a
	single database)</li>
</ol>
<p><strong>If for any reason this automatic file creation doesn't work,
don't worry. You may also simply open <code>config_sample.php</code> in
a text editor, fill in your information, and save it as <code>config.php</code>.
</strong></p>
<p>In all likelihood, these items were supplied to you by your Web Host.
If you do not have this information, then you will need to contact them
before you can continue. If you&#8217;re all ready&hellip;</p>

<p class="step"><a href="setup.php?step=1" class="button">Let&#8217;s
go!</a></p>
<?php
		break;
	
	case 1 :
		display_header ();
		?>
<form method="post" action="setup.php?step=2">
<p>Below you should enter your configuration details. If you're not sure
about these, contact your host provider.</p>
<table class="form-table">
	<tr>
		<th scope="row"><label for="dbname">Database Name</label></th>
		<td><input name="dbname" id="dbname" type="text" size="25"
			value="<?php
		echo $mysql_db_name;
		?>" /></td>
		<td>Your MySQL DB name.</td>
	</tr>
	<tr>
		<th scope="row"><label for="uname">DB User Name</label></th>
		<td><input name="uname" id="uname" type="text" size="25"
			value="<?php
		echo $mysql_db_user;
		?>" /></td>
		<td>Your MySQL username.</td>
	</tr>
	<tr>
		<th scope="row"><label for="pwd">DB User Password</label></th>
		<td><input name="pwd" id="pwd" type="password" size="27"
			value="<?php
		echo $mysql_db_passwd;
		?>" /></td>
		<td>...and MySQL password.</td>
	</tr>
	<tr>
		<th scope="row"><label for="dbhost">Database Host</label></th>
		<td><input name="dbhost" id="dbhost" type="text" size="25"
			value="<?php
		echo $mysql_db_host;
		?>" /></td>
		<td>Database host address.</td>
	</tr>
	<tr>
		<th scope="row"><label for="prefix">Table Prefix</label></th>
		<td><input name="prefix" id="prefix" type="text" id="prefix"
			value="<?php
		echo $table_prefix;
		?>" size="25" /></td>
		<td>If you want to run multiple applications in a single database,
		change this.</td>
	</tr>
</table>
<p class="step"><input name="submit" type="submit" value="Submit"
	class="button" /></p>
</form>
<?php
		break;
	
	case 2 :
		
		$post = array_map ( 'trim', $_POST );
		extract ( $post );
		
		display_header ();
		
		$db = new Database ( $dbhost, $uname, $pwd, $dbname, $prefix );
		$db->connect ();
		
		// If there was a problem connecting to the database display error information and exit script.
		if (count ( $db->errors ) > 0) {
			echo 'Database Connection Error!';
			foreach ( $db->errors as $error )
				echo $error . '<br />';
			echo '<p class="step"><a href="setup.php?step=1" class="button">Go Back</a></p>';
			exit ();
		}
		$c = new config ( );
		$c->setFile ( 'config.php' );
		$c->openFile ();
		$c->insert ( "mysql_db_name", $dbname );
		$c->insert ( "mysql_db_user", $uname );
		$c->insert ( "mysql_db_passwd", $pwd );
		$c->insert ( "mysql_db_host", $dbhost );
		$c->insert ( "table_prefix", $prefix );
		
		$c->closeFile ();
		
		create_db ( $db, $prefix );
		$db->close ();
		?>
<p>All right sparky! You've made it through this part of the
installation. Now the plugin system database has been created. If you are
ready, time now to&hellip;</p>

<p class="step"><a href="control.php" class="button">Go To Control Panel</a></p>
<?php
		break;
}

function display_header($type = '') {
	switch ($type) {
		default :
			$title = "Setup Page";
			$csss [] = "css/install.css";
	}
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome - PHP Plugins System Solution &rsaquo; <?php
	echo $title;
	?></title>
<meta name="keywords" content="php,hook,plugin" />
<?php
	foreach ( $csss as $css )
		echo "<link rel='stylesheet' href='$css' type='text/css' />\n";
	?>
</head>
<body>
<div id="dcpage">
<div id="header"><a href="index.php">
<h1>PHP HOOKS - a plugin system solution</h1>
</a></div>
<?php
}

function create_db($db, $prefix) {
	// Create disputes table
	$sql = "CREATE TABLE IF NOT EXISTS `" . $prefix . "plugins` (
		`filename` varchar(127) collate utf8_bin default NULL,
		`action` tinyint(1) default '0',
		PRIMARY KEY  (`filename`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1";
	$db->query ( $sql );
	if (count ( $db->errors ) > 0) {
		foreach ( $db->errors as $error )
			echo $error . '<br />';
		exit ();
	}
}
?>
</div>
<!-- end div#dcpage -->
</body>
</html>
