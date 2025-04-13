<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str{function headline(string $value){$parts=\explode(' ',$value);$parts=\sizeof($parts)>1?\array_map('\Inilim\Tool\Method\Str\title',$parts):\array_map('\Inilim\Tool\Method\Str\title',\Inilim\Tool\Method\Str\ucsplit(\implode('_',$parts)));$collapsed=\Inilim\Tool\Method\Str\replace(['-','_',' '],'_',\implode('_',$parts));return \implode(' ',\array_filter(\explode('_',$collapsed)));}if(!\Inilim\Tool\Str::__definedIfNot('replace')){
    function replace($search,$replace,$subject,bool $caseSensitive=true){if($search instanceof \Traversable){$search=\iterator_to_array($search);}if($replace instanceof \Traversable){$replace=\iterator_to_array($replace);}if($subject instanceof \Traversable){$subject=\iterator_to_array($subject);}return $caseSensitive?\str_replace($search,$replace,$subject):\str_ireplace($search,$replace,$subject);}
    }if(!\Inilim\Tool\Str::__definedIfNot('title')){
    function title(string $value):string{return \mb_convert_case($value,\MB_CASE_TITLE,'UTF-8');}
    }if(!\Inilim\Tool\Str::__definedIfNot('ucsplit')){
    function ucsplit(string $string):array{return \preg_split('/(?=\p{Lu})/u',$string,-1,\PREG_SPLIT_NO_EMPTY);}
    }}