<?php

namespace Inilim\Tool\Test\ForTest;

class TestJsonSerializeObject implements \JsonSerializable
{
    function jsonSerialize(): array
    {
        return ['foo' => 'bar'];
    }
}
