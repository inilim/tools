<?php

namespace Inilim\Tool\Test;

use Inilim\Tool\PF;
use Inilim\Tool\Path;
use Inilim\Tool\Test\DefinePhpBin;
use Inilim\Tool\Test\Tag\ErrorTag;
use Inilim\Tool\Test\Tag\AssertTag;
use Inilim\Tool\Test\Tag\ProcessTag;
use Inilim\Tool\Test\Tag\ShutdownTag;
use Inilim\Tool\Test\Tag\ExceptionTag;
use Symfony\Component\Process\Process;

class TestProcess
{
    protected static ?TestProcess $instance = null;

    static function self(): TestProcess
    {
        return self::$instance ??= new TestProcess;
    }

    // ---------------------------------------------
    // 
    // ---------------------------------------------

    protected DefinePhpBin $definePhpBin;

    protected function __construct()
    {
        $this->definePhpBin = new DefinePhpBin;
        $this->definePhpBin->definePhpBin();
        if (!$this->definePhpBin->getPhpBin()) {
            throw new \RuntimeException('Empty php bin');
        }
    }

    function testWithPhp(string $phpVersion, string $caseFile, ?string $iniFile = null)
    {
        // 
    }

    /**
     * @return AssertTag[]
     */
    function test(string $caseFile, ?string $iniFile = null): array
    {
        if (!\is_file($caseFile)) {
            throw new \RuntimeException(\sprintf('Not found file case "%s"', $caseFile));
        }

        $startCaseFile = $this->getStartCaseFile();

        if (!\is_file($startCaseFile)) {
            throw new \RuntimeException(\sprintf('Not found file start case "%s"', $startCaseFile));
        }

        $env = [
            'case' => $caseFile,
        ];

        $otherCommands = [];
        if ($iniFile) {
            if (!\is_file($iniFile)) {
                throw new \RuntimeException(\sprintf('Not found file ini "%s"', $iniFile));
            }
            $iniFile = Path::normalize($iniFile);
            $env['ini'] = $iniFile;
            $otherCommands = \array_merge($otherCommands, ['-c', \sprintf("%s", $iniFile)]);
        }

        $assertResults = [];
        foreach ($this->definePhpBin->getPhpBin() as $version => $php) {
            $process = new Process(\array_merge([$php, $startCaseFile], $otherCommands), null, ['__ENV' => \json_encode($env)]);
            $process->run();
            try {
                $output = $process->getOutput();
                $error = $process->getErrorOutput();
            } catch (\Throwable $e) {
                throw new \RuntimeException(\sprintf('Case run failed "%s" Version php: "%s"', $caseFile, $version));
            }

            if ($error !== '') {
                throw new \RuntimeException(\sprintf(
                    'Case exist error output "%s" Version php: "%s". %s',
                    $caseFile,
                    $version,
                    $this->wrapBlock($error)
                ));
            }

            $output = \trim($output);
            if ($output === '' || !PF::str_contains($output, '<assert')) {
                throw new \RuntimeException(\sprintf(
                    '$output empty or not found <assert /> tag. Case "%s" Version php: "%s".',
                    $caseFile,
                    $version
                ));
            }

            // ---------------------------------------------
            // Error
            // ---------------------------------------------

            if (PF::str_contains($output, '<error')) {
                // TODO парсить и сделать исключение
            }

            // ---------------------------------------------
            // Exception
            // ---------------------------------------------

            if (PF::str_contains($output, '<exception')) {
                // TODO парсить и сделать обработку
            }

            // ---------------------------------------------
            // 
            // ---------------------------------------------

            // TODO
            $this->parseShutdown($output, $caseFile, $version);

            // ---------------------------------------------
            // 
            // ---------------------------------------------

            // TODO Добавить проверки
            $processTag = $this->parseProcess($output, $caseFile, $version);

            if ($version !== $processTag->getPhpVersion()) {
                // 
            }

            if ($php !== $processTag->getPhpBin()) {
                // 
            }

            // ---------------------------------------------
            // 
            // ---------------------------------------------

            $assertResults = \array_merge($assertResults, $this->parseAsserts($output, $caseFile, $version));

            if ($output !== '') {
                throw new \RuntimeException(\sprintf(
                    '$output must be empty. Got: "%s". Case "%s" Version php: "%s".',
                    $this->wrapBlock($output),
                    $caseFile,
                    $version
                ));
            }
        }

        return $assertResults;
    }

    protected function parseException(string &$output, string $caseFile, string $version): ExceptionTag
    {
        \preg_match('/(<exception\s[^<>]*\>)/', $output, $exception);
        $exception = $exception[1] ?? null;
        $output = \preg_replace('/(<exception\s[^<>]*\>)/', '', $output);

        \preg_match('/class=\"([^\"]*)\"/i', $exception, $class);
        $class = $class[1] ?? null;

        \preg_match('/message=\"([^\"]*)\"/i', $exception, $message);
        $message = $message[1] ?? null;

        \preg_match('/file=\"([^\"]*)\"/i', $exception, $file);
        $file = $file[1] ?? null;

        \preg_match('/line=\"([^\"]*)\"/i', $exception, $line);
        $line = $line[1] ?? null;

        \preg_match('/code=\"([^\"]*)\"/i', $exception, $code);
        $code = $code[1] ?? null;

        \preg_match('/trace=\"([^\"]*)\"/i', $exception, $trace);
        $trace = $trace[1] ?? null;


        if (\in_array(null, [$class, $message, $file, $line, $code, $trace], true)) {
            $t = [
                '$class' => $class,
                '$message' => $message,
                '$file' => $file,
                '$line' => $line,
                '$code' => $code,
                '$trace' => $trace,
            ];
            throw new \RuntimeException(\sprintf(
                'Parse <exception /> tag failed: "%s". Case "%s" Version php: "%s".',
                $this->wrapBlock(\var_export($t, true)),
                $caseFile,
                $version,
            ));
        }

        return new ExceptionTag($class, $message, $file, $line, $code, $trace);
    }

