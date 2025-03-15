<?php

namespace Inilim\Tool\Method\Arr{function eachSpread(array $array,callable $callback){\Inilim\Tool\Method\Arr\each($array,static function($chunk,$key)use($callback){$chunk[]=$key;return $callback(... $chunk);});}if(!\Inilim\Tool\Arr::__definedIfNot('each')){
    function each($array,callable $callback){foreach($array as $key=>$item){if($callback($item,$key)===false){break;}}}
    }}