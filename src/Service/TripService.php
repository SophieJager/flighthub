<?php

namespace App\Service;

use App\Contract\Manager\FlightManagerInterface;
use App\Contract\Service\TripServiceInterface;
use App\Dto\Filter\FlightFilterDto;
use App\Dto\FlightDto;
use App\Dto\Filter\TripFilterDto;
use App\Entity\Api\Trip;
use App\Entity\Flight;
use App\Enum\TripTypeEnum;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class TripService implements TripServiceInterface
{
    private FlightManagerInterface $manager;

    public function __construct(FlightManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * {@inheritDoc}
     */
    public function findTrips(TripFilterDto $dto): Collection
    {
        $trips = new ArrayCollection();
        $price = 0;
        $flightsDto = new ArrayCollection();
        if ($dto->tripType === TripTypeEnum::ROUND_TRIP) {
            $flights = $this->manager->findRoundTripWithFilters($dto);
            foreach ($flights as $flight) {
                $flightDto = $this->transformToFlightDto($flight);
                $price += $flightDto->price;
                $flightsDto->add($flightDto);
            }
        } else {
            $flight = $this->manager->findOneWithFilters($dto);
            if ($flight === null) {
                return $trips;
            }
            $flightDto = $this->transformToFlightDto($flight);
            /** @var float $price */
            $price = $flightDto->price;
            $flightsDto->add($flightDto);
        }

        $trips->add(new Trip($price, $flightsDto));
        return $trips;
    }

    /**
     * @param Flight $flight
     * @return FlightDto
     */
    private function transformToFlightDto(Flight $flight): FlightDto
    {
        return new FlightDto(
            $flight->getAirline()->getCode(),
            $flight->getNumber(),
            $flight->getDepartureAirport()->getCode(),
            $flight->getArrivalAirport()->getCode(),
            $flight->getArrivalTime(),
            $flight->getDepartureTime(),
            $flight->getPrice()
        );
    }
}
