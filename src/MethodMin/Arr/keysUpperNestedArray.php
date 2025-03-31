<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr{function keysUpperNestedArray(array $array,int $depth=1):array{if($depth<=0){return \Inilim\Tool\Method\Arr\keysUpper($array);}foreach($array as $idx=>$item){if(\is_array($item)){$array[$idx]=\Inilim\Tool\Method\Arr\keysUpperNestedArray($item,$depth-1);}}return $array;}if(!\Inilim\Tool\Arr::__definedIfNot('keysUpper')){
    function keysUpper(array $array){return \array_change_key_case($array,\CASE_UPPER);}
    }}