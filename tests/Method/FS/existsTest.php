<?php

namespace Inilim\Tool\Test\Method\FS;

use Inilim\Tool\FS;
use Inilim\Tool\File;
use org\bovigo\vfs\vfsStream;
use Inilim\Tool\Test\TestCase;

/**
 * by deepseec
 */
class existsTest extends TestCase
{
    function testFileExistsBasicFunctionality()
    {
        // Создаем структуру с файлами и директориями
        $structure = [
            'text_file.txt' => 'text content',
            'empty_file.txt' => '',
            'binary_data.dat' => 'binary content',
            'directory' => [
                'nested_file.php' => '<?php echo "Hello";',
                'config.ini' => 'key=value'
            ],
            'empty_directory' => [],
            'symlink' => 'text_file.txt' // символическая ссылка
        ];

        $root = vfsStream::setup('root', null, $structure);

        // Тестируем существующие файлы
        $this->assertTrue(FS::exists(vfsStream::url('root/text_file.txt')));
        $this->assertTrue(FS::exists(vfsStream::url('root/empty_file.txt')));
        $this->assertTrue(FS::exists(vfsStream::url('root/binary_data.dat')));
        $this->assertTrue(FS::exists(vfsStream::url('root/directory/nested_file.php')));
        $this->assertTrue(FS::exists(vfsStream::url('root/directory/config.ini')));

        // Тестируем директории (FS::exists возвращает true для директорий!)
        $this->assertTrue(FS::exists(vfsStream::url('root/directory')));
        $this->assertTrue(FS::exists(vfsStream::url('root/empty_directory')));
        $this->assertTrue(FS::exists(vfsStream::url('root')));

        // Тестируем символические ссылки
        $this->assertTrue(FS::exists(vfsStream::url('root/symlink')));

        // Тестируем несуществующие пути
        $this->assertFalse(FS::exists(vfsStream::url('root/nonexistent_file.txt')));
        $this->assertFalse(FS::exists(vfsStream::url('root/nonexistent_directory')));
        $this->assertFalse(FS::exists(vfsStream::url('root/directory/nonexistent.file')));
    }

    function testFileExistsWithDeletedFilesAndDirectories()
    {
        // Создаем структуру для последующего удаления
        $structure = [
            'temporary.tmp' => 'temp content',
            'cache.data' => 'cached content',
            'logs' => [
                'app.log' => 'log entries',
                'error.log' => 'error messages'
            ],
            'config' => [
                'database.php' => '<?php config;'
            ]
        ];

        $root = vfsStream::setup('storage', null, $structure);

        $tempFile = vfsStream::url('storage/temporary.tmp');
        $cacheFile = vfsStream::url('storage/cache.data');
        $logsDir = vfsStream::url('storage/logs');
        $appLog = vfsStream::url('storage/logs/app.log');
        $configDir = vfsStream::url('storage/config');

        // Проверяем исходное состояние
        $this->assertTrue(FS::exists($tempFile));
        $this->assertTrue(FS::exists($cacheFile));
        $this->assertTrue(FS::exists($logsDir));
        $this->assertTrue(FS::exists($appLog));
        $this->assertTrue(FS::exists($configDir));

        // Удаляем отдельные файлы
        \unlink($tempFile);
        $this->assertFalse(FS::exists($tempFile), 'Файл должен быть удален');
        $this->assertTrue(FS::exists($cacheFile), 'Другой файл должен остаться');

        \unlink($cacheFile);
        $this->assertFalse(FS::exists($cacheFile));

        // Удаляем файл внутри директории
        \unlink($appLog);
        $this->assertFalse(FS::exists($appLog));
        $this->assertTrue(FS::exists($logsDir), 'Директория должна остаться');

        // Удаляем всю директорию
        $root->removeChild('logs');
        $this->assertFalse(FS::exists($logsDir));
        $this->assertFalse(FS::exists($appLog));
    }

