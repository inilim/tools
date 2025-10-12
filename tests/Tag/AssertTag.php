<?php

namespace Inilim\Tool\Test\Tag;

class AssertTag
{
    protected array $data;
    protected ProcessTag $processTag;
    protected ?ExceptionTag $exceptionTag;

    function __construct(
        array $data,
        ProcessTag $processTag,
        ?ExceptionTag $exceptionTag
    ) {
        $this->data  = $data;
        $this->processTag  = $processTag;
        $this->exceptionTag  = $exceptionTag;
    }

    function getExceptionTag(): ?ExceptionTag
    {
        return $this->exceptionTag;
    }

    function getProcessTag(): ProcessTag
    {
        return $this->processTag;
    }

    function getLine(): int
    {
        return (int)$this->data['line'];
    }

    function getStatus(): bool
    {
        $s = $this->data['status'];
        if (\is_bool($s)) {
            $s = (int)$s;
        }
        return $s === 1 ? true : false;
    }

    function getMessage(): string
    {
        return $this->data['message'];
    }

    function getExpected(): string
    {
        return $this->data['expected'];
    }

    function getActual(): string
    {
        return $this->data['actual'];
    }

    function hasActual(): bool
    {
        return \array_key_exists('actual', $this->data);
    }

    function getTypeExpected(): string
    {
        return $this->data['expected_type'];
    }

    function getTypeActual(): string
    {
        return $this->data['actual_type'];
    }

    function hasExpected(): bool
    {
        return \array_key_exists('expected', $this->data);
    }

    function getName(): string
    {
        return $this->data['name'];
    }

    function assertInfo(): string
    {
        $info = [
            'Name' => $this->getName(),
            'Case::Line' => $this->processTag->getCase() . '::' . $this->getLine(),
        ];
        $message = $this->getMessage();
        if ($message !== '') {
            $info['Message'] = $message;
        }
        if ($this->hasExpected()) {
            $info['Expected'] = $this->getExpected();
        }
        if ($this->hasActual()) {
            $info['Actual'] = $this->getActual();
        }

        return \sprintf(
            '%s%s%s',
            PHP_EOL . \str_repeat('#', 15) . PHP_EOL,
            \print_r($info, true),
            PHP_EOL . \str_repeat('#', 15) . PHP_EOL
        );
    }
}
