<?php

namespace Inilim\Tool\Test\Method\FS;

use Inilim\Tool\FS;
use Inilim\Tool\File;
use org\bovigo\vfs\vfsStream;
use Inilim\Tool\Test\TestCase;

/**
 * by deepseec
 */
class isFileTest extends TestCase
{
    function test()
    {
        // Создаем структуру каталогов и файлов
        $structure = [
            'existing_file.txt' => 'content',
            'subdir' => [
                'nested_file.txt' => 'nested content'
            ]
        ];

        $root = vfsStream::setup('root', null, $structure);

        $file = vfsStream::url('root/existing_file.txt');
        $this->assertTrue(FS::isFile($file));
        \unlink($file);
        $this->assertFalse(FS::isFile($file));
        $this->assertTrue(FS::isFile(vfsStream::url('root/subdir/nested_file.txt')));
        $this->assertFalse(FS::isFile(vfsStream::url('root/nonexistent_file.txt')));
        $this->assertFalse(FS::isFile(vfsStream::url('root/subdir')));
    }

    function testIsFileBasicFunctionality()
    {
        // Создаем структуру с различными типами файлов
        $structure = [
            'text_file.txt' => 'text content',
            'empty_file.txt' => '',
            'binary_file.jpg' => 'binary data here',
            'subdirectory' => [
                'nested_file.php' => '<?php echo "Hello";',
                'config.json' => '{"key": "value"}'
            ],
            'empty_dir' => []
        ];

        $root = vfsStream::setup('root', null, $structure);

        // Тестируем существующие файлы
        $this->assertTrue(FS::isFile(vfsStream::url('root/text_file.txt')));
        $this->assertTrue(FS::isFile(vfsStream::url('root/empty_file.txt')));
        $this->assertTrue(FS::isFile(vfsStream::url('root/binary_file.jpg')));
        $this->assertTrue(FS::isFile(vfsStream::url('root/subdirectory/nested_file.php')));
        $this->assertTrue(FS::isFile(vfsStream::url('root/subdirectory/config.json')));

        // Тестируем НЕ файлы
        $this->assertFalse(FS::isFile(vfsStream::url('root/subdirectory'))); // Это директория
        $this->assertFalse(FS::isFile(vfsStream::url('root/empty_dir'))); // Это директория
        $this->assertFalse(FS::isFile(vfsStream::url('root/nonexistent_file.txt'))); // Не существует
        $this->assertFalse(FS::isFile(vfsStream::url('root'))); // Корневая директория
    }

    function testIsFileWithDeletedFile()
    {
        // Создаем файлы для последующего удаления
        $structure = [
            'temporary_file.tmp' => 'temporary content',
            'log_file.log' => 'log entries',
            'cache_file.cache' => 'cached data'
        ];

        $root = vfsStream::setup('root', null, $structure);

        $tempFile = vfsStream::url('root/temporary_file.tmp');
        $logFile = vfsStream::url('root/log_file.log');
        $cacheFile = vfsStream::url('root/cache_file.cache');

        // Проверяем исходное состояние
        $this->assertTrue(FS::isFile($tempFile));
        $this->assertTrue(FS::isFile($logFile));
        $this->assertTrue(FS::isFile($cacheFile));

        // Удаляем один файл
        \unlink($tempFile);

        // Проверяем состояние после удаления
        $this->assertFalse(FS::isFile($tempFile), 'Файл должен быть удален');
        $this->assertTrue(FS::isFile($logFile), 'Лог файл должен остаться');
        $this->assertTrue(FS::isFile($cacheFile), 'Кеш файл должен остаться');

        // Удаляем все оставшиеся файлы
        \unlink($logFile);
        \unlink($cacheFile);

        $this->assertFalse(FS::isFile($logFile));
        $this->assertFalse(FS::isFile($cacheFile));
    }

    function testIsFileWithConcurrentDeletionScenario()
    {
        // Тестируем сценарий "гонки" при удалении файлов
        $root = vfsStream::setup('temp', null, [
            'session_data.sess' => 'session content',
            'uploaded_file.dat' => 'upload content'
        ]);

        $sessionFile = vfsStream::url('temp/session_data.sess');
        $uploadedFile = vfsStream::url('temp/uploaded_file.dat');

        // Симулируем многократные проверки с удалением между ними
        $checks = [];

        // Первая проверка - оба файла существуют
        $checks['initial_both_exist'] = [
            'session' => FS::isFile($sessionFile),
            'upload' => FS::isFile($uploadedFile)
        ];

        // Удаляем первый файл
        \unlink($sessionFile);

        // Вторая проверка после удаления
        $checks['after_first_deletion'] = [
            'session' => FS::isFile($sessionFile),
            'upload' => FS::isFile($uploadedFile)
        ];

        // Удаляем второй файл
        \unlink($uploadedFile);

        // Финальная проверка
        $checks['after_both_deleted'] = [
            'session' => FS::isFile($sessionFile),
            'upload' => FS::isFile($uploadedFile)
        ];

        $this->assertTrue($checks['initial_both_exist']['session']);
        $this->assertTrue($checks['initial_both_exist']['upload']);

        $this->assertFalse($checks['after_first_deletion']['session']);
        $this->assertTrue($checks['after_first_deletion']['upload']);

        $this->assertFalse($checks['after_both_deleted']['session']);
        $this->assertFalse($checks['after_both_deleted']['upload']);
    }

