<?php

namespace Inilim\Tool\Test\Method\Arr;

use Inilim\Tool\Arr;
use Inilim\Tool\Test\TestCase;

class nestedMapTest extends TestCase
{
    /**
     * @dataProvider data
     */
    function test($expect, $array, $depth, $callable)
    {
        $result = Arr::nestedMap($array, $depth, $callable);

        $this->assertEquals($expect, $result);
    }

    static function data()
    {
        return [
            [
                // Expected
                [
                    [
                        'name' => 'bruce',
                        'email' => 'bruce@mail.com',
                    ],
                    [
                        'name' => 'stive',
                        'email' => 'stive@mail.com',
                    ],
                    [
                        'name' => 'devid',
                        'email' => 'devid@mail.com',
                    ],
                ],
                // Array
                [
                    [
                        'name' => 'Bruce',
                        'email' => 'bruce@mail.com',
                    ],
                    [
                        'name' => 'Stive',
                        'email' => 'stive@mail.com',
                    ],
                    [
                        'name' => 'Devid',
                        'email' => 'devid@mail.com',
                    ],
                ],
                // Depth
                1,
                // Callable
                static function ($array) {
                    $array['name'] = \strtolower($array['name']);
                    return $array;
                },
            ],
            // ------------------------------------------------------------------
            // 
            // ------------------------------------------------------------------
            [
                // Expected
                [
                    [
                        'email' => 'bruce@mail.com',
                    ],
                    [
                        'email' => 'stive@mail.com',
                    ],
                    [
                        'email' => 'devid@mail.com',
                    ],
                ],
                // Array
                [
                    [
                        'name' => 'Bruce',
                        'email' => 'bruce@mail.com',
                    ],
                    [
                        'name' => 'Stive',
                        'email' => 'stive@mail.com',
                    ],
                    [
                        'name' => 'Devid',
                        'email' => 'devid@mail.com',
                    ],
                ],
                // Depth
                1,
                // Callable
                static function ($array) {
                    unset($array['name']);
                    return $array;
                },
            ],
            // ------------------------------------------------------------------
            // 
            // ------------------------------------------------------------------
            [
                // Expected
                [
                    [
                        [
                            'name' => 'Bruce',
                            'allowed' => true,
                        ],
                        [
                            'name' => 'Stive',
                            'allowed' => true,
                        ],
                        [
                            'name' => 'Devid',
                            'allowed' => true,
                        ],
                    ]
                ],
                // Array
                [
                    [
                        [
                            'name' => 'Bruce',
                        ],
                        [
                            'name' => 'Stive',
                        ],
                        [
                            'name' => 'Devid',
                        ],
                    ]
                ],
                // Depth
                2,
                // Callable
                static function ($array) {
                    $array['allowed'] = true;
                    return $array;
                },
            ],
        ];
    }
}
