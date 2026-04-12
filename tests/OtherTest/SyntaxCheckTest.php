<?php

use Inilim\Tool\PF;
use Inilim\Tool\Str;
use Symfony\Component\Finder\Finder;

class SyntaxCheckTest extends \Inilim\Tool\Test\TestCase
{
    /**
     * @test
     */
    function syntax()
    {
        $finder = new Finder;
        $finder
            ->in(\realpath(__DIR__ . '/../../src/Method'))
            ->files()
            ->depth(1)
            ->name('*.php')
            // 
        ;

        // vs code не указывает что это синтаксическая ошибка
        foreach ($finder as $ptf => $_) {
            $phpCode = \file_get_contents($ptf);

            $this->assertFalse(
                Str::isMatch('/' . \preg_quote(' && throw ', '/') . '/i', $phpCode),
                \sprintf('syntax parse from file "%s" "&& throw"', $ptf)
            );

            $this->assertFalse(
                Str::isMatch('/' . \preg_quote(' && return ', '/') . '/i', $phpCode),
                \sprintf('syntax parse from file "%s" "&& return"', $ptf)
            );

            $this->assertFalse(
                Str::isMatch('/' . \preg_quote(' and throw ', '/') . '/i', $phpCode),
                \sprintf('syntax parse from file "%s" "and throw"', $ptf)
            );

            $this->assertFalse(
                Str::isMatch('/' . \preg_quote(' and return ', '/') . '/i', $phpCode),
                \sprintf('syntax parse from file "%s" "and return"', $ptf)
            );
        }
    }
}
