<?php

namespace App\Services\Formatters\Output;

use App\Lib\Timecode\Timecode;

class ClipVideo
{
    public $id;
    public $name;
    public $duration;
    public $standard;
    public $definition;
    public $description;
    public $start;
    public $end;
    public $reel_id;
    public function __construct($video)
    {
        $this->id = $video->id;
        $this->name = $video->name;
        $this->standard = $video->standard;
        $this->definition = $video->definition;
        $this->description = $video->description;
        $this->start = $video->start;
        $this->end = $video->end;
        $this->duration = $this->getDuration($video->duration);
        $this->reel_id = $video->reel_id;
    }

    private function getDuration($duration)
    {
        $timecode = Timecode::fromFrames($duration, $this->standard);
        return $timecode->timecode();
    }
}
