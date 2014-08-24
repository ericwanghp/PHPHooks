<?php

/*
Plugin Name: Plugin1
Plugin URI: https://github.com/ericwanghp/PHPHooks/blob/master/plugins/plugin1.plugin.php
Description: This is plugin1
Version: 1.1
Author: Eric Wang ZhengYu
Author URI: http://wangzhengyu.com/
*/

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