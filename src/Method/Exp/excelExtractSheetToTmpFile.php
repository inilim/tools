<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp;

/**
 * @author inilim
 * @todo tests
 * @ext zip
 * @param string|\ZipArchive $pathToFileOrZip
 * @return null|array
 */
function excelExtractSheetToTmpFile($pathToFileOrZip, string $sheetId): ?array
{
    $anonObj = new class(
        \Inilim\Tool\Method\Zip\getObjFrom($pathToFileOrZip),
        $sheetId,
    ) {
        var \ZipArchive $zip;
        var string $id;
        var string $zipPathToFile;
        var string $zipHashPathToFile;
        var ?string $zipHashFile;
        var string $fileInfo;
        var int $countCreateTmpFiles = 0;
        var int $createInfoFile = 0;
        var int $refresh = 0;

        function __construct(
            \ZipArchive $zip,
            string $id
        ) {
            $this->id                = $id;
            $this->zip               = $zip;
            $this->zipPathToFile     = \Inilim\Tool\Method\Path\normalize($zip->filename);
            $this->zipHashPathToFile = \md5($this->zipPathToFile);
        }

        function __invoke(): ?array
        {
            $resourceSheet = \Inilim\Tool\Method\Exp\excelGetResourceSheetById($this->zip, $this->id);
            if ($resourceSheet === null) {
                return null;
            }
            /** @var resource $resourceSheet */

            // ---------------------------------------------
            // sharedStrings.xml
            // ---------------------------------------------

            $resourceSharedStrings = $this->findSharedStrings();
            if ($resourceSharedStrings === null) {
                return null;
            }

            // ---------------------------------------------
            // создаем информационный файл
            // TODO нужно что-то придумать получше
            // ---------------------------------------------

            $fileInfo = \Inilim\Tool\Method\Path\normalize(\sys_get_temp_dir() . '/inilim-tools-excel-' . $this->zipHashPathToFile . '.tmp');
            $this->fileInfo = $fileInfo;
            // TODO большие файлы это долго
            $this->zipHashFile = \md5_file($this->zipPathToFile);
            $countStartCreateInfo = 0;
            startCreateInfo:
            $countStartCreateInfo++;

            if ($countStartCreateInfo > 2) {
                $this->setErr('todo loop');
                return null;
            }

            if (\Inilim\Tool\Method\FS\isFile($fileInfo)) {
                // old
                $aInfo = \Inilim\Tool\Method\File\json($fileInfo);
                if (!\is_array($aInfo)) {
                    \Inilim\Tool\Method\Exp\excelRemoveTmpFiles($this->zip);
                    goto startCreateInfo;
                }
                $changedXml = $this->changedExcelFile($aInfo);
            } else {
                // new
                $this->createInfoFile = 1;
                $aInfo = [];
                $this->addToInfo($aInfo, 'zip', [
                    'file_name'         => \basename($this->zipPathToFile),
                    'path_to_file'      => $this->zipPathToFile,
                    'hash_path_to_file' => $this->zipHashPathToFile,
                    'hash_file'         => $this->zipHashFile,
                ]);
                $changedXml = false;
            }

            // ---------------------------------------------
            //
            // ---------------------------------------------

            if ($changedXml) {
                unset($aInfo);
                \Inilim\Tool\Method\Exp\excelRemoveTmpFiles($this->zip);
                $this->refresh = 1;
                goto startCreateInfo;
            }

            // ---------------------------------------------
            // переносим ресурсы в временный файл
            // ---------------------------------------------

            $pathToFileSheet = $this->saveResourceAndInfo($resourceSheet, $aInfo);
            \fclose($resourceSheet);
            if ($pathToFileSheet === null) {
                return null;
            }
            unset($resourceSheet);
            // 
            $pathToFileShared = $this->saveResourceAndInfo($resourceSharedStrings, $aInfo);
            \fclose($resourceSharedStrings);
            if ($pathToFileShared === null) {
                return null;
            }
            unset($resourceSharedStrings);

            $status = \Inilim\Tool\Method\File\put($fileInfo, \json_encode($aInfo));
            if ($status['exception']) {
                $this->setErr('Не удалось сохранить инфо файл');
                return null;
            }

            unset(
                $fileInfo,
                $aInfo,
                $countStartCreateInfo,
                $changedXml
            );

            // ---------------------------------------------
            // 
            // ---------------------------------------------

            $this->countCreateTmpFiles += $this->createInfoFile;

            return [
                'info' => [
                    'excel_file'            => $this->zipPathToFile,
                    'refresh'               => $this->refresh,
                    'file_info'             => $this->fileInfo,
                    'create_file_info'      => $this->createInfoFile,
                    'count_create_tmp_file' => $this->countCreateTmpFiles,
                ],
                'sheet' => [
                    'id'   => $this->id,
                    'file' => $pathToFileSheet,
                ],
                'shared_strings' => [
                    'file' => $pathToFileShared,
                ]
            ];
        }

        /**
         * @param mixed[] $aInfo
         * @param resource $res
         */
        function saveResourceAndInfo($res, array &$aInfo): ?string
        {
            $file = \stream_get_meta_data($res)['uri'];
            $file = \Inilim\Tool\Method\Path\normalize($file);
            $hash = \md5($file);
            // INFO ищем файл в инфо
            $pathToFileTmp = $this->findFileFromInfo($aInfo, $hash);
            // INFO создаем файл если он не был найден ИЛИ если были изменения в файле excel
            if ($pathToFileTmp === null || !\Inilim\Tool\Method\FS\isFile($pathToFileTmp)) {
                // TODO что если в инфо файла нету, а временный файл есть?
                // \tmpfile();
                $pathToFileTmp = \sys_get_temp_dir() . '/inilim-tools-excel-' . $this->zipHashPathToFile . '-' . $hash . '.tmp';
                // INFO переносим ресурс в временный файл
                if (!$this->resourceToFile($res, $pathToFileTmp)) {
                    return null;
                }
                $this->countCreateTmpFiles++;
                // INFO добавляем файл в инфо
                $this->addToInfo($aInfo, 'item', [
                    'path_to_file'      => $pathToFileTmp,
                    'hash_path_to_file' => $hash,
                ]);
            }

            return $pathToFileTmp;
        }

        /**
         * @param mixed[] $aInfo
         */
        function changedExcelFile(array &$aInfo): bool
        {
            return \Inilim\Tool\Method\Arr\dataGet($aInfo, 'zip.{first}.hash_file') !== $this->zipHashFile;
        }

        /**
         * @return resource|null
         */
        function findSharedStrings()
        {
            // TODO может есть excel файлы в котором нету sharedStrings.xml?
            $find = \Inilim\Tool\Method\Zip\findFirstResourceByCallable($this->zip, static function ($stat) {
                // TODO регистр?
                if (\basename($stat['name']) === 'sharedStrings.xml') {
                    return true;
                }
            });

            if (!$find) {
                $this->setErr('Not found "sharedStrings.xml" from archive');
                return null;
            }

            return $find;
        }

        /**
         * @param mixed[] $aInfo
         */
        function findFileFromInfo(array &$aInfo, string $fileHash): ?string
        {
            foreach (($aInfo['item'] ?? []) as $item) {
                if (($item['hash_path_to_file'] ?? null) === $fileHash) {
                    return $item['path_to_file'] ?? null;
                }
            }
            return null;
        }

        /**
         * @param resource $resource
         */
        function resourceToFile($resource, string $pathToFile): bool
        {
            if (!\Inilim\Tool\Method\Other\resourceContentWriteToFile($resource, $pathToFile)) {
                $this->setErr('Не удалось перевести ресурс в файл "%s"', $pathToFile);
                return false;
            }
            return true;
        }

        function setErr(string $format, ...$values)
        {
            \Inilim\Tool\Method\Other\__setErrorLast(
                -1,
                \sprintf($format, ...$values),
                $this->zipPathToFile,
                -1
            );
        }
        /**
         * @param mixed[] $aInfo
         * @param array<string,string> $attrs
         */
        function addToInfo(array &$aInfo, string $nameEl, array $attrs = [])
        {
            $aInfo[$nameEl] ??= [];
            $t = [];
            foreach ($attrs as $name => $value) {
                $t[$name] = $value;
            }

            $aInfo[$nameEl][] = $t;
        }
    };

    return \Inilim\Tool\Method\Other\tryCallWithErrHandler(
        static fn() => $anonObj->__invoke(),
        static function () {
            de(func_get_args());
        }
    );
}
