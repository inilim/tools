<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Str{function lenBetween(string $str,$fromTo,$toFrom):bool{return \Inilim\Tool\Method\Integer\checkBetween(\Inilim\Tool\Method\Str\length($str),$fromTo,$toFrom);}if(!\Inilim\Tool\Str::__definedIfNot('length')){
    function length(string $value,$encoding='UTF-8'):int{return \mb_strlen($value,$encoding);}
    }}namespace Inilim\Tool\Method\Integer{if(!\Inilim\Tool\Integer::__definedIfNot('checkBetween')){
    function checkBetween($num,$fromTo,$toFrom):bool{if(!\Inilim\Tool\Method\Integer\isNumeric($num)){throw new \InvalidArgumentException('$num must be numeric');}if(!\Inilim\Tool\Method\Integer\isNumeric($fromTo)){throw new \InvalidArgumentException('$fromTo must be numeric');}if(!\Inilim\Tool\Method\Integer\isNumeric($toFrom)){throw new \InvalidArgumentException('$toFrom must be numeric');}$toFrom=\intval($toFrom);$fromTo=\intval($fromTo);$num=\intval($num);if($fromTo>$toFrom){[$toFrom,$fromTo]=[$fromTo,$toFrom];}return $num>=$fromTo&&$num<=$toFrom;}
    }if(!\Inilim\Tool\Integer::__definedIfNot('isNumeric')){
    function isNumeric($v):bool{$t=\gettype($v);if(!\in_array($t,['string','integer'],true)){return false;}if($t==='integer'||\preg_match('#^\-?[1-9][0-9]{0,}$|^0$#',$v)){return true;}return false;}
    }}