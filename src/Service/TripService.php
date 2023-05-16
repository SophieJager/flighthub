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

        $flights = $this->getDirectFlights($dto);
        $price = 0;
        foreach ($flights as $flight) {
            $price += $flight->price;
        }

        $trips->add(new Trip($price, $flights));
        return $trips;
    }

    /**
     * @param TripFilterDto $dto
     * @return Collection|FlightDto[]
     */
    private function getDirectFlights(TripFilterDto $dto): Collection
    {
        $flights = new ArrayCollection();
        $f = $this->getDirectFlight(
            $dto->airline,
            $dto->date,
            $dto->departureAirport,
            $dto->arrivalAirport
        );
        if ($f === null) {
            return new ArrayCollection();
        }
        $flights->add($f);

        if ($dto->tripType === TripTypeEnum::ROUND_TRIP) {
            $returnFlight = $this->getDirectFlight(
                $dto->airline,
                $dto->returnDate,
                $dto->arrivalAirport,
                $dto->departureAirport
            );
            if ($returnFlight === null) {
                return new ArrayCollection();
            }
            $flights->add($returnFlight);
        }
        return $flights;
    }

    /**
     * @param string|null $airline
     * @param DateTimeImmutable|null $departureDate
     * @param string|null $departureAirport
     * @param string|null $arrivalAirport
     * @return FlightDto|null
     */
    private function getDirectFlight(
        ?string $airline,
        ?DateTimeImmutable $departureDate,
        ?string $departureAirport,
        ?string $arrivalAirport
    ): ?FlightDto {
        $flightFilter = new FlightFilterDto(
            $airline,
            $departureAirport,
            $arrivalAirport,
            $departureDate
        );

        $flight = $this->manager->findOneWithFilters($flightFilter);
        if ($flight === null) {
            return null;
        }

        return $this->transformToFlightDto($flight);
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
