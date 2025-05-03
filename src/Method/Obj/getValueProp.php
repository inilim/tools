<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Obj;

/**
 * @todo test
 * @skip_build
 * @author Inilim
 * @param mixed $default
 * @return mixed
 * @throws \Throwable
 */
function getValueProp(string $nameProp, object $obj, $default = null, bool $throw = false)
{
    $fn = function ($name, $temp) {
        /**
         * @var string $name
         * @var string $temp
         */
        if (!\property_exists($this, $name)) {
            return $temp;
        }
        try {
            return $this::$$name;
        } catch (\Error $e) {
        }
        return $this->$name;
    };

    try {
        // Cannot bind closure to scope of internal class Reflection
        $fn = $fn->bindTo($obj, $obj);
    } catch (\Throwable $e) {
        if ($throw) {
            throw $e;
        } else {
            return $default;
        }
    }

    if ($fn === null) {
        return $default;
    }

    $temp = \md5($nameProp);
    try {
        $result = $fn($nameProp, $temp);
    } catch (\Throwable $e) {
        if ($throw) {
            throw $e;
        } else {
            return $default;
        }
    }

    if ($result === $temp) {
        if ($throw) {
            throw new \Exception(\sprintf('Property "%s" undefined', $nameProp));
        } else {
            return $default;
        }
    }

    return $result;
}
