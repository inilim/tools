<?php

namespace Inilim\Tool\Method\Obj;

/**
 * @template T of \Throwable
 * @param T $e
 * @return T
 */
function rewriteLocationException(\Throwable $e, string $file, int $line)
{
    $rc = new \ReflectionClass($e);

    $rpf = $rc->getProperty('file');
    $rpl = $rc->getProperty('line');

    $rpf->setAccessible(true);
    $rpl->setAccessible(true);

    $rpf->setValue($e, $file);
    $rpl->setValue($e, $line);

    return $e;
}
