<?php

namespace App\Repositories;

interface ReelRepository
{
    public function createReel(array $args);
    public function listReels();
    public function getReel(int $reelId);
}
