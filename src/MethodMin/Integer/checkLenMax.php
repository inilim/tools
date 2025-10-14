<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Integer{function checkLenMax($num,$max):bool{if(!\Inilim\Tool\Method\Integer\isNumeric($num)){throw new \InvalidArgumentException('$num must be numeric');}return \Inilim\Tool\Method\Integer\checkMax(\Inilim\Tool\Method\Integer\lenNumeric($num),$max);}if(!\Inilim\Tool\Integer::__definedIfNot('checkMax')){
    function checkMax($num,$max):bool{if(!\Inilim\Tool\Method\Integer\isNumeric($num)){throw new \InvalidArgumentException('$num must be numeric');}if(!\Inilim\Tool\Method\Integer\isNumeric($max)){throw new \InvalidArgumentException('$max must be numeric');}return \intval($num)<=\intval($max);}
    }if(!\Inilim\Tool\Integer::__definedIfNot('isNumeric')){
    function isNumeric($v):bool{$t=\gettype($v);if(!\in_array($t,['string','integer'],true)){return false;}if($t==='integer'||\preg_match('#^\-?[1-9][0-9]{0,}$|^0$#',$v)){return true;}return false;}
    }if(!\Inilim\Tool\Integer::__definedIfNot('lenNumeric')){
    function lenNumeric($num):int{if(!\Inilim\Tool\Method\Integer\isNumeric($num)){throw new \InvalidArgumentException('$num must be numeric');}return \strlen(\ltrim(\strval($num),'-'));}
    }}