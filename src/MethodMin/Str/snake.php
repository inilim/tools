<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str{function snake(string $value,string $delimiter='_'){if(!\ctype_lower($value)){$modeU=\Inilim\Tool\Method\Check\php80()?'u':'';$value=\preg_replace('/\s+/'.$modeU,'',\ucwords($value));$value=\Inilim\Tool\Method\Str\lower(\preg_replace('/(.)(?=[A-Z])/'.$modeU,'$1'.$delimiter,$value));}return $value;}if(!\Inilim\Tool\Str::__definedIfNot('lower')){
    function lower(string $value,?string $encoding='UTF-8'){return \mb_strtolower($value,$encoding);}
    }}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('php80')){
    function php80(){if(\PHP_VERSION_ID>=80000){return true;}return false;}
    }}