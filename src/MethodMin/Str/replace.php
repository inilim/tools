<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str{function replace($search,$replace,$subject,bool $caseSensitive=true){$search=\Inilim\Tool\Method\Obj\toArrayIfTraversable($search);$replace=\Inilim\Tool\Method\Obj\toArrayIfTraversable($replace);$subject=\Inilim\Tool\Method\Obj\toArrayIfTraversable($subject);return $caseSensitive?\str_replace($search,$replace,$subject):\str_ireplace($search,$replace,$subject);}}namespace Inilim\Tool\Method\Obj{if(!\Inilim\Tool\Obj::__definedIfNot('toArrayIfTraversable')){
    function toArrayIfTraversable($value){if($value instanceof \Traversable){return \iterator_to_array($value);}return $value;}
    }}