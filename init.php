<?php

//include PHP HOOKS Class
include_once "phphooks.class.php";

//create instance of class
$hook = new phphooks ( );

//fetch the active plugins name form db. store in array $plugins. 
include_once 'includes/database.class.php';
require_once ('config.php');
$db = new Database ( $mysql_db_host, $mysql_db_user, $mysql_db_passwd, $mysql_db_name, $table_prefix );
$db->connect ();
$sql = "SELECT filename FROM " . $table_prefix . "plugins WHERE action = '" . $db->escape ( 1 ) . "'";
$result_rows = $db->fetch_all_array ( $sql );

foreach ( $result_rows as $result_rows )
	$hook->active_plugins[] = $result_rows ['filename'];
	
//set hook to which plugin developers can assign functions
$hook->set_hook ( 'test' );

//set multiple hooks to which plugin developers can assign functions
$hook->set_hooks ( array ('test1', 'test2', 'with_args', 'filter' ) );

//load plugins from folder, if no argument is supplied, a 'plugins/' constant will be used
//trailing slash at the end is REQUIRED!
//this method will load all *.plugin.php files from given directory, INCLUDING subdirectories
$hook->load_plugins ();

//now, this is a workaround because plugins, when included, can't access $hook variable, so we
//as developers have to basically redefine functions which can be called from plugin files
function add_hook($tag, $function, $priority = 10) {
	global $hook;
	$hook->add_hook ( $tag, $function, $priority );
}

//same as above
function register_plugin($plugin_id, $data) {
	global $hook;
	$hook->register_plugin ( $plugin_id, $data );
}

?>