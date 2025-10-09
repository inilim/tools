<?php

namespace Inilim\Tool\Test\Tag;

class AssertTag
{
    protected string $name;
    protected string $status;
    protected string $expected;
    protected string $actual;
    protected string $message;

    function __construct(
        string $name,
        string $status,
        string $expected,
        string $actual,
        string $message
    ) {
        $this->name     = $name;
        $this->status   = $status;
        $this->expected = $expected;
        $this->actual   = $actual;
        $this->message  = $message;
    }

    function getStatus(): bool
    {
        return $this->status === '1' ? true : false;
    }

    function getMessage(): string
    {
        return $this->message ? \base64_decode($this->message) : '';
    }

    function getExpected(): string
    {
        return \base64_decode($this->expected);
    }

    function getActual(): string
    {
        return \base64_decode($this->actual);
    }

    function getName(): string
    {
        return $this->name;
    }
}
