<?php

use Inilim\Tool\Other;
use Inilim\Tool\Test\Assert;

// enum 8.1 and up

// TODO енамы нужно инклудить из php/8.1/enum.php

enum TestEnum
{
    case A;
}

enum TestBackedEnum: int
{
    case A = 1;
    case B = 2;
}

enum TestStringBackedEnum: string
{
    case A = 'A';
    case B = 'B';
}

Assert::same('enum', Other::getType(TestEnum::A));
Assert::same('enum', Other::getType(TestBackedEnum::A));
Assert::same('enum', Other::getType(TestBackedEnum::B));
Assert::same('enum', Other::getType(TestStringBackedEnum::A));
Assert::same('enum', Other::getType(TestStringBackedEnum::B));