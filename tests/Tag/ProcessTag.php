<?php

namespace Inilim\Tool\Test\Tag;

use Inilim\Tool\Path;

class ProcessTag
{
    protected string $ini;
    protected string $php_bin;
    protected string $php_version;
    protected string $case;

    function __construct(
        string $ini,
        string $php_bin,
        string $php_version,
        string $case
    ) {
        $this->ini         = $ini;
        $this->php_bin     = $php_bin;
        $this->php_version = $php_version;
        $this->case        = $case;
    }

    function getIni(): bool
    {
        return Path::normalize($this->ini);
    }

    function getPhpBin(): string
    {
        return Path::normalize($this->php_bin);
    }

    function getPhpVersion(): string
    {
        return $this->php_version;
    }

    function getCase(): string
    {
        return Path::normalize($this->case);
    }
}
