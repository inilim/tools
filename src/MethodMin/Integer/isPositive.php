<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Integer{function isPositive($num):bool{if(!\Inilim\Tool\Method\Integer\isNumeric($num)){throw new \InvalidArgumentException('Give not numeric');}return \intval($num)>0;}if(!\Inilim\Tool\Integer::__definedIfNot('isNumeric')){
    function isNumeric($v):bool{$t=\gettype($v);if(!\in_array($t,['string','integer'],true)){return false;}if($t==='integer'||\preg_match('#^\-?[1-9][0-9]{0,}$|^0$#',$v)){return true;}return false;}
    }}