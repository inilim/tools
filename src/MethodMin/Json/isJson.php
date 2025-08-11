<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Json{function isJson(?string $v):bool{if($v===null){return false;}return \Inilim\Tool\Method\PF\json_validate($v);}}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('php83')){
    function php83():bool{return \PHP_VERSION_ID>=80300?true:false;}
    }}namespace Inilim\Tool\Method\PF{if(!\Inilim\Tool\PF::__definedIfNot('json_validate')){
    function json_validate(string $json,int $depth=512,int $flags=0):bool{if(\Inilim\Tool\Method\Check\php83()){return \json_validate($json,$depth,$flags);}if(0!==$flags&&\defined('JSON_INVALID_UTF8_IGNORE')&&\JSON_INVALID_UTF8_IGNORE!==$flags){throw new \Exception('PF::json_validate(): Argument #3 ($flags) must be a valid flag (allowed flags: JSON_INVALID_UTF8_IGNORE)');}if($depth<=0){throw new \Exception('PF::json_validate(): Argument #2 ($depth) must be greater than 0');}$json_max_depth=0x7fffffff;if($depth>$json_max_depth){throw new \Exception(\sprintf('PF::json_validate(): Argument #2 ($depth) must be less than %d',$json_max_depth));}\json_decode($json,null,$depth,$flags);return \JSON_ERROR_NONE===\json_last_error();}
    }}