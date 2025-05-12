<?php

namespace Inilim\Tool\Test\ForTest;

class TestJsonSerializeWithScalarValueObject implements \JsonSerializable
{
    public function jsonSerialize(): string
    {
        return 'foo';
    }
}
