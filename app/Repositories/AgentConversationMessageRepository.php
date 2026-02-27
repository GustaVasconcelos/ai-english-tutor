<?php

namespace App\Repositories;

use App\Interfaces\AgentConversationMessageRepositoryInterface;
use App\Models\AgentConversationMessage;

class AgentConversationMessageRepository implements AgentConversationMessageRepositoryInterface
{
    public function getLastConversationByUserId(int $userId): ?AgentConversationMessage
    {
        return AgentConversationMessage::query()
            ->where('user_id', $userId)
            ->latest('id')
            ->first();
    }

    public function getAllConversationsByUserId(int $userId)
    {
        return AgentConversationMessage::query()
            ->where('user_id', $userId)
            ->orderBy('created_at', 'asc')
            ->get();
    }
}