<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\FS;

function exists(string $path):bool{return \file_exists($path);}