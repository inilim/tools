<?php

namespace Inilim\Tool\Method\String{function kebab(string $value):string{return \Inilim\Tool\Method\String\snake($value,'-');}if(!\Inilim\Tool\Str::__definedIfNot('lower')){
    function lower(string $value,?string $encoding='UTF-8'){return \mb_strtolower($value,$encoding);}
    }if(!\Inilim\Tool\Str::__definedIfNot('snake')){
    function snake(string $value,string $delimiter='_'):string{if(!\ctype_lower($value)){$value=\preg_replace('/\s+/u','',\ucwords($value));$value=\Inilim\Tool\Method\String\lower(\preg_replace('/(.)(?=[A-Z])/u','$1'.$delimiter,$value));}return $value;}
    }}