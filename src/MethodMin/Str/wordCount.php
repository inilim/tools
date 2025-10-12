<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Str;

function wordCount(string $string,?string $characters=null):int{if($characters===null){return \str_word_count($string,0);}return \str_word_count($string,0,$characters);}