    protected function parseError(string &$output, string $caseFile, string $version): ErrorTag
    {
        \preg_match('/(<error\s[^<>]*\>)/', $output, $error);
        $error = $error[1] ?? null;
        $output = \preg_replace('/(<error\s[^<>]*\>)/', '', $output);

        \preg_match('/message=\"([^\"]*)\"/i', $error, $message);
        $message = $message[1] ?? null;

        \preg_match('/file=\"([^\"]*)\"/i', $error, $file);
        $file = $file[1] ?? null;

        \preg_match('/line=\"([^\"]*)\"/i', $error, $line);
        $line = $line[1] ?? null;

        if (\in_array(null, [$message, $file, $line], true)) {
            $t = [
                '$message' => $message,
                '$file' => $file,
                '$line' => $line,
            ];
            throw new \RuntimeException(\sprintf(
                'Parse <error /> tag failed: "%s". Case "%s" Version php: "%s".',
                $this->wrapBlock(\var_export($t, true)),
                $caseFile,
                $version,
            ));
        }

        return new ErrorTag($message, $file, $line);
    }

    protected function parseShutdown(string &$output, string $caseFile, string $version): ShutdownTag
    {
        \preg_match('/(<shutdown\s[^<>]*\>)/', $output, $shutdown);
        $shutdown = $shutdown[1] ?? null;
        if (!$shutdown) {
            throw new \RuntimeException(\sprintf(
                'Not found <shutdown /> tag. Case "%s" Version php: "%s".',
                $caseFile,
                $version,
            ));
        }
        $output = \preg_replace('/(<shutdown\s[^<>]*\>)/', '', $output);

        // return new ShutdownTag();
    }

    protected function parseProcess(string &$output, string $caseFile, string $version): ProcessTag
    {
        \preg_match('/(<process\s[^<>]*\>)/', $output, $process);
        $process = $process[1] ?? null;
        if (!$process) {
            throw new \RuntimeException(\sprintf(
                'Not found <process /> tag. Case "%s" Version php: "%s".',
                $caseFile,
                $version,
            ));
        }
        $output = \preg_replace('/(<process\s[^<>]*\>)/', '', $output);

        \preg_match('/ini=\"([^\"]*)\"/i', $process, $ini);
        $ini = $ini[1] ?? null;

        \preg_match('/php_bin=\"([^\"]*)\"/i', $process, $php_bin);
        $php_bin = $php_bin[1] ?? null;

        \preg_match('/php_version=\"([^\"]*)\"/i', $process, $php_version);
        $php_version = $php_version[1] ?? null;

        \preg_match('/case=\"([^\"]*)\"/i', $process, $case);
        $case = $case[1] ?? null;

        if (\in_array(null, [$ini, $php_bin, $php_version, $case], true)) {
            $t = [
                '$ini' => $ini,
                '$php_bin' => $php_bin,
                '$php_version' => $php_version,
                '$case' => $case,
            ];
            throw new \RuntimeException(\sprintf(
                'Parse <process /> tag failed: "%s". Case "%s" Version php: "%s".',
                $this->wrapBlock(\var_export($t, true)),
                $caseFile,
                $version,
            ));
        }

        return new ProcessTag($ini, $php_bin, $php_version, $case);
    }

    /**
     * @return AssertTag[]
     */
    protected function parseAsserts(string &$output, string $caseFile, string $version): array
    {
        \preg_match_all('/(<assert\s[^<>]*\>)/', $output, $asserts);
        $asserts = $asserts[1] ?? [];
        if (!$asserts) {
            throw new \RuntimeException(\sprintf(
                'Not found <assert /> tag. Case "%s" Version php: "%s".',
                $caseFile,
                $version
            ));
        }
        $output = \preg_replace('/(<assert\s[^<>]*\>)/', '', $output);
        // 
        // new AssertResult();
        $assertResults = [];
        foreach ($asserts as $assert) {

            \preg_match('/name=\"([a-z]+)\"/i', $assert, $name);
            $name = $name[1] ?? null;

            \preg_match('/status=\"(\d)\"/', $assert, $status);
            $status = $status[1] ?? null;

            \preg_match('/message=\"([a-z\d=\/]+)\"/i', $assert, $message);
            $message = $message[1] ?? null;

            \preg_match('/expected=\"([a-z\d=\/]+)\"/i', $assert, $expected);
            $expected = $expected[1] ?? null;

            \preg_match('/actual=\"([a-z\d=\/]+)\"/i', $assert, $actual);
            $actual = $actual[1] ?? null;

            if (\in_array(null, [$name, $status, $message, $expected, $actual], true)) {
                $t = [
                    '$name' => $name,
                    '$status' => $status,
                    '$message' => $message,
                    '$expected' => $expected,
                    '$actual' => $actual,
                ];
                throw new \RuntimeException(\sprintf(
                    'Parse <assert /> tag failed: "%s". Case "%s" Version php: "%s".',
                    $this->wrapBlock(\var_export($t, true)),
                    $caseFile,
                    $version,
                ));
            }

            $assertResults[] = new AssertTag($name, $status, $expected, $actual, $message);
        }

        return $assertResults;
    }

    protected function wrapBlock(string $value): string
    {
        return PHP_EOL . \str_repeat('-', 25) . PHP_EOL . $value . PHP_EOL . \str_repeat('-', 25) . PHP_EOL;
    }

    protected function getStartCaseFile(): string
    {
        return Path::normalize(__DIR__ . '/start_tests_phpt.php');
    }
}
