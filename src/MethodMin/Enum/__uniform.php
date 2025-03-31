<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Enum{function __uniform($value,bool $caseInsensitive){$value=\strval($value);return $caseInsensitive?\Inilim\Tool\Method\Str\lower($value):$value;}}namespace Inilim\Tool\Method\Str{if(!\Inilim\Tool\Str::__definedIfNot('lower')){
    function lower(string $value,?string $encoding='UTF-8'){return \mb_strtolower($value,$encoding);}
    }}