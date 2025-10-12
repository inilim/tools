<?php

namespace Inilim\Tool\Method\LarArr;

function map(array $array,callable $callback){$keys=\array_keys($array);try{$items=\array_map($callback,$array,$keys);}catch(\ArgumentCountError $e){$items=\array_map($callback,$array);}return \array_combine($keys,$items);}