    function testIsFileAfterMultipleCreateDeleteCycles()
    {
        // Тестируем многократное создание и удаление файлов
        $root = vfsStream::setup('cache');

        $cacheFile = vfsStream::url('cache/data.cache');

        // Цикл 1: Создание → Проверка → Удаление
        \file_put_contents($cacheFile, 'cycle 1 data');
        $cycle1Check = FS::isFile($cacheFile);
        \unlink($cacheFile);
        $cycle1AfterDelete = FS::isFile($cacheFile);

        // Цикл 2: Повторное создание → Проверка → Удаление
        \file_put_contents($cacheFile, 'cycle 2 data');
        $cycle2Check = FS::isFile($cacheFile);
        \unlink($cacheFile);
        $cycle2AfterDelete = FS::isFile($cacheFile);

        // Цикл 3: Еще раз
        \file_put_contents($cacheFile, 'cycle 3 data');
        $cycle3Check = FS::isFile($cacheFile);
        \unlink($cacheFile);
        $cycle3AfterDelete = FS::isFile($cacheFile);

        $this->assertTrue($cycle1Check);
        $this->assertFalse($cycle1AfterDelete);

        $this->assertTrue($cycle2Check);
        $this->assertFalse($cycle2AfterDelete);

        $this->assertTrue($cycle3Check);
        $this->assertFalse($cycle3AfterDelete);
    }

    function testIsFileWithStatCacheClear()
    {
        // Подробное тестирование очистки кеша stat
        $root = vfsStream::setup('system', null, [
            'config.ini' => 'key=value'
        ]);

        $configFile = vfsStream::url('system/config.ini');

        // Заполняем кеш многократными вызовами
        $checksBeforeDeletion = [];
        for ($i = 0; $i < 5; $i++) {
            $checksBeforeDeletion[] = FS::isFile($configFile);
            \filemtime($configFile); // Другая stat функция для заполнения кеша
            \filesize($configFile);
        }

        // Удаляем файл
        \unlink($configFile);

        // Проверяем без очистки кеша
        $checksWithoutClear = [];
        for ($i = 0; $i < 3; $i++) {
            $checksWithoutClear[] = FS::isFile($configFile);
        }

        // Очищаем кеш полностью
        \clearstatcache();

        // Проверяем после очистки кеша
        $checksAfterClear = FS::isFile($configFile);

        // Очищаем кеш для конкретного файла
        \clearstatcache(true, $configFile);
        $checksAfterSpecificClear = FS::isFile($configFile);

        // Все проверки до удаления должны быть true
        foreach ($checksBeforeDeletion as $check) {
            $this->assertTrue($check);
        }

        // Все проверки без очистки кеша должны быть false
        foreach ($checksWithoutClear as $check) {
            $this->assertFalse($check);
        }

        $this->assertFalse($checksAfterClear);
        $this->assertFalse($checksAfterSpecificClear);
    }

    function testIsFileOnDeletedParentDirectory()
    {
        // Тестируем файлы в удаленных директориях
        $structure = [
            'temp_files' => [
                'upload1.jpg' => 'image data',
                'upload2.jpg' => 'image data',
                'metadata.json' => '{"status": "processing"}'
            ],
            'persistent' => [
                'config.php' => '<?php config();'
            ]
        ];

        $root = vfsStream::setup('storage', null, $structure);

        $upload1 = vfsStream::url('storage/temp_files/upload1.jpg');
        $upload2 = vfsStream::url('storage/temp_files/upload2.jpg');
        $metadata = vfsStream::url('storage/temp_files/metadata.json');
        $config = vfsStream::url('storage/persistent/config.php');

        // Проверяем исходное состояние
        $this->assertTrue(FS::isFile($upload1));
        $this->assertTrue(FS::isFile($upload2));
        $this->assertTrue(FS::isFile($metadata));
        $this->assertTrue(FS::isFile($config));

        // Удаляем родительскую директорию со всеми файлами
        $root->removeChild('temp_files');

        // Проверяем, что файлы в удаленной директории больше не определяются как файлы
        $this->assertFalse(FS::isFile($upload1));
        $this->assertFalse(FS::isFile($upload2));
        $this->assertFalse(FS::isFile($metadata));
        $this->assertTrue(FS::isFile($config)); // Файл в другой директории должен остаться
    }

