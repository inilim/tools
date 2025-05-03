<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Integer{function checkMax($num,$max):bool{if(!\Inilim\Tool\Method\Integer\isNumeric($num)){throw new \InvalidArgumentException('$num must be numeric');}if(!\Inilim\Tool\Method\Integer\isNumeric($max)){throw new \InvalidArgumentException('$max must be numeric');}return \intval($num)<=\intval($max);}if(!\Inilim\Tool\Integer::__definedIfNot('isNumeric')){
    function isNumeric($v):bool{if(!\is_scalar($v)||\is_bool($v)){return false;}if(\preg_match('#^\-?[1-9][0-9]{0,}$|^0$#',\strval($v))){return true;}return false;}
    }}