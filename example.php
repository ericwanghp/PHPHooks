<?php

//init plugins system
include "init.php";

//your application code
echo "<p>some hardcoded stuff, 'test' hook following</p>";

//place this where you want to execute hooks for "test"
if ($hook->hook_exist ( 'test' )) {
	$hook->execute_hook ( 'test' );
} else {
	echo ('<p><p>no any plugin hooks into TEST!!!</p></p>');
}

//your application code
echo "<p>some hardcoded stuff, 'test1' hook following</p>";

//execute hooks for "test1" only if there are hooks to execute
if ($hook->hook_exist ( 'test1' )) {
	$hook->execute_hook ( 'test1' );
} else {
	echo ('<p><p>no any plugin hooks into TEST1!!!</p></p>');
}

//your application code
echo "<p>some hardcoded stuff, 'test2' hook following</p>";

//execute hooks for "test2" only if there are hooks to execute
if ($hook->hook_exist ( 'test2' )) {
	$hook->execute_hook ( 'test2' );
} else {
	echo ('<p>no any plugin hooks into TEST2!!!</p>');
}

//your application code
echo "<p>some hardcoded stuff, 'with_args' hook following</p>";

//execute hooks for "with_args" only if there are hooks to execute
if ($hook->hook_exist ( 'with_args' )) {
	$hook->execute_hook ( 'with_args', time() );
} else {
	echo ('<p><p>no any plugin hooks on with_args!!!</p></p>');
}

//your application code
echo "<p>some hardcoded stuff, 'filter' hook following</p>";

//execute hooks for "filter" only filter the $args and return its.


$urls[] = "ericbess";
$urls[] = "google";

if ($hook->hook_exist ( 'filter' )) {
	echo 'Before filter:</br>' . $urls [0] . '</br>' . $urls [1] . '</br></br>';
	$result = $hook->filter_hook ( 'filter', $urls );
	echo 'After filter:</br>' . $result [0] . '</br>' . $result [1] . '</br>';
} else {
	echo ('<p><p>no any plugin hooks on filter!!!</p></p>');
}

//print the the plugins header
echo "<p>Print all plugins hearder</p>";
echo "<pre>";
print_r ( $hook->get_plugins_header () );
echo "</pre>";
?>