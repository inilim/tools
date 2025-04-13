<?php

namespace Inilim\Tool\Test\Method\Str;

use Inilim\Tool\Str;
use Inilim\Tool\Test\TestCase;

class randomTest extends TestCase
{
    function testRandom()
    {
        $this->assertEquals(16, strlen(Str::random()));
        $randomInteger = random_int(1, 100);
        $this->assertEquals($randomInteger, strlen(Str::random($randomInteger)));
        $this->assertIsString(Str::random());
    }

    function testWhetherTheNumberOfGeneratedCharactersIsEquallyDistributed()
    {
        $results = [];
        // take 6.200.000 samples, because there are 62 different characters
        for ($i = 0; $i < 620000; $i++) {
            $random = Str::random(1);
            $results[$random] = ($results[$random] ?? 0) + 1;
        }

        // each character should occur 100.000 times with a variance of 5%.
        foreach ($results as $result) {
            $this->assertEqualsWithDelta(10000, $result, 500);
        }
    }

    function testRandomStringFactoryCanBeSet()
    {
        Str::createRandomStringsUsing(static fn($length) => 'length:' . $length);

        $this->assertSame('length:7', Str::random(7));
        $this->assertSame('length:7', Str::random(7));

        Str::createRandomStringsNormally();

        $this->assertNotSame('length:7', Str::random());
    }

    function testItCanSpecifyASequenceOfRandomStringsToUtilise()
    {
        Str::createRandomStringsUsingSequence([
            0 => 'x',
            // 1 => just generate a random one here...
            2 => 'y',
            3 => 'z',
            // ... => continue to generate random strings...
        ]);

        $this->assertSame('x', Str::random());
        $this->assertSame(16, mb_strlen(Str::random()));
        $this->assertSame('y', Str::random());
        $this->assertSame('z', Str::random());
        $this->assertSame(16, mb_strlen(Str::random()));
        $this->assertSame(16, mb_strlen(Str::random()));

        Str::createRandomStringsNormally();
    }

    function testItCanSpecifyAFallbackForARandomStringSequence()
    {
        Str::createRandomStringsUsingSequence([Str::random(), Str::random()], static function () {
            throw new \Exception('Out of random strings.');
        });
        Str::random();
        Str::random();

        try {
            $this->expectExceptionMessage('Out of random strings.');
            Str::random();
            $this->fail();
        } finally {
            Str::createRandomStringsNormally();
        }
    }
}
