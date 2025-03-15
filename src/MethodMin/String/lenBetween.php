<?php

namespace Inilim\Tool\Method\String{function lenBetween(string $str,$fromTo,$toFrom){return \Inilim\Tool\Method\Integer\checkBetween(\Inilim\Tool\Method\String\length($str),$fromTo,$toFrom);}if(!\Inilim\Tool\Str::__definedIfNot('length')){
    function length(string $value,$encoding='UTF-8'){return \mb_strlen($value,$encoding);}
    }}namespace Inilim\Tool\Method\Integer{if(!\Inilim\Tool\Integer::__definedIfNot('checkBetween')){
    function checkBetween($num,$fromTo,$toFrom){if(!\Inilim\Tool\Method\Integer\isNumeric($num)){throw new \InvalidArgumentException('$num must be numeric');}if(!\Inilim\Tool\Method\Integer\isNumeric($fromTo)){throw new \InvalidArgumentException('$fromTo must be numeric');}if(!\Inilim\Tool\Method\Integer\isNumeric($toFrom)){throw new \InvalidArgumentException('$toFrom must be numeric');}$toFrom=\intval($toFrom);$fromTo=\intval($fromTo);$num=\intval($num);if($fromTo>$toFrom){list($toFrom,$fromTo)=[$fromTo,$toFrom];}return $num>=$fromTo&&$num<=$toFrom;}
    }if(!\Inilim\Tool\Integer::__definedIfNot('isNumeric')){
    function isNumeric($v){if(!\is_scalar($v)||\is_bool($v)){return false;}/*// here string|int|float*//*// if (\preg_match('#^0$#', $v) || \preg_match('#^\-?[1-9][0-9]{0,}$#', $v)) return true;*/if(\preg_match('#^\-?[1-9][0-9]{0,}$|^0$#',\strval($v))){return true;}return false;}
    }}