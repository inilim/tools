<?php

namespace Inilim\Tool\Method\Str;

function replaceFirst(string $search,string $replace,string $subject):string{if($search===''){return $subject;}$position=\strpos($subject,$search);if($position!==false){return \substr_replace($subject,$replace,$position,\strlen($search));}return $subject;}