<?php
/*
Plugin Name: Plugin3
Plugin URI: http://www.avramovic.info/
Description: This is plugin3
Version: 1.1
Author: Nemanja Avramovic
Author URI: http://www.avramovic.info/
*/

//this plugin will never be loaded because the plugin file must be suffixed *.plugin.php.

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