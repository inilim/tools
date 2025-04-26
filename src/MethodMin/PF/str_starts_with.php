<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\PF{function str_starts_with(string $haystack,string $needle){if(\Inilim\Tool\Method\Check\php80()){return \str_starts_with($haystack,$needle);}return 0===\strncmp($haystack,$needle,\strlen($needle));}}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('php80')){
    function php80(){return \PHP_VERSION_ID>=80000?true:false;}
    }}