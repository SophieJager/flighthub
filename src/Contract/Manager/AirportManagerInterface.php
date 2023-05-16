<?php

namespace App\Contract\Manager;

use App\Entity\Airport;

interface AirportManagerInterface
{
    /**
     * @param Airport $airport
     * @param bool $flush
     * @return void
     */
    public function createOrUpdate(Airport $airport, bool $flush = true): void;
}
