<?php

namespace App\Lib\Timecode;


class PALTimecodeFromeString extends PALTimecode 
{
    public function __construct(string $timecode)
    {
      $frames = $this->convertToFrames($timecode, self::FPS);
      parent::__construct($frames);
    }
}
