<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Integer{function withLocale(string $locale,callable $callback){$state=\Inilim\Tool\Method\Integer\__state();$previousLocale=$state -> locale;$state -> locale=$locale;$result=$callback();$state -> locale=$previousLocale;return $result;}if(!\Inilim\Tool\Integer::__definedIfNot('__state')){
    function __state(){static $o=null;return $o ?? new class{var string $locale='en';var string $currency='USD';};}
    }}