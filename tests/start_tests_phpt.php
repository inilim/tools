<?php

use Inilim\Dump\Dump;
use Inilim\Tool\File;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Process\Process;

require_once __DIR__ . '/../vendor/autoload.php';

function getComments(string $code): string
{
    $res = \token_get_all($code);
    $res = \array_filter($res, static function ($token) {
        return \in_array($token[0], [\T_COMMENT, \T_DOC_COMMENT]);
    });
    $res = \array_column($res, 1);
    return \implode(PHP_EOL, $res);
}

/**
 * @return array<string,string>
 */
function parseComment(string $comment): array
{
    \preg_match_all(
        '/' .
            '@([a-z_]+)=([a-z\d_]+)' .
            '/i',
        $comment,
        $match
    );
    // de($match);
    $match = \array_combine($match[1] ?? [], $match[2] ?? []);
    return $match;
}

function fn_dir_files(string $dir): Finder
{
    $dir = \DIR_FILES . '/' . $dir;
    if (!\is_dir($dir)) {
        throw new \InvalidArgumentException();
    }
    $finder = new Finder;
    $finder->in($dir)
        ->files();
    return $finder;
}

Dump::init();

// ---------------------------------------------
// Проверить наличие исполняемого php бинаря
// ---------------------------------------------

$php_bins = [
    'D:\other\OSPanel\modules\PHP-7.4\PHP\php74.exe',
];

// ---------------------------------------------
// 
// ---------------------------------------------

$cases = new Finder;
$cases->in(__DIR__ . '/phpt')
    ->files()
    ->name('case*.php')
    // 
;

foreach ($php_bins as $php) {
    // ---------------------------------------------
    // INFO bin check
    // ---------------------------------------------

    if (!\is_executable($php)) {
        throw new \InvalidArgumentException(\sprintf('Неизвестный исполняемый файл php "%s"', $php));
    }

    foreach ($cases as $case) {
        $case        = $case->getPathname();
        $cli_command = [$php, $case];
        // ---------------------------------------------
        // INFO case test
        // ---------------------------------------------

        $code = \file_get_contents($case);
        $comments = \getComments($code);
        $code = '';
        $commands = \parseComment($comments);
        $comments = '';
        // de($commands);

        // ---------------------------------------------
        // INFO cli configs
        // ---------------------------------------------

        if (isset($commands['memory_limit'])) {
            $cli_command[] = \sprintf('--memory_limit="%s"', (string)$commands['memory_limit']);
            unset($commands['memory_limit']);
        }
        if (isset($commands['time_limit'])) {
            $cli_command[] = \sprintf('--time_limit="%s"', (string)$commands['time_limit']);
            unset($commands['time_limit']);
        }

        // ---------------------------------------------
        // 
        // ---------------------------------------------

        // switch (true) {
        //     case !$commands:
        //         // 
        //     case !!$commands:
        //         foreach ($commands as $command) {
        //         }
        // }


        // ---------------------------------------------
        // INFO exec
        // ---------------------------------------------
        // de();
        $process = new Process($cli_command);
        $process->run();
        dd($process->getOutput());
        dde($process->getErrorOutput());

        // ---------------------------------------------
        // INFO parse output
        // ---------------------------------------------
    }
}
