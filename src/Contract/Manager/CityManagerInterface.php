<?php

namespace App\Contract\Manager;

use App\Entity\City;

interface CityManagerInterface
{
    /**
     * @param City $city
     * @param bool $flush
     * @return void
     */
    public function createOrUpdate(City $city, bool $flush = true): void;
}
