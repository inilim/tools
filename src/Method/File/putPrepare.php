<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\File;

/**
 * @build_skip
 * 
 * @todo tests
 * @author Inilim
 * analog function "file_put_contents"
 * @psalm-import-type TYPE_EXCEPTION_ITERATOR from \TypeFile
 * @see https://www.php.net/manual/ru/function.file-put-contents.php
 * 
 * @return object{ setFilename(): self, setData(): self }
 */
function putPrepare(): object
{
    return new class() {

        protected array $params = [];

        function setFilename(string $filename): self
        {
            $this->params['filename'] = $filename;
            return $this;
        }

        /**
         * @param mixed $data
         */
        function setData($data): self
        {
            $this->params['data'] = $data;
            return $this;
        }
    };
    // return \Inilim\Tool\Method\File\put(
    //     $params['filename'],
    //     $params['data'],
    //     $params['flags'] ?? 0,
    //     $params['throw'] ?? false,
    //     $params['context'] ?? null,
    //     $params['contextParams'] ?? null
    // );
}
