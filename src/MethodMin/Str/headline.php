<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str{function headline(string $value):string{$parts=\explode(' ',$value);$parts=\sizeof($parts)>1?\array_map('\Inilim\Tool\Method\Str\title',$parts):\array_map('\Inilim\Tool\Method\Str\title',\Inilim\Tool\Method\Str\ucsplit(\implode('_',$parts)));$collapsed=\Inilim\Tool\Method\Str\replace(['-','_',' '],'_',\implode('_',$parts));return \implode(' ',\array_filter(\explode('_',$collapsed)));}if(!\Inilim\Tool\Str::__definedIfNot('replace')){
    function replace($search,$replace,$subject,bool $caseSensitive=true){return $caseSensitive?\str_replace($search,$replace,$subject):\str_ireplace($search,$replace,$subject);}
    }if(!\Inilim\Tool\Str::__definedIfNot('ucsplit')){
    function ucsplit(string $string):array{return \preg_split('/(?=\p{Lu})/u',$string,-1,\PREG_SPLIT_NO_EMPTY);}
    }}