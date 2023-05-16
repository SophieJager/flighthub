<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Traits\CodeAndNameTrait;

/**
 * Class Airport
 * @package App\Entity
 * @ORM\Entity(repositoryClass="App\Repository\AirportRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Airport extends AbstractEntity
{
    use CodeAndNameTrait;

    /**
     * @var City
     * @ORM\ManyToOne(targetEntity="App\Entity\City")
     * @ORM\JoinColumn(nullable=false)
     */
    private $city;

    /**
     * @var float
     * @ORM\Column(type="float", nullable="false")
     */
    private $latitude;

    /**
     * @var float
     * @ORM\Column(type="float", nullable="false")
     */
    private $longitude;

    /**
     * @var string
     * @ORM\Column(type="string", nullable="false")
     */
    private $timezone;

    /**
     * @return City
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param City $cityCode
     * @return $this
     */
    public function setCity(City $cityCode)
    {
        $this->city = $cityCode;

        return $this;
    }

    /**
     * @return float
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param float $latitude
     * @return $this
     */
    public function setLatitude(float $latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * @return float
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param float $longitude
     * @return $this
     */
    public function setLongitude(float $longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * @return string
     */
    public function getTimezone()
    {
        return $this->timezone;
    }

    /**
     * @param string $timezone
     * @return $this
     */
    public function setTimezone(string $timezone)
    {
        $this->timezone = $timezone;

        return $this;
    }
}
