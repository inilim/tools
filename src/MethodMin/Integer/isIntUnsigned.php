<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Integer{function isIntUnsigned($value):bool{if(!\Inilim\Tool\Method\Integer\isNumeric($value)){return false;}$value=\strval($value);if(\Inilim\Tool\Method\PF\str_starts_with($value,'-')){return false;}$len=\Inilim\Tool\Method\Integer\lenNumeric($value);if($len<\Inilim\Tool\Integer :: MAX_LEN_32_BIT){return true;}if($len>\Inilim\Tool\Integer :: MAX_LEN_32_BIT){return false;}return \Inilim\Tool\Method\Integer\__compare(\str_split($value),[4,2,9,4,9,6,7,2,9,5]);}if(!\Inilim\Tool\Integer::__definedIfNot('__compare')){
    function __compare(array $value,array $arrayInt):bool{foreach(\array_map(null,$value,$arrayInt)as $c){[$v,$a]=$c;$v=\intval($v);if($v>$a){return false;}elseif($v<$a){return true;}}return true;}
    }if(!\Inilim\Tool\Integer::__definedIfNot('isNumeric')){
    function isNumeric($v):bool{if(!\is_scalar($v)||\is_bool($v)){return false;}if(\preg_match('#^\-?[1-9][0-9]{0,}$|^0$#',\strval($v))){return true;}return false;}
    }if(!\Inilim\Tool\Integer::__definedIfNot('lenNumeric')){
    function lenNumeric($num):int{if(!\Inilim\Tool\Method\Integer\isNumeric($num)){throw new \InvalidArgumentException('$num must be numeric');}return \strlen(\ltrim(\strval($num),'-'));}
    }}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('php80')){
    function php80():bool{return \PHP_VERSION_ID>=80000?true:false;}
    }}namespace Inilim\Tool\Method\PF{if(!\Inilim\Tool\PF::__definedIfNot('str_starts_with')){
    function str_starts_with(string $haystack,string $needle):bool{if(\Inilim\Tool\Method\Check\php80()){return \str_starts_with($haystack,$needle);}return 0===\strncmp($haystack,$needle,\strlen($needle));}
    }}