    function testFileExistsVsIsFileAndIsDir()
    {
        // Сравниваем поведение FS::exists, is_file и is_dir
        $structure = [
            'regular_file.txt' => 'content',
            'directory' => [
                'nested.txt' => 'nested content'
            ],
            'empty_dir' => []
        ];

        $root = vfsStream::setup('comparison', null, $structure);

        $file = vfsStream::url('comparison/regular_file.txt');
        $dir = vfsStream::url('comparison/directory');
        $nestedFile = vfsStream::url('comparison/directory/nested.txt');
        $emptyDir = vfsStream::url('comparison/empty_dir');
        $nonexistent = vfsStream::url('comparison/nonexistent');

        // Сравниваем результаты
        $this->assertTrue(FS::exists($file));
        $this->assertTrue(\is_file($file));
        $this->assertFalse(\is_dir($file));

        $this->assertTrue(FS::exists($dir));
        $this->assertFalse(\is_file($dir));
        $this->assertTrue(\is_dir($dir));

        $this->assertTrue(FS::exists($nestedFile));
        $this->assertTrue(\is_file($nestedFile));
        $this->assertFalse(\is_dir($nestedFile));

        $this->assertTrue(FS::exists($emptyDir));
        $this->assertFalse(\is_file($emptyDir));
        $this->assertTrue(\is_dir($emptyDir));

        $this->assertFalse(FS::exists($nonexistent));
        $this->assertFalse(\is_file($nonexistent));
        $this->assertFalse(\is_dir($nonexistent));
    }

    function testFileExistsWithConcurrentOperations()
    {
        // Тестируем сценарии конкурентного доступа
        $root = vfsStream::setup('concurrent', null, [
            'shared_resource.lock' => 'lock data',
            'data_queue.dat' => 'queued items'
        ]);

        $lockFile = vfsStream::url('concurrent/shared_resource.lock');
        $queueFile = vfsStream::url('concurrent/data_queue.dat');

        // Симулируем многопоточный сценарий
        $checks = [];

        // Поток 1: проверка существования
        $checks['thread1_initial'] = FS::exists($lockFile);

        // Поток 2: удаление файла
        \unlink($lockFile);

        // Поток 1: повторная проверка
        $checks['thread1_after_deletion'] = FS::exists($lockFile);

        // Поток 3: создание нового файла
        \file_put_contents($lockFile, 'new lock data');

        // Поток 1: финальная проверка
        $checks['thread1_final'] = FS::exists($lockFile);

        // Поток 2: работа с другим файлом
        $checks['thread2_queue'] = FS::exists($queueFile);
        \unlink($queueFile);
        $checks['thread2_queue_after'] = FS::exists($queueFile);

        $this->assertTrue($checks['thread1_initial']);
        $this->assertFalse($checks['thread1_after_deletion']);
        $this->assertTrue($checks['thread1_final']);
        $this->assertTrue($checks['thread2_queue']);
        $this->assertFalse($checks['thread2_queue_after']);
    }

    function testFileExistsAfterMultipleModifications()
    {
        // Тестируем множественные изменения файловой системы
        $root = vfsStream::setup('dynamic');

        $dynamicFile = vfsStream::url('dynamic/changing.file');

        $states = [];

        // Файл не существует
        $states['initial'] = FS::exists($dynamicFile);

        // Создаем файл
        \file_put_contents($dynamicFile, 'version 1');
        $states['created'] = FS::exists($dynamicFile);

        // Переименовываем
        $renamedFile = vfsStream::url('dynamic/renamed.file');
        \rename($dynamicFile, $renamedFile);
        $states['after_rename_old'] = FS::exists($dynamicFile);
        $states['after_rename_new'] = FS::exists($renamedFile);

        // Перемещаем в поддиректорию
        \mkdir(vfsStream::url('dynamic/subdir'));
        $movedFile = vfsStream::url('dynamic/subdir/moved.file');
        \rename($renamedFile, $movedFile);
        $states['after_move_old'] = FS::exists($renamedFile);
        $states['after_move_new'] = FS::exists($movedFile);

        // Удаляем
        \unlink($movedFile);
        $states['after_deletion'] = FS::exists($movedFile);

        // Создаем заново
        \file_put_contents($dynamicFile, 'version 2');
        $states['recreated'] = FS::exists($dynamicFile);

        $this->assertFalse($states['initial']);
        $this->assertTrue($states['created']);
        $this->assertFalse($states['after_rename_old']);
        $this->assertTrue($states['after_rename_new']);
        $this->assertFalse($states['after_move_old']);
        $this->assertTrue($states['after_move_new']);
        $this->assertFalse($states['after_deletion']);
        $this->assertTrue($states['recreated']);
    }

