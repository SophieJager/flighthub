<?php

namespace App\Contract\Manager\Api;

use App\Entity\Api\Airport;

interface AirportManagerInterface
{
    /**
     * @param Airport $airport
     * @param bool $flush
     * @return void
     */
    public function createOrUpdate(Airport $airport, bool $flush = true): void;
}
