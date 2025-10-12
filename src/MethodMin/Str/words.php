<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Str{function words(string $value,int $words=100,string $end='...'):string{\preg_match('/^\s*+(?:\S++\s*+){1,'.$words.'}/u',$value,$matches);if(!isset($matches[0])||\Inilim\Tool\Method\Str\length($value)===\Inilim\Tool\Method\Str\length($matches[0])){return $value;}return \rtrim($matches[0]).$end;}if(!\Inilim\Tool\Str::__definedIfNot('length')){
    function length(string $value,$encoding='UTF-8'):int{return \mb_strlen($value,$encoding);}
    }}