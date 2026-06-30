<?php

namespace Inilim\Tool\Method\LarStr{function initials($value,$capitalize=false){$parts=\preg_split('/\s+/u',$value,-1,\PREG_SPLIT_NO_EMPTY);$parts=\array_map(fn($part)=>\mb_substr($part,0,1),$parts);$initials=\implode('',$parts);return $capitalize?\Inilim\Tool\Method\LarStr\upper($initials):$initials;}if(!\Inilim\Tool\LarStr::__definedIfNot('upper')){
    function upper($value){return \mb_strtoupper($value,'UTF-8');}
    }}