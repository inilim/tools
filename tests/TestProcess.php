<?php

namespace Inilim\Tool\Test;

use Inilim\Tool\PF;
use Inilim\Tool\Str;
use Inilim\Tool\Path;
use Inilim\Tool\Test\DefinePhpBin;
use Inilim\Tool\Test\Tag\ErrorTag;
use Inilim\Tool\Test\Tag\AssertTag;
use Inilim\Tool\Test\Tag\ProcessTag;
use Inilim\Tool\Test\Tag\ShutdownTag;
use Inilim\Tool\Test\Tag\ExceptionTag;
use Symfony\Component\Process\Process;

/**
 * Тестирование через дочерние процессы
 */
class TestProcess
{
    protected string $caseFile;
    protected string $php;
    protected string $phpVersion;
    protected array $dataEnv = [];

    function __construct(string $caseFile)
    {
        if (!\is_file($caseFile)) {
            throw new \RuntimeException(\sprintf('Not found file case "%s"', $caseFile));
        }
        $this->caseFile = $caseFile;
        $this->dataEnv['case'] = $caseFile;
    }

    /**
     * @return self
     */
    function withPhp(string $phpVersion)
    {
        $php = DefinePhpBin::self()->getPhpBin()[$phpVersion] ?? null;
        if ($php === null) {
            throw new \RuntimeException(\sprintf('Not found php version "%s"', $phpVersion));
        }
        $this->php        = $php;
        $this->phpVersion = $phpVersion;
        return $this;
    }

    /**
     * @return self
     */
    function withComposerAutoloadInclude()
    {
        $this->dataEnv['composer_autoload'] = true;
        return $this;
    }

    /**
     * TODO
     * @return self
     */
    function withIni(string $iniFile)
    {
        // 
        return $this;
    }

    /**
     * @param mixed $value
     * @return self
     */
    function withEnv(string $name, $value)
    {
        $this->dataEnv[$name] = $value;
        return $this;
    }

    /**
     * @return self
     */
    function withTimeLimit(int $seconds)
    {
        $this->dataEnv['time_limit'] = $seconds;
        return $this;
    }

    /**
     * @param string $value 5M 1G ...
     * @return self
     */
    function withMemoryLimit(string $value)
    {
        if (!\preg_match('/^\d+[MG]{1}$/', $value)) {
            throw new \InvalidArgumentException(\sprintf('memoty limit invalid value "%s"', $value));
        }
        $this->dataEnv['memory_limit'] = $value;
        return $this;
    }

    /**
     * @return AssertTag[]
     */
    function run(): array
    {
        if (!isset($this->php) || !isset($this->phpVersion)) {
            throw new \RuntimeException('php and phpVersion required');
        }
        return $this->_test();
    }

    // ---------------------------------------------
    // 
    // ---------------------------------------------

