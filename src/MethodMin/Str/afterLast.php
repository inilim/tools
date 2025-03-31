<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

function afterLast(string $subject,string $search):string{if($search===''){return $subject;}$position=\strrpos($subject,$search);if($position===false){return $subject;}return \substr($subject,$position+\strlen($search));}