<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

function dotKeys(iterable $array,string $prepend=''):array{$results=[];$flatten=static function(iterable $array,string $prefix)use(&$results,&$flatten){foreach($array as $key=>$value){if(\is_array($value)&&!empty($value)){$flatten($value,$prefix.$key.'.');}else{$results[]=$prefix.$key;}}};$flatten($array,$prepend);return $results;}