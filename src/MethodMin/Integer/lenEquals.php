<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Integer{function lenEquals($num,$equal){if(!\Inilim\Tool\Method\Integer\isNumeric($num)){throw new \InvalidArgumentException('$num must be numeric');}if(!\Inilim\Tool\Method\Integer\isNumeric($equal)){throw new \InvalidArgumentException('$equal must be numeric');}return \Inilim\Tool\Method\Integer\equals(\Inilim\Tool\Method\Integer\lenNumeric($num),\Inilim\Tool\Method\Integer\lenNumeric($equal));}if(!\Inilim\Tool\Integer::__definedIfNot('equals')){
    function equals($num1,$num2){if(!\Inilim\Tool\Method\Integer\isNumeric($num1)){throw new \InvalidArgumentException('$num1 must be numeric');}if(!\Inilim\Tool\Method\Integer\isNumeric($num2)){throw new \InvalidArgumentException('$num2 must be numeric');}return \intval($num1)===\intval($num2);}
    }if(!\Inilim\Tool\Integer::__definedIfNot('isNumeric')){
    function isNumeric($v){if(!\is_scalar($v)||\is_bool($v)){return false;}if(\preg_match('#^\-?[1-9][0-9]{0,}$|^0$#',\strval($v))){return true;}return false;}
    }if(!\Inilim\Tool\Integer::__definedIfNot('lenNumeric')){
    function lenNumeric($num){if(!\Inilim\Tool\Method\Integer\isNumeric($num)){throw new \InvalidArgumentException('$num must be numeric');}return \strlen(\ltrim(\strval($num),'-'));}
    }}