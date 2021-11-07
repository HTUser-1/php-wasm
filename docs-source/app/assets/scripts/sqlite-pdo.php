<?php // {"autorun":true, "persist":false, "single-expression": false, "render-as": "text"}

$db = new PDO('sqlite:people.db');

$db->query('CREATE TABLE IF NOT EXISTS people (
	id INTEGER PRIMARY KEY,
   	name TEXT NOT NULL
);');

for($i = 0; $i < 10; $i++) {
	$insert = $db->prepare('INSERT INTO people (name) VALUES(:name)');
	$insert->bindParam(':name', str_repeat(chr($i+64), 10), SQLITE3_TEXT);

	$insert->execute();
}

$results = $db->query('SELECT * FROM people');

$rows = [];

while ($row = $results->fetchObject()) {
    print_r($row);
}
