<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert{function php83($message=''){if(\Inilim\Tool\Method\Check\php83()){return;}throw new \AssertionError($message?:'The current version is lower than required "8.3"');}}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('php83')){
    function php83():bool{return \PHP_VERSION_ID>=80300?true:false;}
    }}