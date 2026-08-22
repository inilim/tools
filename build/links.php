<?php


$clasess = [
    \Inilim\Tool\File::class,
    \Inilim\Tool\Path::class,
    \Inilim\Tool\Arr::class,
    \Inilim\Tool\Integer::class,
    \Inilim\Tool\Double::class,
    \Inilim\Tool\Data::class,
    \Inilim\Tool\Str::class,
    \Inilim\Tool\Other::class,
    \Inilim\Tool\Json::class,
    \Inilim\Tool\FS::class,
    \Inilim\Tool\Zip::class,
    \Inilim\Tool\Refl::class,
    \Inilim\Tool\ID::class,
    \Inilim\Tool\Time::class,
    \Inilim\Tool\Obj::class,
    \Inilim\Tool\Assert::class,
    \Inilim\Tool\Exp::class,
    \Inilim\Tool\Enum::class,
    \Inilim\Tool\VD::class,
    \Inilim\Tool\Check::class,
    \Inilim\Tool\PF::class,
    \Inilim\Tool\Xml::class,
    \Inilim\Tool\Sql::class,
    \Inilim\Tool\LarArr::class,
    \Inilim\Tool\Lar::class,
    \Inilim\Tool\LarStr::class,
    \Inilim\Tool\LarExp::class,
];
$array = [];
$root = \dirname(__DIR__);

foreach ($clasess as $class) {
    $nameClass = \basename($class);

    $array[] = [
        'method'      => \sprintf('Inilim\Tool\Method\%s', $nameClass),
        'tool'        => $class,
        'nameClass'   => $nameClass,
        'path'        => \sprintf('%s/src/Method/%s', $root, $nameClass),
        'pathMin'     => \sprintf('%s/src/MethodMin/%s', $root, $nameClass),
        'pathToClass' => \sprintf('%s/src/%s', $root, $nameClass),
    ];
}

return $array;
