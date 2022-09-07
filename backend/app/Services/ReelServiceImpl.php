<?php

namespace App\Services;

use App\Repositories\ReelRepository;
use App\Services\BaseService;
use PHPUnit\Runner\Exception;

class ReelServiceImpl extends BaseService implements ReelService
{
    private $repo;

    public function __construct(ReelRepository $repo)
    {
        $this->repo = $repo;
    }

    public function create(array $args)
    {
        try {
            $reels = $this->repo->createReel($args);
            return $this->formatResponse(self::SUCCESS, $reels);
        } catch (\PDOException $e) {
            return $this->formatResponse(self::DB_ERROR, null, $e->getMessage());
        } catch (Exception $e) {
            return $this->formatResponse(self::ERROR, null, $e->getMessage());
        }
    }

    public function listReels()
    {
        $reels = $this->repo->listReels();
        return $this->formatResponse(self::SUCCESS, $reels);
    }

    public function getReel(int $reelId)
    {
        $reel = $this->repo->getReel($reelId);
        return $this->formatResponse(self::SUCCESS, $reel);
    }
}
