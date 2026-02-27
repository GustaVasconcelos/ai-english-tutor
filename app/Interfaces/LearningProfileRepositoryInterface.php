<?php

namespace App\Interfaces;

use App\Models\LearningProfile;

interface LearningProfileRepositoryInterface
{
    public function save(array $data): LearningProfile;

    public function get(): ?LearningProfile;
}