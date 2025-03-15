<?php

namespace Inilim\Tool\Method\String;

function afterLast(string $subject,string $search):string{if($search===''){return $subject;}$position=\strrpos($subject,$search);if($position===false){return $subject;}return \substr($subject,$position+\strlen($search));}