<?php

namespace App\Contract\Service;

use App\Dto\Filter\TripFilterDto;
use App\Entity\Api\Trip;
use Doctrine\Common\Collections\Collection;

interface TripServiceInterface
{
    /**
     * @param TripFilterDto $dto
     * @return Collection|Trip[]
     */
    public function findTrips(TripFilterDto $dto): Collection;
}
