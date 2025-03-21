<?php

namespace Inilim\Tool\Method\Arr;

function dot(iterable $array,string $prepend=''){$results=[];foreach($array as $key=>$value){if(\is_array($value)&&!empty($value)){$results=\array_merge($results,\Inilim\Tool\Method\Arr\dot($value,$prepend.$key.'.'));}else{$results[$prepend.$key]=$value;}}return $results;}