<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\PF{function fdiv(float $dividend,float $divisor){if(\Inilim\Tool\Method\Check\php80()){return \fdiv($dividend,$divisor);}return@($dividend/$divisor);}}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('php80')){
    function php80(){return \PHP_VERSION_ID>=80000?true:false;}
    }}