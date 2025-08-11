<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

function iEndsWithOnce(string $haystack,string $needle):bool{return ''===$needle||\mb_stripos($haystack,$needle,-\mb_strlen($needle,'UTF-8'),'UTF-8')!==false;}