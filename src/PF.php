<?php

namespace Inilim\Tool;

/**
 * PolyFill
 */
final class PF extends \Inilim\Tool\LazyMethodAbstract
{
    protected const NAMESPACE = 'Inilim\Tool\Method\PF',
        PATH_TO_DIR           = __DIR__ . '/MethodMin/PF',
        IDX                   = 20;

    const MB_CASE_UPPER = 0,
        MB_CASE_LOWER   = 1,
        MB_CASE_TITLE   = 2,
        MB_CASE_FOLD    = 3;
}
