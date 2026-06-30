<?php

namespace Inilim\Tool\Method\LarArr;

function dot($array,$prepend='',$depth=\INF){$results=[];$flatten=static function($data,$prefix,$currentDepth)use(&$results,&$flatten,$depth):void{foreach($data as $key=>$value){$newKey=$prefix.$key;if(\is_array($value)&&!empty($value)&&$currentDepth<$depth){$flatten($value,$newKey.'.',$currentDepth+1);}else{$results[$newKey]=$value;}}};$flatten($array,$prepend,0);$flatten=null;return $results;}