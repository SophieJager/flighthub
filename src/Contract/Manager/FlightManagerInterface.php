<?php

namespace App\Contract\Manager;

use App\Entity\Flight;

interface FlightManagerInterface
{
    /**
     * @param Flight $flight
     * @param bool $flush
     * @return void
     */
    public function createOrUpdate(Flight $flight, bool $flush = true): void;
}
