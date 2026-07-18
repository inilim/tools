<?php

namespace Inilim\Tool\Method\Arr{function prependKeysWith(array $array,string $prependWith):array{return \Inilim\Tool\Method\LarArr\mapWithKeys($array,static fn($item,$key)=>[$prependWith.$key=>$item]);}}namespace Inilim\Tool\Method\LarArr{if(!\Inilim\Tool\LarArr::__definedIfNot('mapWithKeys')){
    function mapWithKeys(array $array,callable $callback){$result=[];foreach($array as $key=>$value){$assoc=$callback($value,$key);foreach($assoc as $mapKey=>$mapValue){$result[$mapKey]=$mapValue;}}return $result;}
    }}