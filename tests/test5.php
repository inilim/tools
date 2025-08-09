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

__include([
    'File\getViaArray',
    'Exp\fgcSend',
    'Other\valueToString',
    'File\get',
    'Assert\inArray',
    'Other\tryCallWithErrHandler',
    'Obj\getCollectionThrowable',
    'Time\unixMs',
    'Str\startsWith',
    'PF\str_starts_with',
    'Check\php80',
    'Assert\strOrArr',
    'Check\strOrArr',
    'Other\getType',
    'Assert\string',
    'Exp\normalizeHeaders',
    'Assert\allString',
    'Assert\isIterable',
    'Check\isIterable',
    'Exp\headersFromLines',
    'Arr\dot',
    'Arr\walkRecursive',
    'Assert\__notArgsHere',
    'PF\str_contains',
    'Assert\httpHeaderValue',
    'Check\httpHeaderValue',
    'Assert\httpHeaderName',
    'Check\httpHeaderName',
    'Exp\arrJoin',
    'Str\contains',
    'Str\iEndsWithOnce',
    'Exp\stringContainsInArray',
    'Assert\isArray',
    'Assert\contains',
    'Check\contains',
    'Other\timedMsCall',
    'Other\_refDots',
]);






$headers = [];
$headers = [
    'name-heade5' => 'value-header6',
    'name-heade5:value-header7',
    'name-header' => ['value-header1', 'value-header2'],
    'name-header2' => ['value-header4'],
    'name-header3:value-header5',
    'name-header4:value-header1,value-header2,value-header3',
];
// $dots = \Inilim\Tool\Method\Arr\dot($headers, '', '|');

// $a = \next($dots);
// current()
// prev
// \end($dots);

// \next($dots);
// $a = \current($dots);
// dde($a);

$headers = \Inilim\Tool\Method\Exp\normalizeHeaders($headers);

de($headers);

de();

// $response = \Inilim\Tool\Method\Exp\fgcSend('http://127.0.0.1:11434/api/embed', 'PUT', \json_encode([
//     'model' => 'nomic-embed-text',
//     'input' => 'Llamas are members of the camelid family',
//     'options' => [
//         'num_gpu' => 0,
//     ],
// ]));

// redirects_1_to_index
$response = \Inilim\Tool\Method\Exp\fgcSend('http://http-test.test/index.php', [
    'method' => 'post',
    'debug' => true,
    'headers' => [
        'content-type' => ['dawdw']
    ],
    'body' => \json_encode([
        'model' => 'nomic-embed-text',
        'input' => 'Llamas are members of the camelid family',
        'options' => [
            'num_gpu' => 0,
        ],
    ]),
]);

// $response['request']['body'];
// $response = \Inilim\Tool\Method\Exp\fgcSend('https://webhook.site/d0bd56bc-8837-4e69-89f9-8621ccb4d8af');

// fgcSend()
// fgcSendPost()
// fgcSendJsonPost()
// fgcSendXmlPost()
// fgcSendGet()


// $response = Arr::dot($response);

de($response);
