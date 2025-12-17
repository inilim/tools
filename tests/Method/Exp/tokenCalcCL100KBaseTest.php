<?php

namespace Inilim\Tool\Test\Method\Exp;

use Inilim\Tool\FS;
use Inilim\Tool\Exp;
use Inilim\Tool\Test\TestCase;
use Symfony\Component\Finder\Finder;

/**
 * TODO нужно еще тесты
 */
class tokenCalcCL100KBaseTest extends TestCase
{
    function testWithTokens()
    {
        // 
        $finder = new Finder;
        $finder->in(\realpath(__DIR__ . '/../../files/json/token_calc'))->files()->name('*.json');

        $fnWith = Exp::tokenCalcCL100KBase(false);
        foreach ($finder as $ptf => $_) {
            $data = \json_decode(\file_get_contents($ptf), true);
            foreach ($data as $idx => $item) {
                /** @var array{text:string,tokens:int[],count:int} $item */

                ['tokens' => $tokens, 'count' => $count] = $fnWith($item['text']);

                $this->assertSame(
                    $item['tokens'],
                    $tokens,
                    \sprintf('Tokens fail | File: "%s" | item idx %s', $ptf, $idx)
                );
                $this->assertSame(
                    $item['count'],
                    $count,
                    \sprintf('Count fail | File: "%s" | item idx %s', $ptf, $idx)
                );
            }
            // dd($ptf);
        }
    }

    function testWithoutTokens()
    {
        // 
        $finder = new Finder;
        $finder->in(\realpath(__DIR__ . '/../../files/json/token_calc'))->files()->name('*.json');

        $fnWith = Exp::tokenCalcCL100KBase(true);
        foreach ($finder as $ptf => $_) {
            $data = \json_decode(\file_get_contents($ptf), true);
            foreach ($data as $idx => $item) {
                /** @var array{text:string,tokens:int[],count:int} $item */

                ['tokens' => $tokens, 'count' => $count] = $fnWith($item['text']);

                $this->assertSame(
                    [],
                    $tokens,
                    \sprintf('Tokens fail | File: "%s" | item idx %s', $ptf, $idx)
                );
                $this->assertSame(
                    $item['count'],
                    $count,
                    \sprintf('Count fail | File: "%s" | item idx %s', $ptf, $idx)
                );
            }
            // dd($ptf);
        }
    }
}
