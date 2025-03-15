<?php

namespace Inilim\Tool\Method\Integer{function equals($num1,$num2){if(!\Inilim\Tool\Method\Integer\isNumeric($num1)){throw new \InvalidArgumentException('$num1 must be numeric');}if(!\Inilim\Tool\Method\Integer\isNumeric($num2)){throw new \InvalidArgumentException('$num2 must be numeric');}return \intval($num1)===\intval($num2);}if(!\Inilim\Tool\Integer::__definedIfNot('isNumeric')){
    function isNumeric($v){if(!\is_scalar($v)||\is_bool($v)){return false;}/*// here string|int|float*//*// if (\preg_match('#^0$#', $v) || \preg_match('#^\-?[1-9][0-9]{0,}$#', $v)) return true;*/if(\preg_match('#^\-?[1-9][0-9]{0,}$|^0$#',\strval($v))){return true;}return false;}
    }}