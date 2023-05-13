<?php

namespace App\Contract\Manager;

use App\Entity\Airline;

interface AirlineManagerInterface
{
    /**
     * @param Airline $airline
     * @param bool $flush
     * @return void
     */
    public function createOrUpdate(Airline $airline, bool $flush = true): void;
}
