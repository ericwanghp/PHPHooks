<?php

/*
Plugin Name: Plugin Withargs
Plugin URI: http://www.instant-update.com/
Description: This is plugin withargs
Version: 1.1
Author: Nemanja Avramovic
Author URI: http://www.instant-update.com/
*/

//plugin function with argument(s) which are sent from application
function args($time) {
	echo "NOW:".date('H:i', $time)." h<br />";
}

//add hook, where to execute a function
add_hook('with_args','args');

//code to execute when loading plugin
echo "<p>Clock plugin LOADED!</p>";

?>