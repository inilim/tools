<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Obj;

/**
 * @author Inilim
 * 
 * @psalm-import-type Return_getCollectionThrowable from \TypeObj
 * 
 * @return Return_getCollectionThrowable
 */
function getCollectionThrowable(
    string $message       = '',
    int $code             = 0,
    ?int $line            = null,
    ?string $file         = null,
    ?\Throwable $previous = null
) {
    return new class($message, $code, $line, $file, $previous) extends \Exception implements \ArrayAccess, \IteratorAggregate, \Countable {
        protected $a = [];

        /**
         * @param \Throwable[] $exceptions
         * @param \Throwable|null $previous
         */
        function __construct($message, $code, $line, $file, $previous)
        {
            parent::__construct($message, $code, $previous);
            $this->line = $line ?? -1;
            $this->file = $file ?? '';
        }

        function getIterator(): \Traversable
        {
            return new \ArrayIterator($this->a);
        }

        #[\ReturnTypeWillChange]
        function offsetExists($offset): bool
        {
            return isset($this->a[$offset]);
        }
        /**
         * @return ?\Throwable
         */
        #[\ReturnTypeWillChange]
        function offsetGet($offset)
        {
            return $this->a[$offset] ?? null;
        }
        /**
         * @param \Throwable $e
         * @return void
         */
        #[\ReturnTypeWillChange]
        function offsetSet($offset, $e)
        {
            if (!($e instanceof \Throwable)) {
                throw new \InvalidArgumentException('Value must be of type object<\Throwable>');
            }
            if ($offset === null) {
                $this->a[] = $e;
            } else {
                $this->a[$offset] = $e;
            }
        }
        /**
         * @return void
         */
        #[\ReturnTypeWillChange]
        function offsetUnset($offset)
        {
            unset($this->a[$offset]);
        }

        function count(): int
        {
            return \sizeof($this->a);
        }
    };

    return $e;
}
