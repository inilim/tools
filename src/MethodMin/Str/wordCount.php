<?php

namespace Inilim\Tool\Method\Str;

function wordCount(string $string,?string $characters=null):int{return \str_word_count($string,0,$characters);}