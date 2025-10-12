<?php

namespace Inilim\Tool\Test\Tag;

use Inilim\Tool\Path;

class ProcessTag
{
    protected array $data;

    function __construct(array $data)
    {
        $this->data = $data;
    }

    function getEnv(): array
    {
        return $this->data['env'];
    }

    function getIni(): bool
    {
        return Path::normalize($this->data['ini']);
    }

    function getPhpBin(): string
    {
        return Path::normalize($this->data['php_bin']);
    }

    function getPhpVersion(): string
    {
        return $this->data['php_version'];
    }

    function getCase(): string
    {
        return Path::normalize($this->data['case']);
    }
}
