<?php

namespace Inilim\Tool\Method\Arr;

function dotKeys(iterable $array,string $prepend=''){$results=[];foreach($array as $key=>$value){if(\is_array($value)&&!empty($value)){$results=\array_merge($results,\Inilim\Tool\Method\Arr\dotKeys($value,$prepend.$key.'.'));}else{$results[]=$prepend.$key;}}return $results;}