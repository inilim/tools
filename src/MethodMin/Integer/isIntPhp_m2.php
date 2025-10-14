<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Integer{function isIntPhp_m2($value):bool{if(!\Inilim\Tool\Method\Integer\isNumeric($value)){throw new \InvalidArgumentException('$value must be numeric');}return \strval(\intval($value))===\strval($value)?true:false;}if(!\Inilim\Tool\Integer::__definedIfNot('isNumeric')){
    function isNumeric($v):bool{$t=\gettype($v);if(!\in_array($t,['string','integer'],true)){return false;}if($t==='integer'||\preg_match('#^\-?[1-9][0-9]{0,}$|^0$#',$v)){return true;}return false;}
    }}