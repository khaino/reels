<?php

namespace App\Repositories;

interface VideoClipRepository
{
    public function create(int $reelId, array $args);
    public function delete(int $reelId, int $id);
}
