<?php

namespace Inilim\Tool\Method\LarArr;

function crossJoin(... $arrays){$results=[[]];foreach($arrays as $index=>$array){$append=[];foreach($results as $product){foreach($array as $item){$product[$index]=$item;$append[]=$product;}}$results=$append;}return $results;}