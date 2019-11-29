<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MemberRepository")
 */
class Member
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $membername;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $cityname;

    public function getId()
    {
        return $this->id;
    }

    public function getMembername(): ?string
    {
        return $this->membername;
    }

    public function setMembername(?string $membername): self
    {
        $this->membername = $membername;

        return $this;
    }

    public function getCityname(): ?string
    {
        return $this->cityname;
    }

    public function setCityname(?string $cityname): self
    {
        $this->cityname = $cityname;

        return $this;
    }
}
