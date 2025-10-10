<?php

namespace Inilim\Tool\Test;

use Inilim\Tool\Path;
use Symfony\Component\Finder\Finder;

/**
 * Ищем тесты по callable
 */
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
        $dir = __DIR__ . '/phpt/' . $nameClass . '/' . $method;
        if (!\is_dir($dir)) {
            throw new \RuntimeException(\sprintf('Not found dir "%s"', $dir));
        }
        $finder = new Finder;
        $finder->in($dir)->name('*.php');

        foreach ($finder as $file => $_) {
            $file = Path::normalize($file);
            yield $file;
        }
    }
}
