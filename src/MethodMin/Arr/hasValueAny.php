<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Arr{function hasValueAny(array $array,$values,bool $strict=false):bool{$values=\Inilim\Tool\Method\Arr\wrap($values);if(!$array||!$values){return false;}foreach($values as $value){if(\Inilim\Tool\Method\Arr\hasValue($array,$value,$strict)){return true;}}return false;}if(!\Inilim\Tool\Arr::__definedIfNot('hasValue')){
    function hasValue(array $array,$values,bool $strict=false):bool{$values=\Inilim\Tool\Method\Arr\wrap($values);if(!$array||!$values){return false;}foreach($values as $value){if(!\in_array($value,$array,$strict)){return false;}}return true;}
    }if(!\Inilim\Tool\Arr::__definedIfNot('wrap')){
    function wrap($value):array{return \is_array($value)?$value:[$value];}
    }}