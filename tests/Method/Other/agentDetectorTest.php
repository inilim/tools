<?php

declare(strict_types=1);

use Inilim\Tool\Data;
use Inilim\Tool\Other;

class agentDetectorTest extends \Inilim\Tool\Test\TestCase
{

    protected function setUp(): void
    {
        parent::setUp();
        self::__reset_env_agent();
    }

    protected function __reset_env_agent(): void
    {
        // Очистка переменных окружения
        \putenv('AI_AGENT');
        foreach (Data::agentsEnvVars() as $envs) {
            foreach ($envs as $env) {
                \putenv($env);
            }
        }

        // Сброс глобального мока для file_exists
        unset($GLOBALS['__mock_file_exists']);
    }

    protected function tearDown(): void
    {
        self::__reset_env_agent();
        parent::tearDown();
    }

    /** @test */
    function detects_custom_agent_via_ai_agent(): void
    {
        putenv('AI_AGENT=my-custom-agent');

        $result = Other::agentDetector();

        $this->assertTrue($result['status']);
        $this->assertSame('my-custom', $result['name']);
    }

    /** @test */
    function does_not_detect_agent_when_ai_agent_not_set(): void
    {
        $result = Other::agentDetector();

        $this->assertFalse($result['status']);
        $this->assertNull($result['name']);
    }

    /** @test */
    function detects_cursor_via_cursor_agent(): void
    {
        putenv('CURSOR_AGENT=1');

        $result = Other::agentDetector();

        $this->assertTrue($result['status']);
        $this->assertSame('cursor', $result['name']);
    }

    /** @test */
    function detects_gemini_via_gemini_cli(): void
    {
        putenv('GEMINI_CLI=true');

        $result = Other::agentDetector();

        $this->assertTrue($result['status']);
        $this->assertSame('gemini', $result['name']);
    }

    /** @test */
    function detects_codex_via_codex_sandbox(): void
    {
        putenv('CODEX_SANDBOX=true');

        $result = Other::agentDetector();

        $this->assertTrue($result['status']);
        $this->assertSame('codex', $result['name']);
    }

    /** @test */
    function detects_codex_via_codex_thread_id(): void
    {
        putenv('CODEX_THREAD_ID=some-thread-id');

        $result = Other::agentDetector();

        $this->assertTrue($result['status']);
        $this->assertSame('codex', $result['name']);
    }

    /** @test */
    function detects_augment_cli_via_augment_agent(): void
    {
        putenv('AUGMENT_AGENT=true');

        $result = Other::agentDetector();

        $this->assertTrue($result['status']);
        $this->assertSame('augment', $result['name']);
    }

    /** @test */
    function detects_opencode_via_opencode_client(): void
    {
        putenv('OPENCODE_CLIENT=true');

        $result = Other::agentDetector();

        $this->assertTrue($result['status']);
        $this->assertSame('opencode', $result['name']);
    }

    /** @test */
    function detects_opencode_via_opencode(): void
    {
        putenv('OPENCODE=true');

        $result = Other::agentDetector();

        $this->assertTrue($result['status']);
        $this->assertSame('opencode', $result['name']);
    }

    /** @test */
    function detects_amp_via_amp_current_thread_id(): void
    {
        putenv('AMP_CURRENT_THREAD_ID=some-thread-id');

        $result = Other::agentDetector();

        $this->assertTrue($result['status']);
        $this->assertSame('amp', $result['name']);
    }

    /** @test */
    function detects_claude_via_claudecode(): void
    {
        putenv('CLAUDECODE=1');

        $result = Other::agentDetector();

        $this->assertTrue($result['status']);
        $this->assertSame('claude', $result['name']);
    }

    /** @test */
    function detects_claude_via_claude_code(): void
    {
        putenv('CLAUDE_CODE=1');

        $result = Other::agentDetector();

        $this->assertTrue($result['status']);
        $this->assertSame('claude', $result['name']);
    }

    /** @test */
    function detects_copilot_via_copilot_cli(): void
    {
        putenv('COPILOT_CLI=1');

        $result = Other::agentDetector();

        $this->assertTrue($result['status']);
        $this->assertSame('copilot', $result['name']);
    }

    /** @test */
    function detects_replit_via_repl_id(): void
    {
        putenv('REPL_ID=some-repl-id');

        $result = Other::agentDetector();

        $this->assertTrue($result['status']);
        $this->assertSame('replit', $result['name']);
    }

    /** @test */
    function detects_antigravity_via_antigravity_agent(): void
    {
        putenv('ANTIGRAVITY_AGENT=1');

        $result = Other::agentDetector();

        $this->assertTrue($result['status']);
        $this->assertSame('antigravity', $result['name']);
    }

    // TODO 
    /** @tеest */
    function detects_devin_via_opt_devin_file(): void
    {
        $GLOBALS['__mock_file_exists'] = fn(string $path): bool => $path === '/opt/.devin';

        $result = Other::agentDetector();

        $this->assertTrue($result['status']);
        $this->assertSame('devin', $result['name']);
    }

