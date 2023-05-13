<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Traits\CodeAndNameTrait;

/**
 * Class City
 * @package App\Entity
 * @ORM\Entity(repositoryClass="App\Repository\CityRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class City extends AbstractEntity
{
    use CodeAndNameTrait;

    /**
     * @var string
     * @ORM\Column(type="string", nullable="false")
     */
    private $countryCode;

    /**
     * @var string
     * @ORM\Column(type="string", nullable="false")
     */
    private $regionCode;

    /**
     * @return string
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * @param string $countryCode
     * @return City
     */
    public function setCountryCode(string $countryCode)
    {
        $this->countryCode = $countryCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getRegionCode()
    {
        return $this->regionCode;
    }

    /**
     * @param string $regionCode
     * @return City
     */
    public function setRegionCode(string $regionCode)
    {
        $this->regionCode = $regionCode;
        return $this;
    }
}
