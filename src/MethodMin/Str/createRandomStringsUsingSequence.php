<?php

namespace Inilim\Tool\Method\Str{function createRandomStringsUsingSequence(array $sequence,?callable $when_missing=null){$next=0;$when_missing ??= static function($length)use(&$next){$state=\Inilim\Tool\Method\Str\__state();$factory_cache=$state -> randomStringFactory;$state -> randomStringFactory=null;$random_string=\Inilim\Tool\Method\Str\random($length);$state -> randomStringFactory=$factory_cache;$next++;return $random_string;};\Inilim\Tool\Method\Str\createRandomStringsUsing(static function($length)use(&$next,$sequence,$when_missing){if(\array_key_exists($next,$sequence)){return $sequence[$next++];}return $when_missing($length);});}if(!\Inilim\Tool\Str::__definedIfNot('__state')){
    function __state(){static $o=null;return $o ?? new class{var $randomStringFactory;};}
    }if(!\Inilim\Tool\Str::__definedIfNot('createRandomStringsUsing')){
    function createRandomStringsUsing(?callable $factory=null){\Inilim\Tool\Method\Str\__state()-> randomStringFactory=$factory;}
    }if(!\Inilim\Tool\Str::__definedIfNot('random')){
    function random(int $length=16):string{return(\Inilim\Tool\Method\Str\__state()-> randomStringFactory ?? static function($length){$string='';while(($len=\strlen($string))<$length){$size=$length-$len;$bytesSize=(int) \ceil($size/3)*3;$bytes=\random_bytes($bytesSize);$string .= \substr(\str_replace(['/','+','='],'',\base64_encode($bytes)),0,$size);}return $string;})($length);}
    }}