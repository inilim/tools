<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str{function kebab(string $value){return \Inilim\Tool\Method\Str\snake($value,'-');}if(!\Inilim\Tool\Str::__definedIfNot('lower')){
    function lower(string $value,?string $encoding='UTF-8'){return \mb_strtolower($value,$encoding);}
    }if(!\Inilim\Tool\Str::__definedIfNot('snake')){
    function snake(string $value,string $delimiter='_'){if(!\ctype_lower($value)){$value=\preg_replace('/\s+/u','',\ucwords($value));$value=\Inilim\Tool\Method\Str\lower(\preg_replace('/(.)(?=[A-Z])/u','$1'.$delimiter,$value));}return $value;}
    }}