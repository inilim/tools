<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Assert{function php81(string $message=''){if(!\Inilim\Tool\Method\Check\php81()){throw new \InvalidArgumentException($message?:'The current version is lower than required "8.1"');}}}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('php81')){
    function php81():bool{return \PHP_VERSION_ID>=80100?true:false;}
    }}