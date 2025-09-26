<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

/**
 * @author inilim
 * is not php function \error_get_last()
 * @return null|array{type:int,message:string,file:string,line:int}
 */
function errorGetLast(): ?array
{
    return \Inilim\Tool\Method\Other\__state()->error;
}
