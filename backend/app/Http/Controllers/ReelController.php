<?php

namespace App\Http\Controllers;

use App\Services\ReelService;
use Illuminate\Http\Request;

class ReelController extends Controller
{
    private $reelService;
    public function __construct(ReelService $reelService)
    {
        $this->reelService = $reelService;
    }

    public function create(Request $request)
    {
        return $this->reelService->create($request->all());
    }

    public function listReels()
    {
        return $this->reelService->listReels();
    }

    public function getReel(string $reelId)
    {
        return $this->reelService->getReel($reelId);
    }
}
