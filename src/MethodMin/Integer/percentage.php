<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Integer{function percentage($number,int $precision=0,?int $maxPrecision=null,?string $locale=null){if(!\Inilim\Tool\Method\Other\extPhp('intl')){throw new \RuntimeException('The "intl" PHP extension is required to use the [spell] function.');}$formatter=new \NumberFormatter($locale ?? \Inilim\Tool\Method\Integer\__state()-> locale,\NumberFormatter :: PERCENT);if($maxPrecision!==null){$formatter -> setAttribute(\NumberFormatter :: MAX_FRACTION_DIGITS,$maxPrecision);}else{$formatter -> setAttribute(\NumberFormatter :: FRACTION_DIGITS,$precision);}return $formatter -> format($number/100);}if(!\Inilim\Tool\Integer::__definedIfNot('__state')){
    function __state(){static $o=null;return $o ?? new class{var string $locale='en';var string $currency='USD';};}
    }}namespace Inilim\Tool\Method\Other{if(!\Inilim\Tool\Other::__definedIfNot('extPhp')){
    function extPhp(string $ext,bool $rechecking=false):bool{static $o=null;$o ??=[];if(isset($o[$ext])&&!$rechecking){return $o[$ext];}return $o[$ext]=\extension_loaded($ext);}
    }}