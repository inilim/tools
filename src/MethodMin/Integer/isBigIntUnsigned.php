<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Integer{function isBigIntUnsigned($value){if(!\Inilim\Tool\Method\Integer\isNumeric($value)){return false;}/**@varint|float|string$value*/$value=\strval($value);/**@varstring$value*/if(\Inilim\Tool\Method\Str\_startsWith($value,'-')){return false;}$len=lenNumeric($value);if($len<\Inilim\Tool\Integer :: BIG_INT_MAX_UNSIGNED_LENGHT){return true;}if($len>\Inilim\Tool\Integer :: BIG_INT_MAX_UNSIGNED_LENGHT){return false;}/*// длина 20*/return \Inilim\Tool\Method\Integer\__compare(\str_split($value),[1,8,4,4,6,7,4,4,0,7,3,7,0,9,5,5,1,6,1,5]);}if(!\Inilim\Tool\Integer::__definedIfNot('__compare')){
    function __compare(array $value,array $arrayInt){foreach(\array_map(null,$value,$arrayInt)as $c){list($v,$a)=$c;$v=\intval($v);if($v>$a){return false;}elseif($v<$a){return true;}}return true;}
    }if(!\Inilim\Tool\Integer::__definedIfNot('isNumeric')){
    function isNumeric($v){if(!\is_scalar($v)||\is_bool($v)){return false;}/*// here string|int|float*//*// if (\preg_match('#^0$#', $v) || \preg_match('#^\-?[1-9][0-9]{0,}$#', $v)) return true;*/if(\preg_match('#^\-?[1-9][0-9]{0,}$|^0$#',\strval($v))){return true;}return false;}
    }}namespace Inilim\Tool\Method\Str{if(!\Inilim\Tool\Str::__definedIfNot('_startsWith')){
    function _startsWith(string $haystack,string $needle){if(\PHP_VERSION_ID>=80000){return \str_starts_with($haystack,$needle);}return 0===\strncmp($haystack,$needle,\strlen($needle));}
    }}