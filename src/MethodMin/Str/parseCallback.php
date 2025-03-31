<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str{function parseCallback(string $callback,?string $default=null):array{if(\Inilim\Tool\Method\Str\contains($callback,"@anonymous\x00")){if(\Inilim\Tool\Method\Str\substrCount($callback,'@')>1){return[\Inilim\Tool\Method\Str\beforeLast($callback,'@'),\Inilim\Tool\Method\Str\afterLast($callback,'@')];}return[$callback,$default];}return \Inilim\Tool\Method\Str\contains($callback,'@')?\explode('@',$callback,2):[$callback,$default];}if(!\Inilim\Tool\Str::__definedIfNot('_contains')){
    function _contains(string $haystack,string $needle){if(\PHP_VERSION_ID>=80000){return \str_contains($haystack,$needle);}return ''===$needle||false!==strpos($haystack,$needle);}
    }if(!\Inilim\Tool\Str::__definedIfNot('afterLast')){
    function afterLast(string $subject,string $search):string{if($search===''){return $subject;}$position=\strrpos($subject,$search);if($position===false){return $subject;}return \substr($subject,$position+\strlen($search));}
    }if(!\Inilim\Tool\Str::__definedIfNot('beforeLast')){
    function beforeLast(string $subject,string $search):string{if($search===''){return $subject;}$pos=\mb_strrpos($subject,$search);if($pos===false){return $subject;}return \Inilim\Tool\Method\Str\substr($subject,0,$pos);}
    }if(!\Inilim\Tool\Str::__definedIfNot('contains')){
    function contains(string $haystack,$needles,bool $ignoreCase=false){if($ignoreCase){$haystack=\mb_strtolower($haystack,'UTF-8');}if(!\is_iterable($needles)){$needles=(array) $needles;}foreach($needles as $needle){if($ignoreCase){$needle=\mb_strtolower($needle,'UTF-8');}if($needle!==''&&\Inilim\Tool\Method\Str\_contains($haystack,$needle)){return true;}}return false;}
    }if(!\Inilim\Tool\Str::__definedIfNot('substr')){
    function substr(string $string,int $start,?int $length=null,string $encoding='UTF-8'){return \mb_substr($string,$start,$length,$encoding);}
    }if(!\Inilim\Tool\Str::__definedIfNot('substrCount')){
    function substrCount(string $haystack,string $needle,int $offset=0,?int $length=null){if($length!==null){return \substr_count($haystack,$needle,$offset,$length);}return \substr_count($haystack,$needle,$offset);}
    }}