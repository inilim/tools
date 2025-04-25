<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert{function php84($message=''){if(\Inilim\Tool\Method\Check\php84()){return;}throw new \AssertionError($message?:'The current version is lower than required "8.4"');}}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('php84')){
    function php84(){if(\PHP_VERSION_ID>=80400){return true;}return false;}
    }}