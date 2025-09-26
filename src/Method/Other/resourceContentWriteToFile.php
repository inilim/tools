<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

/**
 * @author inilim
 * @todo tests
 * @param resource $resource
 */
function resourceContentWriteToFile($resource, string $pathToFile): ?string
{
    \Inilim\Tool\Method\Assert\resource($resource);

    return \Inilim\Tool\Method\Other\tryCallWithErrHandler(
        static function () use (&$resource, $pathToFile) {

            // Создаем временный файл
            $targetResource = \fopen($pathToFile, 'wb');
            if ($targetResource === false) {
                return null;
            }

            // Сохраняем текущую позицию
            $curPos = \ftell($resource);
            \rewind($resource);
            // Размер буфера для чтения/записи (например, 8 КБ)
            $bufferSize = 8192;
            while (true) {
                // Читаем порцию данных из исходного файла
                $data = \fread($resource, $bufferSize);
                if ($data === false) {
                    break;
                }

                // Записываем прочитанную порцию в целевой файл
                \fwrite($targetResource, $data);

                if (\feof($resource)) {
                    break;
                }
            }

            \fclose($targetResource);

            // Возвращаем позицию
            \fseek($resource, $curPos);

            return $pathToFile;
        },
        null
    );
}
