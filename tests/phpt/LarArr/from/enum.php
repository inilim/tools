<?php

use Inilim\Tool\LarArr;
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

Assert::same(['name' => 'A'], LarArr::from(TestEnum::A));
Assert::same(['name' => 'A', 'value' => 1], LarArr::from(TestBackedEnum::A));
Assert::same(['name' => 'A', 'value' => 'A'], LarArr::from(TestStringBackedEnum::A));
