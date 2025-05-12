<?php

namespace Inilim\Tool\Test\ForTest;

class TestTraversableAndJsonSerializableObject implements \IteratorAggregate, \JsonSerializable
{
    public $items;

    public function __construct($items = [])
    {
        $this->items = $items;
    }

    public function getIterator(): \Traversable
    {
        return new \ArrayIterator($this->items);
    }

    public function jsonSerialize(): array
    {
        return json_decode(json_encode($this->items), true);
    }
}
