<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp;

/**
 * @internal
 * @todo Не стал добавлять поле в __state, думаю лучше создавать простые фукнции, а то __state много где участвует, и если его раздувать, то будут раздуватся все функции в котором участвует __state
 */
function __tagJsonSqlite(): string
{
    return 'open-file-json-sqlite';
}
