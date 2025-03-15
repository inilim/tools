<?php

namespace Inilim\Tool\Method\String;

function replaceLast(string $search,string $replace,string $subject):string{if($search===''){return $subject;}$position=\strrpos($subject,$search);if($position!==false){return \substr_replace($subject,$replace,$position,\strlen($search));}return $subject;}