<?php

namespace Inilim\Tool\Test\Tag;

// '<exception class="%s" message="%s" file="%s" line="%s" code="%s" trace="%s" />',

class ExceptionTag
{
    protected string $class;
    protected string $message;
    protected string $file;
    protected string $line;
    protected string $code;
    protected string $trace;

    function __construct(
        string $class,
        string $message,
        string $file,
        string $line,
        string $code,
        string $trace
    ) {
        $this->class  = $class;
        $this->message  = $message;
        $this->file  = $file;
        $this->line  = $line;
        $this->code  = $code;
        $this->trace  = $trace;
    }
}
