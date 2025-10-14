<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Integer{function defaultCurrency():string{return \Inilim\Tool\Method\Integer\__state()-> currency;}if(!\Inilim\Tool\Integer::__definedIfNot('__state')){
    function __state(){static $o=null;return $o ??= new class{var string $locale='en';var string $currency='USD';};}
    }}