<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\File;

/**
 * Get the contents of a file as serialize.
 * @todo tests
 * @author inilim
 * @param  mixed  $default
 * @return mixed
 * @phpstan-import-type TYPEExceptionV1 from \TypeFile
 * @throws TYPEExceptionV1
 */
function unserialize(
    string $pathToFile,
    array $options = [],
    bool $lock     = false,
    bool $throw    = false,
    $default       = null
) {
    if ($lock) {
        $data = \Inilim\Tool\Method\File\sharedGet($pathToFile, $throw);
    } else {
        $data = \Inilim\Tool\Method\File\get($pathToFile, 0, null, false, $throw);
    }

    /**
     * @var array{result:?string,exception:?\Throwable} $data
     */

    if ($data['exception']) {
        if ($throw) {
            throw $data['exception'];
        }
        return $default;
    }
    $data = $data['result'];
    /** @var string $data */

    if ($data === '') {
        return null;
    }
    if ($data === 'b:0;') {
        return false;
    }

    $errors = [];
    $undata = \Inilim\Tool\Method\Other\tryCallWithErrHandler(
        static function () use (&$data, &$options) {
            return \unserialize($data, $options);
        },
        // [Handle]
        static function ($type, $message, $file, $line) use (&$errors, $throw) {
            if ($throw) {
                $errors[] = [$message, $type, $file, $line];
            } else {
                $errors[] = null;
            }
        }
    );

    if ($errors) {
        if ($throw) {
            $e = \Inilim\Tool\Method\Obj\getCollectionThrowable();
            foreach ($errors as $err) {
                $e[] = new \ErrorException($err[0], $err[1], $err[1], $err[2], $err[3]);
            }
            throw $e;
        }
        return $default;
    }
    unset($data);

    if ($undata === null || $undata === false) {
        return $default;
    }

    return $undata;
}
