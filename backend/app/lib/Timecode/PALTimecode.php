<?php

namespace App\Lib\Timecode;

class PALTimecode extends Timecode
{
    protected const FPS = 25;
    public function __construct(int $frames)
    {
        parent::__construct($frames, self::FPS);
    }
    public function timecode()
    {
        return $this->convertToTimecode($this->frames, self::FPS);
    }
}
