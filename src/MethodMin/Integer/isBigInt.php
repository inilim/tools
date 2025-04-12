<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Integer{function isBigInt($value){if(!\Inilim\Tool\Method\Integer\isNumeric($value)){return false;}$value=\strval($value);$len=\Inilim\Tool\Method\Integer\lenNumeric($value);if($len<\Inilim\Tool\Integer :: BIG_INT_MAX_LENGHT){return true;}if($len>\Inilim\Tool\Integer :: BIG_INT_MAX_LENGHT){return false;}$last=\Inilim\Tool\Method\Str\startsWith($value,'-')?8:7;return \Inilim\Tool\Method\Integer\__compare(\str_split(\trim($value,'-')),[9,2,2,3,3,7,2,0,3,6,8,5,4,7,7,5,8,0,$last]);}if(!\Inilim\Tool\Integer::__definedIfNot('__compare')){
    function __compare(array $value,array $arrayInt){foreach(\array_map(null,$value,$arrayInt)as $c){list($v,$a)=$c;$v=\intval($v);if($v>$a){return false;}elseif($v<$a){return true;}}return true;}
    }if(!\Inilim\Tool\Integer::__definedIfNot('isNumeric')){
    function isNumeric($v){if(!\is_scalar($v)||\is_bool($v)){return false;}if(\preg_match('#^\-?[1-9][0-9]{0,}$|^0$#',\strval($v))){return true;}return false;}
    }if(!\Inilim\Tool\Integer::__definedIfNot('lenNumeric')){
    function lenNumeric($num){if(!\Inilim\Tool\Method\Integer\isNumeric($num)){throw new \InvalidArgumentException('$num must be numeric');}return \strlen(\ltrim(\strval($num),'-'));}
    }}namespace Inilim\Tool\Method\Str{if(!\Inilim\Tool\Str::__definedIfNot('_startsWith')){
    function _startsWith(string $haystack,string $needle){if(\PHP_VERSION_ID>=80000){return \str_starts_with($haystack,$needle);}return 0===\strncmp($haystack,$needle,\strlen($needle));}
    }if(!\Inilim\Tool\Str::__definedIfNot('startsWith')){
    function startsWith(string $haystack,$needles){if(!\is_iterable($needles)){$needles=[$needles];}foreach($needles as $needle){if((string) $needle!==''&&\Inilim\Tool\Method\Str\_startsWith($haystack,$needle)){return true;}}return false;}
    }}