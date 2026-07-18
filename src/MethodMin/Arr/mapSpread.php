<?php

namespace Inilim\Tool\Method\Arr{function mapSpread(array $array,callable $callback):array{return \Inilim\Tool\Method\LarArr\map($array,static function($chunk,$key)use($callback){$chunk[]=$key;return $callback(... $chunk);});}}namespace Inilim\Tool\Method\LarArr{if(!\Inilim\Tool\LarArr::__definedIfNot('map')){
    function map(array $array,callable $callback){$keys=\array_keys($array);try{$items=\array_map($callback,$array,$keys);}catch(\ArgumentCountError $e){$items=\array_map($callback,$array);}return \array_combine($keys,$items);}
    }}