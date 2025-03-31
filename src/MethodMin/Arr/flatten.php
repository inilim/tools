<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

function flatten(iterable $array,int $depth){$result=[];foreach($array as $item){if(!\is_array($item)){$result[]=$item;}else{$values=$depth===1?\array_values($item):\Inilim\Tool\Method\Arr\flatten($item,$depth-1);foreach($values as $value){$result[]=$value;}}}return $result;}