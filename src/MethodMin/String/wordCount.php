<?php

namespace Inilim\Tool\Method\String;

function wordCount(string $string,?string $characters=null):int{return \str_word_count($string,0,$characters);}