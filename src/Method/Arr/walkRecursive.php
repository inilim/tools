<?php

namespace Inilim\Tool\Method\Arr;

/**
 * @return \Closure(object|array &$array, callable $callable):void
 */
function walkRecursive()
{
    if (\func_num_args() !== 0) {
        throw new \InvalidArgumentException(__FUNCTION__ . '()(...) <-- The arguments were passed to the wrong place');
    }
    return static function (&$array, callable $callable) {
        $recursive = null;
        $state     = [
            'depth'       => 0,
            'prepend'     => '',
            'changedKeys' => [],
        ];
        /**
         * @param object|array $array
         * @param callable $callable
         * @param \Closure $recursive
         */
        $recursive = static function (&$array, $callable, $recursive) use (&$state) {
            foreach ($array as $key => &$value) {
                $dotKey = $state['prepend'] . $key;
                if ($state['changedKeys'] && \in_array($dotKey, $state['changedKeys'])) {
                    continue;
                }
                $beforeKey = $key;

                $callable($value, $key, $dotKey, $state['depth']);

                if ($beforeKey !== $key) {
                    $state['changedKeys'][] = $state['prepend'] . $key;
                    $array[$key] = $array[$beforeKey];
                    unset($array[$beforeKey]);
                }

                if (\is_iterable($value)) {
                    $state['depth']++;
                    $beforePrepend = $state['prepend'];
                    $state['prepend'] = $state['prepend'] . $key . '.';
                    $recursive->__invoke($value, $callable, $recursive);
                    $state['prepend'] = $beforePrepend;
                    $state['depth']--;
                }
            }
        };

        $recursive($array, $callable, $recursive);
    };
}
