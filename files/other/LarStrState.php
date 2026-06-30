<?php

namespace Inilim\Internal;

/**
 * @internal Inilim\Tool\Method\LarStr
 */
class LarStrState
{
    /**
     * The list of characters that are considered "invisible" in strings.
     *
     * @var string
     */
    const INVISIBLE_CHARACTERS = '';

    /**
     * The cache of snake-cased words.
     *
     * @var array<string, string>
     */
    public $snakeCache = [];

    /**
     * The cache of camel-cased words.
     *
     * @var array<string, string>
     */
    public $camelCache = [];

    /**
     * The cache of studly-cased words.
     *
     * @var array<string, string>
     */
    public $studlyCache = [];

    /**
     * The callback that should be used to generate UUIDs.
     *
     * @var (callable(): \Ramsey\Uuid\UuidInterface)|null
     */
    public $uuidFactory;

    /**
     * The callback that should be used to generate ULIDs.
     *
     * @var (callable(): \Symfony\Component\Uid\Ulid)|null
     */
    public $ulidFactory;

    /**
     * The callback that should be used to generate random strings.
     *
     * @var (callable(int): string)|null
     */
    public $randomStringFactory;
}
