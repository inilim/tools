<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Xml{function appendChild(object $what,object $where,bool $throw=false):?object{\Inilim\Tool\Method\Assert\extPhp('dom');\Inilim\Tool\Method\Assert\isInstanceOf($what,\DOMNode :: class);\Inilim\Tool\Method\Assert\isInstanceOf($where,\DOMNode :: class);$doc=$where -> ownerDocument;if($doc===null){if($throw){throw new \DOMException('Failed $where->ownerDocument is null');}else{return null;}}$newWhat=@$doc -> importNode($what,true);if($newWhat===false){if($throw){throw new \DOMException('Failed importNode($what, true)');}else{return null;}}try{$where -> appendChild($newWhat);}catch(\DOMException $e){if($throw){throw $e;}else{return null;}}return $newWhat;}}namespace Inilim\Tool\Method\Other{if(!\Inilim\Tool\Other::__definedIfNot('extPhp')){
    function extPhp(string $ext,bool $rechecking=false):bool{static $o=null;$o ??=[];if(isset($o[$ext])&&!$rechecking){return $o[$ext];}return $o[$ext]=\extension_loaded($ext);}
    }if(!\Inilim\Tool\Other::__definedIfNot('getType')){
    function getType($v,bool $trueFalseAsSeparateType=false):string{$r=\gettype($v);switch($r){case 'NULL':return 'null';case 'double':return 'float';case 'object':if(\PHP_VERSION_ID>=80100&&$v instanceof \UnitEnum){return 'enum';}if($v instanceof \Throwable){return 'exception';}return 'object';case 'boolean':if($trueFalseAsSeparateType){return $v===true?'true':'false';}return 'bool';case 'integer':return 'int';case 'resource (closed)':return 'resource_closed';case 'unknown type':return 'unknown_type';default:return $r;}}
    }}namespace Inilim\Tool\Method\Assert{if(!\Inilim\Tool\Assert::__definedIfNot('extPhp')){
    function extPhp(string $nameExt,string $message=''){if(!\Inilim\Tool\Method\Other\extPhp($nameExt)){throw new \InvalidArgumentException(\sprintf($message?:'PHP Extension "%s" not found',$nameExt));}}
    }if(!\Inilim\Tool\Assert::__definedIfNot('isInstanceOf')){
    function isInstanceOf($value,$class,string $message=''){if(!$value instanceof $class){throw new \InvalidArgumentException(\sprintf($message?:'Expected an instance of %2$s. Got: %s',\Inilim\Tool\Method\Other\getType($value),$class));}}
    }}