<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr{function prependKeysWith(array $array,string $prependWith):array{return \Inilim\Tool\Method\Arr\mapWithKeys($array,static fn($item,$key)=>[$prependWith.$key=>$item]);}if(!\Inilim\Tool\Arr::__definedIfNot('mapWithKeys')){
    function mapWithKeys(array $array,callable $callback):array{$result=[];foreach($array as $key=>$value){$assoc=$callback($value,$key);foreach($assoc as $map_key=>$map_value){$result[$map_key]=$map_value;}}return $result;}
    }}