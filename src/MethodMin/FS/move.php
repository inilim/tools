<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\FS;

function move(string $path,string $target):bool{return \rename($path,$target);}