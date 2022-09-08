<?php

namespace App\Services;

interface ReelService
{
    public function create(array $args);
    public function listReels();
    public function getReel(int $reelId);
}
