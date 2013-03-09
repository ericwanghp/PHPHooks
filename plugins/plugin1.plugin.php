<?php

/*
Plugin Name: Plugin1
Plugin URI: http://code.google.com/p/phphooks/source/browse/trunk/plugins/plugin1.plugin.php
Description: This is plugin1
Version: 1.0
Author: Eric Wang
Author URI: http://www.ericbess.com/
*/


//set plugin id as file name of plugin
$plugin_id = basename(__FILE__);

//some plugin data
$data['name'] = "First plugin";
$data['author'] = "eric wang";
$data['url'] = "http://www.ericbess.com/";

//register plugin data
register_plugin($plugin_id, $data);

//plugin function
function plugin1_testfunc() {
	echo 'Plugin1 hooks into TEST, priority = default(10)<br />';
}

function plugin1_filter2($urls) {
	$return[] = "$urls[0]:80/";
	$return[] = "$urls[1]:80/";
	return $return;
}

add_hook('filter','plugin1_filter2',7);

//add hook, where to execute a function
add_hook('test','plugin1_testfunc');

//code to execute when loading plugin
echo "<p>Plugin 1 LOADED!</p>";
?>