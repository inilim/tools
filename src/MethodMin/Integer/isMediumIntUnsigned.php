<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Integer{function isMediumIntUnsigned(mixed $value){if(!\Inilim\Tool\Method\Integer\isNumeric($value)){return false;}$value=\strval($value);if(\Inilim\Tool\Method\Integer\lenNumeric($value)>\Inilim\Tool\Integer :: MEDIUM_INT_UNSIGNED_MAX_LENGHT){return false;}return \Inilim\Tool\Method\Integer\checkBetween($value,\Inilim\Tool\Integer :: MEDIUM_INT_UNSIGNED_MIN,\Inilim\Tool\Integer :: MEDIUM_INT_UNSIGNED_MAX);}if(!\Inilim\Tool\Integer::__definedIfNot('checkBetween')){
    function checkBetween($num,$fromTo,$toFrom){if(!\Inilim\Tool\Method\Integer\isNumeric($num)){throw new \InvalidArgumentException('$num must be numeric');}if(!\Inilim\Tool\Method\Integer\isNumeric($fromTo)){throw new \InvalidArgumentException('$fromTo must be numeric');}if(!\Inilim\Tool\Method\Integer\isNumeric($toFrom)){throw new \InvalidArgumentException('$toFrom must be numeric');}$toFrom=\intval($toFrom);$fromTo=\intval($fromTo);$num=\intval($num);if($fromTo>$toFrom){list($toFrom,$fromTo)=[$fromTo,$toFrom];}return $num>=$fromTo&&$num<=$toFrom;}
    }if(!\Inilim\Tool\Integer::__definedIfNot('isNumeric')){
    function isNumeric($v){if(!\is_scalar($v)||\is_bool($v)){return false;}if(\preg_match('#^\-?[1-9][0-9]{0,}$|^0$#',\strval($v))){return true;}return false;}
    }if(!\Inilim\Tool\Integer::__definedIfNot('lenNumeric')){
    function lenNumeric($num){if(!\Inilim\Tool\Method\Integer\isNumeric($num)){throw new \InvalidArgumentException('$num must be numeric');}return \strlen(\ltrim(\strval($num),'-'));}
    }}