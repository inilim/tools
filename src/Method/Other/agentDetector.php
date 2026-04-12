<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

/**
 * @author https://github.com/shipfastlabs/agent-detector/
 * @author inilim
 * 
 * @return array{status:bool,name:?string}
 */
function agentDetector(): array
{
    // TODO может взять сразу весь массив? getenv прожорлив
    // $env = \getenv();
    $aiAgent = \getenv('AI_AGENT');
    if (\is_string($aiAgent) && ($aiAgent = \Inilim\Tool\Method\LarStr\trim($aiAgent)) !== '') {
        $normalized = \preg_replace('/(\-|\_)(cli|ai|agent)$/', '', \Inilim\Tool\Method\Str\lower($aiAgent));
        return ['status' => true, 'name' => $normalized];
    }

    foreach (\Inilim\Tool\Method\Data\agentsEnvVars() as $agent => $envVars) {
        foreach ($envVars as $envVar) {
            if (\getenv($envVar) !== false) {
                // Для claude-code: если установлен CLAUDE_CODE_IS_COWORK, то это cowork
                // if ($agent === 'claude' && \getenv('CLAUDE_CODE_IS_COWORK') !== false) {
                //     return ['status' => true, 'name' => 'cowork'];
                // }
                return ['status' => true, 'name' => $agent];
            }
        }
    }

    // Дополнительная проверка для Cursor CLI по роли расширения
    // if (\getenv('CURSOR_EXTENSION_HOST_ROLE') === 'agent-exec') {
    //     return ['status' => true, 'name' => 'cursor'];
    // }

    // 3. Проверка наличия файла Devin (как в оригинале)
    if (\Inilim\Tool\Method\FS\isFile('/opt/.devin')) {
        return ['status' => true, 'name' => 'devin'];
    }

    return ['status' => false, 'name' => null];
}
