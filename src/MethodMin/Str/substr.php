<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

function substr(string $string,int $start,?int $length=null,string $encoding='UTF-8'){return \mb_substr($string,$start,$length,$encoding);}