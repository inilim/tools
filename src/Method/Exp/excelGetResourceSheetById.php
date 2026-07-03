<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp;

/**
 * @author inilim
 * @todo tests
 * @psalm-import-type ZipStatItem from \TypeZip
 * @ext zip
 * @param string|\ZipArchive $pathToFileOrZip
 * @param string $sheetId id find from Exp::excelGetSheetsInfo()
 * @return null|resource
 */
function excelGetResourceSheetById($pathToFileOrZip, string $sheetId)
{
    $zip = \Inilim\Tool\Method\Zip\getObjFrom($pathToFileOrZip);
    if ($zip === null) {
        return null;
    }
    $anonObj = new class($zip, $sheetId) {
        var \ZipArchive $zip;
        var string $id;
        var string $zipPathToFile;

        function __construct(\ZipArchive $zip, string $id)
        {
            $this->id = $id;
            $this->zip = $zip;
            $this->zipPathToFile = \Inilim\Tool\Method\Path\normalize($zip->filename);
        }

        /**
         * @return null|resource
         */
        function __invoke()
        {
            $resourceWorkbookRels = $this->findWorkbookRels();
            if ($resourceWorkbookRels === null) {
                return null;
            }

            $xml = $this->resToXmlString($resourceWorkbookRels);
            unset($resourceWorkbookRels);
            if ($xml === null) {
                return null;
            }

            $fileNameSheet = $this->findSheetFromXmlString($xml);
            unset($xml);
            if ($fileNameSheet === null) {
                return null;
            }

            return $this->findSheet($fileNameSheet);
        }

        /**
         * @return resource|null
         */
        function findWorkbookRels()
        {
            $find = \Inilim\Tool\Method\Zip\findFirstResourceByCallable($this->zip, static function ($stat) {
                // INFO workbook.xml.rels файл где хранятся имена файлов-таблиц внутри архива
                if (\strtolower(\basename($stat['name'])) === 'workbook.xml.rels') {
                    return true;
                }
            });

            if (!$find) {
                \Inilim\Tool\Method\Other\__setErrorLast(
                    -1,
                    'Not found file "workbook.xml.rels" from archive',
                    $this->zipPathToFile,
                    -1
                );
                return null;
            }

            return $find;
        }

        /**
         * @param resorce $res
         */
        function resToXmlString($res): ?string
        {
            // TODO может стоит всетаки не читать все, а сохранить во временный файл и загружать из файла
            $content = \stream_get_contents($res);
            \fclose($res);

            if (!\is_string($content)) {
                \Inilim\Tool\Method\Other\__setErrorLast(
                    -1,
                    'stream_get_contents() failed',
                    $this->zipPathToFile,
                    -1
                );
                return null;
            }

            return $content;
        }

        function findSheetFromXmlString(string $xml): ?string
        {
            // <Relationship Id="rId11" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/worksheet" Target="worksheets/sheet5.xml"/>

            // Id="rId11" — ищет точное совпадение нужного идентификатора.
            // [^>]* — пропускает любые символы до следующего атрибута, кроме > (чтобы оставаться в пределах одного тега).
            // Target=" — находит начало искомого атрибута.
            // ([^"]*) — захватывающая группа, которая извлечёт значение атрибута Target (все символы до следующей кавычки). Это значение можно получить из первой группы совпадения.
            // Флаг i делает поиск нечувствительным к регистру.

            // `<Relationship Id="rId11" Type="..." Target="worksheets/sheet5.xml"/>`
            // `<Relationship Target="worksheets/sheet5.xml" Type="..." Id="rId11"/>`

            // $xml = '<Relationship Target="worksheets/sheet5.xml" Type="..." Id="rId11"/><Relationship Target="worksheets/sheet5.xml" Type="..." Id="rId11"/><Relationship Target="worksheets/sheet5.xml" Type="..." Id="rId11"/>';
            $id = \preg_quote($this->id);
            // TODO регульрку можно написать и лучше
            $regex = \sprintf(
                '/' . // start
                    '<Relationship[^>]*Id="%s"[^>]*Target="([^"]*)"' .
                    '|' . // или
                    '<Relationship[^>]*Target="([^"]*)"[^>]*Id="%s"' .
                    '/i' // end
                ,
                $id,
                $id
            );
            // de($regex);
            // TODO ебаный preg_match_all результат
            \preg_match_all($regex, $xml, $match);
            // \de($match);
            $m = $match[1] ?? [];
            $m = \Inilim\Tool\Method\PF\array_filter($m);
            if (\sizeof($m) === 1) {
                return $m[0];
            }
            $m = $match[2] ?? [];
            $m = \Inilim\Tool\Method\PF\array_filter($m);
            if (\sizeof($m) === 1) {
                return $m[0];
            }
            \Inilim\Tool\Method\Other\__setErrorLast(
                -1,
                \sprintf('Not found "%s" from file "workbook.xml.rels"', $id),
                $this->zipPathToFile,
                -1
            );
            return null;
        }

        /**
         * @return resource|null
         */
        function findSheet(string $fileNameSheet)
        {
            $fileNameSheet = \Inilim\Tool\Method\Path\normalize($fileNameSheet);

            $find = \Inilim\Tool\Method\Zip\findFirstResourceByCallable($this->zip, static function ($stat) use ($fileNameSheet) {
                // TODO регистр?
                $name = \Inilim\Tool\Method\Path\normalize($stat['name']);
                if (\Inilim\Tool\Method\PF\str_ends_with($name, $fileNameSheet)) {
                    return true;
                }
            });

            if (!$find) {
                \Inilim\Tool\Method\Other\__setErrorLast(
                    -1,
                    \sprintf('Zip::findFirstResourceByCallable() file "%s" not found', $fileNameSheet),
                    $this->zipPathToFile,
                    -1
                );
                return null;
            }

            return $find;
        }
    };

    return \Inilim\Tool\Method\Other\tryCallWithErrHandler(
        static fn() => $anonObj->__invoke(),
        null
    );
}
