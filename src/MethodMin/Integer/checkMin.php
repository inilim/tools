<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Integer{function checkMin($num,$min){if(!\Inilim\Tool\Method\Integer\isNumeric($num)){throw new \InvalidArgumentException('$num must be numeric');}if(!\Inilim\Tool\Method\Integer\isNumeric($min)){throw new \InvalidArgumentException('$min must be numeric');}return \intval($num)>=\intval($min);}if(!\Inilim\Tool\Integer::__definedIfNot('isNumeric')){
    function isNumeric($v){if(!\is_scalar($v)||\is_bool($v)){return false;}if(\preg_match('#^\-?[1-9][0-9]{0,}$|^0$#',\strval($v))){return true;}return false;}
    }}