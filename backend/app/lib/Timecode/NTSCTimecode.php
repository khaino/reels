<?php

namespace App\Lib\Timecode;

class NTSCTimecode extends Timecode
{
    protected const FPS = 30;
    public function __construct(int $frames)
    {
        parent::__construct($frames, self::FPS);
    }

    public function timecode()
    {
        return $this->convertToTimecode($this->frames, self::FPS);
    }
}
