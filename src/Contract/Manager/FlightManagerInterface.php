<?php

namespace App\Contract\Manager;

use App\Dto\Filter\FlightFilterDto;
use App\Entity\Flight;

interface FlightManagerInterface
{
    /**
     * @param Flight $flight
     * @param bool $flush
     * @return void
     */
    public function createOrUpdate(Flight $flight, bool $flush = true): void;

    /**
     * @param FlightFilterDto $dto
     * @return ?Flight
     */
    public function findOneWithFilters(FlightFilterDto $dto): ?Flight;
}
