<?php

namespace Inilim\Tool\Test\Resource;

use Inilim\Tool\Test\TestCase;

/**
 * Проверка ресурсов
 */
class ExpTest extends TestCase
{
    /**
     * TODO data provider?
     */
    function test()
    {
        $dir = $this->getDir();

        // ---------------------------------------------
        // db_for_json_file_sqlite
        // ---------------------------------------------

        $file = $dir . '/db_for_json_file_sqlite.php';
        $this->_assertFileExists($file);
        $this->_assertFileNotEmpty($file);
        $this->_assertHashFile($file, [
            'md5'    => '63730ac7da0772d7c1b1f6d9d50d7a06',
            'sha1'   => '61dbb141609e70e82291d9279d18fcb474b5eec4',
            'sha256' => '65d63cf71f66b1154a2aa46ac46c79f7af064dfe8135ada7d32fe3ecabac90a7',
        ]);


        // ---------------------------------------------
        // cl100k_base.tiktoken.raw.txt
        // INFO файл не должен подвергатся изменению
        // ---------------------------------------------

        $file = $dir . '/cl100k_base.tiktoken.raw.txt';
        $this->_assertFileExists($file);
        $this->_assertFileNotEmpty($file);
        $this->_assertHashFile($file, [
            'md5'    => '6ffb773d88dfc0e1163568a3190b35b6',
            'sha1'   => '887f8a30e9336286d6ad016f2fd650ad0545ee16',
            'sha256' => '085dcea7fc301966830f245cb17c9702c63e7aa9d9409563578d567670ba869e',
        ]);


        // ---------------------------------------------
        // cl100k_base.tiktoken.base64.json
        // INFO файл не должен подвергатся изменению
        // ---------------------------------------------

        $file = $dir . '/cl100k_base.tiktoken.base64.json';
        $this->_assertFileExists($file);
        $this->_assertFileNotEmpty($file);
        $this->_assertHashFile($file, [
            'md5'    => 'ef3dfee8dd207946204ace4d9e688a63',
            'sha1'   => 'b7e1d97bee053d3a4b2ac13d66ab0ea1afa1e93d',
            'sha256' => '9e03aaaa16e0cc18ed6e4b404a108293fa9e8d243e871191cbeb23652e65452a',
        ]);

        // ---------------------------------------------
        // cl100k_base.tiktoken.serialize.txt
        // INFO файл не должен подвергатся изменению
        // ---------------------------------------------

        $file = $dir . '/cl100k_base.tiktoken.serialize.txt';
        $this->_assertFileExists($file);
        $this->_assertFileNotEmpty($file);
        $this->_assertHashFile($file, [
            'md5'    => 'f6e2c3d2bd44d83ed99bc2a99f1d862f',
            'sha1'   => '43a00cd4ef6be58f637a526de403770d6984d3d6',
            'sha256' => '3df2cd5a997ee47f0eb71d2d7c4a15e0957a88ff97811914e2285c8d9ed0352b',
        ]);

        // ---------------------------------------------
        // cl100k_base.tiktoken.crc32.json
        // INFO файл не должен подвергатся изменению
        // ---------------------------------------------

        $file = $dir . '/cl100k_base.tiktoken.crc32.json';
        $this->_assertFileExists($file);
        $this->_assertFileNotEmpty($file);
        $this->_assertHashFile($file, [
            'md5'    => '87eab6d65d4f031137d9ac41d2b0ec5c',
            'sha1'   => '1d7f05ff418f85a210ed8755bded53cd4b1fdb74',
            'sha256' => '9398cdf87ca02f3ba75f5b89048ac7808251ba29bd3a7b795b2d0e8e5cc97976',
        ]);
        // dd([
        //     'md5' => \hash_file('md5', $file),
        //     'sha1' => \hash_file('sha1', $file),
        //     'sha256' => \hash_file('sha256', $file),
        // ]);

        // ---------------------------------------------
        // cl100k_base.tiktoken.crc32.array.php
        // INFO файл не должен подвергатся изменению
        // ---------------------------------------------

        $file = $dir . '/cl100k_base.tiktoken.crc32.array.php';
        $this->_assertFileExists($file);
        $this->_assertFileNotEmpty($file);
        $this->_assertHashFile($file, [
            'md5'    => '620e739494d18d11a19d673ccc031b3b',
            'sha1'   => '54a02ff683dd7e5b3ec87a68746b8fe0cd3c81b5',
            'sha256' => '63519986cf7ccc176740f356094a171ab7a93a74a105213c56c4136ca6f06d30',
        ]);
    }

    // ---------------------------------------------
    // 
    // ---------------------------------------------

    /**
     * @param array<string,string> $expected
     */
    protected function _assertHashFile(string $pathToFile, array $expected): void
    {
        foreach ($expected as $algo => $expectedHash) {
            $this->assertSame($expectedHash, \hash_file($algo, $pathToFile));
        }
    }

    protected function _assertFileExists(string $pathToFile): void
    {
        $this->assertTrue(
            \is_file($pathToFile),
            \sprintf('File not found "%s"', $pathToFile)
        );
    }

    protected function _assertFileNotEmpty(string $pathToFile): void
    {
        $size = \filesize($pathToFile);
        $this->assertTrue(
            $size !== false && $size > 0,
            \sprintf('File empty "%s"', $pathToFile)
        );
    }

    protected function getDir(): string
    {
        return \realpath(__DIR__ . '/../../files/resources/Exp');
    }
}
