<?php

namespace App\Repositories;

use App\Interfaces\LearningProfileRepositoryInterface;
use App\Models\LearningProfile;

class LearningProfileRepository implements LearningProfileRepositoryInterface
{
    public function save(array $data): LearningProfile
    {
        return LearningProfile::updateOrCreate(
            ['id' => 1],
            $data
        );
    }

    public function get(): ?LearningProfile
    {
        return LearningProfile::query()->find(1);
    }
}