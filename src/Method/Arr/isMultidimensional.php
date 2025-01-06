<?php

namespace Inilim\Method\Arr;

/**
 * проверка на многомерный массив
 * true - многомерный
 * false - одномерный
 */
function isMultidimensional(array $arr): bool
{
    return (\sizeof($arr) - \sizeof($arr, \COUNT_RECURSIVE)) !== 0;
}
