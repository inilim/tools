<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

/**
 * @author inilim
 * @todo tests
 * @param resource $resource
 * @param string $pathToFile file overwrite
 */
function resourceContentWriteToFile($resource, string $pathToFile): ?string
{
    \Inilim\Tool\Method\Assert\resource($resource);

    return \Inilim\Tool\Method\Other\tryCallWithErrHandler(
        static function () use (&$resource, $pathToFile) {

            $targetResource = \fopen($pathToFile, 'wb');
            if ($targetResource === false) {
                \Inilim\Tool\Method\Other\__setErrorLast(
                    -1,
                    \sprintf('fopen("%s") failed', $pathToFile),
                    '',
                    -1
                );
                return null;
            }

            // Сохраняем текущую позицию
            $curPos = \ftell($resource);
            \rewind($resource);
            while (true) {
                // Читаем порцию данных из исходного файла
                // Размер буфера для чтения/записи (например, 8 КБ)
                $data = \fread($resource, 8192);
                if ($data === false) {
                    \Inilim\Tool\Method\Other\__setErrorLast(
                        -1,
                        'fread(arg#0) failed',
                        '',
                        -1
                    );
                    break;
                }

                // Записываем прочитанную порцию в целевой файл
                if (\fwrite($targetResource, $data) === false) {
                    \Inilim\Tool\Method\Other\__setErrorLast(
                        -1,
                        \sprintf('fwrite("%s") failed', $pathToFile),
                        '',
                        -1
                    );
                    break;
                }

                if (\feof($resource)) {
                    break;
                }
            } // endwhile

            \fclose($targetResource);

            // Возвращаем позицию
            // TODO указатель вообще меняется внутри функциях?
            \fseek($resource, $curPos);

            return $pathToFile;
        },
        null
    );
}
