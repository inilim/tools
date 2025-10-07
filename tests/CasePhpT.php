<?php

namespace Inilim\Tool\Test;

use Inilim\Tool\Test\DefinePhpBin;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Process\Process;

class CasePhpT
{
    protected static ?CasePhpT $instance = null;

    static function self(): CasePhpT
    {
        return self::$instance ??= new CasePhpT;
    }

    // ---------------------------------------------
    // 
    // ---------------------------------------------

    /**
     * @param array{0:class-string,1:string} $callable
     * @return \Generator<int,string>
     */
    function cases(array $callable): \Generator
    {
        if (!\is_callable($callable)) {
            throw new \RuntimeException(\sprintf('not callable'));
        }
        [$class, $method] = $callable;
        $nameClass = \basename($class);
        $finder = new Finder;
        $finder->in(__DIR__ . '/phpt/' . $nameClass . '/' . $method)->name('*.php');

        foreach ($finder as $file => $_) {
            yield $file;
        }
    }
}
