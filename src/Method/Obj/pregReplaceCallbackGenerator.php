<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Obj;

/**
 * @author inilim
 *
 * @param string|string[] $pattern
 * @param string|string[] $subject
 * @return \Generator<int,array{0:string[]|array<array{0:string,1:int}>,1:\Closure(string):void}>
 */
function pregReplaceCallbackGenerator(
    $pattern,
    $subject,
    int $limit = -1,
    int $flags = 0
): \Generator {

    \Inilim\Tool\Method\Assert\php81();

    $callback = static function (array $matches) use ($flags): string {
        /** @var string[]|array<array{0:string,1:int}> $matches */

        if ($flags & \PREG_OFFSET_CAPTURE) {
            $result = $matches[0][0];
        } else {
            /** @var string[] $matches */
            $result = $matches[0];
        }

        $change = static function (string $newResult) use (&$result): void {
            $result = $newResult;
        };

        \Fiber::suspend([$matches, $change]);

        return $result;
    };

    $fiber = new \Fiber(static function (
        $pattern,
        \Closure $callback,
        $subject,
        int $limit,
        int $flags
    ) {
        $count = 0;
        return \preg_replace_callback(
            $pattern,
            $callback,
            $subject,
            $limit,
            $count,
            $flags
        );
    });

    $value = $fiber->start(
        $pattern,
        $callback,
        $subject,
        $limit,
        $flags
    );

    /** @var array{0:string[]|array<array{0:string,1:int}>,1:\Closure} $value */

    while (!$fiber->isTerminated()) {
        yield $value;
        $value = $fiber->resume();
    }

    return $fiber->getReturn();
}


// @example

// foreach ($gen = \Inilim\Tool\Method\Obj\pregReplaceCallbackGenerator('/\d/', '12345') as [$matches, $change]) {
//     $change('2');
// }

// $newSubject = $gen->getReturn(); // return "22222"