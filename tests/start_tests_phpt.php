<?php

use Inilim\Dump\Dump;
use Inilim\Tool\File;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Process\Process;

require_once __DIR__ . '/../vendor/autoload.php';

/**
 * @return string[]
 */
function getComments(string $code): array
{
    $res = \token_get_all($code);
    $res = \array_filter($res, static function ($token) {
        return \in_array($token[0], [\T_COMMENT, \T_DOC_COMMENT]);
    });
    return \array_column($res, 1);
}

/**
 * @param string[] $comment
 * @return array<string,string|string[]>
 */
function parseComment(array $comments): array
{
    foreach ($comments as &$block) {
        \preg_match_all(
            '/' .
                '@([a-z_]+\[?\]?)=([a-z\d_]+)' .
                '/i',
            $block,
            $match
        );
        // $match = \array_combine($match[1] ?? [], $match[2] ?? []);
        // de($match);
        $match = \array_map(static function ($value1, $value2) {
            return $value1 . '=' . $value2;
        }, $match[1], $match[2]);
        $match = \implode(PHP_EOL, $match);
        $match = \parse_ini_string($match);
        $block = $match;
    }
    return $comments;
}

function data_dir_files(string $dir): Finder
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

    foreach ($cases as $case => $_) {
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

        if (\is_string($commands['memory_limit'] ?? null)) {
            $cli_command[] = \sprintf('--memory_limit="%s"', $commands['memory_limit']);
            unset($commands['memory_limit']);
        }
        if (\is_string($commands['time_limit'] ?? null)) {
            $cli_command[] = \sprintf('--time_limit="%s"', $commands['time_limit']);
            unset($commands['time_limit']);
        }

        // ---------------------------------------------
        // Есть дата провайдер
        // ---------------------------------------------

        if (\is_array($commands['data'] ?? null) || \is_string($commands['data'] ?? null)) {
            $data = $commands['data'];
            if (\is_string($data)) {
                $data = [$data];
            }
            foreach ($data as $provider) {
                // 
            }
            continue;
        }


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
