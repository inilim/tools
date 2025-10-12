<?php

namespace Inilim\Tool\Method\LarArr;

function mapWithKeys(array $array,callable $callback){$result=[];foreach($array as $key=>$value){$assoc=$callback($value,$key);foreach($assoc as $mapKey=>$mapValue){$result[$mapKey]=$mapValue;}}return $result;}