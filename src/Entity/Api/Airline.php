<?php

namespace App\Entity\Api;

use App\Entity\AbstractEntity;
use App\Traits\CodeAndNameTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Airline
 * @package App\Entity\Api
 * @ORM\Entity(repositoryClass="App\Repository\Api\AirlineRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Airline extends AbstractEntity
{
    use CodeAndNameTrait;
}
