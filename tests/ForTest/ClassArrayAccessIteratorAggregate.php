<?php

namespace Inilim\Tool\Test\ForTest;

class ClassArrayAccessIteratorAggregate implements \ArrayAccess, \IteratorAggregate
{
    public $container;

    function __construct(array $array = [])
    {
        $this->container = $array;
    }

    /**
     * Get an iterator for the items.
     *
     * @return \ArrayIterator<TKey, TValue>
     */
    function getIterator(): \Traversable
    {
        return new \ArrayIterator($this->container);
    }

    function offsetSet($offset, $value): void
    {
        if ($offset === null) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    function offsetExists($offset): bool
    {
        return \array_key_exists($offset, $this->container);
    }

    function offsetUnset($offset): void
    {
        unset($this->container[$offset]);
    }

    /**
     * @return mixed
     */
    function offsetGet($offset)
    {
        return \array_key_exists($offset, $this->container) ? $this->container[$offset] : null;
    }
}
