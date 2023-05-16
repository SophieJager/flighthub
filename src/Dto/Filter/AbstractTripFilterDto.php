<?php

namespace App\Dto\Filter;

use App\Enum\TripTypeEnum;

abstract class AbstractTripFilterDto
{
    /**
     * @var string|null
     */
    public $airline;
    /**
     * @var string|null
     */
    public $departureAirport;
    /**
     * @var string|null
     */
    public $arrivalAirport;
    /**
     * @var \DateTimeImmutable|null
     */
    public $date;

    public function __construct(
        ?string $airline,
        ?string $departureAirport,
        ?string $arrivalAirport,
        ?\DateTimeImmutable $date
    ) {
        $this->airline = $airline;
        $this->arrivalAirport = $arrivalAirport;
        $this->departureAirport = $departureAirport;
        $this->date = $date;
    }
}
