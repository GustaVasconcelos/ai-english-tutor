<?php

namespace App\Interfaces;

use App\Models\AgentConversationMessage;

interface AgentConversationMessageRepositoryInterface
{
    public function getLastConversationByUserId(int $userId): ?AgentConversationMessage;

    public function getAllConversationsByUserId(int $userId);
}