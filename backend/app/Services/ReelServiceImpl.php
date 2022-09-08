<?php

namespace App\Services;

use App\Repositories\ReelRepository;
use App\Services\BaseService;
use App\Services\Formatters\Output\Reel;
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
            $reel = $this->repo->createReel($args);
            return $this->formatResponse(self::SUCCESS, $this->formatReel($reel));
        } catch (\PDOException $e) {
            return $this->formatResponse(self::DB_ERROR, null, $e->getMessage());
        } catch (Exception $e) {
            return $this->formatResponse(self::ERROR, null, $e->getMessage());
        }
    }

    public function listReels()
    {
        $reels = $this->repo->listReels();
        $formattedReels = [];
        foreach($reels as $reel) {
            $formattedReels[] = $this->formatReel($reel);
        }
        return $this->formatResponse(self::SUCCESS, $formattedReels);
    }

    public function getReel(int $reelId)
    {
        $reel = $this->repo->getReel($reelId);
        return $this->formatResponse(self::SUCCESS, $this->formatReel($reel));
    }

    private function formatReel($reel)
    {
        return new Reel((object) $reel);
    }
}
