<?php

namespace App\Services;

use App\Interfaces\LearningProfileRepositoryInterface;
use App\Models\LearningProfile;

class SetupService
{
    public function __construct(
        protected LearningProfileRepositoryInterface $repository
    ) {}

    public function save(array $data): LearningProfile
    {
        return $this->repository->save($data);
    }

    public function get(): ?LearningProfile
    {
        return $this->repository->get();
    }
}