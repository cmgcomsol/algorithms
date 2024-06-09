<?php
require "nosqlsqlite3.php";

$db = new NoSQLSqlite3("example.sqlite3");

var_dump($db->getKeylist());

for ($i = 0; $i < 100; $i++) {
    $db->set("a" . $i, time());
}

foreach ($db->getKeylist() as $key) {
    echo "\n $key=" . $db->get($key);
}


for ($i = 0; $i < 100; $i++) {
    $db->del("a" . $i);
}


foreach ($db->getKeylist() as $key) {
    echo "\n $key=" . $db->get($key);
}
