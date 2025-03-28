<?php

namespace Inilim\Tool\Method\Str{function take(string $string,int $limit):string{if($limit<0){return \Inilim\Tool\Method\Str\substr($string,$limit);}return \Inilim\Tool\Method\Str\substr($string,0,$limit);}if(!\Inilim\Tool\Str::__definedIfNot('substr')){
    function substr(string $string,int $start,?int $length=null,string $encoding='UTF-8'){return \mb_substr($string,$start,$length,$encoding);}
    }}