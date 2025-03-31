<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Obj;

/**
 * @author Inilim
 * @phpstan-import-type getCollectionThrowable_return from \Obj
 * @return getCollectionThrowable_return
 */
function getCollectionThrowable(
    string $message      = '',
    int $code            = 0,
    ?int $line           = null,
    ?string $file        = null,
    \Throwable $previous = null
) {
    return new class($message, $code, $line, $file, $previous) extends \Exception implements \ArrayAccess, \Countable {
        protected $array = [];

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

        /**
         * @return bool
         */
        #[\ReturnTypeWillChange]
        function offsetExists($offset)
        {
            return isset($this->array[$offset]);
        }
        /**
         * @return ?\Throwable
         */
        #[\ReturnTypeWillChange]
        function offsetGet($offset)
        {
            return $this->array[$offset] ?? null;
        }
        /**
         * @param \Throwable $e
         * @return void
         */
        #[\ReturnTypeWillChange]
        function offsetSet($offset, $e)
        {
            if (!($e instanceof \Throwable)) {
                throw new \Exception('Value must be of type object<\Throwable>');
            }
            if ($offset === null) {
                $this->array[] = $e;
            } else {
                $this->array[$offset] = $e;
            }
        }
        /**
         * @return void
         */
        #[\ReturnTypeWillChange]
        function offsetUnset($offset)
        {
            unset($this->array[$offset]);
        }

        /**
         * @return int
         */
        #[\ReturnTypeWillChange]
        function count()
        {
            return \sizeof($this->array);
        }
    };
    return $e;
}
