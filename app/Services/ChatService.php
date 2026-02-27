<?php

namespace App\Services;

use App\Ai\Agents\ChatAgent;
use App\Interfaces\LearningProfileRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\AgentConversationMessageRepositoryInterface;
use Exception;
use App\Models\User;
use App\Models\LearningProfile;

class ChatService
{
    public function __construct(
        protected LearningProfileRepositoryInterface $profileRepository,
        protected AgentConversationMessageRepositoryInterface $agentConversationMessageRepository,
        protected UserRepositoryInterface $userRepository,
        protected ChatAgent $agent
    ) {}

    public function send(string $message): string
    {
        $user = $this->getUser();
        $profile = $this->getProfile();
        $agent = $this->getAgentForUserWithHistory($user);
        $prompt = $this->buildPromptForUser($message, $profile);
        return $this->sendPrompt($agent, $prompt);
    }

    public function listUserConversations()
    {
        $user = $this->getUser(); 
        return $this->agentConversationMessageRepository->getAllConversationsByUserId($user->id);
    }

    private function getProfile(): LearningProfile
    {
        $profile = $this->profileRepository->get();

        if (!$profile) throw new Exception('Configuração inicial não encontrada. Execute o setup primeiro.');

        return $profile;
    }

    private function getUser(): ?User
    {
        $user = $this->userRepository->get();

        if (!$user) throw new Exception('Usuário não encontrado.');

        return $user;
    }

    private function getAgentForUserWithHistory($user)
    {
        $agent = $this->agent->forUser($user);
        return $this->applyLastConversation($agent, $user);
    }

    private function applyLastConversation($agent, $user)
    {
        $lastConversationId = $this->agentConversationMessageRepository
            ->getLastConversationByUserId($user->id)?->conversation_id;

        return $lastConversationId ? $agent->continue($lastConversationId, $user) : $agent;
    }

    private function buildPromptForUser(string $message, $profile): string
    {
        return $this->agent->buildPrompt(
            message: $message,
            level: $profile->level,
            language: $profile->explanation_language,
            correctAlways: $profile->correct_always
        );
    }

    private function sendPrompt($agent, string $prompt): string
    {
        $response = $agent->prompt($prompt);
        return (string) $response;
    }
}