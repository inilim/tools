<?php

declare(strict_types=1);

use Inilim\Tool\PF;
use Inilim\Tool\File;
use Inilim\Tool\Path;

require_once \dirname(__DIR__) . '/bootstrap.dev.php';

$links = include \DIR_ROOT . '/files/links.php';

$notFoundTest = 0;
$foundTest    = 0;

foreach ($links as $link) {
    /**
     * @var array{method:string,tool:string,nameClass:string,path:string,pathMin:string,pathToClass:string} $link
     */

    $pattern = \sprintf(
        '%s/src/Method/%s/*.php',
        \DIR_ROOT,
        $link['nameClass'],
    );

    $files = \glob($pattern);

    foreach ($files as $file) {
        $fileInfo = Path::info($file);

        if (\in_array($fileInfo['name'], [
            '__state',
            '__resource',
            '__resourceCache',
        ])) {
            continue;
        }

        $fileTest = \sprintf(
            '%s/tests/Method/%s/%s',
            \DIR_ROOT,
            $link['nameClass'],
            $fileInfo['name'] . 'Test.php'
        );

        $exists = \is_file($fileTest);

        // Проверяем на наличие тестов с флагом "inactive"
        if ($exists && PF::str_contains(File::get($fileTest)['result'] ?? '', '@group inactive')) {
            $exists = false;
        }

        if (!$exists) {
            echo \sprintf('%s::%s', $link['nameClass'], $fileInfo['name']) . PHP_EOL;
            $notFoundTest++;
        } else {
            $foundTest++;
        }
    }
}


de([
    'Есть тесты'  => $foundTest,
    'Нету тестов' => $notFoundTest,
]);
