<?php

namespace Inilim\Tool\Test\Method\Other;

use Inilim\Tool\Other;
use Inilim\Tool\Test\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

class paginationTest extends TestCase
{
    function test()
    {
        $logName = __FUNCTION__ . ' | ';

        foreach ($this->getTestData() as $i => $subValues) {
            $dto = (new Pagination)->getAll(
                $subValues['curPage'],
                $subValues['limitOnePage'],
                $subValues['countRecords']
            );

            $this->assertSame(
                $dto->toArray(),
                $subValues['expecting'],
                $logName . $i
            );
        }
    }

    static function data()
    {
        return [
            [[
                'curPage'      => 1,
                'limitOnePage' => 25,
                'countRecords' => 100,
                'expecting' => [
                    'countPages'   => 4,
                    'countRecords' => 100,
                    'limitOnePage' => 25,
                    'offset'       => 0,
                    'curPage'      => 1,
                    'nextPage'     => 2,
                    'prevPage'     => null,
                    'isLastPage'   => false,
                    'isFirstPage'  => true,
                ],
            ]],
            [[
                'curPage'      => 7,
                'limitOnePage' => 25,
                'countRecords' => 100,
                'expecting' => [
                    'countPages'   => 4,
                    'countRecords' => 100,
                    'limitOnePage' => 25,
                    'offset'       => 75,
                    'curPage'      => 4,
                    'nextPage'     => null,
                    'prevPage'     => 3,
                    'isLastPage'   => true,
                    'isFirstPage'  => false,
                ],
            ]],
            [[
                'curPage'      => -5,
                'limitOnePage' => 25,
                'countRecords' => 100,
                'expecting' => [
                    'countPages'   => 4,
                    'countRecords' => 100,
                    'limitOnePage' => 25,
                    'offset'       => 0,
                    'curPage'      => 1,
                    'nextPage'     => 2,
                    'prevPage'     => null,
                    'isLastPage'   => false,
                    'isFirstPage'  => true,
                ],
            ]],
            [[
                'curPage'      => 0,
                'limitOnePage' => 25,
                'countRecords' => 99,
                'expecting' => [
                    'countPages'   => 4,
                    'countRecords' => 99,
                    'limitOnePage' => 25,
                    'offset'       => 0,
                    'curPage'      => 1,
                    'nextPage'     => 2,
                    'prevPage'     => null,
                    'isLastPage'   => false,
                    'isFirstPage'  => true,
                ],
            ]],
            [[
                'curPage'      => 2,
                'limitOnePage' => 50,
                'countRecords' => 25,
                'expecting' => [
                    'countPages'   => 1,
                    'countRecords' => 25,
                    'limitOnePage' => 50,
                    'offset'       => 0,
                    'curPage'      => 1,
                    'nextPage'     => null,
                    'prevPage'     => null,
                    'isLastPage'   => true,
                    'isFirstPage'  => true,
                ],
            ]],
        ];
    }
}