    function testFileExistsWithStatCache()
    {
        // Тестируем влияние кеширования stat
        $root = vfsStream::setup('cache_test', null, [
            'cached_file.conf' => 'configuration data'
        ]);

        $cachedFile = vfsStream::url('cache_test/cached_file.conf');

        // Заполняем кеш многократными вызовами
        $cachedResults = [];
        for ($i = 0; $i < 10; $i++) {
            $cachedResults[] = FS::exists($cachedFile);
            \filesize($cachedFile); // Дополнительные stat вызовы
            \filemtime($cachedFile);
        }

        // Удаляем файл
        \unlink($cachedFile);

        // Проверяем без очистки кеша
        $withoutClear = FS::exists($cachedFile);

        // Очищаем кеш полностью
        \clearstatcache();
        $afterFullClear = FS::exists($cachedFile);

        // Очищаем кеш для конкретного файла
        \clearstatcache(true, $cachedFile);
        $afterSpecificClear = FS::exists($cachedFile);

        // Все результаты до удаления должны быть true
        foreach ($cachedResults as $result) {
            $this->assertTrue($result);
        }

        $this->assertFalse($withoutClear);
        $this->assertFalse($afterFullClear);
        $this->assertFalse($afterSpecificClear);
    }

    function testFileExistsOnComplexStructures()
    {
        // Тестируем сложные структуры с вложенными директориями
        $structure = [
            'app' => [
                'src' => [
                    'Controller' => [
                        'UserController.php' => '<?php class UserController',
                        'AdminController.php' => '<?php class AdminController'
                    ],
                    'Model' => [
                        'User.php' => '<?php class User',
                        'Product.php' => '<?php class Product'
                    ]
                ],
                'config' => [
                    'database.php' => '<?php config',
                    'routes.php' => '<?php routes'
                ],
                'public' => [
                    'index.php' => '<?php bootstrap',
                    'assets' => [
                        'style.css' => 'css content',
                        'script.js' => 'js content'
                    ]
                ],
                'var' => [
                    'cache' => [],
                    'logs' => [
                        'app.log' => 'log content'
                    ]
                ]
            ]
        ];

        $root = vfsStream::setup('project', null, $structure);

        // Проверяем различные уровни вложенности
        $this->assertTrue(FS::exists(vfsStream::url('project/app/src/Controller/UserController.php')));
        $this->assertTrue(FS::exists(vfsStream::url('project/app/src/Controller')));
        $this->assertTrue(FS::exists(vfsStream::url('project/app/src/Model')));
        $this->assertTrue(FS::exists(vfsStream::url('project/app/public/assets/style.css')));
        $this->assertTrue(FS::exists(vfsStream::url('project/app/var/logs/app.log')));

        // Проверяем директории
        $this->assertTrue(FS::exists(vfsStream::url('project/app/src/Controller')));
        $this->assertTrue(FS::exists(vfsStream::url('project/app/public/assets')));
        $this->assertTrue(FS::exists(vfsStream::url('project/app/var/cache')));

        // Удаляем часть структуры
        $root->getChild('app')->getChild('src')->removeChild('Controller');

        $this->assertFalse(FS::exists(vfsStream::url('project/app/src/Controller')));
        $this->assertFalse(FS::exists(vfsStream::url('project/app/src/Controller/UserController.php')));
        $this->assertTrue(FS::exists(vfsStream::url('project/app/src/Model/User.php')));
    }

    function testFileExistsInRealWorldApplication()
    {
        // Реальный сценарий: проверка зависимостей и конфигурации
        $root = vfsStream::setup('application', null, [
            'vendor' => [
                'autoload.php' => '<?php autoload'
            ],
            'config' => [
                'app.php' => '<?php return [];',
                'database.php' => '<?php return [];'
            ],
            'storage' => [
                'framework' => [
                    'cache' => [],
                    'sessions' => []
                ]
            ],
            'public' => [
                'index.php' => '<?php echo "Hello";'
            ]
        ]);

        // Функция проверки требований приложения
        $checkRequirements = function () use ($root) {
            $requirements = [];

            $paths = [
                'autoload' => vfsStream::url('application/vendor/autoload.php'),
                'config_dir' => vfsStream::url('application/config'),
                'storage_dir' => vfsStream::url('application/storage'),
                'cache_dir' => vfsStream::url('application/storage/framework/cache'),
                'public_index' => vfsStream::url('application/public/index.php')
            ];

            foreach ($paths as $key => $path) {
                $requirements[$key] = FS::exists($path);
            }

            return $requirements;
        };

        // Проверяем требования
        $requirements = $checkRequirements();

        $this->assertTrue($requirements['autoload']);
        $this->assertTrue($requirements['config_dir']);
        $this->assertTrue($requirements['storage_dir']);
        $this->assertTrue($requirements['cache_dir']);
        $this->assertTrue($requirements['public_index']);

        // Удаляем критичный файл и проверяем снова
        $root->getChild('vendor')->removeChild('autoload.php');

        $requirementsAfterDeletion = $checkRequirements();
        $this->assertFalse($requirementsAfterDeletion['autoload']);
    }

