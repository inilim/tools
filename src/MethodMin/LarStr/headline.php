<?php

namespace Inilim\Tool\Method\LarStr{function headline($value){$parts=\preg_split('/\s+/u',$value,-1,\PREG_SPLIT_NO_EMPTY);$parts=\count($parts)>1?\array_map('\Inilim\Tool\Method\LarStr\title',$parts):\array_map('\Inilim\Tool\Method\LarStr\title',\Inilim\Tool\Method\LarStr\ucsplit(\implode('_',$parts)));$collapsed=\Inilim\Tool\Method\LarStr\replace(['-','_',' '],'_',\implode('_',$parts));return \implode(' ',\array_filter(\explode('_',$collapsed)));}if(!\Inilim\Tool\LarStr::__definedIfNot('replace')){
    function replace($search,$replace,$subject,$caseSensitive=true){if($search instanceof \Traversable){$search=\iterator_to_array($search);}if($replace instanceof \Traversable){$replace=\iterator_to_array($replace);}if($subject instanceof \Traversable){$subject=\iterator_to_array($subject);}return $caseSensitive?\str_replace($search,$replace,$subject):\str_ireplace($search,$replace,$subject);}
    }if(!\Inilim\Tool\LarStr::__definedIfNot('title')){
    function title($value){return \mb_convert_case($value,\MB_CASE_TITLE,'UTF-8');}
    }if(!\Inilim\Tool\LarStr::__definedIfNot('ucsplit')){
    function ucsplit($string){return \preg_split('/(?=\p{Lu})/u',$string,-1,\PREG_SPLIT_NO_EMPTY);}
    }}