    protected function _test(): array
    {
        $startCaseFile = $this->getStartCaseFile();
        if (!\is_file($startCaseFile)) {
            throw new \RuntimeException(\sprintf('Not found file start case "%s"', $startCaseFile));
        }

        $process = new Process(\array_merge([$this->php, $startCaseFile]), null, ['__ENV' => \json_encode($this->dataEnv)]);
        $process->run();
        try {
            $output = $process->getOutput();
            $error = $process->getErrorOutput();
        } catch (\Throwable $e) {
            throw new \RuntimeException(\sprintf('Get output failed. Case "%s" Version php: "%s"', $this->caseFile, $this->phpVersion));
        }

        if ($error !== '') {
            throw new \RuntimeException(\sprintf(
                'Exist error output. Case "%s" Version php: "%s". %s',
                $this->caseFile,
                $this->phpVersion,
                $this->wrapBlock($error)
            ));
        }

        $output = Str::trim($output);
        if ($output === '' || !PF::str_contains($output, '<assert')) {
            throw new \RuntimeException(\sprintf(
                '$output empty or not found <assert /> tag. Case "%s" Version php: "%s". $output: %s',
                $this->caseFile,
                $this->phpVersion,
                $this->wrapBlock($output)
            ));
        }

        // ---------------------------------------------
        // Process tag
        // ---------------------------------------------

        $processTag = $this->parseProcess($output);

        if ($this->phpVersion !== $processTag->getPhpVersion()) {
            throw new \RuntimeException(\sprintf(
                'Version php not equal %s !== %s. Case "%s" Version php: "%s".',
                $this->phpVersion,
                $processTag->getPhpVersion(),
                $this->caseFile,
                $this->phpVersion
            ));
        }

        if ($this->php !== $processTag->getPhpBin()) {
            throw new \RuntimeException(\sprintf(
                'php bin not equal %s !== %s. Case "%s" Version php: "%s".',
                $this->php,
                $processTag->getPhpBin(),
                $this->caseFile,
                $this->phpVersion
            ));
        }

        if ($this->caseFile !== $processTag->getCase()) {
            throw new \RuntimeException(\sprintf(
                'Case file not equal %s !== %s. Case "%s" Version php: "%s".',
                $this->caseFile,
                $processTag->getCase(),
                $this->caseFile,
                $this->phpVersion
            ));
        }
        // TODO ini file

        // ---------------------------------------------
        // Error
        // ---------------------------------------------

        if (PF::str_contains($output, '<error')) {
            // TODO парсить и сделать исключение
            $errorTag = $this->parseError($output, $processTag);
            if ($errorTag) {
                $errorTag->throw();
            }
        }

        // ---------------------------------------------
        // Exception
        // ---------------------------------------------

        $exceptionTag = null;
        if (PF::str_contains($output, '<exception')) {
            // TODO парсить и сделать обработку
            $exceptionTag = $this->parseException($output);
        }

        // ---------------------------------------------
        // 
        // ---------------------------------------------

        // TODO
        $this->parseShutdown($output);

        // ---------------------------------------------
        // 
        // ---------------------------------------------

        $assertResults = $this->parseAsserts($output, $processTag, $exceptionTag);
        // de($assertResults);
        $output = Str::trim($output);
        // dde($output);
        if ($output !== '') {
            throw new \RuntimeException(\sprintf(
                '$output must be empty. Got: "%s". Case "%s" Version php: "%s".',
                $this->wrapBlock($output),
                $this->caseFile,
                $this->phpVersion
            ));
        }

        return $assertResults;
    }

