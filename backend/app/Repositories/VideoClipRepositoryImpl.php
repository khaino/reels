<?php

namespace App\Repositories;

use App\Lib\Timecode\Timecode;
use App\Models\VideoClip;

class VideoClipRepositoryImpl implements VideoClipRepository
{
    public function create(int $reelId, array $args)
    {
        $duration = $this->getDuration($args['start'], $args['end'], $args['standard']);
        $videoArgs = array_merge([
            'reel_id' => $reelId,
            'duration' => $duration,
        ], $args);
        return VideoClip::create($videoArgs);
    }

    public function delete(int $reelId, int $id)
    {
        return VideoClip::where('id', $id)
            ->where('reel_id', $reelId)
            ->update(['is_active' => false]);
    }

    private function getDuration(string $start, string $end, string $standard)
    {
        $start = Timecode::fromString($start, $standard);
        $end = Timecode::fromString($end, $standard);
        return $end->frames() - $start->frames();
    }

}
