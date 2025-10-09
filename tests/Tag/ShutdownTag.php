<?php

namespace Inilim\Tool\Test\Tag;

// '<shutdown work_ms="%s" memory_limit="%s" time_limit="%s" timezone="%s" />',

class ShutdownTag
{
    protected string $work_ms;
    protected string $memory_limit;
    protected string $time_limit;
    protected string $timezone;

    function __construct(
        string $work_ms,
        string $memory_limit,
        string $time_limit,
        string $timezone
    ) {}
}
