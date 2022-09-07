<?php

namespace App\Services;

interface ReelService
{
    function create(array $args);
    public function listReels();
    public function getReel(int $reelId);
}
