<?php

namespace App\Services\Formatters\Output;

use App\Lib\Timecode\Timecode;

class Reel
{
    public $name;
    public $duration;
    public $standard;
    public $definition;
    public $clip_videos;
    public function __construct($reel)
    {
        $this->name = $reel->name;
        $this->standard = $reel->standard;
        $this->definition = $reel->definition;
        $this->duration = $this->getDuration($reel->clipVideos);
        $this->clip_videos = $this->formatVideos($reel->clipVideos);
    }

    private function formatVideos($videos)
    {
        $formattedVideos = [];
        foreach ($videos as $video) {
            $formattedVideos[] = new ClipVideo($video);
        }

        return $formattedVideos;
    }

    private function getDuration($videos)
    {
        $totalDuration = 0;
        foreach ($videos as $video) {
            $totalDuration += $video->duration;
        }
        $timecode = Timecode::fromFrames($totalDuration, $this->standard);
        return $timecode->timecode();
    }
}
