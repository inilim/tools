<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr{function mapToGroups(array $array,callable $callback):array{return \array_reduce(\Inilim\Tool\Method\Arr\map($array,$callback),static function($groups,$pair){$groups[\key($pair)][]=\reset($pair);return $groups;});}if(!\Inilim\Tool\Arr::__definedIfNot('map')){
    function map(array $array,callable $callback):array{$keys=\array_keys($array);try{$items=\array_map($callback,$array,$keys);}catch(\ArgumentCountError $e){$items=\array_map($callback,$array);}return \array_combine($keys,$items);}
    }}