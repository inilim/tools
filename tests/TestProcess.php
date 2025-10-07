<?php

namespace Inilim\Tool\Test;

use Inilim\Tool\Test\DefinePhpBin;
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

    function test(string $caseFile, ?string $iniFile = null)
    {
        if (!\is_file($caseFile)) {
            throw new \RuntimeException(\sprintf('Not found file case "%s"', $caseFile));
        }
        $otherCommands = [];
        if ($iniFile) {
            $otherCommands = \array_merge($otherCommands, ['-c', \sprintf("%s", $iniFile)]);
        }

        foreach ($this->definePhpBin->getPhpBin() as $version => $php) {
            $process = new Process(\array_merge([$php, $caseFile], $otherCommands));
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
                    PHP_EOL . \str_repeat('-', 25) . PHP_EOL . $error . PHP_EOL . \str_repeat('-', 25) . PHP_EOL
                ));
            }

            // $output
        }
    }

    protected function parseOutput(string $output)
    {
        // 
    }
}
