<?php

namespace App\Contract\Manager;

use App\Dto\Filter\TripFilterDto;
use App\Entity\Flight;
use Doctrine\Common\Collections\Collection;

interface FlightManagerInterface
{
    /**
     * @param Flight $flight
     * @param bool $flush
     * @return void
     */
    public function createOrUpdate(Flight $flight, bool $flush = true): void;

    /**
     * @param TripFilterDto $dto
     * @return ?Flight
     */
    public function findOneWithFilters(TripFilterDto $dto): ?Flight;

    /**
     * @param TripFilterDto $dto
     * @return Collection|Flight[]
     */
    public function findRoundTripWithFilters(TripFilterDto $dto): Collection;
}
