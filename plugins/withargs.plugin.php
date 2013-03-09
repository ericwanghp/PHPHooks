<?php

/*
Plugin Name: Plugin Withargs
Plugin URI: http://www.instant-update.com/
Description: This is plugin withargs
Version: 1.0
Author: Nemanja Avramovic
Author URI: http://www.instant-update.com/
*/

//set plugin id as file name of plugin
$plugin_id = basename(__FILE__);

//some plugin data
$data['name'] = "With args";
$data['author'] = "Nemanja";
$data['url'] = "http://www.instant-update.com/";

//register plugin data
register_plugin($plugin_id, $data);

//plugin function with argument(s) which are sent from application
function args($time) {
	echo "NOW:".date('H:i', $time)." h<br />";
}

//add hook, where to execute a function
add_hook('with_args','args');

//code to execute when loading plugin
echo "<p>Clock plugin LOADED!</p>";

?>