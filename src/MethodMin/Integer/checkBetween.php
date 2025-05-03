<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Integer{function checkBetween($num,$fromTo,$toFrom):bool{if(!\Inilim\Tool\Method\Integer\isNumeric($num)){throw new \InvalidArgumentException('$num must be numeric');}if(!\Inilim\Tool\Method\Integer\isNumeric($fromTo)){throw new \InvalidArgumentException('$fromTo must be numeric');}if(!\Inilim\Tool\Method\Integer\isNumeric($toFrom)){throw new \InvalidArgumentException('$toFrom must be numeric');}$toFrom=\intval($toFrom);$fromTo=\intval($fromTo);$num=\intval($num);if($fromTo>$toFrom){list($toFrom,$fromTo)=[$fromTo,$toFrom];}return $num>=$fromTo&&$num<=$toFrom;}if(!\Inilim\Tool\Integer::__definedIfNot('isNumeric')){
    function isNumeric($v):bool{if(!\is_scalar($v)||\is_bool($v)){return false;}if(\preg_match('#^\-?[1-9][0-9]{0,}$|^0$#',\strval($v))){return true;}return false;}
    }}