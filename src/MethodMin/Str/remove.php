<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str{function remove($search,$subject,bool $caseSensitive=true){$search=\Inilim\Tool\Method\Obj\toArrayIfTraversable($search);$subject=\Inilim\Tool\Method\Obj\toArrayIfTraversable($subject);return $caseSensitive?\str_replace($search,'',$subject):\str_ireplace($search,'',$subject);}}namespace Inilim\Tool\Method\Obj{if(!\Inilim\Tool\Obj::__definedIfNot('toArrayIfTraversable')){
    function toArrayIfTraversable($value){if($value instanceof \Traversable){return \iterator_to_array($value);}return $value;}
    }}