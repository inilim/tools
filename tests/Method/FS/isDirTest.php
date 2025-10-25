<?php

namespace Inilim\Tool\Test\Method\FS;

use Inilim\Tool\FS;
use Inilim\Tool\File;
use org\bovigo\vfs\vfsStream;
use Inilim\Tool\Test\TestCase;

/**
 * by deepseec
 */
class isDirTest extends TestCase
{
    function testIsDirWithVirtualFileSystem()
    {
        // Создаем структуру каталогов и файлов
        $structure = [
            'existing_dir' => [
                'subdir' => [
                    'file.txt' => 'content'
                ],
                'file1.txt' => 'content'
            ],
            'file2.txt' => 'content',
            'empty_dir' => []
        ];

        $root = vfsStream::setup('root', null, $structure);

        // Тестируем FS::isDir() на виртуальных директориях
        $this->assertTrue(FS::isDir(vfsStream::url('root/existing_dir')));
        $this->assertTrue(FS::isDir(vfsStream::url('root/existing_dir/subdir')));
        $this->assertTrue(FS::isDir(vfsStream::url('root/empty_dir')));
        $this->assertFalse(FS::isDir(vfsStream::url('root/file2.txt'))); // Это файл
        $this->assertFalse(FS::isDir(vfsStream::url('root/nonexistent_dir')));
    }

    function testIsDirWithDeletedDirectory()
    {
        // Создаем структуру с директориями
        $structure = [
            'dir_to_delete' => [
                'file1.txt' => 'content'
            ],
            'persistent_dir' => [
                'file2.txt' => 'content'
            ]
        ];

        $root = vfsStream::setup('root', null, $structure);

        $dirToDelete = vfsStream::url('root/dir_to_delete');
        $persistentDir = vfsStream::url('root/persistent_dir');

        // Проверяем, что директории существуют изначально
        $this->assertTrue(FS::isDir($dirToDelete));
        $this->assertTrue(FS::isDir($persistentDir));

        // Удаляем одну директорию
        $root->removeChild('dir_to_delete');

        // Проверяем состояние после удаления
        $this->assertFalse(FS::isDir($dirToDelete), 'Директория должна быть удалена');
        $this->assertTrue(FS::isDir($persistentDir), 'Вторая директория должна остаться');

        // Проверяем, что директория действительно отсутствует в структуре vfsStream
        $this->assertFalse($root->hasChild('dir_to_delete'));
        $this->assertTrue($root->hasChild('persistent_dir'));
    }

    function testIsDirWithRecursiveDeletion()
    {
        // Тест с рекурсивным удалением вложенных директорий
        $structure = [
            'parent_dir' => [
                'child_dir' => [
                    'grandchild_dir' => [
                        'file.txt' => 'content'
                    ]
                ]
            ]
        ];

        $root = vfsStream::setup('root', null, $structure);

        $parentDir = vfsStream::url('root/parent_dir');
        $childDir = vfsStream::url('root/parent_dir/child_dir');
        $grandchildDir = vfsStream::url('root/parent_dir/child_dir/grandchild_dir');

        // Проверяем, что все директории существуют
        $this->assertTrue(FS::isDir($parentDir));
        $this->assertTrue(FS::isDir($childDir));
        $this->assertTrue(FS::isDir($grandchildDir));

        // Удаляем родительскую директорию (рекурсивно)
        $root->removeChild('parent_dir');

        // Проверяем, что все вложенные директории тоже удалены
        $this->assertFalse(FS::isDir($parentDir));
        $this->assertFalse(FS::isDir($childDir));
        $this->assertFalse(FS::isDir($grandchildDir));
    }

    function testIsDirAfterMultipleOperations()
    {
        $root = vfsStream::setup('root');

        $dirPath = vfsStream::url('root/dynamic_dir');

        // Создаем директорию
        \mkdir($dirPath);
        $this->assertTrue(FS::isDir($dirPath));

        // Удаляем директорию
        \rmdir($dirPath);
        $this->assertFalse(FS::isDir($dirPath));

        // Пытаемся создать заново
        \mkdir($dirPath);
        $this->assertTrue(FS::isDir($dirPath));

        // Снова удаляем
        \rmdir($dirPath);
        $this->assertFalse(FS::isDir($dirPath));
    }

    function testIsDirWithClearStatCache()
    {
        // Тест с очисткой кеша stat для директорий
        $root = vfsStream::setup('root', null, [
            'cached_dir' => [
                'file.txt' => 'content'
            ]
        ]);

        $dirPath = vfsStream::url('root/cached_dir');

        // Первая проверка - директория существует
        $firstCheck = FS::isDir($dirPath);

        // Удаляем директорию
        $root->removeChild('cached_dir');

        // Вторая проверка без очистки кеша
        $secondCheck = FS::isDir($dirPath);

        // Очищаем кеш и проверяем снова
        \clearstatcache(true, $dirPath);
        $thirdCheck = FS::isDir($dirPath);

        $this->assertTrue($firstCheck);
        $this->assertFalse($secondCheck);
        $this->assertFalse($thirdCheck);
    }

