<?php

namespace Inilim\Tool\Test\Method\Str;

use Inilim\Tool\Str;
use Inilim\Tool\Test\TestCase;

class wordCountTest extends TestCase
{
    function test()
    {
        $this->assertEquals(2, Str::wordCount('Hello, world!'));
        $this->assertEquals(10, Str::wordCount('Hi, this is my first contribution to the Explosion tools.'));

        // dde(Str::wordCount('мама'));
        // INFO на windows php74 выдает 2, на linux 0
        // TODO хз что с этим делать
        $this->assertEquals(0, Str::wordCount('мама'));
        $this->assertEquals(0, Str::wordCount('мама мыла раму'));

        $this->assertEquals(1, Str::wordCount('мама', 'абвгдеёжзийклмнопрстуфхцчшщъыьэюяАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ'));
        $this->assertEquals(3, Str::wordCount('мама мыла раму', 'абвгдеёжзийклмнопрстуфхцчшщъыьэюяАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ'));

        $this->assertEquals(1, Str::wordCount('МАМА', 'абвгдеёжзийклмнопрстуфхцчшщъыьэюяАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ'));
        $this->assertEquals(3, Str::wordCount('МАМА МЫЛА РАМУ', 'абвгдеёжзийклмнопрстуфхцчшщъыьэюяАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ'));
    }
}
