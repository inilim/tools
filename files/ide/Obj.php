<?php

namespace Inilim\Tool;

class Obj
{
        /**
 * @author inilim
 * 
 * @template TValue
 * @template TKey
 *
 * @param iterable<TKey,TValue> $iterable
 * @param positive-int $size
 * @return ($preserve_keys is true ? \Generator<TKey,TValue> : \Generator<int,TValue>)
 */
    static function chunkIterator(iterable $iterable, int $size, bool $preserve_keys = true): Generator {
        throw new \Exception;
    }

        /**
 * @author Inilim
 * 
 * @psalm-import-type Return_getCollectionThrowable from \TypeObj
 * 
 * @return Return_getCollectionThrowable
 */
    static function getCollectionThrowable(string $message = '', int $code = 0, ?int $line = null, ?string $file = null, ?\Throwable $previous = null): object {
        throw new \Exception;
    }

        /**
 * @todo tests
 * @author inilim
 * @return \RecursiveIteratorIterator<string,\SplFileInfo>
 * @throws \InvalidArgumentException
 */
    static function iteratorFilesRecursive(string $pathToDir, bool $skipDots = true) {
        throw new \Exception;
    }

        /**
 * @author inilim
 * @param iterable ...$iterables
 * @return \Generator
 * @throws \InvalidArgumentException
 */
    static function multipleIteratorMap(iterable ...$iterables): Generator {
        throw new \Exception;
    }

        /**
 * @author inilim
 * 
 * @desc Такой итератор реализует функциональность «заглядывания вперед и занад» (peek/lookback).
 * @template TValue
 * @template TKey
 *
 * @param iterable<TKey,TValue> $iterator
 * @return \Generator<TKey,array{before:TValue|null,current:TValue,after:TValue|null}>
 */
    static function peekBackIterator(iterable $iterator): Generator {
        throw new \Exception;
    }

        /**
 * @author inilim
 *
 * @param string|string[] $pattern
 * @param string|string[] $subject
 * @return \Generator<int,array{0:string[]|array<array{0:string,1:int}>,1:\Closure(string):void}>
 */
    static function pregReplaceCallbackGenerator($pattern, $subject, int $limit = -1, int $flags = 0): Generator {
        throw new \Exception;
    }

        /**
 * @author inilim
 * 
 * @return \Generator<int,int>
 * @throws \ErrorException
 */
    static function rangeInt(int $start, int $end, int $step = 1): Generator {
        throw new \Exception;
    }

        /**
 * @template T of \Throwable
 * @param T $e
 * @return T
 */
    static function rewriteLocationException(\Throwable $e, string $file, int $line): object {
        throw new \Exception;
    }

        /**
 * @author inilim
 * @template T of \Throwable
 *
 * @param array $values
 * @param class-string<T>|T $classOrObj
 * @return T
 */
    static function sprintfException(string $format = '', array $values = [], $classOrObj = \Exception::class, array $args = []): Throwable {
        throw new \Exception;
    }

        /**
 * @author inilim
 *
 * @param array $values
 * @return \InvalidArgumentException
 */
    static function sprintfInvalidArgumentException(string $format = '', array $values = [], array $args = []): InvalidArgumentException {
        throw new \Exception;
    }

        /**
 * @author inilim
 *
 * @param array $values
 * @return \LogicException
 */
    static function sprintfLogicException(string $format = '', array $values = [], array $args = []): LogicException {
        throw new \Exception;
    }

        /**
 * @author inilim
 *
 * @param array $values
 * @return \RuntimeException
 */
    static function sprintfRuntimeException(string $format = '', array $values = [], array $args = []): RuntimeException {
        throw new \Exception;
    }

        /**
 * @author inilim
 * @return \Generator<int,string>
 */
    static function stringAndSeparatorGenerator(string $string, string $separator): Generator {
        throw new \Exception;
    }

        /**
 * @deprecated use Arr::from
 * @author mohammadrasoulasghari <https://github.com/mohammadrasoulasghari>
 * Convert a Traversable to an array, or return the original value if not Traversable.
 * @template T of mixed
 * @param T $value
 * @return ($value is \Traversable ? array : T)
 */
    static function toArrayIfTraversable($value) {
        throw new \Exception;
    }

        /**
 * @author inilim
 * 
 * @template T of mixed
 * @param \Traversable<T> $obj
 * @return T[]
 */
    static function unpuckTraversableRecursive(\Traversable $obj): array {
        throw new \Exception;
    }

    }