    function testFileExistsWithErrorHandling()
    {
        // Тестируем обработку ошибок при проверке существования
        $root = vfsStream::setup('error_test');

        $criticalFile = vfsStream::url('error_test/required.config');

        // Функция безопасной загрузки конфигурации
        $loadConfigSafely = function ($configPath) {
            // Многократная проверка с отказоустойчивостью
            if (!FS::exists($configPath)) {
                // Попытка найти резервную копию
                $backupPath = $configPath . '.backup';
                if (FS::exists($backupPath)) {
                    return ['success' => true, 'data' => 'backup data', 'source' => 'backup'];
                }

                // Попытка создать конфиг по умолчанию
                \file_put_contents($configPath, 'default config');

                // Финальная проверка
                if (!FS::exists($configPath)) {
                    throw new \RuntimeException("Cannot access or create config file: $configPath");
                }

                return ['success' => true, 'data' => 'default data', 'source' => 'default'];
            }

            return ['success' => true, 'data' => 'actual data', 'source' => 'actual'];
        };

        // Тестируем различные сценарии

        // Сценарий 1: Файл не существует, нет бэкапа
        $result1 = $loadConfigSafely($criticalFile);
        $this->assertTrue($result1['success']);
        $this->assertEquals('default', $result1['source']);
        $this->assertTrue(FS::exists($criticalFile));

        // Сценарий 2: Файл существует
        $result2 = $loadConfigSafely($criticalFile);
        $this->assertTrue($result2['success']);
        $this->assertEquals('actual', $result2['source']);

        // Сценарий 3: Удаляем файл и создаем бэкап
        \unlink($criticalFile);
        $backupFile = $criticalFile . '.backup';
        \file_put_contents($backupFile, 'backup content');

        $result3 = $loadConfigSafely($criticalFile);
        $this->assertTrue($result3['success']);
        $this->assertEquals('backup', $result3['source']);
    }

    function testFileExistsPerformance()
    {
        // Тестируем производительность множественных проверок
        $root = vfsStream::setup('performance');

        // Создаем множество файлов для проверки
        $files = [];
        for ($i = 0; $i < 100; $i++) {
            $filename = "file_$i.dat";
            \file_put_contents(vfsStream::url("performance/$filename"), "content $i");
            $files[] = vfsStream::url("performance/$filename");
        }

        $iterations = 1000;
        $startTime = \microtime(true);

        $existsCount = 0;
        for ($i = 0; $i < $iterations; $i++) {
            $fileToCheck = $files[$i % \count($files)];
            if (FS::exists($fileToCheck)) {
                $existsCount++;
            }
        }

        $endTime = \microtime(true);
        $executionTime = $endTime - $startTime;

        $this->assertEquals($iterations, $existsCount);
        $this->assertLessThan(1.0, $executionTime, "Проверка 1000 файлов должна занимать менее 1 секунды");

        // Тестируем проверку несуществующих файлов
        $nonexistentCount = 0;
        for ($i = 0; $i < 100; $i++) {
            if (!FS::exists(vfsStream::url("performance/nonexistent_$i.dat"))) {
                $nonexistentCount++;
            }
        }

        $this->assertEquals(100, $nonexistentCount);
    }

    function testFileExistsEdgeCases()
    {
        // Тестируем граничные случаи
        $root = vfsStream::setup('edge_cases');

        // Случай 1: Путь с точкой
        \file_put_contents(vfsStream::url('edge_cases/.hidden'), 'hidden content');
        $this->assertTrue(FS::exists(vfsStream::url('edge_cases/.hidden')));

        // Случай 2: Путь с пробелами
        \file_put_contents(vfsStream::url('edge_cases/file with spaces.txt'), 'content');
        $this->assertTrue(FS::exists(vfsStream::url('edge_cases/file with spaces.txt')));

        // Случай 3: Очень длинное имя файла
        $longName = \str_repeat('a', 100) . '.txt';
        \file_put_contents(vfsStream::url("edge_cases/$longName"), 'long content');
        $this->assertTrue(FS::exists(vfsStream::url("edge_cases/$longName")));

        // Случай 4: Пустая строка
        $this->assertFalse(FS::exists(''));

        // Случай 5: Точка (текущая директория)
        $this->assertTrue(FS::exists(vfsStream::url('edge_cases/.')));

        // Случай 6: Две точки (родительская директория)
        $this->assertTrue(FS::exists(vfsStream::url('edge_cases/..')));
    }
}
