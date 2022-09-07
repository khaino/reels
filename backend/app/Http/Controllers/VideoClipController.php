<?php

namespace App\Http\Controllers;

use App\Services\VideoClipService;
use Illuminate\Http\Request;

class VideoClipController extends Controller
{
    private $videoClipService;
    public function __construct(VideoClipService $videoClipService)
    {
        $this->videoClipService = $videoClipService;
    }

    public function create(int $reelId, Request $request)
    {
        return $this->videoClipService->create($reelId, $request->all());
    }

    public function delete(int $reelId, int $id)
    {
        return $this->videoClipService->delete($reelId, $id);
    }
}
