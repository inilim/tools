<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str{function camel(string $value){return \lcfirst(\Inilim\Tool\Method\Str\studly($value));}if(!\Inilim\Tool\Str::__definedIfNot('replace')){
    function replace($search,$replace,$subject,bool $caseSensitive=true){$search=\Inilim\Tool\Method\Obj\toArrayIfTraversable($search);$replace=\Inilim\Tool\Method\Obj\toArrayIfTraversable($replace);$subject=\Inilim\Tool\Method\Obj\toArrayIfTraversable($subject);return $caseSensitive?\str_replace($search,$replace,$subject):\str_ireplace($search,$replace,$subject);}
    }if(!\Inilim\Tool\Str::__definedIfNot('studly')){
    function studly(string $value){$words=\explode(' ',\Inilim\Tool\Method\Str\replace(['-','_'],' ',$value));$studlyWords=\array_map('\Inilim\Tool\Method\Str\ucfirst',$words);return \implode($studlyWords);}
    }if(!\Inilim\Tool\Str::__definedIfNot('substr')){
    function substr(string $string,int $start,?int $length=null,string $encoding='UTF-8'){return \mb_substr($string,$start,$length,$encoding);}
    }if(!\Inilim\Tool\Str::__definedIfNot('ucfirst')){
    function ucfirst(string $string){return \Inilim\Tool\Method\Str\upper(\Inilim\Tool\Method\Str\substr($string,0,1)).\Inilim\Tool\Method\Str\substr($string,1);}
    }if(!\Inilim\Tool\Str::__definedIfNot('upper')){
    function upper(string $value,?string $encoding='UTF-8'){return \mb_strtoupper($value,$encoding);}
    }}namespace Inilim\Tool\Method\Obj{if(!\Inilim\Tool\Obj::__definedIfNot('toArrayIfTraversable')){
    function toArrayIfTraversable($value){if($value instanceof \Traversable){return \iterator_to_array($value);}return $value;}
    }}