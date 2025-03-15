<?php

namespace Inilim\Tool\Method\Path{function normalizePath(string $path){$path=\strtr($path,'\\','/');$path=\Inilim\Tool\Method\String\deduplicate($path,'/');/*// Windows paths should uppercase the drive letter.*/if(':'===\Inilim\Tool\Method\String\substr($path,1,1)){$path=\Inilim\Tool\Method\String\ucfirst($path);}return $path;}}namespace Inilim\Tool\Method\String{if(!\Inilim\Tool\Str::__definedIfNot('deduplicate')){
    function deduplicate(string $string,string $character=' '){return \preg_replace('/'.\preg_quote($character,'/').'+/u',$character,$string);}
    }if(!\Inilim\Tool\Str::__definedIfNot('substr')){
    function substr(string $string,int $start,?int $length=null,string $encoding='UTF-8'){return \mb_substr($string,$start,$length,$encoding);}
    }if(!\Inilim\Tool\Str::__definedIfNot('ucfirst')){
    function ucfirst(string $string):string{return \Inilim\Tool\Method\String\upper(\Inilim\Tool\Method\String\substr($string,0,1)).\Inilim\Tool\Method\String\substr($string,1);}
    }if(!\Inilim\Tool\Str::__definedIfNot('upper')){
    function upper(string $value,?string $encoding='UTF-8'){return \mb_strtoupper($value,$encoding);}
    }}