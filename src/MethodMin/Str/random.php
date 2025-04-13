<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str{function random(int $length=16):string{return(\Inilim\Tool\Method\Str\__state()-> randomStringFactory ?? static function($length){$string='';while(($len=\strlen($string))<$length){$size=$length-$len;$bytesSize=(int) \ceil($size/3)*3;$bytes=\random_bytes($bytesSize);$string .= \substr(\str_replace(['/','+','='],'',\base64_encode($bytes)),0,$size);}return $string;})($length);}if(!\Inilim\Tool\Str::__definedIfNot('__state')){
    function __state(){static $o=null;return $o ?? new class{var $randomStringFactory;var $internalEncoding='UTF-8';function getEncoding($encoding){if(null===$encoding){return $this -> internalEncoding;}if('UTF-8'===$encoding){return 'UTF-8';}$encoding=\strtoupper($encoding);if('8BIT'===$encoding||'BINARY'===$encoding){return 'CP850';}if('UTF8'===$encoding){return 'UTF-8';}return $encoding;}};}
    }}