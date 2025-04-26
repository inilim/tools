<?php

namespace foo\bar\baz;

class ClassA
{
    public function getClassExplode()
    {
        $c = array_pop(explode('\\', get_class($this)));
        return $c;
    }

    public function getClassReflection()
    {
        $c = (new \ReflectionClass($this))->getShortName();
        return $c;
    }

    public function getClassBasename()
    {
        $c = basename(str_replace('\\', '/', get_class($this)));
        return $c;
    }

    public function getClassSubstring()
    {
        $classNameWithNamespace = get_class($this);
        return substr($classNameWithNamespace, strrpos($classNameWithNamespace, '\\') + 1);
    }
}

$a = new ClassA();
$num = 100000;

$rounds = 10;
$res = array(
    "Reflection" => array(),
    "Basename" => array(),
    "Explode" => array(),
    "Substring" => array()
);

for ($r = 0; $r < $rounds; $r++) {

    $start = microtime(true);
    for ($i = 0; $i < $num; $i++) {
        $a->getClassReflection();
    }
    $end = microtime(true);
    $res["Reflection"][] = ($end - $start);

    $start = microtime(true);
    for ($i = 0; $i < $num; $i++) {
        $a->getClassBasename();
    }
    $end = microtime(true);
    $res["Basename"][] = ($end - $start);

    $start = microtime(true);
    for ($i = 0; $i < $num; $i++) {
        $a->getClassExplode();
    }
    $end = microtime(true);
    $res["Explode"][] = ($end - $start);

    $start = microtime(true);
    for ($i = 0; $i < $num; $i++) {
        $a->getClassSubstring();
    }
    $end = microtime(true);
    $res["Substring"][] = ($end - $start);
}

echo "Reflection: " . array_sum($res["Reflection"]) / count($res["Reflection"]) . " s " . $a->getClassReflection() . "\n";
echo "Basename: " . array_sum($res["Basename"]) / count($res["Basename"]) . " s " . $a->getClassBasename() . "\n";
echo "Explode: " . array_sum($res["Explode"]) / count($res["Explode"]) . " s " . $a->getClassExplode() . "\n";
echo "Substring: " . array_sum($res["Substring"]) / count($res["Substring"]) . " s " . $a->getClassSubstring() . "\n";
