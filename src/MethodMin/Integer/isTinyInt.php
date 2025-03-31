<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Integer{function isTinyInt($value){if(!\Inilim\Tool\Method\Integer\isNumeric($value)){return false;}/**@varint|float|string$value*/$value=\strval($value);/**@varstring$value*/if(\Inilim\Tool\Method\Integer\lenNumeric($value)>\Inilim\Tool\Integer :: TINY_INT_MAX_LENGHT){return false;}return checkBetween($value,\Inilim\Tool\Integer :: TINY_INT_MIN,\Inilim\Tool\Integer :: TINY_INT_MAX);}if(!\Inilim\Tool\Integer::__definedIfNot('isNumeric')){
    function isNumeric($v){if(!\is_scalar($v)||\is_bool($v)){return false;}/*// here string|int|float*//*// if (\preg_match('#^0$#', $v) || \preg_match('#^\-?[1-9][0-9]{0,}$#', $v)) return true;*/if(\preg_match('#^\-?[1-9][0-9]{0,}$|^0$#',\strval($v))){return true;}return false;}
    }if(!\Inilim\Tool\Integer::__definedIfNot('lenNumeric')){
    function lenNumeric($num){if(!\Inilim\Tool\Method\Integer\isNumeric($num)){throw new \InvalidArgumentException('$num must be numeric');}return \strlen(\ltrim(\strval($num),'-'));}
    }}