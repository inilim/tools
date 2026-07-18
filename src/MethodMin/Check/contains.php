<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Check{function contains($value,string $subString,bool $ingnoreCase=false):bool{return \is_string($value)&&($ingnoreCase?\Inilim\Tool\Method\Str\iContainsOnce($value,$subString):\Inilim\Tool\Method\PF\str_contains($value,$subString));}if(!\Inilim\Tool\Check::__definedIfNot('php80')){
    function php80():bool{return \PHP_VERSION_ID>=80000?true:false;}
    }}namespace Inilim\Tool\Method\Str{if(!\Inilim\Tool\Str::__definedIfNot('iContainsOnce')){
    function iContainsOnce(string $haystack,string $needle):bool{\Inilim\Tool\Method\Assert\extPhp('mbstring');return ''===$needle||\mb_stripos($haystack,$needle,0,'UTF-8')!==false;}
    }}namespace Inilim\Tool\Method\Other{if(!\Inilim\Tool\Other::__definedIfNot('extPhp')){
    function extPhp(string $ext,bool $rechecking=false):bool{static $o=null;$o ??=[];if(isset($o[$ext])&&false===$rechecking){return $o[$ext];}return $o[$ext]=\extension_loaded($ext);}
    }}namespace Inilim\Tool\Method\Assert{if(!\Inilim\Tool\Assert::__definedIfNot('extPhp')){
    function extPhp(string $nameExt,string $message=''){if(false===\Inilim\Tool\Method\Other\extPhp($nameExt)){throw new \InvalidArgumentException(\sprintf($message?:'PHP Extension "%s" not found',$nameExt));}}
    }}namespace Inilim\Tool\Method\PF{if(!\Inilim\Tool\PF::__definedIfNot('str_contains')){
    function str_contains(string $haystack,string $needle):bool{if(\Inilim\Tool\Method\Check\php80()){return \str_contains($haystack,$needle);}return ''===$needle||false!==\strpos($haystack,$needle);}
    }}