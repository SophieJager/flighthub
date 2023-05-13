<?php

namespace App\Entity\Api;

use App\Entity\AbstractEntity;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Flight
 * @package App\Entity\Api
 * @ORM\Entity(repositoryClass="App\Repository\Api\FlightRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Flight extends AbstractEntity
{
    /**
     * @var Airline
     * @ORM\ManyToOne(targetEntity="App\Entity\Api\Airline")
     * @ORM\JoinColumn(nullable=false)
     */
    private $airline;
    /**
     * @var int
     * @ORM\Column(type="integer", nullable="false")
     */
    private $number;
    /**
     * @var Airport
     * @ORM\ManyToOne(targetEntity="App\Entity\Api\Airport")
     * @ORM\JoinColumn(nullable=false)
     */
    private $departureAirport;
    /**
     * @var DateTimeImmutable
     * @ORM\Column(type="datetimetz_immutable")
     */
    private $departureTime;
    /**
     * @var Airport
     * @ORM\ManyToOne(targetEntity="App\Entity\Api\Airport")
     * @ORM\JoinColumn(nullable=false)
     */
    private $arrivalAirport;
    /**
     * @var DateTimeImmutable
     * @ORM\Column(type="datetimetz_immutable")
     */
    private $arrivalTime;
    /**
     * @var float
     * @ORM\Column(type="float", nullable="false")
     */
    private $price;

    /**
     * @return Airline
     */
    public function getAirline()
    {
        return $this->airline;
    }

    /**
     * @param Airline $airline
     * @return Flight
     */
    public function setAirline(Airline $airline)
    {
        $this->airline = $airline;
        return $this;
    }

    /**
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param int $number
     * @return Flight
     */
    public function setNumber(int $number)
    {
        $this->number = $number;
        return $this;
    }

    /**
     * @return Airport
     */
    public function getDepartureAirport()
    {
        return $this->departureAirport;
    }

    /**
     * @param Airport $departureAirport
     * @return Flight
     */
    public function setDepartureAirport(Airport $departureAirport)
    {
        $this->departureAirport = $departureAirport;
        return $this;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getDepartureTime()
    {
        return $this->departureTime;
    }

    /**
     * @param DateTimeImmutable $departureTime
     * @return Flight
     */
    public function setDepartureTime(DateTimeImmutable $departureTime)
    {
        $this->departureTime = $departureTime;
        return $this;
    }

    /**
     * @return Airport
     */
    public function getArrivalAirport()
    {
        return $this->arrivalAirport;
    }

    /**
     * @param Airport $arrivalAirport
     * @return Flight
     */
    public function setArrivalAirport(Airport $arrivalAirport)
    {
        $this->arrivalAirport = $arrivalAirport;
        return $this;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getArrivalTime()
    {
        return $this->arrivalTime;
    }

    /**
     * @param DateTimeImmutable $arrivalTime
     * @return Flight
     */
    public function setArrivalTime(DateTimeImmutable $arrivalTime)
    {
        $this->arrivalTime = $arrivalTime;
        return $this;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
     * @return Flight
     */
    public function setPrice(float $price)
    {
        $this->price = $price;
        return $this;
    }
}
