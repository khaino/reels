<?php

namespace App\Repositories;

use App\Models\Reel;
use Illuminate\Support\Facades\DB;

class ReelRepositoryImpl implements ReelRepository
{
    private $videoRepo;
    public function __construct(VideoClipRepository $videoRepo)
    {
        $this->videoRepo = $videoRepo;
    }
    public function createReel(array $args)
    {
        try {
            DB::beginTransaction();

            $reelArgs = $this->formatReelArgs($args);
            $reel = Reel::create($reelArgs);
            $this->videoRepo->create($reel->id, $args['video']);

            DB::commit();

            return $this->getReel($reel->id);
        } catch (\PDOException $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function getReel(int $reelId)
    {
        return Reel::with($this->videoQuery())
            ->where('id', $reelId)
            ->first();
    }

    public function listReels()
    {
        return Reel::with($this->videoQuery())
            ->orderBy('id', 'DESC')
            ->get();
    }

    private function videoQuery()
    {
        return ['clipVideos' => function ($query) {
            $query->where('is_active', true);
            $query->orderBy('created_at', 'asc');
        }];
    }

    private function formatReelArgs(array $args)
    {
        return [
            'name' => $args['name'],
            'standard' => $args['video']['standard'],
            'definition' => $args['video']['definition'],
        ];
    }
}
