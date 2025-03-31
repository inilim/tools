<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

function deduplicate(string $string,string $character=' '){return \preg_replace('/'.\preg_quote($character,'/').'+/u',$character,$string);}