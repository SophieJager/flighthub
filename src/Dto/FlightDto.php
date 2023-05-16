<?php

namespace App\Dto;

class FlightDto
{
    /**
     * @var string|null
     */
    public $airline;
    /**
     * @var int|null
     */
    public $number;
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
    public $departureDateTime;
    /**
     * @var \DateTimeImmutable|null
     */
    public $arrivalDateTime;
    /**
     * @var float|null
     */
    public $price;

    public function __construct(
        ?string $airline,
        ?int $number,
        ?string $departureAirport,
        ?string $arrivalAirport,
        ?\DateTimeImmutable $arrivalDateTime,
        ?\DateTimeImmutable $departureDateTime,
        ?float $price
    ) {
        $this->airline = $airline;
        $this->number = $number;
        $this->departureAirport = $departureAirport;
        $this->arrivalAirport = $arrivalAirport;
        $this->arrivalDateTime = $arrivalDateTime;
        $this->departureDateTime = $departureDateTime;
        $this->price = $price;
    }
}
