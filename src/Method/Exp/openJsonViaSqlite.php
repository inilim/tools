<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp;

/**
 * @author inilim
 * Создает временный файл sqlite в котором содержится json из файла $pathToFile, для последующих вызовов связанных функций
 * Значительно экономит ОЗУ, но медленее чем json_decode()
 * @todo add support resource
 * @todo tests
 * @param resource|string $source file or resource
 * @ext PDO pdo_sqlite
 */
function openJsonViaSqlite($source): ?object
{
    $type = \gettype($source);
    if ($type === 'string') {
        /** @var string $source */
        \Inilim\Tool\Method\Assert\file($source);
    } elseif ($type === 'resource') {
        /** @var resource $source */
        $source = \Inilim\Tool\Method\Other\getPathFromResource($source);
        /** @var ?string $source */
        if ($source === null || $source === 'php://temp') {
            throw new \InvalidArgumentException('$source failed get path to file from resource');
        }
    } else {
        throw new \InvalidArgumentException('$source allow file or open resource');
    }

    $class = __FUNCTION__;

    $internal = static function ($obj) use ($source, $class) {
        /** @var \stdClass $obj */
        $obj->pathToFile = \Inilim\Tool\Method\Path\normalize($source);
        $obj->hashPathToFile = \md5($obj->pathToFile);
        try {
            $gen = \Inilim\Tool\Method\File\toCharsGenerator($source, 4024);
        } catch (\Exception $e) {
            \Inilim\Tool\Method\Other\__setErrorLast(-1, $e->getMessage(), '', -1);
            return null;
        }

        // ---------------------------------------------
        // Создаем файл sqlite
        // ---------------------------------------------

        $obj->tmpFile = \sys_get_temp_dir() . '/inilim-tools-' . $obj->hashPathToFile . '.tmp';
        // TODO может стоит хранить базу как файл, и содержимое копировать в файл
        ['exception' => $e] = \Inilim\Tool\Method\File\put(
            $obj->tmpFile,
            \base64_decode(\Inilim\Tool\Method\Other\__resource($class, 'db_for_json_file_sqlite'), true)
            // ''
        );
        if ($e) {
            return null;
        }

        // ---------------------------------------------
        // Соединение
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
        // TODO проверить что быстрее конкатенация или транзакция

        $res = \Inilim\Tool\Method\Other\timedMsCall(static function () use ($gen, $obj) {
            // $i = 0;
            foreach ($gen as $text) {
                $obj->stmt = $obj->pdo->prepare('UPDATE _table SET _value = _value || :_value WHERE _name = "json"');
                // $obj->stmt = $obj->pdo->prepare('INSERT INTO _table (_name,_value) VALUES (:_name,:_value)');
                $obj->stmt->execute([
                    // '_name' => $i,
                    '_value' => $text,
                ]);
                // $i++;
            }
            // dd($i);
        });
        // de($res);
        unset($gen, $text);

        // ---------------------------------------------
        // Валидация
        // ---------------------------------------------

        $obj->stmt = $obj->pdo->query('SELECT json_valid(_value) as valid FROM _table WHERE _name = "json"');
        $results = $obj->stmt->fetch(\PDO::FETCH_NUM);
        if (!isset($results[0]) || $results[0] == 0) {
            \Inilim\Tool\Method\Other\__setErrorLast(-1, 'JSON invalid', '', -1);
            $obj->pdo = $obj->stmt = null;
            \Inilim\Tool\Method\FS\unlink($obj->tmpFile);
            return null;
        }

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
        protected ?\PDO $pdo;
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