    function testIsDirVsIsFile()
    {
        // Тест на различие между FS::isDir() и is_file()
        $structure = [
            'directory' => [
                'file.txt' => 'content'
            ],
            'regular_file.txt' => 'content'
        ];

        $root = vfsStream::setup('root', null, $structure);

        $directory = vfsStream::url('root/directory');
        $fileInDir = vfsStream::url('root/directory/file.txt');
        $regularFile = vfsStream::url('root/regular_file.txt');

        // Проверяем FS::isDir()
        $this->assertTrue(FS::isDir($directory));
        $this->assertFalse(FS::isDir($fileInDir));
        $this->assertFalse(FS::isDir($regularFile));

        // Проверяем is_file()
        $this->assertFalse(\is_file($directory));
        $this->assertTrue(\is_file($fileInDir));
        $this->assertTrue(\is_file($regularFile));

        // Удаляем директорию и проверяем снова
        $root->removeChild('directory');

        $this->assertFalse(FS::isDir($directory));
        $this->assertFalse(\is_file($fileInDir));
    }

    function testIsDirOnEmptyAndNonEmptyDirectories()
    {
        // Тестируем пустые и непустые директории
        $structure = [
            'empty_dir' => [],
            'non_empty_dir' => [
                'file1.txt' => 'content',
                'subdir' => []
            ]
        ];

        $root = vfsStream::setup('root', null, $structure);

        $emptyDir = vfsStream::url('root/empty_dir');
        $nonEmptyDir = vfsStream::url('root/non_empty_dir');

        // Обе директории должны определяться как директории
        $this->assertTrue(FS::isDir($emptyDir));
        $this->assertTrue(FS::isDir($nonEmptyDir));

        // Удаляем пустую директорию
        $root->removeChild('empty_dir');
        $this->assertFalse(FS::isDir($emptyDir));

        // Удаляем непустую директорию
        $root->removeChild('non_empty_dir');
        $this->assertFalse(FS::isDir($nonEmptyDir));
    }

    function testDirectoryProcessingWithPotentialDeletion()
    {
        // Симулируем реальный сценарий работы с директориями
        $root = vfsStream::setup('project', null, [
            'uploads' => [
                'images' => [
                    'photo1.jpg' => 'binary data',
                    'photo2.jpg' => 'binary data'
                ],
                'documents' => [
                    'doc1.pdf' => 'pdf content'
                ]
            ],
            'temp' => []
        ]);

        $uploadsDir = vfsStream::url('project/uploads');
        $imagesDir = vfsStream::url('project/uploads/images');
        $tempDir = vfsStream::url('project/temp');

        // Функция для обработки директории
        $processDirectory = function ($path) {
            if (!FS::isDir($path)) {
                throw new \RuntimeException('Directory not found or was deleted');
            }

            // Получаем содержимое директории
            $files = \scandir($path);
            $files = \array_diff($files, ['.', '..']);

            // Проверяем снова, что директория не была удалена во время обработки
            if (!FS::isDir($path)) {
                throw new \RuntimeException('Directory was deleted during processing');
            }

            return \count($files);
        };

        // Успешная обработка
        $uploadFilesCount = $processDirectory($uploadsDir);
        $this->assertEquals(2, $uploadFilesCount); // images и documents

        // Удаляем директорию и пытаемся обработать снова
        $root->removeChild('uploads');

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Directory not found or was deleted');
        $processDirectory($uploadsDir);
    }

    function testDirectoryCreationAndDeletionWorkflow()
    {
        // Тестируем полный workflow создания и удаления директорий
        $root = vfsStream::setup('workspace');

        $workDir = vfsStream::url('workspace/project');
        $cacheDir = vfsStream::url('workspace/project/cache');
        $logsDir = vfsStream::url('workspace/project/logs');

        // Создаем структуру директорий
        \mkdir($workDir, 0755, true);
        \mkdir($cacheDir, 0755, true);
        \mkdir($logsDir, 0755, true);

        // Проверяем создание
        $this->assertTrue(FS::isDir($workDir));
        $this->assertTrue(FS::isDir($cacheDir));
        $this->assertTrue(FS::isDir($logsDir));

        // Удаляем вложенную директорию
        \rmdir($cacheDir);
        $this->assertFalse(FS::isDir($cacheDir));
        $this->assertTrue(FS::isDir($workDir)); // Родительская должна остаться
        $this->assertTrue(FS::isDir($logsDir)); // И сестринская тоже

        // Удаляем родительскую директорию (должна быть пустой)
        \rmdir($logsDir);
        // Нельзя удалить workDir пока она не пустая, нужно удалить рекурсивно через vfsStream
        $root->removeChild('project');

        $this->assertFalse(FS::isDir($workDir));
    }
}
