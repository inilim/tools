<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Integer{function withCurrency(string $currency,callable $callback){$state=\Inilim\Tool\Method\Integer\__state();$previousCurrency=$state -> currency;$state -> currency=$currency;$result=$callback();$state -> currency=$previousCurrency;return $result;}if(!\Inilim\Tool\Integer::__definedIfNot('__state')){
    function __state(){static $o=null;return $o ??= new class{var string $locale='en';var string $currency='USD';};}
    }}