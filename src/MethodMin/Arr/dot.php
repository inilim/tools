<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Arr;

function dot(iterable $array,string $prepend='',string $separator='.'){$results=[];$flatten=static function(iterable $data,string $prefix,string $separator)use(&$results,&$flatten){foreach($data as $key=>$value){$newKey=$prefix.$key;if(\is_array($value)&&!empty($value)){$flatten($value,$newKey.$separator,$separator);}else{$results[$newKey]=$value;}}};$flatten($array,$prepend,$separator);return $results;}