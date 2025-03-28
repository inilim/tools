<?php

namespace Inilim\Tool\Method\Str;

function ucsplit(string $string):array{return \preg_split('/(?=\p{Lu})/u',$string,-1,\PREG_SPLIT_NO_EMPTY);}