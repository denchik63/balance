<?php

namespace App\Model\BalanceHistory;

use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

class User
{
    /**
     * @var int
     *
     * @Assert\NotBlank()
     * @Assert\Type(type="integer")
     * @Assert\GreaterThan(value="0", message="Param has invalid type or 0 or less")
     * @Serializer\Type("int")
     */
    private $id;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }
}