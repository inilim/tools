<?php

namespace Inilim\Tool\Method\String{function studly(string $value):string{$words=\explode(' ',\Inilim\Tool\Method\String\replace(['-','_'],' ',$value));$studly_words=\array_map(static fn($word)=>\Inilim\Tool\Method\String\ucfirst($word),$words);return \implode($studly_words);}if(!\Inilim\Tool\Str::__definedIfNot('replace')){
    function replace($search,$replace,$subject,bool $caseSensitive=true){return $caseSensitive?\str_replace($search,$replace,$subject):\str_ireplace($search,$replace,$subject);}
    }if(!\Inilim\Tool\Str::__definedIfNot('substr')){
    function substr(string $string,int $start,?int $length=null,string $encoding='UTF-8'){return \mb_substr($string,$start,$length,$encoding);}
    }if(!\Inilim\Tool\Str::__definedIfNot('ucfirst')){
    function ucfirst(string $string):string{return \Inilim\Tool\Method\String\upper(\Inilim\Tool\Method\String\substr($string,0,1)).\Inilim\Tool\Method\String\substr($string,1);}
    }if(!\Inilim\Tool\Str::__definedIfNot('upper')){
    function upper(string $value,?string $encoding='UTF-8'){return \mb_strtoupper($value,$encoding);}
    }}