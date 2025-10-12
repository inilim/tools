<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Str;

function replaceFirst(string $search,string $replace,string $subject){if($search===''){return $subject;}$position=\strpos($subject,$search);if($position!==false){return \substr_replace($subject,$replace,$position,\strlen($search));}return $subject;}