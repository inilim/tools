<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\ID;

function uuidv4(): string
{
    return \Inilim\Tool\Method\ID\uuidFromHex(
        \bin2hex(\random_bytes(16)),
        4
    );
}
