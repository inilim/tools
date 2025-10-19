<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp;

/**
 * @author inilim
 * Создает временный файл sqlite в котором содержится json из файла $pathToFile, для последующих вызовов связанных функций
 * Значительно экономит ОЗУ, но медленее чем json_decode()
 * @todo add support resource
 * @todo tests
 * @build_skip
 * @ext PDO pdo_sqlite
 */
function openFileJsonViaSqlite(string $pathToFile): ?object
{
    \Inilim\Tool\Method\Assert\file($pathToFile);

    $internal = static function ($obj) use ($pathToFile) {
        /** @var \stdClass $obj */
        $obj->pathToFile = \Inilim\Tool\Method\Path\normalize($pathToFile);
        $obj->hashPathToFile = \md5($obj->pathToFile);
        try {
            $gen = \Inilim\Tool\Method\File\toCharsGenerator($obj->pathToFile, 2024);
        } catch (\Exception $e) {
            \Inilim\Tool\Method\Other\__setErrorLast(-1, $e->getMessage(), '', -1);
            return null;
        }

        // ---------------------------------------------
        // 
        // ---------------------------------------------
        dde(__FUNCTION__);
        $obj->tmpFile = \sys_get_temp_dir() . '/inilim-tools-' . $obj->hashPathToFile . '.tmp';
        ['exception' => $e] = \Inilim\Tool\Method\File\put(
            $obj->tmpFile,
            \base64_decode(\Inilim\Tool\Method\Other\__resource(__FUNCTION__, 'db_for_json_file_sqlite'), true)
            // ''
        );
        if ($e) {
            return null;
        }

        // ---------------------------------------------
        // Создание таблицы и записи
        // ---------------------------------------------

        $obj->pdo = new \PDO('sqlite:' . $obj->tmpFile, null, null, [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
        ]);
        // tables
        // $obj->pdo->exec('CREATE TABLE _table (_name TEXT, _value TEXT)');
        // records
        // $obj->pdo->exec('INSERT INTO _table (_name,_value) VALUES ("json","")');

        // ---------------------------------------------
        // Загрузка json
        // ---------------------------------------------

        foreach ($gen as $text) {
            $obj->stmt = $obj->pdo->prepare('UPDATE _table SET _value = _value || :_value WHERE _name = "json"');
            $obj->stmt->execute(['_value' => $text]);
        }
        unset($gen, $text);

        // ---------------------------------------------
        // Валидация
        // ---------------------------------------------

        $obj->stmt = $obj->pdo->query('SELECT json_valid(_value) FROM _table WHERE _name = "json"');
        $valid = $obj->stmt->fetch(\PDO::FETCH_NUM)[0] ?? null;
        if ($valid == 0) {
            \Inilim\Tool\Method\Other\__setErrorLast(-1, 'JSON invalid', '', -1);
            $obj->pdo = $obj->stmt = null;
            \Inilim\Tool\Method\FS\unlink($obj->tmpFile);
            return null;
        }

        // ---------------------------------------------
        // end
        // ---------------------------------------------

        $obj->pdo->query('INSERT INTO _table (_name,_value) VALUES ("end","1")');

        return $obj;
    };

    $result = \Inilim\Tool\Method\Other\tryCallWithErrHandler(
        $internal,
        static function ($_, $msg, $_1, $_2, $context) {
            \Inilim\Tool\Method\Other\__setErrorLast(-1, $msg, '', -1);
            if ($context['isException']) {
                $obj = $context['obj'];
                $obj->pdo = $obj->stmt = null;
                \Inilim\Tool\Method\FS\unlink($obj->tmpFile);
            }
        }
    );

    if (!\is_object($result)) {
        return null;
    }

    $object = new class {
        protected $tag; // onlyread
        protected string $tmpFile;
        protected string $jsonFile;
        protected string $hashJsonFile;
        protected \PDO $pdo;
    };
    \Inilim\Tool\Method\Other\bindAndCall($object, function ($result) {
        $this->tag          = \Inilim\Tool\Method\Exp\__tagJsonSqlite();
        $this->tmpFile      = $result->tmpFile;
        $this->jsonFile     = $result->pathToFile;
        $this->hashJsonFile = $result->hashPathToFile;
        $this->pdo          = $result->pdo;
    }, $result);

    return $object;
}
