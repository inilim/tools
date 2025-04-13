<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str{function camel(string $value){return \lcfirst(\Inilim\Tool\Method\Str\studly($value));}if(!\Inilim\Tool\Str::__definedIfNot('replace')){
    function replace($search,$replace,$subject,bool $caseSensitive=true){if($search instanceof \Traversable){$search=\iterator_to_array($search);}if($replace instanceof \Traversable){$replace=\iterator_to_array($replace);}if($subject instanceof \Traversable){$subject=\iterator_to_array($subject);}return $caseSensitive?\str_replace($search,$replace,$subject):\str_ireplace($search,$replace,$subject);}
    }if(!\Inilim\Tool\Str::__definedIfNot('studly')){
    function studly(string $value){$words=\explode(' ',\Inilim\Tool\Method\Str\replace(['-','_'],' ',$value));$studlyWords=\array_map('\Inilim\Tool\Method\Str\ucfirst',$words);return \implode($studlyWords);}
    }}