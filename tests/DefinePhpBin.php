<?php

namespace Inilim\Tool\Test;

use Inilim\Tool\Path;
use Symfony\Component\Process\Process;

class DefinePhpBin
{
    protected static ?DefinePhpBin $instance = null;

    static function self(): DefinePhpBin
    {
        self::$instance ??= new DefinePhpBin;
        self::$instance->definePhpBin();
        return self::$instance;
    }

    // ---------------------------------------------
    // 
    // ---------------------------------------------

    /**
     * @var array<string,string>
     */
    protected array $bins = [];

    /**
     * @return array<string,string>
     */
    function getPhpBin(): array
    {
        return $this->bins;
    }

    /**
     * TODO сделать автопоиск бинарников
     */
    protected function definePhpBin()
    {
        $filePhpVersion = __DIR__ . '/getPhpVersion.php';
        if (!\is_file($filePhpVersion)) {
            throw new \RuntimeException(\sprintf('Not found file "%s"', $filePhpVersion));
        }

        $php_bins = [
            'D:\other\OSPanel\modules\PHP-7.4\PHP\php74.exe',
            'D:\other\OSPanel\modules\PHP-8.2\PHP\php.exe',
            'D:\other\php\php84\php84.exe',
        ];
        foreach ($php_bins as $php) {
            $php = Path::normalize($php);
            if (!\is_file($php)) {
                continue;
            }
            // de($filePhpVersion);
            $process = new Process([$php, \sprintf('%s', $filePhpVersion)]);
            $process->run();
            try {
                $version = $process->getOutput();
                // dde($version);
            } catch (\Throwable $e) {
                continue;
            }
            if (!\preg_match('/^\d+\.\d+$/', $version)) {
                continue;
            }
            $this->bins[$version] = $php;
        }
    }
}
