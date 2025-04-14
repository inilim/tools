<?php

namespace Inilim\Tool\Test\Method\Exp;

use Inilim\Tool\Exp;
use Inilim\Tool\Test\TestCase;

class interpolateTest extends TestCase
{
    function test()
    {
        $this->assertSame(
            'Hi John Doe!',
            Exp::interpolate('{{greetings}} {{  name  }}!', ['greetings' => 'Hi', 'name' => 'John Doe'])
        );

        // Preserve:false will remove placeholders not in the map
        $this->assertSame(
            ' John Doe!',
            Exp::interpolate('{{greetings  }} {{  name}}!', ['name' => 'John Doe'], false)
        );

        // Preserve:true will keep placeholders not in the map
        $this->assertSame(
            '{{greetings}} John Doe!',
            Exp::interpolate('{{greetings}} {{name}}!', ['name' => 'John Doe'], true)
        );

        // Using a different placeholder pattern
        $this->assertSame(
            'Hello Mr. Miyagi!',
            Exp::interpolate('Hello {{ @name }}!', ['name' => 'Mr. Miyagi'], true, '/{{\s*\@(\w+)\s*}}/')
        );
    }
}
