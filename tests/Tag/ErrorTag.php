<?php

namespace Inilim\Tool\Test\Tag;

class ErrorTag
{
    protected string $message;
    protected string $file;
    protected string $line;

    function __construct(
        string $message,
        string $file,
        string $line
    ) {
        $this->message  = $message;
        $this->file  = $file;
        $this->line  = $line;
    }
}
