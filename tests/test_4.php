<?php

declare(strict_types=1);

use Inilim\Tool\PF;
use Inilim\Tool\Exp;
use Inilim\Tool\File;
use Inilim\Tool\Other;
use Inilim\Tool\Test\CasePhpT;
use Inilim\Tool\Test\TestProcess;
use Inilim\Tool\Test\DefinePhpBin;
use Symfony\Component\Finder\Finder;


require_once \dirname(__DIR__) . '/bootstrap.dev.php';

\ini_set('memory_limit', '5M');

__includeDeep([
    // 'Other\phpInfoCache',
    // 'Other\phpInfo',
]);

function str_decrement(string $string): string
{
    if (\substr($string, -1) !== '0') {
        return \implode('', \array_slice(\str_split($string), 0, -1)) . \chr(\ord(\substr($string, -1)) - 1);
    }

    $carry = '';
    $decremented = '';
    for ($i = \strlen($string) - 1; $i >= 0; --$i) {
        $char = $string[$i];
        dd($char);

        switch ($char) {
            case '0':
                if ('' !== $carry) {
                    $decremented = $carry . $decremented;
                    $carry = '';
                }
                $carry = '9';

                break;
            case '1':
                if ('' !== $carry) {
                    $decremented = $carry . $decremented;
                    $carry = '';
                }

                break;
            default:
                if ('' !== $carry) {
                    $decremented = $carry . $decremented;
                    $carry = '';
                }

                if ($char !== '0') {
                    $decremented = \chr(\ord($char) - 1) . $decremented;
                }
        }
    }

    return $decremented;
}


// de(PF::str_decrement('9999'));
de(\str_decrement('1999999990'));


de();
$code = File::get('D:\projects\tools\src\Method\Arr\where.php');

$tokens = \token_get_all($code['result']);
de($tokens);


$files = new Finder;
$files->files()->in(__DIR__ . '/files')->name(['*.xlsx']);
foreach (CasePhpT::self()->cases([Exp::class, 'excelGetSheetsInfo']) as $case) {
    foreach ($files as $file => $_) {
        $asserts = (new TestProcess($case))->withPhp('7.4')->withEnv('file', $file)->run();
        de($asserts);
        foreach ($asserts as $assert) {
        }
    }
}


// de(ini_get_all());
de([
    'php_ini_loaded_file'   => \php_ini_loaded_file(),
    'php_ini_scanned_files' => \php_ini_scanned_files(),
    'get_loaded_extensions' => \get_loaded_extensions(),
    // 'ini_get_all' => \ini_get_all(),
    'cli_get_process_title' => \cli_get_process_title(),
]);

de();
$a = new DefinePhpBin;
$a->definePhpBin();
de($a->getPhpBin());