    protected function parseException(string &$output): ?ExceptionTag
    {
        \preg_match('/(<exception\s[^<>]*\>)/', $output, $exception);
        $exception = $exception[1] ?? null;
        if ($exception === null) {
            return null;
        }
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
                $this->caseFile,
                $this->phpVersion,
            ));
        }

        return new ExceptionTag($class, $message, $file, $line, $code, $trace);
    }

    protected function parseError(string &$output, ProcessTag $processTag): ?ErrorTag
    {
        \preg_match('/(<error\s[^<>]*\>)/', $output, $error);
        $error = $error[1] ?? null;
        if ($error === null) {
            return null;
        }
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
                $this->caseFile,
                $this->phpVersion,
            ));
        }

        return new ErrorTag($message, $file, $line, $processTag);
    }

    protected function parseShutdown(string &$output)
    {
        \preg_match('/(<shutdown\s[^<>]*\>)/', $output, $shutdown);
        $shutdown = $shutdown[1] ?? null;
        if (!$shutdown) {
            throw new \RuntimeException(\sprintf(
                'Not found <shutdown /> tag. Case "%s" Version php: "%s".',
                $this->caseFile,
                $this->phpVersion
            ));
        }
        $output = \preg_replace('/(<shutdown\s[^<>]*\>)/', '', $output);

        // return new ShutdownTag();
    }

    protected function parseProcess(string &$output): ProcessTag
    {
        \preg_match('/(<process\s[^<>]*\>)/', $output, $process);
        $process = $process[1] ?? null;
        if (!$process) {
            throw new \RuntimeException(\sprintf(
                'Not found <process /> tag. Case "%s" Version php: "%s".',
                $this->caseFile,
                $this->phpVersion
            ));
        }
        $output = \preg_replace('/(<process\s[^<>]*\>)/', '', $output);

        // \preg_match('/ini=\"([^\"]*)\"/i', $process, $ini);
        // $ini = $ini[1] ?? null;

        // \preg_match('/php_bin=\"([^\"]*)\"/i', $process, $php_bin);
        // $php_bin = $php_bin[1] ?? null;

        // \preg_match('/php_version=\"([^\"]*)\"/i', $process, $php_version);
        // $php_version = $php_version[1] ?? null;

        // \preg_match('/case=\"([^\"]*)\"/i', $process, $case);
        // $case = $case[1] ?? null;

        // \preg_match('/env=\"([^\"]*)\"/i', $process, $env);
        // $env = $env[1] ?? null;

        \preg_match('/data=\"([^\"]*)\"/i', $process, $data);
        $data = $data[1] ?? null;

        if ($data === null) {
            throw new \RuntimeException(\sprintf(
                'Parse %s tag failed. Case "%s" Version php: "%s".',
                $process,
                $this->caseFile,
                $this->phpVersion
            ));
        }

        $data = @\base64_decode($data, true);
        $data = \json_decode((string)$data, true);

        if (!\is_array($data)) {
            throw new \RuntimeException(\sprintf(
                'Parse %s tag data param not array failed. Case "%s" Version php: "%s".',
                $process,
                $this->caseFile,
                $this->phpVersion
            ));
        }

        return new ProcessTag($data);
    }

    /**
     * @return AssertTag[]
     */
    protected function parseAsserts(string &$output, ProcessTag $processTag, ?ExceptionTag $exceptionTag): array
    {
        \preg_match_all('/(<assert\s[^<>]*\>)/', $output, $asserts);
        $asserts = $asserts[1] ?? [];
        if (!$asserts) {
            throw new \RuntimeException(\sprintf(
                'Not found <assert /> tag. Case "%s" Version php: "%s".',
                $this->caseFile,
                $this->phpVersion
            ));
        }
        $output = \preg_replace('/(<assert\s[^<>]*\>)/', '', $output);
        // new AssertResult();
        $assertResults = [];
        foreach ($asserts as $assert) {

            // \preg_match('/line=\"(-?\d+)\"/', $assert, $line);
            // $line = $line[1] ?? null;

            // \preg_match('/name=\"([^\"]*)\"/', $assert, $name);
            // $name = $name[1] ?? null;

            // \preg_match('/status=\"(\d)\"/', $assert, $status);
            // $status = $status[1] ?? null;

            // \preg_match('/message=\"([^\"]*)\"/', $assert, $message);
            // $message = $message[1] ?? null;

            // \preg_match('/expected=\"([^\"]*)\"/', $assert, $expected);
            // $expected = $expected[1] ?? null;

            // \preg_match('/actual=\"([^\"]*)\"/', $assert, $actual);
            // $actual = $actual[1] ?? null;

            \preg_match('/data=\"([^\"]*)\"/', $assert, $data);
            $data = $data[1] ?? null;

            if ($data === null) {
                throw new \RuntimeException(\sprintf(
                    'Parse %s tag failed. Case "%s" Version php: "%s".',
                    $assert,
                    $this->caseFile,
                    $this->phpVersion
                ));
            }

            $data = @\base64_decode($data, true);
            $data = \json_decode((string)$data, true);

            if (!\is_array($data)) {
                throw new \RuntimeException(\sprintf(
                    'Parse %s tag data param not array failed. Case "%s" Version php: "%s".',
                    $assert,
                    $this->caseFile,
                    $this->phpVersion
                ));
            }

            $assertResults[] = new AssertTag(
                $data,
                $processTag,
                $exceptionTag
            );
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
