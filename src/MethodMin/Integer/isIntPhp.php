<?php

namespace Inilim\Tool\Method\Integer{function isIntPHP($v){if(\Inilim\Tool\Method\Integer\isNumeric($v)){/**@varstring$v*/if(\strval(\intval($v))===\strval($v)){return true;}return false;}return false;}if(!\Inilim\Tool\Integer::__definedIfNot('isNumeric')){
    function isNumeric($v){if(!\is_scalar($v)||\is_bool($v)){return false;}/*// here string|int|float*//*// if (\preg_match('#^0$#', $v) || \preg_match('#^\-?[1-9][0-9]{0,}$#', $v)) return true;*/if(\preg_match('#^\-?[1-9][0-9]{0,}$|^0$#',\strval($v))){return true;}return false;}
    }}