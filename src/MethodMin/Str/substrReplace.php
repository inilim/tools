<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Str{function substrReplace($string,$replace,$offset=0,$length=null){if($length===null){$length=\Inilim\Tool\Method\Str\length($string);}return \mb_substr($string,0,$offset).$replace.\mb_substr(\mb_substr($string,$offset),$length);}if(!\Inilim\Tool\Str::__definedIfNot('length')){
    function length(string $value,$encoding='UTF-8'):int{return \mb_strlen($value,$encoding);}
    }}