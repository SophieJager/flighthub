<?php

namespace App\Contract\Manager\Api;

use App\Entity\Api\Airline;

interface AirlineManagerInterface
{
    /**
     * @param Airline $airline
     * @param bool $flush
     * @return void
     */
    public function createOrUpdate(Airline $airline, bool $flush = true): void;
}
