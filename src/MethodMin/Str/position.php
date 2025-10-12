<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Str;

function position(string $haystack,string $needle,int $offset=0,?string $encoding='UTF-8'){return \mb_strpos($haystack,$needle,$offset,$encoding);}