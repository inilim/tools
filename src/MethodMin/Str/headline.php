<?php

namespace Inilim\Tool\Method\Str{function headline(string $value){$parts=\explode(' ',$value);$parts=\sizeof($parts)>1?\array_map('\Inilim\Tool\Method\Str\title',$parts):\array_map('\Inilim\Tool\Method\Str\title',\Inilim\Tool\Method\Str\ucsplit(\implode('_',$parts)));$collapsed=\Inilim\Tool\Method\Str\replace(['-','_',' '],'_',\implode('_',$parts));return \implode(' ',\Inilim\Tool\Method\PF\array_filter(\explode('_',$collapsed)));}if(!\Inilim\Tool\Str::__definedIfNot('replace')){
    function replace($search,$replace,$subject,bool $caseSensitive=true){if($search instanceof \Traversable){$search=\Inilim\Tool\Method\LarArr\from($search);}if($replace instanceof \Traversable){$replace=\Inilim\Tool\Method\LarArr\from($replace);}if($subject instanceof \Traversable){$subject=\Inilim\Tool\Method\LarArr\from($subject);}return $caseSensitive?\str_replace($search,$replace,$subject):\str_ireplace($search,$replace,$subject);}
    }if(!\Inilim\Tool\Str::__definedIfNot('title')){
    function title(string $value):string{return \mb_convert_case($value,\Inilim\Tool\PF :: MB_CASE_TITLE,'UTF-8');}
    }if(!\Inilim\Tool\Str::__definedIfNot('ucsplit')){
    function ucsplit(string $string):array{return \preg_split('/(?=\p{Lu})/u',$string,-1,\PREG_SPLIT_NO_EMPTY);}
    }}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('php80')){
    function php80():bool{return \PHP_VERSION_ID>=80000?true:false;}
    }}namespace Inilim\Tool\Method\PF{if(!\Inilim\Tool\PF::__definedIfNot('array_filter')){
    function array_filter(array $array,?callable $callback=null,int $mode=0):array{if($callback!==null){return \array_filter($array,$callback,$mode);}if(\Inilim\Tool\Method\Check\php80()){return \array_filter($array,null,$mode);}foreach($array as $k=>$v){if(false===(bool) $v){unset($array[$k]);}}return $array;}
    }}namespace Inilim\Tool\Method\LarArr{if(!\Inilim\Tool\LarArr::__definedIfNot('from')){
    function from($items){$type=\gettype($items);if($type==='array'){return $items;}elseif($type==='object'){if(false){}elseif(\method_exists($items,'toArray')){return $items -> toArray();}elseif(\method_exists($items,'toJson')){return (array) \json_decode($items -> toJson(),true);}elseif(\Inilim\Tool\Method\Check\php80()&&$items instanceof \WeakMap){return \iterator_to_array($items,false);}elseif($items instanceof \Traversable){return \iterator_to_array($items);}elseif($items instanceof \JsonSerializable){return (array) $items -> jsonSerialize();}else{return (array) $items;}}throw new \InvalidArgumentException('Items cannot be represented by a scalar value.');}
    }}