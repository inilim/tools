<?php

namespace Inilim\Tool\Test\Method\Str;

use Inilim\Tool\Str;
use Inilim\Tool\Test\TestCase;

class excerptTest extends TestCase
{
    function test()
    {
        $this->assertSame('...is a beautiful morn...', Str::excerpt('This is a beautiful morning', 'beautiful', ['radius' => 5]));
        $this->assertSame('This is a...', Str::excerpt('This is a beautiful morning', 'this', ['radius' => 5]));
        $this->assertSame('...iful morning', Str::excerpt('This is a beautiful morning', 'morning', ['radius' => 5]));
        $this->assertNull(Str::excerpt('This is a beautiful morning', 'day'));
        $this->assertSame('...is a beautiful! mor...', Str::excerpt('This is a beautiful! morning', 'Beautiful', ['radius' => 5]));
        $this->assertSame('...is a beautiful? mor...', Str::excerpt('This is a beautiful? morning', 'beautiful', ['radius' => 5]));
        $this->assertSame('', Str::excerpt('', '', ['radius' => 0]));
        $this->assertSame('a', Str::excerpt('a', 'a', ['radius' => 0]));
        $this->assertSame('...b...', Str::excerpt('abc', 'B', ['radius' => 0]));
        $this->assertSame('abc', Str::excerpt('abc', 'b', ['radius' => 1]));
        $this->assertSame('abc...', Str::excerpt('abcd', 'b', ['radius' => 1]));
        $this->assertSame('...abc', Str::excerpt('zabc', 'b', ['radius' => 1]));
        $this->assertSame('...abc...', Str::excerpt('zabcd', 'b', ['radius' => 1]));
        $this->assertSame('zabcd', Str::excerpt('zabcd', 'b', ['radius' => 2]));
        $this->assertSame('zabcd', Str::excerpt('  zabcd  ', 'b', ['radius' => 4]));
        $this->assertSame('...abc...', Str::excerpt('z  abc  d', 'b', ['radius' => 1]));
        $this->assertSame('[...]is a beautiful morn[...]', Str::excerpt('This is a beautiful morning', 'beautiful', ['omission' => '[...]', 'radius' => 5]));
        $this->assertSame(
            'This is the ultimate supercalifragilisticexpialidocious very looooooooooooooooooong looooooooooooong beautiful morning with amazing sunshine and awesome tempera[...]',
            Str::excerpt(
                'This is the ultimate supercalifragilisticexpialidocious very looooooooooooooooooong looooooooooooong beautiful morning with amazing sunshine and awesome temperatures. So what are you gonna do about it?',
                'very',
                ['omission' => '[...]'],
            )
        );

        $this->assertSame('...i...', Str::excerpt('article', 'i', ['radius' => 0]));
        $this->assertSame('...tic...', Str::excerpt('article', 'I', ['radius' => 1]));
        $this->assertSame('<div> The article description </div>', Str::excerpt('<div> The article description </div>', 'article'));
        $this->assertSame('...The article desc...', Str::excerpt('<div> The article description </div>', 'article', ['radius' => 5]));
        $this->assertSame('The article description', Str::excerpt(strip_tags('<div> The article description </div>'), 'article'));
        // $this->assertSame('', Str::excerpt(null));
        $this->assertSame('', Str::excerpt(''));
        // $this->assertSame('', Str::excerpt(null, ''));
        // $this->assertSame('T...', Str::excerpt('The article description', null, ['radius' => 1]));
        $this->assertSame('The arti...', Str::excerpt('The article description', '', ['radius' => 8]));
        $this->assertSame('', Str::excerpt(' '));
        $this->assertSame('The arti...', Str::excerpt('The article description', ' ', ['radius' => 4]));
        $this->assertSame('...cle description', Str::excerpt('The article description', 'description', ['radius' => 4]));
        $this->assertSame('T...', Str::excerpt('The article description', 'T', ['radius' => 0]));
        $this->assertSame('What i?', Str::excerpt('What is the article?', 'What', ['radius' => 2, 'omission' => '?']));

        $this->assertSame('...ö - 二 sān 大åè...', Str::excerpt('åèö - 二 sān 大åèö', '二 sān', ['radius' => 4]));
        $this->assertSame('åèö - 二...', Str::excerpt('åèö - 二 sān 大åèö', 'åèö', ['radius' => 4]));
        $this->assertSame('åèö - 二 sān 大åèö', Str::excerpt('åèö - 二 sān 大åèö', 'åèö - 二 sān 大åèö', ['radius' => 4]));
        $this->assertSame('åèö - 二 sān 大åèö', Str::excerpt('åèö - 二 sān 大åèö', 'åèö - 二 sān 大åèö', ['radius' => 4]));
        $this->assertSame('...༼...', Str::excerpt('㏗༼㏗', '༼', ['radius' => 0]));
        $this->assertSame('...༼...', Str::excerpt('㏗༼㏗', '༼', ['radius' => 0]));
        $this->assertSame('...ocê e...', Str::excerpt('Como você está', 'ê', ['radius' => 2]));
        $this->assertSame('...ocê e...', Str::excerpt('Como você está', 'Ê', ['radius' => 2]));
        $this->assertSame('João...', Str::excerpt('João Antônio ', 'jo', ['radius' => 2]));
        $this->assertSame('João Antô...', Str::excerpt('João Antônio', 'JOÃO', ['radius' => 5]));
        $this->assertNull(Str::excerpt('', '/'));
    }
}
