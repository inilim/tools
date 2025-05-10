<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Obj;

function rewriteLocationException(\Throwable $e,string $file,int $line):object{$rc=new \ReflectionClass($e);$rpf=$rc -> getProperty('file');$rpl=$rc -> getProperty('line');$rpf -> setAccessible(true);$rpl -> setAccessible(true);$rpf -> setValue($e,$file);$rpl -> setValue($e,$line);return $e;}