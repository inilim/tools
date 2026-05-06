<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

/**
 * @author https://github.com/shipfastlabs/agent-detector/
 * @author inilim
 * 
 * @ext mbstring
 * 
 * @return array{status:bool,name:?string}
 */
function agentDetector(): array
{
    $class = new class {

        function detect(): array
        {
            return $this->fromAiAgentEnvVar()
                ?? $this->fromKnownEnvVars()
                ?? $this->fromFileSystem()
                ?? ['status' => false, 'name' => null];
        }

        function fromAiAgentEnvVar(): ?array
        {
            $aiAgent = \getenv('AI_AGENT');

            if ($aiAgent === false) {
                return null;
            }

            $aiAgent = \trim($aiAgent);

            if ($aiAgent === '') {
                return null;
            }

            if (\in_array($aiAgent, ['github-copilot', 'github-copilot-cli'], true)) {
                return ['status' => true, 'name' => 'copilot'];
            }
            if (\Inilim\Tool\Method\PF\str_starts_with($aiAgent, 'claude-code')) {
                return ['status' => true, 'name' => 'claude'];
            }
            return ['status' => true, 'name' => $aiAgent];
        }

        function fromKnownEnvVars(): ?array
        {
            foreach (\Inilim\Tool\Method\Data\agentsEnvVars() as $agent => $envVars) {
                foreach ($envVars as $envVar) {
                    if (\getenv($envVar) === false) {
                        continue;
                    }

                    if ($agent === 'claude') {
                        return [
                            'status' => true,
                            'name'   => \getenv('CLAUDE_CODE_IS_COWORK') !== false ? 'cowork' : 'claude',
                        ];
                    }

                    return ['status' => true, 'name' => $agent];
                }
            }


            return null;
        }

        function fromFileSystem(): ?array
        {
            if (\Inilim\Tool\Method\FS\isFile('/opt/.devin')) {
                return ['status' => true, 'name' => 'dewin'];
            }
            return null;
        }
    };

    $result = $class->detect();

    if ($result['status']) {
        $result['name'] = \preg_replace('/(\-|\_)(cli|ai|agent)$/', '', \Inilim\Tool\Method\Str\lower($result['name']));
    }

    return $result;
}
