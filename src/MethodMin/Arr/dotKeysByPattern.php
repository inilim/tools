<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Arr{function dotKeysByPattern(iterable $target,string $dotPattern):array{$regex='#^'.\str_replace('\*','[^\.]+',\preg_quote($dotPattern)).'#';return \array_values(\array_filter(\Inilim\Tool\Method\Arr\dotKeys($target),static fn($key)=>\preg_match($regex,$key)));}if(!\Inilim\Tool\Arr::__definedIfNot('dotKeys')){
    function dotKeys(iterable $array,string $prepend=''):array{$results=[];$flatten=static function(iterable $array,string $prefix)use(&$results,&$flatten){foreach($array as $key=>$value){if(\is_array($value)&&!empty($value)){$flatten($value,$prefix.$key.'.');}else{$results[]=$prefix.$key;}}};$flatten($array,$prepend);return $results;}
    }}