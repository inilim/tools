<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Obj;

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
function peekBackIterator(iterable $iterator): \Generator
{
    if (\is_array($iterator)) {
        $iterator = new \ArrayIterator($iterator);
    }
    $bufferKey = null;
    $bufferValue = null;
    $hasBuffer = false;
    $prevValue = null;

    foreach ($iterator as $key => $value) {
        if (!$hasBuffer) {
            // Первый элемент сохраняем в буфер, но ещё не выдаём
            $bufferKey = $key;
            $bufferValue = $value;
            $hasBuffer = true;
            continue;
        }

        // Выдаём элемент из буфера, так как теперь известен следующий ($value)
        yield $bufferKey => [
            'before' => $prevValue,
            'current'  => $bufferValue,
            'after'  => $value,
        ];

        // Сдвигаем окно: предыдущим становится выданный буфер
        $prevValue = $bufferValue;
        // Буфером становится текущий элемент
        $bufferKey = $key;
        $bufferValue = $value;
    }

    // Последний элемент (после цикла в буфере остался последний)
    if ($hasBuffer) {
        yield $bufferKey => [
            'before' => $prevValue,
            'current'  => $bufferValue,
            'after'  => null,
        ];
    }
}
