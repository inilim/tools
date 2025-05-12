<?php

namespace Inilim\Tool\Test\Method\Sql;

use Inilim\Tool\Sql;
use Inilim\Tool\Test\TestCase;

/**
 * @group inactive
 */
class sanitizeLikeTest extends TestCase
{
    function test()
    {
        $this->assertEquals('100\%', Sql::sanitizeLike('100%'));
        $this->assertEquals('snake\_cased\_string', Sql::sanitizeLike('snake_cased_string'));
        $this->assertEquals('great!!', Sql::sanitizeLike('great!', '!'));
        $this->assertEquals('C:\\\\Programs\\\\MsPaint', Sql::sanitizeLike('C:\\Programs\\MsPaint'));
        $this->assertEquals('normal string 42', Sql::sanitizeLike('normal string 42'));
    }

    function testSanitizeSqlLikeWithCustomEscapeCharacter()
    {
        $this->assertEquals('100!%', Sql::sanitizeLike('100%', '!'));
        $this->assertEquals('snake!_cased!_string', Sql::sanitizeLike('snake_cased_string', '!'));
        $this->assertEquals('great!!', Sql::sanitizeLike('great!', '!'));
        $this->assertEquals('C:\\Programs\\MsPaint', Sql::sanitizeLike('C:\\Programs\\MsPaint', '!'));
        $this->assertEquals('normal string 42', Sql::sanitizeLike('normal string 42', '!'));
    }

    function testSanitizeSqlLikeWithWildcardAsEscapeCharacter()
    {
        $this->assertEquals('1__000_%', Sql::sanitizeLike('1_000%', '_'));
        $this->assertEquals('1%_000%%', Sql::sanitizeLike('1_000%', '%'));
    }
}
