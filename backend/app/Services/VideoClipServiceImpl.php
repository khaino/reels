<?php

namespace App\Services;

use App\Exceptions\ValidationError;
use App\Repositories\ReelRepository;
use App\Repositories\VideoClipRepository;
use App\Services\BaseService;
use App\Services\Formatters\Output\ClipVideo;
use PHPUnit\Runner\Exception;

class VideoClipServiceImpl extends BaseService implements VideoClipService
{
    private $repo;

    private $reelRepo;

    public function __construct(VideoClipRepository $repo, ReelRepository $reelRepo)
    {
        $this->repo = $repo;
        $this->reelRepo = $reelRepo;
    }

    public function create(int $reelId, array $args)
    {
        try {
            $this->validate($reelId, $args);
            $video = $this->repo->create($reelId, $args);
            return $this->formatResponse(self::SUCCESS, new ClipVideo($video));
        } catch (\PDOException $e) {
            return $this->formatResponse(self::DB_ERROR, null, $e->getMessage());
        } catch (ValidationError $e) {
            return $this->formatResponse(self::VALIDATION_ERROR, null, $e->getMessage());
        } catch (Exception $e) {
            return $this->formatResponse(self::ERROR, null, $e->getMessage());
        }
    }

    public function delete(int $reelId, int $id)
    {
        $ret = $this->repo->delete($reelId, $id);
        $args = ['id' => $id];
        if ($ret == 1) {
            return $this->formatResponse(self::SUCCESS, $args, 'deleted video');
        } else {
            return $this->formatResponse(self::ERROR, $args, 'failed to delete video');
        }
    }

    private function validate($reelId, $args)
    {
        $reel = $this->reelRepo->getReel($reelId);
        if ($reel->definition != $args['definition']) {
            throw new ValidationError('Video defination must be ' . $reel->definition);
        }

        if ($reel->standard != $args['standard']) {
            throw new ValidationError('Video standard must be ' . $reel->standard);
        }
    }

}
