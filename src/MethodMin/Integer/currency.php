<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Integer{function currency($number,string $in='',?string $locale=null,?int $precision=null){if(!\Inilim\Tool\Method\Other\extPhp('intl')){throw new \RuntimeException('The "intl" PHP extension is required to use the [spell] function.');}$state=\Inilim\Tool\Method\Integer\__state();$formatter=new \NumberFormatter($locale ?? $state -> locale,\NumberFormatter :: CURRENCY);if($precision!==null){$formatter -> setAttribute(\NumberFormatter :: FRACTION_DIGITS,$precision);}return $formatter -> formatCurrency($number,!empty($in)?$in:$state -> currency);}if(!\Inilim\Tool\Integer::__definedIfNot('__state')){
    function __state(){static $o=null;return $o ??= new class{var string $locale='en';var string $currency='USD';};}
    }}namespace Inilim\Tool\Method\Other{if(!\Inilim\Tool\Other::__definedIfNot('extPhp')){
    function extPhp(string $ext,bool $rechecking=false):bool{static $o=null;$o ??=[];if(isset($o[$ext])&&!$rechecking){return $o[$ext];}return $o[$ext]=\extension_loaded($ext);}
    }}