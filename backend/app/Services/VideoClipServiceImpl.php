<?php

namespace App\Services;

use App\Repositories\VideoClipRepository;
use App\Services\BaseService;
use PHPUnit\Runner\Exception;

class VideoClipServiceImpl extends BaseService implements VideoClipService
{
    private $repo;

    public function __construct(VideoClipRepository $repo)
    {
        $this->repo = $repo;
    }

    public function create(int $reelId, array $args)
    {
        try {
            $reels = $this->repo->create($reelId, $args);
            return $this->formatResponse(self::SUCCESS, $reels);
        } catch (\PDOException $e) {
            return $this->formatResponse(self::DB_ERROR, null, $e->getMessage());
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
}
