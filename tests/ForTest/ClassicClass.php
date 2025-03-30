<?php

namespace Inilim\Tool\Test\ForTest;

use Inilim\Tool\Test\ForTest\ClassForProp;

class ClassicClass
{
    // ---------------------------------------------
    // Non static
    // ---------------------------------------------

    public ClassForProp|\stdClass $testProp;
    public ClassForProp&\stdClass $testProp2;

    public $publicPropNonType;
    protected $protectedPropNonType;
    private $privatePropNonType;

    public mixed $publicPropMixed;
    protected mixed $protectedPropMixed;
    private mixed $privatePropMixed;

    public string $publicPropString;
    protected string $protectedPropString;
    private string $privatePropString;

    public array $publicPropArray;
    protected array $protectedPropArray;
    private array $privatePropArray;

    public bool $publicPropBool;
    protected bool $protectedPropBool;
    private bool $privatePropBool;

    public int $publicPropInt;
    protected int $protectedPropInt;
    private int $privatePropInt;

    public float $publicPropFloat;
    protected float $protectedPropFloat;
    private float $privatePropFloat;

    public \stdClass $publicPropStdClass;
    protected \stdClass $protectedPropStdClass;
    private \stdClass $privatePropStdClass;

    public ClassForProp $publicPropCustomClass;
    protected ClassForProp $protectedPropCustomClass;
    private ClassForProp $privatePropCustomClass;

    // ---------------------------------------------
    // Static
    // ---------------------------------------------

    static public $publicStaticPropNonType;
    static protected $protectedStaticPropNonType;
    static private $privateStaticPropNonType;

    static public mixed $publicStaticPropMixed;
    static protected mixed $protectedStaticPropMixed;
    static private mixed $privateStaticPropMixed;

    static public string $publicStaticPropString;
    static protected string $protectedStaticPropString;
    static private string $privateStaticPropString;

    static public array $publicStaticPropArray;
    static protected array $protectedStaticPropArray;
    static private array $privateStaticPropArray;

    static public bool $publicStaticPropBool;
    static protected bool $protectedStaticPropBool;
    static private bool $privateStaticPropBool;

    static public int $publicStaticPropInt;
    static protected int $protectedStaticPropInt;
    static private int $privateStaticPropInt;

    static public float $publicStaticPropFloat;
    static protected float $protectedStaticPropFloat;
    static private float $privateStaticPropFloat;

    static public \stdClass $publicStaticPropStdClass;
    static protected \stdClass $protectedStaticPropStdClass;
    static private \stdClass $privateStaticPropStdClass;

    static public ClassForProp $publicStaticPropCustomClass;
    static protected ClassForProp $protectedStaticPropCustomClass;
    static private ClassForProp $privateStaticPropCustomClass;

    // ---------------------------------------------
    // Non static
    // ---------------------------------------------

    function getClosureWithContext()
    {
        return function () {};
    }

    function publicMethod() {}
    protected function protectedMethod() {}
    private function privateMethod() {}

    // ---------------------------------------------
    // Static
    // ---------------------------------------------

    static function publicStaticMethod() {}
    protected static function protectedStaticMethod() {}
    private static function privateStaticMethod() {}
}
