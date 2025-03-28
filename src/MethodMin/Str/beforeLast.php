<?php

namespace Inilim\Tool\Method\Str{function beforeLast(string $subject,string $search):string{if($search===''){return $subject;}$pos=\mb_strrpos($subject,$search);if($pos===false){return $subject;}return \Inilim\Tool\Method\Str\substr($subject,0,$pos);}if(!\Inilim\Tool\Str::__definedIfNot('substr')){
    function substr(string $string,int $start,?int $length=null,string $encoding='UTF-8'){return \mb_substr($string,$start,$length,$encoding);}
    }}