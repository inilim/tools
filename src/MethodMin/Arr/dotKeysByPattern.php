<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr{function dotKeysByPattern(iterable $target,string $dotPattern){$regex='#^'.\str_replace('\*','[^\.]+',\preg_quote($dotPattern)).'#';return \array_values(\array_filter(\Inilim\Tool\Method\Arr\dotKeys($target),static fn($key)=>\preg_match($regex,$key)));}if(!\Inilim\Tool\Arr::__definedIfNot('dotKeys')){
    function dotKeys(iterable $array,string $prepend=''){$results=[];foreach($array as $key=>$value){if(\is_array($value)&&!empty($value)){$results=\array_merge($results,\Inilim\Tool\Method\Arr\dotKeys($value,$prepend.$key.'.'));}else{$results[]=$prepend.$key;}}return $results;}
    }}