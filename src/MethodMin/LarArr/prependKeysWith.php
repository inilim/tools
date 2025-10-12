<?php

namespace Inilim\Tool\Method\LarArr{function prependKeysWith($array,$prependWith){return \Inilim\Tool\Method\LarArr\mapWithKeys($array,static fn($item,$key)=>[$prependWith.$key=>$item]);}if(!\Inilim\Tool\LarArr::__definedIfNot('mapWithKeys')){
    function mapWithKeys(array $array,callable $callback){$result=[];foreach($array as $key=>$value){$assoc=$callback($value,$key);foreach($assoc as $mapKey=>$mapValue){$result[$mapKey]=$mapValue;}}return $result;}
    }}