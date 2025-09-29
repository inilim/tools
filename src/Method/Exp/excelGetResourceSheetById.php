<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp;

use function Inilim\Tool\Method\Zip\findFirstResourceByCallable;

/**
 * @author inilim
 * @todo tests
 * @psalm-import-type ZipStatItem from \TypeZip
 * @ext zip dom
 * @param string|\ZipArchive $pathToFileOrZip
 * @param string $id id find from Exp::excelGetSheetsInfo()
 * @return null|resource
 */
function excelGetResourceSheetById($pathToFileOrZip, string $id)
{
    // TODO тут можно убрать зависимость dom, используя regex
    \Inilim\Tool\Method\Assert\extPhp('dom');

    $anonObj = new class(
        \Inilim\Tool\Method\Zip\getObjFrom($pathToFileOrZip),
        $id
    ) {
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

            $docWorkbookRels = $this->resToXml($resourceWorkbookRels);
            unset($resourceWorkbookRels);
            if ($docWorkbookRels === null) {
                return null;
            }

            $fileNameSheet = $this->findSheetFromXml($docWorkbookRels);
            unset($docWorkbookRels);
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
                // TODO регистр?
                if (\basename($stat['name']) === 'workbook.xml.rels') {
                    return true;
                }
            });

            if (!$find) {
                \Inilim\Tool\Method\Other\__setErrorLast(
                    -1,
                    'Not found "workbook.xml.rels" from archive',
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
        function resToXml($res): ?\DOMDocument
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

            $docRelWorkbook = new \DOMDocument();
            if ($docRelWorkbook->loadXML($content) !== true) {
                \Inilim\Tool\Method\Other\__setErrorLast(
                    -1,
                    'DOMDocument()->loadXML() failed',
                    $this->zipPathToFile,
                    -1
                );
                return null;
            }

            return $docRelWorkbook;
        }

        function findSheetFromXml(\DOMDocument $doc): ?string
        {
            ['list' => $search] = \Inilim\Tool\Method\Xml\xpathQueryFromDoc(
                $doc,
                '//*[local-name()="Relationship"][@Id="' . $this->id . '"]'
            );
            if ($search === null) {
                return null;
            }

            // INFO DOMNodeList()->getIterator() php 8.0
            if ($search->count() !== 1) {
                return null;
            }

            $search = $search->item(0);
            /** @var \DOMNode|\DOMNameSpaceNode $search */

            return $search->attributes->getNamedItem('Target')->value;
        }

        /**
         * @return resource|null
         */
        function findSheet(string $fileNameSheet)
        {
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
                    \sprintf('Zip::findFirstResourceByCallable() find file "%s" failed', $fileNameSheet),
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
