<?php
/*
Plugin Name: Plugin2
Plugin URI: https://github.com/ericwanghp/PHPHooks/blob/master/plugins/plugin2/plugin2.plugin.php
Description: This is plugin2
Version: 1.1
Author: Eric Wang ZhengYu
Author URI: http://www.wangzhengyu.com/
*/
/*
 * a Class Structure to design plugin.
 * It's necessary in order to avoid naming collisions with other plugins. 
 * If someone out there sets up the same function name as yours in a plugin, 
 * an error will result and system will be rendered inoperable until that plugin is removed. 
 * 
 * To avoid naming collisions, it is imperative that all plugins incorporate a PHP class structure. 
 * Here is some example code that will allow you to set up a class structure.
 */

class plugin2 {
	function plg2() {
		echo 'Plugin2 hooks into TEST, priority = 2<br />';
	}
	
	function njeh() {
		echo "Plugin2 hooks into TEST1<br />";
	}
	
	function filter1($urls) {
		$return [] = "http://www.$urls[0].com";
		$return [] = "http://www.$urls[1].com";
		return $return;
	}
}

$plg2 = new plugin2 ( );
add_hook ( 'filter', array(&$plg2,'filter1'), 2 );
add_hook ( 'test', array(&$plg2,'plg2'), 2 );
add_hook ( 'test1', array(&$plg2,'njeh'));

echo "<p>Plugin 2 LOADED!</p>";

?>