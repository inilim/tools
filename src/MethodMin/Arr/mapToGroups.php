<?php

namespace Inilim\Tool\Method\Arr{function mapToGroups(array $array,callable $callback):array{return \array_reduce(\Inilim\Tool\Method\LarArr\map($array,$callback),static function($groups,$pair){$groups[\key($pair)][]=\reset($pair);return $groups;});}}namespace Inilim\Tool\Method\LarArr{if(!\Inilim\Tool\LarArr::__definedIfNot('map')){
    function map(array $array,callable $callback){$keys=\array_keys($array);try{$items=\array_map($callback,$array,$keys);}catch(\ArgumentCountError $e){$items=\array_map($callback,$array);}return \array_combine($keys,$items);}
    }}