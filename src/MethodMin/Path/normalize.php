<?php

namespace Inilim\Tool\Method\Path{function normalize(string $path):string{$path=\strtr($path,'\\','/');$path=\Inilim\Tool\Method\Str\deduplicate($path,'/');if(':'===\Inilim\Tool\Method\LarStr\substr($path,1,1)){$path=\Inilim\Tool\Method\LarStr\ucfirst($path);}return $path;}}namespace Inilim\Tool\Method\Str{if(!\Inilim\Tool\Str::__definedIfNot('deduplicate')){
    function deduplicate(string $string,string $character=' '){return \preg_replace('/'.\preg_quote($character,'/').'+/u',$character,$string);}
    }}namespace Inilim\Tool\Method\LarStr{if(!\Inilim\Tool\LarStr::__definedIfNot('substr')){
    function substr($string,$start,$length=null,$encoding='UTF-8'){return \mb_substr($string,$start,$length,$encoding);}
    }if(!\Inilim\Tool\LarStr::__definedIfNot('ucfirst')){
    function ucfirst($string){return \Inilim\Tool\Method\LarStr\upper(\Inilim\Tool\Method\LarStr\substr($string,0,1)).\Inilim\Tool\Method\LarStr\substr($string,1);}
    }if(!\Inilim\Tool\LarStr::__definedIfNot('upper')){
    function upper($value){return \mb_strtoupper($value,'UTF-8');}
    }}