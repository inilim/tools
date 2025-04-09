<?php

namespace Inilim\Tool\Test\Method\Other;

use Inilim\Tool\Other;
use Inilim\Tool\Test\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

class paginationTest extends TestCase
{
    /**
     * @dataProvider data
     */
    function test($subValues)
    {
        // de($subValues);
        $this->assertSame(
            Other::pagination($subValues['curPage'], $subValues['limitOnePage'], $subValues['countRecords']),
            $subValues['expecting'],
        );
    }

    static function data()
    {
        return [
            [[
                'curPage'      => 1,
                'limitOnePage' => 25,
                'countRecords' => 100,
                'expecting' => [
                    'pageCount'   => 4,
                    'recordCount' => 100,
                    'recordPerPage' => 25,
                    'curPage'      => 1,
                    'offset'       => 0,
                    'next'     => 2,
                    'prev'     => null,
                    'isLast'   => false,
                    'isFirst'  => true,
                ],
            ]],
            [[
                'curPage'      => 7,
                'limitOnePage' => 25,
                'countRecords' => 100,
                'expecting' => [
                    'pageCount'   => 4,
                    'recordCount' => 100,
                    'recordPerPage' => 25,
                    'curPage'      => 4,
                    'offset'       => 75,
                    'next'     => null,
                    'prev'     => 3,
                    'isLast'   => true,
                    'isFirst'  => false,
                ],
            ]],
            [[
                'curPage'      => -5,
                'limitOnePage' => 25,
                'countRecords' => 100,
                'expecting' => [
                    'pageCount'   => 4,
                    'recordCount' => 100,
                    'recordPerPage' => 25,
                    'curPage'      => 1,
                    'offset'       => 0,
                    'next'     => 2,
                    'prev'     => null,
                    'isLast'   => false,
                    'isFirst'  => true,
                ],
            ]],
            [[
                'curPage'      => 0,
                'limitOnePage' => 25,
                'countRecords' => 99,
                'expecting' => [
                    'pageCount'   => 4,
                    'recordCount' => 99,
                    'recordPerPage' => 25,
                    'curPage'      => 1,
                    'offset'       => 0,
                    'next'     => 2,
                    'prev'     => null,
                    'isLast'   => false,
                    'isFirst'  => true,
                ],
            ]],
            [[
                'curPage'      => 2,
                'limitOnePage' => 50,
                'countRecords' => 25,
                'expecting' => [
                    'pageCount'   => 1,
                    'recordCount' => 25,
                    'recordPerPage' => 50,
                    'curPage'      => 1,
                    'offset'       => 0,
                    'next'     => null,
                    'prev'     => null,
                    'isLast'   => true,
                    'isFirst'  => true,
                ],
            ]],
        ];
    }
}
