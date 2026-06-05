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
        /**
         * @var array<int|string,\Throwable>
         */
        protected array $a = [];

        /**
         */
        function __construct(string $message, int $code, ?int $line, ?string $file, ?\Throwable $previous)
        {
            parent::__construct($message, $code, $previous);
            $this->line = $line ?? -1;
            $this->file = $file ?? '';
        }

        /**
         * @return \Generator<int|string,\Throwable>
         */
        function getIterator(): \Generator
        {
            foreach ($this->a as $k => $e) {
                yield $k => $e;
            }
        }

        #[\ReturnTypeWillChange]
        function offsetExists($offset): bool
        {
            return isset($this->a[$offset]);
        }

        #[\ReturnTypeWillChange]
        function offsetGet($offset): ?\Throwable
        {
            return $this->a[$offset] ?? null;
        }

        /**
         * @param \Throwable $e
         */
        #[\ReturnTypeWillChange]
        function offsetSet($offset, $e): void
        {
            if (!($e instanceof \Throwable)) {
                throw new \InvalidArgumentException('Value must be of type \Throwable');
            }
            if ($offset === null) {
                $this->a[] = $e;
            } else {
                $this->a[$offset] = $e;
            }
        }

        #[\ReturnTypeWillChange]
        function offsetUnset($offset): void
        {
            unset($this->a[$offset]);
        }

        function count(): int
        {
            return \count($this->a);
        }
    };
}


// $a = getCollectionThrowable();