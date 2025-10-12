<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * @deprecated use LarArr::***
 * @todo check PR _undot()
 * Convert a flatten "dot" notation array into an expanded array.
 * @param  iterable  $array
 */
function undot($array): array
{
    $results = [];
    $set = \Inilim\Tool\Method\Arr\set();
    foreach ($array as $key => $value) {
        $set($results, $key, $value);
    }

    return $results;
}



// function _undot($array)
// {
//     $results = [];

//     foreach ($array as $key => $value) {
//         $current = &$results;
//         $segment = \strtok($key, '.');

//         while (true) {
//             $nextSegment = \strtok('.');

//             if ($nextSegment === false) {
//                 $current[$segment] = $value;
//                 break;
//             } else {
//                 if (! isset($current[$segment]) || ! \is_array($current[$segment])) {
//                     $current[$segment] = [];
//                 }
//                 $current = &$current[$segment];
//                 $segment = $nextSegment;
//             }
//         }
//         unset($current);
//     }

//     return $results;
// }
