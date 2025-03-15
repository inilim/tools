<?php

namespace Inilim\Tool\Method\String{function lcfirst(string $string):string{return \Inilim\Tool\Method\String\lower(\Inilim\Tool\Method\String\substr($string,0,1)).\Inilim\Tool\Method\String\substr($string,1);}if(!\Inilim\Tool\Str::__definedIfNot('lower')){
    function lower(string $value,?string $encoding='UTF-8'){return \mb_strtolower($value,$encoding);}
    }if(!\Inilim\Tool\Str::__definedIfNot('substr')){
    function substr(string $string,int $start,?int $length=null,string $encoding='UTF-8'){return \mb_substr($string,$start,$length,$encoding);}
    }}