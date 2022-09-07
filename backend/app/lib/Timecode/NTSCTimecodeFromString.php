<?php

namespace App\Lib\Timecode;


class NTSCTimecodeFromString extends NTSCTimecode
{
    public function __construct(string $timecode)
    {
      $frames = $this->convertToFrames($timecode, self::FPS);
      parent::__construct($frames);
    }
}
