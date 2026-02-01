<?php

namespace Inilim\Tool\Method\LarArr;

function dot($array,$prepend=''){$results=[];$flatten=static function($data,$prefix)use(&$results,&$flatten):void{foreach($data as $key=>$value){$newKey=$prefix.$key;if(\is_array($value)&&!empty($value)){$flatten($value,$newKey.'.');}else{$results[$newKey]=$value;}}};$flatten($array,$prepend);$flatten=null;return $results;}