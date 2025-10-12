<?php

declare(strict_types=1);namespace Inilim\Tool\Method\PF{function fpow(float $num,float $exponent):float{if(\Inilim\Tool\Method\Check\php84()){return \fpow($num,$exponent);}return $num ** $exponent;}}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('php84')){
    function php84():bool{return \PHP_VERSION_ID>=80400?true:false;}
    }}