    /** @test */
    function does_not_detect_devin_when_opt_devin_file_missing(): void
    {
        $GLOBALS['__mock_file_exists'] = fn(string $path): bool => false;

        $result = Other::agentDetector();

        $this->assertFalse($result['status']);
        $this->assertNull($result['name']);
    }

    /** @test */
    function prioritizes_ai_agent_over_cursor_trace_id(): void
    {
        putenv('AI_AGENT=custom');
        putenv('CURSOR_TRACE_ID=trace');

        $result = Other::agentDetector();

        $this->assertSame('custom', $result['name']);
    }

    /** @test */
    function prioritizes_cursor_trace_id_over_cursor_agent(): void
    {
        putenv('CURSOR_TRACE_ID=trace');
        putenv('CURSOR_AGENT=true');

        $result = Other::agentDetector();

        $this->assertSame('cursor', $result['name']);
    }

    /** @test */
    function prioritizes_cursor_agent_over_claudecode(): void
    {
        putenv('CURSOR_AGENT=true');
        putenv('CLAUDECODE=1');

        $result = Other::agentDetector();

        $this->assertSame('cursor', $result['name']);
    }

    /** @test */
    function prioritizes_claudecode_over_repl_id(): void
    {
        putenv('CLAUDECODE=1');
        putenv('REPL_ID=some-id');

        $result = Other::agentDetector();

        $this->assertSame('claude', $result['name']);
    }

    /** @test */
    function ignores_empty_ai_agent(): void
    {
        putenv('AI_AGENT=');
        $GLOBALS['__mock_file_exists'] = fn(string $path): bool => false;

        $result = Other::agentDetector();

        $this->assertFalse($result['status']);
        $this->assertNull($result['name']);
    }

    /** @test */
    function ignores_whitespace_only_ai_agent(): void
    {
        putenv('AI_AGENT=   ');
        $GLOBALS['__mock_file_exists'] = fn(string $path): bool => false;

        $result = Other::agentDetector();

        $this->assertFalse($result['status']);
        $this->assertNull($result['name']);
    }

    /** @test */
    function trims_ai_agent_value(): void
    {
        putenv('AI_AGENT=  my-agent  ');

        $result = Other::agentDetector();

        $this->assertSame('my', $result['name']);
    }

    /** @test */
    function handles_ai_agent_with_special_characters(): void
    {
        putenv('AI_AGENT=my-agent/v2.0 (beta)');

        $result = Other::agentDetector();

        $this->assertTrue($result['status']);
        $this->assertSame('my-agent/v2.0 (beta)', $result['name']);
    }

    /** @test */
    function handles_ai_agent_with_name_upper(): void
    {
        putenv('AI_AGENT=AGENT_NAME');

        $result = Other::agentDetector();

        $this->assertTrue($result['status']);
        $this->assertSame('agent_name', $result['name']);
    }

    /**
     * @test
     * @dataProvider knownAgentsProvider
     */
    function returns_correct_enum_for_known_agents(string $envVar, string $envValue, string $expected): void
    {
        putenv("{$envVar}={$envValue}");

        $result = Other::agentDetector();

        $this->assertSame($expected, $result['name']);
    }

    public static function knownAgentsProvider(): \Generator
    {

        yield 'cursor'       => ['CURSOR_AGENT', '1', 'cursor'];
        yield 'gemini'       => ['GEMINI_CLI', 'true', 'gemini'];
        yield 'codex'        => ['CODEX_SANDBOX', 'true', 'codex'];
        yield 'codex_2'      => ['CODEX_CI', 'true', 'codex'];
        yield 'v0'           => ['AI_AGENT', 'v0', 'v0'];
        yield 'augment'      => ['AUGMENT_AGENT', 'true', 'augment'];
        yield 'opencode'     => ['OPENCODE_CLIENT', 'true', 'opencode'];
        yield 'amp'          => ['AMP_CURRENT_THREAD_ID', 'thread-id', 'amp'];
        yield 'copilot'      => ['COPILOT_CLI', '1', 'copilot'];
        yield 'claude'       => ['CLAUDECODE', '1', 'claude'];
        yield 'replit'       => ['REPL_ID', 'id', 'replit'];
        yield 'antigravity'  => ['ANTIGRAVITY_AGENT', '1', 'antigravity'];
        yield 'pi'           => ['PI_CODING_AGENT', 'true', 'pi'];
        yield 'kiro'         => ['KIRO_AGENT_PATH', '/usr/local/bin/kiro-cli', 'kiro'];
    }

    /** @test */
    function returns_false_is_agent_when_no_agent_detected(): void
    {
        $GLOBALS['__mock_file_exists'] = fn(string $path): bool => false;

        $result = Other::agentDetector();

        $this->assertFalse($result['status']);
        $this->assertNull($result['name']);
    }
}
