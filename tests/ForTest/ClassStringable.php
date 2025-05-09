<?php

namespace Inilim\Tool\Test\ForTest;

class ClassStringable implements \Stringable
{
    protected string $value;

    function __construct(string $value)
    {
        $this->value = $value;
    }

    function __toString()
    {
        return $this->value;
    }
}
