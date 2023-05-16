<?php

declare(strict_types=1);

namespace App\Traits;

use Doctrine\ORM\Mapping as ORM;

trait CodeAndNameTrait
{
    /**
     * @var string
     * @ORM\Column(type="string", nullable="false", unique="true")
     */
    private $code;

    /**
     * @var string
     * @ORM\Column(type="string", nullable="false")
     */
    private $name;

    public function __ToString()
    {
        return $this->getName();
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     * @return $this
     */
    public function setCode(string $code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }
}
