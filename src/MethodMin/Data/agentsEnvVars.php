<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Data;

function agentsEnvVars():\Generator{yield 'cline'=>['CLINE_ACTIVE'];yield 'trae'=>['TRAE_AI_SHELL_ID'];yield 'cursor'=>['CURSOR_AGENT','CURSOR_TRACE_ID'];yield 'gemini'=>['GEMINI_CLI'];yield 'codex'=>['CODEX_SANDBOX','CODEX_THREAD_ID','CODEX_CI'];yield 'augment'=>['AUGMENT_AGENT'];yield 'opencode'=>['OPENCODE_CLIENT','OPENCODE','OPENCODE_CALLER'];yield 'amp'=>['AMP_CURRENT_THREAD_ID'];yield 'cowork'=>['CLAUDE_CODE_IS_COWORK'];yield 'claude'=>['CLAUDECODE','CLAUDE_CODE'];yield 'replit'=>['REPL_ID'];yield 'copilot'=>['COPILOT_CLI','COPILOT_MODEL','COPILOT_ALLOW_ALL','COPILOT_GITHUB_TOKEN'];yield 'antigravity'=>['ANTIGRAVITY_AGENT'];yield 'goose'=>['GOOSE_PROVIDER'];}