<?php

declare(strict_types=1);

use Inilim\Tool\File;
use Inilim\IPDO\IPDOSQLite;

require_once \dirname(__DIR__) . '/bootstrap.dev.php';

\ini_set('memory_limit', '5M');

$file = 'D:\projects\SecLists\Discovery\Web-Content\DirBuster-2007_directory-list-2.3-big.txt';
$fileJson = __DIR__ . '/big_txt.json';

$connect = new IPDOSQLite(__DIR__ . '/big_txt.sqlite');
// $connect->createFunction('MY_REGEX', static function ($pattern, $subject) {
//     return (bool)\preg_match("/$pattern/", $subject);
// });
// $res = $connect->sequence();
// de($res);

$sql1 = 'SELECT json_extract(full_json, "$[222]") as item
    FROM (SELECT GROUP_CONCAT(value, "") AS full_json FROM parts);';

$sql2 = 'SELECT j.key as idx, j.value as item
FROM json_each((SELECT GROUP_CONCAT(value, "") AS full_json FROM parts)) j
LIMIT 1000,10';

$sql3 = 'SELECT count(*)
FROM json_each((SELECT GROUP_CONCAT(value, "") AS full_json FROM parts)) j';

try {
    $res = $connect->exec($sql3, 2);
} catch (\Throwable $e) {
    de($e);
}

de($res);


// de(sizeof($res));


$connect->exec('CREATE TABLE IF NOT EXISTS parts (
    id    INTEGER PRIMARY KEY AUTOINCREMENT
                  NOT NULL,
    value TEXT
);');

foreach (File::toCharsGenerator($fileJson, 8000) as $part) {
    // de($part);
    $connect->exec('INSERT INTO parts (value) VALUES ({value})', ['value' => $part]);
}
