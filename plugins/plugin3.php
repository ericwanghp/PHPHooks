<?php
/*
Plugin Name: Plugin3
Plugin URI: http://www.avramovic.info/
Description: This is plugin3
Version: 1.0
Author: Nemanja Avramovic
Author URI: http://www.avramovic.info/
*/

//this plugin will never be loaded because it has no valid file name (*.plugin.php)

$plugin_id = basename(__FILE__);

$data['name'] = "Third plugin";
$data['author'] = "Nemanja Avramovic";
$data['url'] = "http://www.avramovic.info/";

//register plugin data
register_plugin($plugin_id, $data);

function plg3() {
	echo 'Plugin3 hooks into TEST,priority = 15<br />';
}

function njeh() {
	echo "Plugin3 hooks into TEST1<br />";
}

add_hook('test','plg3',15);
add_hook('test1','njeh');

echo "Plugin 3 LOADED!<br />";
?>