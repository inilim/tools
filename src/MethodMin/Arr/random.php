<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Arr;

function random(array $array,?int $number=null,bool $preserveKeys=false){$requested=$number===null?1:$number;$count=\sizeof($array);if($requested>$count){throw new \InvalidArgumentException("You requested {$requested} items, but there are only {$count} items available.");}if($number===null){return $array[\array_rand($array)];}if((int) $number===0){return[];}$keys=\array_rand($array,$number);$results=[];if($preserveKeys){foreach((array) $keys as $key){$results[$key]=$array[$key];}}else{foreach((array) $keys as $key){$results[]=$array[$key];}}return $results;}