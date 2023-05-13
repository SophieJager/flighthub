<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Uid\Uuid;

/**
 * Class AbstactEntity
 * @package App\Entity
 * @ORM\HasLifecycleCallbacks()
 */
abstract class AbstractEntity
{
    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *
     * @Groups({"none"})
     */
    protected $id;

    /**
     * @var string
     * @ORM\GeneratedValue()
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\CustomIdGenerator(class="doctrine.uuid_generator")
     *
     * @Groups({"READ"})
     */
    protected $uuid;

    public function __construct()
    {
        $this->uuid = Uuid::v4();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }
}
