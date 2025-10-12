<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Arr{function mapSpread(array $array,callable $callback):array{return \Inilim\Tool\Method\Arr\map($array,static function($chunk,$key)use($callback){$chunk[]=$key;return $callback(... $chunk);});}if(!\Inilim\Tool\Arr::__definedIfNot('map')){
    function map(array $array,callable $callback):array{$keys=\array_keys($array);try{$items=\array_map($callback,$array,$keys);}catch(\ArgumentCountError $e){$items=\array_map($callback,$array);}return \array_combine($keys,$items);}
    }}