<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert{function json($value,string $message=''){\Inilim\Tool\Method\Assert\string($value);if(!\Inilim\Tool\Method\Check\isJson($value)){throw new \InvalidArgumentException(\sprintf($message?:'Expected an json. Got: "%s"',$value));}}if(!\Inilim\Tool\Assert::__definedIfNot('string')){
    function string($value,string $message=''){if(!\is_string($value)){throw new \InvalidArgumentException(\sprintf($message?:'Expected a string. Got: %s',\Inilim\Tool\Method\Other\getType($value)));}}
    }}namespace Inilim\Tool\Method\Other{if(!\Inilim\Tool\Other::__definedIfNot('getType')){
    function getType($v){$r=\gettype($v);switch($r){case 'NULL':return 'null';case 'double':return 'float';case 'object':if(\PHP_VERSION_ID>=80100&&$v instanceof \UnitEnum){return 'enum';}elseif($v instanceof \Throwable){return 'exception';}return 'object';case 'boolean':return 'bool';case 'integer':return 'int';default:return $r;}}
    }}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('isJson')){
    function isJson($value):bool{if(!\is_string($value)){return false;}return \Inilim\Tool\Method\PF\json_validate($value);}
    }if(!\Inilim\Tool\Check::__definedIfNot('php83')){
    function php83():bool{return \PHP_VERSION_ID>=80300?true:false;}
    }}namespace Inilim\Tool\Method\PF{if(!\Inilim\Tool\PF::__definedIfNot('json_validate')){
    function json_validate(string $json,int $depth=512,int $flags=0):bool{if(\Inilim\Tool\Method\Check\php83()){return \json_validate($json,$depth,$flags);}if(0!==$flags&&\defined('JSON_INVALID_UTF8_IGNORE')&&\JSON_INVALID_UTF8_IGNORE!==$flags){throw new \ValueError('PF::json_validate(): Argument #3 ($flags) must be a valid flag (allowed flags: JSON_INVALID_UTF8_IGNORE)');}if($depth<=0){throw new \ValueError('PF::json_validate(): Argument #2 ($depth) must be greater than 0');}$json_max_depth=0x7fffffff;if($depth>$json_max_depth){throw new \ValueError(\sprintf('PF::json_validate(): Argument #2 ($depth) must be less than %d',$json_max_depth));}\json_decode($json,null,$depth,$flags);return \JSON_ERROR_NONE===\json_last_error();}
    }}