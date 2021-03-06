--TEST--
SQLite3::enableExceptions test
--CREDITS--
Thijs Feryn <thijs@feryn.eu>
#TestFest PHPBelgium 2009
--SKIPIF--
<?php require_once(dirname(__FILE__) . '/skipif.inc'); ?>
--FILE--
<?php

$db = new SQLite3(':memory:');
var_dump($db->enableExceptions(true));
try{
    $db->query("SELECT * FROM non_existent_table");
} catch(Exception $e) {
    echo $e->getMessage().PHP_EOL;
}
var_dump($db->enableExceptions(false));
$db->query("SELECT * FROM non_existent_table");
var_dump($db->enableExceptions("wrong_type","wrong_type"));
echo "Closing database\n";
var_dump($db->close());
echo "Done\n";
?>
--EXPECTF--
bool(false)
no such table: non_existent_table
bool(true)

Warning: SQLite3::query(): no such table: non_existent_table in %s on line %d

Warning: SQLite3::enableExceptions() expects at most 1 parameter, 2 given in %s on line %d
NULL
Closing database
bool(true)
Done
