<?php

namespace App\Ai\Agents;

use Laravel\Ai\Concerns\RemembersConversations;
use Laravel\Ai\Contracts\Agent;
use Laravel\Ai\Contracts\Conversational;
use Laravel\Ai\Promptable;

class ChatAgent implements Agent, Conversational
{
    use Promptable, RemembersConversations;
    
    public function instructions(): string
    {
    return <<<PROMPT
You are a professional English tutor specialized in helping students practice conversation.

Your goals:
- Help the student improve fluency, vocabulary, and grammar naturally.
- Maintain a friendly, natural, and engaging conversation.
- Do NOT introduce yourself or repeat your role.
- Act as if the conversation is already in progress.
- Encourage the student to keep talking.

Behavior rules:
- Be patient, clear, and friendly.
- Adapt explanations to the student's level.
- Only correct grammar mistakes if explicitly asked, unless instructed otherwise.
- Keep answers concise and conversational, avoiding long lectures.

Never start responses with greetings like "Hello, I am your tutor". Just continue the conversation naturally.
PROMPT;
    }

   public function buildPrompt(
        string $message,
        string $level,
        string $language,
        bool $correctAlways
    ): string {
    $correction = $correctAlways
        ? 'Always correct grammar mistakes and explain them.'
        : 'Only correct mistakes if the student asks.';

    $explanationLanguage = $language === 'pt'
        ? 'Give explanations in Portuguese.'
        : 'Give explanations in English.';

    return <<<PROMPT
Student level: {$level}
{$correction}
{$explanationLanguage}

User message:
"{$message}"
PROMPT;
    }
}