<?php

namespace Inilim\Method\Arr;

/**
 * проверка на многомерный массив
 * true - многомерный
 * false - одномерный
 * @return bool
 */
function isMultidimensional(array $array)
{
    return \sizeof(\array_filter($array, 'is_array')) > 0;
}
