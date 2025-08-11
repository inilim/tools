<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert{function php82(string $message=''){if(!\Inilim\Tool\Method\Check\php82()){throw new \InvalidArgumentException($message?:'The current version is lower than required "8.2"');}}}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('php82')){
    function php82():bool{return \PHP_VERSION_ID>=80200?true:false;}
    }}