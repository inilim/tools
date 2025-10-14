<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Integer{function lenEquals($num,$equal):bool{if(!\Inilim\Tool\Method\Integer\isNumeric($num)){throw new \InvalidArgumentException('$num must be numeric');}if(!\Inilim\Tool\Method\Integer\isNumeric($equal)){throw new \InvalidArgumentException('$equal must be numeric');}return \Inilim\Tool\Method\Integer\equals(\Inilim\Tool\Method\Integer\lenNumeric($num),\Inilim\Tool\Method\Integer\lenNumeric($equal));}if(!\Inilim\Tool\Integer::__definedIfNot('equals')){
    function equals($num1,$num2):bool{if(!\Inilim\Tool\Method\Integer\isNumeric($num1)){throw new \InvalidArgumentException('$num1 must be numeric');}if(!\Inilim\Tool\Method\Integer\isNumeric($num2)){throw new \InvalidArgumentException('$num2 must be numeric');}return \intval($num1)===\intval($num2);}
    }if(!\Inilim\Tool\Integer::__definedIfNot('isNumeric')){
    function isNumeric($v):bool{$t=\gettype($v);if(!\in_array($t,['string','integer'],true)){return false;}if($t==='integer'||\preg_match('#^\-?[1-9][0-9]{0,}$|^0$#',$v)){return true;}return false;}
    }if(!\Inilim\Tool\Integer::__definedIfNot('lenNumeric')){
    function lenNumeric($num):int{if(!\Inilim\Tool\Method\Integer\isNumeric($num)){throw new \InvalidArgumentException('$num must be numeric');}return \strlen(\ltrim(\strval($num),'-'));}
    }}