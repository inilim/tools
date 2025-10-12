<?php

namespace Inilim\Tool\Test\Tag;

use Inilim\Tool\Path;

class ErrorTag
{
    protected string $message;
    protected string $file;
    protected string $line;
    protected ProcessTag $processTag;

    function __construct(
        string $message,
        string $file,
        string $line,
        ProcessTag $processTag
    ) {
        $this->message  = $message;
        $this->file  = $file;
        $this->line  = $line;
        $this->processTag  = $processTag;
    }

    function throw()
    {
        throw new \Error(\sprintf(
            '%s%s | %s::%s %sEnv: %s %s',
            PHP_EOL . \str_repeat('#', 15) . PHP_EOL,
            $this->message,
            $this->getFile(),
            $this->getLine(),
            PHP_EOL . \str_repeat('-', 15) . PHP_EOL,
            \print_r($this->processTag->getEnv(), true),
            PHP_EOL . \str_repeat('#', 15) . PHP_EOL
        ));
    }

    function getMessage(): string
    {
        return $this->message;
    }

    function getFile(): string
    {
        return Path::normalize($this->file);
    }

    function getLine(): int
    {
        return (int)$this->line;
    }
}
