<?php

declare(strict_types=1);

require_once \dirname(__DIR__) . '/bootstrap.dev.php';

use Inilim\Tool\VD;
use Inilim\Tool\Arr;
use Inilim\Tool\Obj;
use Inilim\Tool\Str;
use Inilim\Tool\Xml;
use Inilim\Dump\Dump;
use Inilim\Tool\Data;
use Inilim\Tool\Enum;
use Inilim\Tool\File;
use Inilim\Tool\Json;
use Inilim\Tool\Path;
use Inilim\Tool\Refl;
use Inilim\Tool\Time;
use Inilim\Tool\Other;
use Inilim\Tool\Double;
use Inilim\Tool\Integer;
use Inilim\IPDO\IPDOSQLite;

__include('File\getViaArray');
__include('Exp\fgcSend');
__include('Other\valueToString');
__include('File\get');
__include('Assert\inArray');
__include('Other\tryCallWithErrHandler');
__include('Obj\getCollectionThrowable');
__include('Time\unixMs');
__include('Str\startsWith');
__include('PF\str_starts_with');
__include('Check\php80');

// $response = \Inilim\Tool\Method\Exp\fgcSend('http://127.0.0.1:11434/api/embed', 'PUT', \json_encode([
//     'model' => 'nomic-embed-text',
//     'input' => 'Llamas are members of the camelid family',
//     'options' => [
//         'num_gpu' => 0,
//     ],
// ]));
$response = \Inilim\Tool\Method\Exp\fgcSend('https://webhook.site/d0bd56bc-8837-4e69-89f9-8621ccb4d8af', 'POST', \json_encode([
    'model' => 'nomic-embed-text',
    'input' => 'Llamas are members of the camelid family',
    'options' => [
        'num_gpu' => 0,
    ],
]));
// $response = \Inilim\Tool\Method\Exp\fgcSend('https://webhook.site/d0bd56bc-8837-4e69-89f9-8621ccb4d8af');

// fgcSend()
// fgcSendPost()
// fgcSendJsonPost()
// fgcSendXmlPost()
// fgcSendGet()


de($response);
