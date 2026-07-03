<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Arr{function splitIntoChunks(array $array,int $chunks,bool $preserveKeys=false,bool $removeEmptyChunks=false):array{if($array===[]||$chunks<1){return[];}$i=0;$result=\array_fill(0,$chunks,[]);foreach($array as $key=>$value){if($preserveKeys){$result[$i][$key]=$value;}else{$result[$i][]=$value;}$i++;if(!isset($result[$i])){$i=0;}}if($removeEmptyChunks){if(\Inilim\Tool\Method\Check\php80()){$result=\array_filter($result,null);}else{foreach($result as $idx=>$item){if($item===[]){unset($result[$idx]);}}}}return $result;}}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('php80')){
    function php80():bool{return \PHP_VERSION_ID>=80000?true:false;}
    }}