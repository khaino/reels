<?php

namespace App\Lib\Timecode;

abstract class Timecode implements TimecodeInterface
{
    protected const SEC_IN_MINUTE = 60;
    protected const SEC_IN_HOUR = self::SEC_IN_MINUTE * 60;
    protected const INDEX_FRAME = 3;
    protected const INDEX_SEC = 2;
    protected const INDEX_MINUTE = 1;
    protected const INDEX_HOUR = 0;

    protected const DELIMITER = ":";

    protected const PAL = 'PAL';
    protected const NTSC = 'NTSC';

    protected $frames;
    protected $fps;

    protected function __construct(int $frames, int $fps)
    {
        $this->frames = $frames;
        $this->fps = $fps;
    }

    protected function convertToTimecode(int $frames, int $fps)
    {
        $hrs = abs($frames / (self::SEC_IN_HOUR * $fps));
        $frames = $frames % (self::SEC_IN_HOUR * $fps);
        $mins = abs($frames / (self::SEC_IN_MINUTE * $fps));
        $frames = $frames % (self::SEC_IN_MINUTE * $fps);
        $secs = abs($frames / $fps);
        $frames = $frames % $fps;
        return sprintf("%02d", $hrs) . self::DELIMITER
        . sprintf("%02d", $mins) . self::DELIMITER
        . sprintf("%02d", $secs) . self::DELIMITER
        . sprintf("%02d", $frames);
    }

    protected function convertToFrames(string $timecode, int $fps)
    {
        $strCodes = explode(self::DELIMITER, $timecode);
        $intCodes = array_map(function ($aStr) {
            return (int) $aStr;
        }, $strCodes);

        $frames = $intCodes[self::INDEX_FRAME];
        $frames = $frames + $intCodes[self::INDEX_SEC] * $fps;
        $frames = $frames + $intCodes[self::INDEX_MINUTE] * self::SEC_IN_MINUTE * $fps;
        $frames = $frames + $intCodes[self::INDEX_HOUR] * self::SEC_IN_HOUR * $fps;
        return $frames;
    }
    public function frames()
    {
        return $this->frames;
    }

    public static function fromString(string $timecode, string $standard)
    {
        if ($standard == self::PAL) {
            return new PALTimecodeFromeString($timecode);
        } elseif ($standard == self::NTSC) {
            return new NTSCTimecodeFromString($timecode);
        } else {
            throw new \Exception($standard . ' video standard not supported');
        }
    }

    public static function fromFrames(int $frames, string $standard)
    {
        if ($standard == self::PAL) {
            return new PALTimecode($frames);
        } elseif ($standard == self::NTSC) {
            return new NTSCTimecode($frames);
        } else {
            throw new \Exception($standard . ' video standard not supported');
        }
    }
}
