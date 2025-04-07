<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

function nestedMap(array $array,int $depth,callable $callable){$internal=static function($internal,&$array,$key,$depth,$callable){/***@var\Closure$internal*@varmixed[]$array*@varint|string|null$key*@varint$depth*@varcallable$callable*/if($depth<=0){return $callable($array,$key);}foreach($array as $idx=>$item){if(\is_array($item)){$array[$idx]=$internal($internal,$item,$idx,$depth-1,$callable);}}return $array;};return $internal -> __invoke($internal,$array,null,$depth,$callable);}