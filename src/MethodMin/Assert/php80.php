<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert{function php80(string $message=''){if(!\Inilim\Tool\Method\Check\php80()){throw new \InvalidArgumentException($message?:'The current version is lower than required "8.0"');}}}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('php80')){
    function php80():bool{return \PHP_VERSION_ID>=80000?true:false;}
    }}