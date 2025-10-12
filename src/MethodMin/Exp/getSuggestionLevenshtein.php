<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Exp;

function getSuggestionLevenshtein(array $possibilities,string $value){$best=[];$min=(\strlen($value)/4+1)*10+0.1;foreach($possibilities as $item){if($item!==$value&&($len=\levenshtein($item,$value,10,11,10))<=$min){if($min!==$len){$best=[];}$min=$len;$best[]=$item;}}return $best;}