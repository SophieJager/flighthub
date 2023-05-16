<?php

namespace App\Dto\Filter;

use App\Enum\TripTypeEnum;

class TripFilterDto extends AbstractTripFilterDto
{
    /**
     * @var \DateTimeImmutable|null
     */
    public $returnDate;
    /**
     * @var TripTypeEnum|null
     */
    public $tripType;

    public function __construct(
        ?string $airline = null,
        ?string $departureAirport = null,
        ?string $arrivalAirport = null,
        ?\DateTimeImmutable $date = null,
        ?\DateTimeImmutable $returnDate = null,
        ?TripTypeEnum $tripType = TripTypeEnum::ROUND_TRIP
    ) {
        parent::__construct($airline, $departureAirport, $arrivalAirport, $date);
        $this->returnDate = $returnDate;
        $this->tripType = $tripType;
    }
}
