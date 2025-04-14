<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp{function extract(string $haystack,string $pattern){$placeholders=\Inilim\Tool\Method\Str\matchAll('/\{([^{}]+)}/',$pattern);$pattern=\preg_quote($pattern,'/');foreach($placeholders as $placeholder){$pattern=\Inilim\Tool\Method\Str\replace(\preg_quote('{'.$placeholder.'}','/'),'(?<'.$placeholder.'>[^\/]+?)',$pattern);}$pattern=\Inilim\Tool\Method\Str\replace(['\*','\{','\}'],['.*?','{','}'],$pattern);if(\preg_match("/^{$pattern}\$/i",$haystack,$matches)){return \array_intersect_key($matches,\array_flip($placeholders));}return[];}}namespace Inilim\Tool\Method\Str{if(!\Inilim\Tool\Str::__definedIfNot('matchAll')){
    function matchAll(string $pattern,string $subject){\preg_match_all($pattern,$subject,$matches);if(empty($matches[0])){return[];}return $matches[1]?? $matches[0];}
    }if(!\Inilim\Tool\Str::__definedIfNot('replace')){
    function replace($search,$replace,$subject,bool $caseSensitive=true){$search=\Inilim\Tool\Method\Obj\toArrayIfTraversable($search);$replace=\Inilim\Tool\Method\Obj\toArrayIfTraversable($replace);$subject=\Inilim\Tool\Method\Obj\toArrayIfTraversable($subject);return $caseSensitive?\str_replace($search,$replace,$subject):\str_ireplace($search,$replace,$subject);}
    }}namespace Inilim\Tool\Method\Obj{if(!\Inilim\Tool\Obj::__definedIfNot('toArrayIfTraversable')){
    function toArrayIfTraversable($value){if($value instanceof \Traversable){return \iterator_to_array($value);}return $value;}
    }}