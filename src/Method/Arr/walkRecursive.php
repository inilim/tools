<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * @author inilim
 * @psalm-import-type Param_2_walkRecursive from \TypeArr
 * 
 * @return \Closure(object|array &$array,Param_2_walkRecursive $callable):void
 */
function walkRecursive()
{
    \Inilim\Tool\Method\Assert\__notArgsHere(__FUNCTION__, \func_num_args());

    return static function (&$array, callable $callable) {
        $recursive = null;
        $state     = [
            'depth'       => 0,
            'prepend'     => '',
            'changedKeys' => [],
        ];
        $recursive = static function (&$array, $callable, $recursive) use (&$state) {
            /**
             * @param object|array $array
             * @param Param_2_walkRecursive $callable
             * @param \Closure $recursive
             */
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
