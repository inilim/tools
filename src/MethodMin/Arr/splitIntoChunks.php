<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

function splitIntoChunks(array $array,int $chunks,bool $preserveKeys=false,bool $removeEmptyChunks=false){if(!$array||$chunks<1){return[];}/*// return \array_chunk($array, \ceil(\sizeof($array) / \abs($chunks)), $preserveKeys);*/$i=0;$result=\array_fill(0,$chunks,[]);foreach($array as $key=>$value){if($preserveKeys){$result[$i][$key]=$value;}else{$result[$i][]=$value;}$i++;if(!isset($result[$i])){$i=0;}}if($removeEmptyChunks){$result=\array_filter($result,null);}return $result;}