<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Arr;

function mapFilter(array $array,callable $callback,$filteringValue=null,bool $preserveKeys=false){$i=0;$result=[];foreach($array as $key=>$value){$t=$callback($value,$key,$i);$i++;if($t!==$filteringValue){if($preserveKeys){$result[$key]=$t;}else{$result[]=$t;}}}return $result;}