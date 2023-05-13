<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Traits\CodeAndNameTrait;

/**
 * Class Airline
 * @package App\Entity
 * @ORM\Entity(repositoryClass="App\Repository\AirlineRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Airline extends AbstractEntity
{
    use CodeAndNameTrait;
}