    function testIsFileWithDifferentFileStates()
    {
        // Тестируем различные состояния файлов
        $root = vfsStream::setup('workspace');

        $filePath = vfsStream::url('workspace/test.file');

        // Файл не существует
        $state1 = FS::isFile($filePath);

        // Создаем файл
        \file_put_contents($filePath, 'content');
        $state2 = FS::isFile($filePath);

        // Переименовываем файл
        $newPath = vfsStream::url('workspace/renamed.file');
        \rename($filePath, $newPath);
        $state3 = FS::isFile($filePath);
        $state4 = FS::isFile($newPath);

        // Удаляем переименованный файл
        \unlink($newPath);
        $state5 = FS::isFile($newPath);

        $this->assertFalse($state1, 'Несуществующий файл');
        $this->assertTrue($state2, 'Созданный файл');
        $this->assertFalse($state3, 'Исходное имя после переименования');
        $this->assertTrue($state4, 'Новое имя после переименования');
        $this->assertFalse($state5, 'Удаленный переименованный файл');
    }

    function testIsFileInRealWorldApplication()
    {
        // Реальный сценарий: обработка загруженных файлов
        $root = vfsStream::setup('uploads', null, [
            'user_123' => [
                'avatar.jpg' => 'binary image data',
                'document.pdf' => 'pdf content',
                'temp' => [
                    'processing.tmp' => 'temporary data'
                ]
            ]
        ]);

        $avatarFile = vfsStream::url('uploads/user_123/avatar.jpg');
        $documentFile = vfsStream::url('uploads/user_123/document.pdf');
        $tempFile = vfsStream::url('uploads/user_123/temp/processing.tmp');

        // Функция валидации загруженных файлов
        $validateUploadedFile = function ($filePath) {
            if (!FS::isFile($filePath)) {
                return ['valid' => false, 'error' => 'File does not exist'];
            }

            $size = \filesize($filePath);
            if ($size === 0) {
                return ['valid' => false, 'error' => 'File is empty'];
            }

            if ($size > 10 * 1024 * 1024) { // 10MB
                return ['valid' => false, 'error' => 'File too large'];
            }

            return ['valid' => true, 'size' => $size];
        };

        // Валидация существующих файлов
        $avatarValidation = $validateUploadedFile($avatarFile);
        $documentValidation = $validateUploadedFile($documentFile);

        $this->assertTrue($avatarValidation['valid']);
        $this->assertTrue($documentValidation['valid']);

        // Удаляем файл и пробуем провалидировать
        \unlink($avatarFile);
        $deletedValidation = $validateUploadedFile($avatarFile);

        $this->assertFalse($deletedValidation['valid']);
        $this->assertEquals('File does not exist', $deletedValidation['error']);
    }

    function testIsFileWithErrorHandling()
    {
        // Тестируем обработку ошибок при работе с файлами
        $root = vfsStream::setup('app');

        $configFile = vfsStream::url('app/config.php');
        $logFile = vfsStream::url('app/debug.log');

        // Функция безопасного чтения файла
        $safeFileRead = function ($path) {
            // Многократная проверка с обработкой возможного удаления
            if (!FS::isFile($path)) {
                throw new \RuntimeException("File not accessible: $path");
            }

            $content = \file_get_contents($path);

            // Проверяем снова после чтения
            if (!FS::isFile($path)) {
                throw new \RuntimeException("File was deleted during read: $path");
            }

            return $content;
        };

        // Создаем файл и успешно читаем
        \file_put_contents($configFile, '<?php return [];');
        $content = $safeFileRead($configFile);
        $this->assertEquals('<?php return [];', $content);

        // Удаляем файл и пытаемся прочитать
        \unlink($configFile);

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('File not accessible');
        $safeFileRead($configFile);
    }

    function testIsFilePerformanceWithMultipleChecks()
    {
        // Тестируем производительность множественных проверок
        $root = vfsStream::setup('performance');

        $testFile = vfsStream::url('performance/test.dat');
        \file_put_contents($testFile, 'performance test data');

        $iterations = 1000;
        $startTime = \microtime(true);

        for ($i = 0; $i < $iterations; $i++) {
            FS::isFile($testFile);
        }

        $endTime = \microtime(true);
        $executionTime = $endTime - $startTime;

        // Проверяем что все вызовы вернули true
        $this->assertTrue(FS::isFile($testFile));

        // Удаляем и проверяем снова
        \unlink($testFile);

        $falseChecks = 0;
        for ($i = 0; $i < 100; $i++) {
            if (!FS::isFile($testFile)) {
                $falseChecks++;
            }
        }

        $this->assertEquals(100, $falseChecks);
    }
}
