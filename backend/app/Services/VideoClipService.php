<?php

namespace App\Services;

interface VideoClipService
{
    function create(int $reelId, array $args);
    function delete(int $reelId, int $id);
}
