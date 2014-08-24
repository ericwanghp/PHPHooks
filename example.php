<!DOCTYPE html>
<html>
<head>
<style type="text/css">
div#alarm {
	background-color: #ffff99;
}

div#hearder {
	background-color: #c0c0c0;
}

div#hook {
	background-color: rgb(231, 247, 211);
}
</style>
</head>
<body>
<?php
// init plugins system
include_once "init.php";

// your application code
echo "<p>Some hardcoded stuff, 'test' hook following:</p>";

// place this where you want to execute hooks for "test"
if ($hook->hook_exist ( 'test' )) {
	echo '<div id="hook">';
	$hook->execute_hook ( 'test' );
	echo '</div>';
} else {
	echo '<div id="alarm"><p>not any plugin hooks into TEST!!!</p></div>';
}

// your application code
echo "<p>Some hardcoded stuff, 'test1' hook following:</p>";

// execute hooks for "test1" only if there are hooks to execute
if ($hook->hook_exist ( 'test1' )) {
	echo '<div id="hook">';
	$hook->execute_hook ( 'test1' );
	echo '</div>';
} else {
	echo '<div id="alarm"><p>not any plugin hooks into TEST1!!!</p></div>';
}

// your application code
echo "<p>Some hardcoded stuff, 'test2' hook following:</p>";

// execute hooks for "test2" only if there are hooks to execute
if ($hook->hook_exist ( 'test2' )) {
	echo '<div id="hook">';
	$hook->execute_hook ( 'test2' );
	echo '</div>';
} else {
	echo '<div id="alarm"><p>not any plugin hooks into TEST2!!!</p></div>';
}

// your application code
echo "<p>Some hardcoded stuff, 'with_args' hook following:</p>";

// execute hooks for "with_args" only if there are hooks to execute
if ($hook->hook_exist ( 'with_args' )) {
	echo '<div id="hook">';
	$hook->execute_hook ( 'with_args', time () );
	echo '</div>';
} else {
	echo '<div id="alarm"><p>not any plugin hooks on with_args!!!</p></div>';
}

// your application code
echo "<p>Some hardcoded stuff, 'filter' hook following:</p>";

// execute hooks for "filter" only filter the $args and return its.

$urls [] = "wangzhengyu";
$urls [] = "google";
echo 'Before the filter:</br>' . $urls [0] . '</br>' . $urls [1] . '</br></br>';
if ($hook->hook_exist ( 'filter' )) {
	$urls = $hook->filter_hook ( 'filter', $urls );
	echo '<div id="hook">';
	echo 'After the filter:</br>' . $urls [0] . '</br>' . $urls [1] . '</br>';
	echo '</div>';
} else {
	echo 'After the filter:</br>' . $urls [0] . '</br>' . $urls [1] . '</br>';
	echo '<div id="alarm"><p>not any plugin hooks on filter!!!</p></div>';
}

// print the plugins header
echo "<div id=\"hearder\"><p>Print all plugins header</p>";
echo "<pre>";
print_r ( $hook->get_plugins_header () );
echo "</pre>";

// print hooks array
echo "<p>Print hooks array</p>";
echo "<pre>";
print_r ( $hook->hooks );
echo "</pre></div>";
?>
</body>
</html>
